<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StandardCode;
use App\Product;
use App\Customer;
use App\PurchaseOrder;
use App\PurchaseOrderDt;
use App\PurchaseRequestVendorDt;
use App\vPurchaseOrder;
use App\vPurchaseOrderDt;
use App\SendOrderPo;
use App\Invoice;
use App\Bank;
use App\vInvoice;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use  DB;
use Config;
use App\vPurchaseRequestVendor;
class OrderController extends Controller
{
    //
    public function index(){

        $PurchaseOrder=  vPurchaseOrder::orderBy('id', 'DESC')->paginate(20);
        $back = false;
        $data = array(
            "purchaseOrders"=> $PurchaseOrder,
            "back"=> $back,
        );
        return view('order.index', $data);
    }
    public function search(Request $request){
        
        $keyword = $request->keyword;
        $back = true;
        $PurchaseOrder=  vPurchaseOrder::WHERE("purchase_order_no", $keyword)
            ->orderBy('id', 'DESC')->paginate(20);
        $data = array(
            "purchaseOrders"=> $PurchaseOrder,
            "back"=> $back,
        );
        return view('order.index', $data);
    }
    public function view($id){
        $PurchaseOrder=  vPurchaseOrder::where('id', '=', $id)->first();
        $orderdt=  vPurchaseOrderDt::where('purchase_order_id', '=', $id )->get();

        //inprogress
        $prdata = vPurchaseRequestVendor::WHERE("purchase_order_id","=", $id)->get();
        
        //data kiriim 
        $sendpo = SendOrderPo::WHERE("purchase_order_id","=", $id)
        ->whereNull("deleted_at")->get();
        
        //invoice
        $inv = vInvoice::WHERE("purchase_order_id", "=", $id)->first();
        
        if($inv != null){
            $formInv  = $inv;
        }else{
            $invdata = array(
                "id"=>"",
                "inv_no"=>"",
                "inv_date"=>date("Y-m-d"),
                "bank_id"=>"",
                "purchase_order_id"=>"",
                "date_payment"=>"",
                "bank_name"=>"",
                "rek_no"=>"",
                "ref_no"=>"",
                "total_payment"=>"0",
                "notes"=>"",
                "sc_statuspayment"=>"",
                "deleted_at"=>"",
                "created_at"=>"",
                "updated_at"=>"",
                "statuspayment"=>"",
                "total_inv"=>"0",
                "customer_name"=>"",
            );

            $formInv  = json_decode(json_encode($invdata), FALSE);
        }

        // bank 
        $bank = Bank::whereNull("deleted_at")->get();

        //standard_codes
        $sc_payment = StandardCode::where("parent_id", 11)->get(); //status 

        $data = array(
            "data"=> $PurchaseOrder,
            "orders"=> $orderdt,
            "prdatas"=>$prdata , 
            "sendpo"=>$sendpo,
            "formInv"=>$formInv,
            "bank"=>$bank,
            "sc_payment"=> $sc_payment
        );
       
        return view('order.detail_po', $data);
    }
     
    public function  order_add(){
        $customers = Customer::whereNull("deleted_at")
        ->get();  

        $colors = StandardCode::where("parent_id", "=", "1")
        ->whereNull("deleted_at")
        ->get();

        $products = Product::whereNull("deleted_at")
        ->get();
        
        $datenow = Date("Y-m-d");

        $data = array(
            "customers"=>$customers,
            "colors"=>$colors,
            "products"=> $products,
            "datenow"=> $datenow
        );
        return view('order.form_new_order', $data);
    }

    public function AtrAddFormProduct(){
        
        $colors= StandardCode::where("parent_id", "=", "1")
        ->whereNull("deleted_at")
        ->get();

        $products= Product::whereNull("deleted_at")
        ->get();

      
        $data = array(
            "colors"=>$colors,
            "products"=> $products,
            
        );
        return view('order.atribute.form_add_product', $data);
    }

