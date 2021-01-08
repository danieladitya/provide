<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Vendor;
use App\Bank;

class MasterController extends Controller
{
    #region customer
    public function customer_index()
    {
        $customer= Customer::whereNull("deleted_at")
        ->get();

        $form = array(
            "id"=>"",
            "customer_name"=> "",
            "customer_phone"=> "",
            "customer_address"=> "",
        );
        
        $data = array(
            "customers"=> $customer,
            "form"=> (object) $form ,
        );

        return view('customer.index', $data);
    }
    public function customer_add(){
        $form = array(
            "id"=>"",
            "customer_name"=> "",
            "customer_phone"=> "",
            "customer_address"=> "",
        );
        
        $data = array(
            "form"=> (object) $form ,
        );

        return view('customer.form', $data);
    }
    public function customer_edit($id){

        $customer=  Customer::findOrFail($id);
        $action = "edit";
        $data = array(
            "form"=> $customer ,
        );

        return view('customer.form', $data);
    }
    public function customer_delete($id){
        $customer=  Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('master.customer.index')->with('success',' delete successfully!');
    }
    public function customer_store(Request $request){
        
        $request->validate([
            'customer_name' => 'required',
        ]);
        
        $id= $request->input('id');
        if($id != null){

            $data = Customer::findOrFail($id);
            $data->customer_name = $request->input('customer_name');
            $data->customer_phone = $request->input('customer_phone');
            $data->customer_address = $request->input('customer_address');
            $data->updated_at = date("Y-m-d H:i:s");
            $data->save();
            $message = "created";
        }else{
            $data = new Customer ;
            $data->customer_name = $request->input('customer_name');
            $data->customer_phone = $request->input('customer_phone');
            $data->customer_address = $request->input('customer_address');
            $data->created_at = date("Y-m-d H:i:s");
            $data->save();
            $message = "updated";
        }

        return redirect()->route('master.customer.index')->with('success', $message .' successfully!');
    }
    #endregion

    #region product
    public function product_index()
    {
        $Product= Product::whereNull("deleted_at")
        ->get();

        $form = array(
            "id"=>"",
            "product_name"=> "",
        );
        
        $data = array(
            "products"=> $Product,
            "form"=> (object) $form ,
        );

        return view('product.index', $data);
    }
    public function product_add(){
        $form = array(
            "id"=>"",
            "product_name"=> "",
          
        );
        
        $data = array(
            "form"=> (object) $form ,
        );

        return view('product.form', $data);
    }
    public function product_edit($id){

        $product=  Product::findOrFail($id);
        $action = "edit";
        $data = array(
            "form"=> $product ,
        );

        return view('product.form', $data);
    }
    public function product_delete($id){
        $product=  Product::findOrFail($id);
        $product->delete();
        return redirect()->route('master.product.index')->with('success',' delete successfully!');
    }
    public function product_store(Request $request){
        
        $request->validate([
            'product_name' => 'required',
        ]);
        
        $id= $request->input('id');
        if($id != null){

            $data = Product::findOrFail($id);
            $data->product_name = $request->input('product_name');
            $data->updated_at = date("Y-m-d H:i:s");
            $data->save();
            $message = "created";
        }else{
            $data = new Product ;
            $data->product_name = $request->input('product_name');
            $data->created_at = date("Y-m-d H:i:s");
            $data->save();
            $message = "updated";
        }

        return redirect()->route('master.product.index')->with('success', $message .' successfully!');
    }
    #endregion

     #region vendor
     public function vendor_index()
     {
         $vendor= Vendor::whereNull("deleted_at")
         ->get();
  
         $data = array(
             "vendors"=> $vendor,
         );
 
         return view('vendors.index', $data);
     }
     public function vendor_add(){
        $form = array(
            "id"=>"",
            "vendor_name"=> "",
            "vendor_phone"=> "",
            "vendor_alamat"=> "",
        );
         
         $data = array(
             "form"=> (object) $form ,
         );
 
         return view('vendors.form', $data);
     }
     public function vendor_edit($id){
 
         $vendor=  Vendor::findOrFail($id);
         $action = "edit";
         $data = array(
             "form"=> $vendor ,
         );
 
         return view('vendors.form', $data);
     }
     public function vendor_delete($id){
         $vendor=  Vendor::findOrFail($id);
         $vendor->delete();
         return redirect()->route('master.vendor.index')->with('success',' delete successfully!');
     }
     public function vendor_store(Request $request){
         
         $request->validate([
             'vendor_name' => 'required',
         ]);
         
         $id= $request->input('id');
         if($id != null){
 
             $data = Vendor::findOrFail($id);
             $data->vendor_name = $request->input('vendor_name');
             $data->vendor_phone = $request->input('vendor_phone');
             $data->vendor_alamat = $request->input('vendor_alamat');

             $data->updated_at = date("Y-m-d H:i:s");
             $data->save();
             $message = "created";
         }else{
             $data = new Vendor ;
             $data->vendor_name = $request->input('vendor_name');
             $data->vendor_phone = $request->input('vendor_phone');
             $data->vendor_alamat = $request->input('vendor_alamat');
             
             $data->created_at = date("Y-m-d H:i:s");
             $data->save();
             $message = "updated";
         }
 
         return redirect()->route('master.vendor.index')->with('success', $message .' successfully!');
     }
     #endregion

     #regionn Bank 
     public function bank_index(){
        $bank= Bank::whereNull("deleted_at")
         ->get();
  
         $data = array(
             "bank"=> $bank,
         );
 
        return view("bank.index",  $data );
     }
     public function bank_add(){
        $form = array(
            "id"=>"",
            "bank_name"=> "",
            "rek_no"=> "",
            "account_name"=> "",
        );
        
        $data = array(
            "form"=> (object) $form ,
        );

        return view('bank.form', $data);
    }
    public function  bank_edit($id){

        $product=  Bank::findOrFail($id);
        $action = "edit";
        $data = array(
            "form"=> $product ,
        );

        return view('bank.form', $data);
    }
    public function bank_delete($id){
        $product=  Bank::findOrFail($id);
        $product->delete();
        return redirect()->route('master.bank.index')->with('success',' delete successfully!');
    }
    public function bank_store(Request $request){
        
        $request->validate([
            "bank_name"=> "required",
            "rek_no"=> "required",
            "account_name"=> "required",
        ]);
        
        $id= $request->input('id');
        if($id != null){

            $data = Bank::findOrFail($id);
            $data->bank_name = $request->input('bank_name');
            $data->rek_no = $request->input('rek_no');
            $data->account_name = $request->input('account_name');

            $data->updated_at = date("Y-m-d H:i:s");
            $data->save();
            $message = "created";
        }else{
            $data = new Bank ;
            $data->bank_name = $request->input('bank_name');
            $data->rek_no = $request->input('rek_no');
            $data->account_name = $request->input('account_name');
            $data->created_at = date("Y-m-d H:i:s");
            $data->save();
            $message = "updated";
        }

        return redirect()->route('master.bank.index')->with('success', $message .' successfully!');
    }
     #endregion
}
