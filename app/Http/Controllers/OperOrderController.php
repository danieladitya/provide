<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vPurchaseOrder;
use App\vPurchaseOrderDt;
use App\Vendor;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;
use App\PurchaseRequestVendor;
use App\PurchaseRequestVendorDt;
use App\vPurchaseRequestVendor;
use App\vPurchaseRequestVendorDt;
use Config;
class OperOrderController extends Controller
{
    //
    public function index(){
        
        $prdata = vPurchaseRequestVendor::get();
      
        $data = array(
            "prdatas"=>$prdata , 
        );
        return view('opervendor.index', $data);
    }
    
    
    public function add(){
        $purchaseorders = vPurchaseOrder::whereIn("sc_status_orderid", [6,7])->get(); //approve dan inprogress
        $vendor = Vendor::whereNull("deleted_at")->get();

        //cek no po
        $prefix = (string) "POV/".date("Ymd")."/"; 
        $pono =  IdGenerator::generate(['table' => 'purchase_request_vendors', 'field'=>'purchase_request_no', 'length' =>17, 'prefix' =>$prefix]);
        
        $datenow = Date("Y-m-d");
        $data = array(
           "purchaseorders"=> $purchaseorders,
           "vendors"=>$vendor,
           "pono"=> $pono,
           "datenow"=> $datenow
        );
        return view('opervendor.form', $data);
    }
    public function updateStatus(Request $request){
        $request->validate([
            'id' => 'required',
            'type' => 'required',
        ]);
        DB::beginTransaction();
        try{
            $inprogress_id = Config::get("constants.status_po.in_progress");
            $close_id = Config::get("constants.status_po.close");

            $id = $request->input('id') ;
            $PoData = PurchaseRequestVendor::findOrFail($id);
            $PoData->sc_statuspo = $request->input('type');
            
            //jika dikirm
            if( $inprogress_id ==  $request->input('type')){
                $PoData->date_send = date("Y-m-d H:i:s");
            }
            //jika close berarti sudah diterima
            if($close_id == $request->input('type')){
                $PoData->date_recive = date("Y-m-d H:i:s"); 
            }
            $PoData->updated_at = date("Y-m-d H:i:s");
            $PoData->save();
            DB::commit();
            return redirect()->back()->with('success','update successfully!');
        }catch(\Exception $e ){
            DB::rollBack();
            return "<h1>error</h1><br/>". $e->getMessage();
        }
    }
    public function error_message(){
        return  [
            'purchase_order_id.required' => 'No. PO Customer wajib diisi',
            'purchase_request_no.required' => 'No. PO Vendor wajib diisi',
            'vendor_id.required' => 'Vendor wajib diisi',
            'date_createpo.required' => 'Tanggal Buat PO wajib diisi',
          
            
        ];
    }
    public function store(Request $request){
        $request->validate([
            'purchase_order_id' => 'required',
            'purchase_request_no' => 'required',
            'vendor_id' => 'required',
            'date_createpo' => 'required',
        ], 
        $this->error_message(),
        );
         
        DB::beginTransaction();
        try{
    
            $purchase_request_no = $request->input('purchase_request_no');
            $prcheckdata = PurchaseRequestVendor::where("purchase_request_no", "=",$purchase_request_no)->first();
            if($prcheckdata){
                $prefix = (string) "POV/".date("Ymd")."/"; 
                $pono =  IdGenerator::generate(['table' => 'purchase_request_vendors', 'field'=>'purchase_request_no', 'length' =>17, 'prefix' =>$prefix]);
            
            }else{
                $pono = $purchase_request_no;
            }
        

            $PrData = new PurchaseRequestVendor;
            $PrData->purchase_request_no =  $pono;
            $PrData->purchase_order_id = $request->input('purchase_order_id');
            $PrData->vendor_id = $request->input('vendor_id');
            $PrData->sc_statuspo = 5;
            $PrData->date_createpo = date("Y-m-d H:i:s");
            $PrData->created_at = date("Y-m-d H:i:s");
            $PrData->save();

            if($PrData != null){
                
                $chkOk = $request->input('chkOk'); 
                $purchase_orderdt_id = $request->input('purchase_orderdt_id'); 
                $request_quantity = $request->input('request_quantity');
                $perunit_amount = $request->input('perunit_amount');
                
                for($i=0; $i < count($chkOk); $i++){
                    $PrDataDt = new PurchaseRequestVendorDt;
                    $PrDataDt->purchase_request_id = $PrData->id;
                   if($chkOk[$i] == 1){
                        if($request_quantity[$i] != "" &&  $perunit_amount[$i] !="")
                        {
                            $PrDataDt->purchase_orderdt_id = $purchase_orderdt_id[$i];
                            $PrDataDt->request_quantity = $request_quantity[$i];
                            $PrDataDt->perunit_amount = $perunit_amount[$i];
                            $PrDataDt->created_at = date("Y-m-d H:i:s");
                            $PrDataDt->save();
                        }else{
                            DB::rollBack();
                            return redirect()->route('operoder.add')->with('error','harga dan jumlah produk wajib diisi');
                            die();
                        }
                   }
                    
                }
            }
            DB::commit();
            return redirect()->route('operoder.view',$PrData->id )->with('success','successfully!');

        }catch(\Exception $e){
                DB::rollBack();
                return "<h1>error</h1><br/>". $e->getMessage();
        }
    }
    public function updatedt(Request $request){
        $request->validate([
            'id' => 'required',
            'receive_quantiy' => 'required',
        ]);
        DB::beginTransaction();
        try{
           
            $id = $request->input('id') ;
            $PoData = PurchaseRequestVendorDt::findOrFail($id);
            $PoData->receive_quantiy = $request->input('receive_quantiy'); 
            $PoData->updated_at = date("Y-m-d H:i:s");
            $PoData->save();
            DB::commit();
            return redirect()->back()->with('success','update successfully!');
        }catch(\Exception $e ){
            DB::rollBack();
            return "<h1>error</h1><br/>". $e->getMessage();
        }
    }
    public function view($id){

        $purchasevendor = vPurchaseRequestVendor::where("id", "=", $id)->first();
        if($purchasevendor != null){
            $po_id = $purchasevendor->purchase_order_id;
            $podtdata = vPurchaseRequestVendorDt::where("purchase_request_id", "=", $id)->get();
            $pocust = vPurchaseOrder::where("id", "=", $po_id)->first();
            $pocustdata = vPurchaseOrderDt::where("purchase_order_id", "=", $po_id)->get();
        } 
        
        $void_id = Config::get('constants.status_po.void');
        $approve_id = Config::get('constants.status_po.approve');
        $open_id = Config::get("constants.status_po.open");
        $inprogress_id = Config::get("constants.status_po.in_progress");
        $close_id = Config::get("constants.status_po.close");

        $data= array(
            "data" =>  $purchasevendor,
            "podtdata"=>  $podtdata,
            "pocust"=>$pocust,
            "pocustdata"=>$pocustdata,
            "void_id"=> $void_id,
            "approve_id"=> $approve_id,
            "open_id" => $open_id,
            "inprogress_id"=>$inprogress_id,
            "close_id"=> $close_id 

        );
        return view('opervendor.detail', $data);
    }
    public function getProductPerPo($id){
        $purchaseorders = vPurchaseOrderDt::where("purchase_order_id","=",$id)
        ->get(); //open dan inprogress
        $data = array(
            "purchaseorderdt"=> $purchaseorders,
         );
        return view("opervendor.attribute.form_productper_po", $data);
    }
    public function getDetailPo($id){
        $orderdt=  vPurchaseOrderDt::where('purchase_order_id', '=', $id )->get();
          $data = array(
            "orders"=> $orderdt,
        );
        return response()->json($data, 200); //view("opervendor.detail_po", $data);
    }

    public function print_po($id){
        $pohd = vPurchaseRequestVendor::where("id", "=", $id)->first();
        $podt = vPurchaseRequestVendorDt::where("purchase_request_id", "=", $id)->get();
       
        $data = array(
            "podata"=>$pohd,
            "podt"=>$podt
        );
        return view('opervendor.print.po', $data);
    }
}