    public function updateStatus(Request $request){
        $request->validate([
            'id' => 'required',
            'type' => 'required',
        ]);

        DB::beginTransaction();
        try{
            $id = $request->input('id') ;
            if($request->input('type') == 'approve'){
                $sc_status_orderid = Config::get('constants.status_po.approve');  
                $prefix = (string) "INV/".date("Ymd")."/"; 
                $invno =  IdGenerator::generate(['table' => 'invoices', 'field'=>'inv_no', 'length' =>17, 'prefix' =>$prefix]);
                
                //create invoice
               
                $invoice = new Invoice;
                $invoice->inv_no = $invno;
                $invoice->bank_id =0;
                $invoice->inv_date = date("Y-m-d H:i:s");
                $invoice->purchase_order_id = $id;
                $invoice->sc_statuspayment =  Config::get('constants.invoice_status.belum_lunas');
                $invoice->created_at= date("Y-m-d H:i:s");

                $invoice->save();

            }elseif($request->input('type') == 'void'){
                $sc_status_orderid =  Config::get('constants.status_po.void');
            }
            elseif($request->input('type') == 'close'){
                $sc_status_orderid =  Config::get('constants.status_po.close');
            }
            $PoData = PurchaseOrder::find($id);
            $PoData->sc_status_orderid = $sc_status_orderid;
            $PoData->updatedbyid = 1;
            $PoData->updated_at = date("Y-m-d H:i:s");
            $PoData->save();
            DB::commit();
            return redirect()->route('order.index')->with('success','successfully!');
        }catch(\Exception $e ){
            DB::rollBack();
            return "<h1>error</h1><br/>". $e->getMessage();
        }
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $prefix = (string) "PO/".date("Ymd")."/"; 
            //$pono =  IdGenerator::generate(['table' => 'purchase_orders', 'field'=>'purchase_order_no', 'length' =>17, 'prefix' =>$prefix]);
            $pono = $request->input('purchase_order_no');
            $PoData = new PurchaseOrder;
            $PoData->customer_id = $request->input('customer_id');
            $PoData->purchase_order_no = $pono;
            $PoData->order_date = $request->input('order_date');
            $PoData->close_date = $request->input('close_date');
            $PoData->sc_status_orderid = 5;
            $PoData->createdbyid = 1;
            $PoData->created_at = date("Y-m-d H:i:s");
            $PoData->save();

            if($PoData != null){
                $product_id = $request->input('product_id'); 
                $product_colorid = $request->input('product_colorid'); 
                $quantity_request  = $request->input('quantity_request'); 
                $perunit_amount = $request->input('perunit_amount'); 

                for($i=0; $i < count($product_id); $i++){
                    $PoDataDt = new PurchaseOrderDt;
                    $PoDataDt->purchase_order_id = $PoData->id;
                    $PoDataDt->product_id = $product_id[$i];
                    $PoDataDt->sc_colorid = $product_colorid[$i];
                    $PoDataDt->quantity_request = $quantity_request[$i];
                    $PoDataDt->perunit_amount = $perunit_amount[$i];
                    $PoDataDt->created_at = date("Y-m-d H:i:s");
                    $PoDataDt->save();
                }
            }
            DB::commit();
            return redirect()->route('order.view', $PoData->id)->with('success','successfully!');
        }catch(\Exception $e){
            DB::rollBack();
            return "<h1>error</h1><br/>". $e->getMessage();
        }
    }

    public function povendordt($id){
        $datadt = PurchaseRequestVendorDt::WHERE("purchase_request_id", "=", $id)
            ->whereNull("deleted_at")->get();
        $data = array(
            "vendordt"=>$datadt,
        );
        return view('order.vendordt', $data);
    }

    public function printinvoice($id){

        $Invoice =  Invoice::where('purchase_order_id', '=', $id)->first();
        $PurchaseOrder =  vPurchaseOrder::where('id', '=', $id)->first();
        $PurchaseOrderDt =  vPurchaseOrderDt::where('purchase_order_id', '=', $id)->get();

        $data=array(
            "invoice"=>$Invoice,
            "po"=>$PurchaseOrder,
            "podt"=> $PurchaseOrderDt 
        );
        return view('order.print.inv', $data);
    }

    public function invoice_store(Request $request){
        $request->validate([
            'id' => 'required',
            'total_payment' => 'required',
        ]);

        DB::beginTransaction();
        try{
            $id = $request->input("id");
            $inv = Invoice::find($id);
            $inv->purchase_order_id =$request->input("purchase_order_id");
            $inv->date_payment =$request->input("date_payment");
            $inv->bank_id =$request->input("bank_id");
            $inv->ref_no = $request->input("ref_no");
            $inv->total_payment =$request->input("total_payment");
            $inv->notes = $request->input("notes");
            $inv->sc_statuspayment = $request->input("sc_statuspayment");
            $inv->updated_at = date("Y-m-d");
            $inv->save();

            DB::commit();
            return redirect()->back()->with('success','successfully!');
        }catch(\Exception $e){
            DB::rollBack();
            return "<h1>error</h1><br/>". $e->getMessage();
        }

    }
}
