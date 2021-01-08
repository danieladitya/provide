@extends('layout.app')
@section('content')
<div class="breadcrumb"><h1>PO Vendor</h1> </div>
<div class="separator-breadcrumb border-top"></div>
 
@include('layout.error_form_notif')

<form method="POST" action="{{ route("operoder.store") }}">
 @csrf
<div class="row">
    <div class="col-sm-12">
    <div class="card">
        <div class="card-header">Form PO Vendor</div>
      
        <div class="card-body">
            <div class="border-top"></div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-4">
                                <div class="form-group">
                                    <label>No. PO Customer</label>
                                    <select class="select form-control" name="purchase_order_id" id="purchase_order_id" value="">
                                        <option></option>
                                        @foreach ($purchaseorders as $row)
                                             <option value="{{ $row->id }}">{{ $row->purchase_order_no }} - {{ $row->customer_name }} </option>
                                        @endforeach
                                       
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>No. PO Vendor</label>
                                    <input  class="form-control"   name="purchase_request_no" value="{{ $pono  }}"/>
                                </div>
                                 <div class="form-group">
                                    <label>Nama Vendor</label>
                                    <select  class="form-control select" name="vendor_id" value="">
                                        <option></option>
                                         @foreach ($vendors as $row)
                                             <option value="{{ $row->id }}">{{ $row->vendor_name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label>Tanggal Buat PO</label>
                                    <input class="form-control datepicker" value="{{ $datenow }}" name="date_createpo" value=""/>
                                </div>
                            <div class="row">
                              
                                {{-- <div class="col-sm-3">
                                 
                                  <button class="btn btn-danger" type="button" id="add" >Tambah Product</button>
                                </div> --}}
                                <div class="col-sm-3">
                                    <input type="hidden"  name="chkOk[]" value="0" />
                                    <input type="hidden"  name="purchase_orderdt_id[]" />
                                    <input type="hidden"  name="request_quantity[]" />
                                    <input type="hidden"  name="perunit_amount[]" />
                                    
                               
                                </div>
                            </div>
                          
                        </div>
                      
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header"> Informasi PO Detail </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                                <table class="table table-borderless" >
                                    <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Produk</td>
                                        <td>Jumlah PO</td>
                                        <td>Sedang dikerjakan</td>
                                        <td>Sudah diterima</td>
                                        <td>Jumlah pesanan</td>
                                        <td>Harga perproduk</td>
                                    </tr>
                                    </thead>
                                    <tbody id="tableProduct">
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
        
            
        </div>
    </div>
    </div>
</div>
<div class="row separator-breadcrumb">
    <div class="col-sm-12">
        <div id="PoDataDetail"></div>
    </div>
</div>

</form>
<script>
 

    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    $('#purchase_order_id').change(function(){
        var poid =  $('#purchase_order_id').val();
        $("#tableProduct").empty();
        if(poid == ""){
            alert("Silahkan pilih no po customer dahulu");
            return false;
        }
        var GetUrl = "{{ route('operoder.get.poperproduct', ':poid') }}".replace(':poid', poid);
        $.ajax({
            url: GetUrl,
            success: function (data) {  
               $("#tableProduct").append(data);
            },
            dataType: 'html'
        });
       
    });
    
 
 
   function change(id){

    $('#chk'+id).change(function() {
        if(this.checked) {
            
            $("#qty"+id).removeAttr("readonly"); 
            $("#price"+id).removeAttr("readonly"); 
        }else{
            $("#qty"+id).prop("readonly", true); 
            $("#price"+id).prop("readonly", true); 
        }
       
    });
 
    
   }  
   
 
</script>
@endsection