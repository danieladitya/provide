@extends('layout.app')
@section('content')
<div class="breadcrumb"><h1>Order</h1> </div>
<div class="separator-breadcrumb border-top"></div>
<form method="POST" action="{{ route('order.store') }}">
<div class="row">
    
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">Order</div>
            <div class="card-body">
               
                      @csrf
                        <div class="form-group ">
                            <label>No PO</label>
                            <input type="text"  class="form-control" name="purchase_order_no"/>
                        </div>
                        <div class="form-group">
                            <label>Customer</label>
                            <select class="form-control" name="customer_id">
                                @foreach ($customers as $item )
                                    <option value="{{ $item->id }}">{{ $item->customer_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Order</label>
                            <input class="datepicker form-control" value="{{ $datenow }}"  class="form-control"  type="text"  name="order_date" >
                        
                        </div>
                        <div class="form-group">
                            <label>Tanggal Jatuh Tempo</label>
                            <input class="datepicker form-control"  class="form-control"  type="text"  name="close_date" >
                        
                        </div>
                        
                        <a href="#" id="add" class="btn btn-danger">Tambah Produk</a>
                         <button type="submit" class="btn btn-primary">Simpan</button>
                  
                    
            </div>

        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">Item Produk</div>
            <div class="card-body">
                <table class="table table-borderless" id="tableProduct">
                    <thead>
                        <tr>
                            <td>Produk</td>
                            <td>Warna</td>
                            <td>Qty</td>
                            <td>Harga Per Item</td>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <select  class="form-control" name="product_id[]">
                                    @foreach ($products as $item )
                                        <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                            <select  class="form-control"  name="product_colorid[]">
                                @foreach ($colors as $item )
                                    <option value="{{ $item->id }}">{{ $item->standard_code_name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                            <input  type="text" class="form-control"  name="quantity_request[]" />
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                            <input   type="text" class="form-control"  name="perunit_amount[]" />
                            </div>
                        </td>
                    </tr> 
                    </tbody>
                
                </table>
            </div>
        </div>
    </div>

</div>
</form>

<script>
//$("#tableProduct").hide();
  $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
 $(document).ready(function () {
        
    $("#add").click(function(){
        var $tableBody = $('#tableProduct').find("tbody"), $trLast = $tableBody.find("tr:last"),
            $trNew = $trLast.clone();
        $trLast.after($trNew);
       // $("#tableProduct").show();
            /*$.get( "{{ route('order.AtrAddFormProduct')  }}", function( data ) {
            $("#tableProduct").append(data);
            });*/
        /*$.ajax({
            url: "{{ route('order.AtrAddFormProduct')  }}",
            success: function (data) {  
                
                var testform = ' <input type="text" class="form-control"  name="product_pricesid[]" />';
                $("#tableProduct").html(testform); 
                
            },
            dataType: 'html'
        });*/ 
    });    

});

           
</script>
@endsection