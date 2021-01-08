<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SendOrderPo;
use App\SendOrderPoDt;
use App\PurchaseOrder;
use App\vSendOrderPoDt;
use App\vSendOrderPo;

use DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class SendOrderController extends Controller
{
    //
    public function index(){

        return view('sendorder.index');
    }
    public function view($id){

        $dataOrderHd = vSendOrderPo::WHERE("id", "=", $id)->first();
        $dataOrderDt  = vSendOrderPoDt::WHERE("send_order_po_id", "=", $id)->get();
        $data= array(
            "sendorderdt"=>$dataOrderDt,
            "dataHd"=>$dataOrderHd,
        );
        return view('sendorder.detail', $data);
    }
    public function store(Request $request){
        if($request->has('chkSendOrder')) {
            $value = $request->input('chkSendOrder');
       }
       else {
            $value = "put default value (false)";
       }
       
        DB::beginTransaction();
        try{
            
            $prefix = (string) "SJ/".date("Ymd")."/"; 
            $sjno =  IdGenerator::generate(['table' => 'send_order_po', 'field'=>'sj_no', 'length' =>17, 'prefix' =>$prefix]);
            $sendOrderPo = new SendOrderPo;
            $sendOrderPo->sj_no = $sjno;
            $sendOrderPo->purchase_order_id = $request->input("purchase_order_id");
            $sendOrderPo->created_at = Date("Y-m-d H:i:s");
            $sendOrderPo->save();

            if($sendOrderPo){
                $chkSendOrder = $request->input("chkSendOrder");

                for($i=0; $i < count($chkSendOrder); $i++){
                    if($chkSendOrder[$i] == "1")
                    {
                        $SendOrderPoDt = new SendOrderPoDt;
                        $SendOrderPoDt->send_order_po_id = $sendOrderPo->id;
                        $SendOrderPoDt->name_product = $request->input("name_product")[$i];
                        $SendOrderPoDt->purchase_order_dt_id = $request->input("purchase_order_dt_id")[$i];
                        $SendOrderPoDt->quantity_item = $request->input("quantity_item")[$i];
                        $SendOrderPoDt->created_at = Date("Y-m-d H:i:s");
                        $SendOrderPoDt ->save();
                    } 
                }
            }
            DB::commit();
            return redirect()->back()->with('success','successfully!');
        }catch(\Exception $e ){
            DB::rollBack();
            return "<h1>error</h1><br/>". $e->getMessage();
        }
    }
}
