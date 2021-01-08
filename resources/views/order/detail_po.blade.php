@extends('layout.app')
@section('content')
    <div class="breadcrumb">
        <h1>Order</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="home-basic-tab" data-toggle="tab" href="#homeBasic" role="tab" aria-controls="homeBasic" aria-selected="true">PO Customer</a></li>
                        <li class="nav-item"><a class="nav-link" id="profile-basic-tab" data-toggle="tab" href="#profileBasic" role="tab" aria-controls="profileBasic" aria-selected="false">Vendor</a></li>
                        <li class="nav-item"><a class="nav-link" id="profile-Send-tab" data-toggle="tab" href="#Send" role="tab" aria-controls="Send" aria-selected="false">Pengiriman</a></li>
                        <li class="nav-item"><a class="nav-link" id="profile-payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Pembayaran</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="homeBasic" role="tabpanel" aria-labelledby="home-basic-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <!--PO Customer -->
                                    <div class="accordion" id="accordionRightIcon">
                                        <div class="accordion" id="accordionRightIcon">
                                            <div class="card ">
                                                <div class="card-header header-elements-inline">
                                                    <h6
                                                        class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                                        <a data-toggle="collapse" class="text-default collapsed" href="#accordion-item-icon-right-1" aria-expanded="false">INFORMASI</a>

                                                    </h6>
                                                </div>
                                                <div id="accordion-item-icon-right-1" class="collapse in show" data-parent="#accordionRightIcon" >
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>No PO</label>
                                                            <input type="text" readonly="true"
                                                                value="{{ $data->purchase_order_no }}"
                                                                class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Customer</label>
                                                            <input type="text" readonly="true"
                                                                value=" {{ $data->customer_name }}" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Order</label>
                                                            <input class="datepicker form-control" class="form-control"
                                                                value=" {{ $data->order_date }}" type="text"
                                                                name="order_date" readonly="true">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Jatuh Tempo</label>
                                                            <input class="datepicker form-control"
                                                                value=" {{ $data->close_date }}" class="form-control"
                                                                type="text" name="close_date" readonly="true">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <input class="datepicker form-control"
                                                                value=" {{ $data->status_order }}" class="form-control"
                                                                type="text" name="status_order" readonly="true">
                                                        </div>

                                                        @if ($data->sc_status_orderid == 5)
                                                            <div class="row">
                                                                <div class="col-sm-6">

                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <form method="POST"
                                                                                action="{{ route('order.update.status') }}">
                                                                                @csrf
                                                                                <input type="hidden" value="{{ $data->id }}"
                                                                                    name="id" />
                                                                                <input type="hidden" value="approve"
                                                                                    name="type" />
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">APPROVE</button>
                                                                            </form>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <form method="POST"
                                                                                action="{{ route('order.update.status') }}">
                                                                                @csrf
                                                                                <input type="hidden" value="{{ $data->id }}"
                                                                                    name="id" />
                                                                                <input type="hidden" value="void"
                                                                                    name="type" />
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">VOID</button>
                                                                            </form>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($data->sc_status_orderid != 5)
                                                            <a target="_blank" href="{{ route('order.print.inv', $data->id) }}" class="btn btn-primary" >Print Invoice Customer</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">Detail</div>
                                                    <div class="card-body">
                                                        <table class="table table-striped" id="tableProduct">
                                                            <thead>
                                                                <tr>
                                                                    <td>Produk</td>
                                                                    <td>Warna</td>
                                                                    <td><div class="float-right">Qty</div></td>
                                                                    <td><div class="float-right">Harga Perproduk</div></td>
                                                                    <td><div class="float-right">Total</div></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $total = 0;?>
                                                                @foreach ($orders as $order)
                                                                <?php $total += $order->quantity_request * $order->perunit_amount  ?>
                                                                    <tr>
                                                                        <td>{{ $order->product_name }}</td>
                                                                        <td>{{ $order->color }}</td>
                                                                        <td><div class="float-right">{{ $order->quantity_request }}</div></td>
                                                                        <td><div class="float-right">{{ $order->perunit_amount }}</div></td>
                                                                        <td><div class="float-right">@currency($order->perunit_amount * $order->quantity_request) </div></td>
                                                                    </tr>
                                                                @endforeach
                                                                <tr>
                                                                    <td colspan="3">Total</td>
                                                                    <td colspan="3"><div class="float-right">@currency($total) </div></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!--inporgress -->
                         <div class="tab-pane fade" id="profileBasic" role="tabpanel" aria-labelledby="profile-basic-tab">
                          
                            @if($data->sc_status_orderid != 9 &&  $data->sc_status_orderid != 10  )  {{-- close dan void --}} 
                            <div class="row ">
                                 <div class="col-sm-12">
                                    <a href="{{ route('operoder.add') }}"   class="btn btn-primary">Buat PO Vendor</a>
                                 </div>
                             </div>
                             @endif
                             <div class="separator-breadcrumb "></div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">Daftar vendor yang mengerjakan No Po. {{ $data->purchase_order_no }}</div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <td>#</td>
                                                            <td>No Po Vendor</td>
                                                            <td>Nama Vendor</td>
                                                            <td>Tanggal PO</td>
                                                            <td>Status Pengerjaan</td>
                                                            <td></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($prdatas as  $row)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{ $row->purchase_request_no }}</td>
                                                            <td>{{ $row->vendor_name }}</td>
                                                            <td>{{ $row->date_createpo }}</td>
                                                            <td>{{ $row->statuspo }}</td>
                                                            <td>
                                                                {{-- <a href="{{ route('operoder.view', $row->id) }}" class="btn btn-primary">Detail</a> --}}
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" onclick="GetInprogressDt({{ $row->id }},'{{ $row->purchase_request_no }}', '{{ $row->vendor_name }}')">
                                                                   Lihat Detail
                                                                </button>
                                                            </td>
                                                            
                                                        </tr>
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--modal detail inprogress -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"  aria-hidden="true"  data-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="inProgressdt-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="inProgessdt-body"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--inprogress -->
                        <!--Pengiriman -->
                        <div class="tab-pane fade" id="Send" role="tabpanel" aria-labelledby="profile-basic-tab">
                        <h2>Pengiriman Po</h2>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped" id="tableProduct">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Produk</td>
                                            <td>Warna</td>
                                            <td><div class="float-right">Qty request</div></td>
                                            <td><div class="float-right">Qty sudah dikerjakan</div></td>
                                            <td><div class="float-right">Qty dikirim</div></td>
                                            <td><div class="float-right">Qty outstanding</div></td>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <form action="{{ route("sendorder.store") }}" method="POST" id="formSendOrder">
                                        @csrf
                                        <input type="hidden" name="purchase_order_id" value="{{ $order->purchase_order_id }}" />
                                        <input type="hidden" name="chkSendOrder[]" value="0">
                                        <input type="hidden" name="name_product[]"  />
                                        <input type="hidden" name="purchase_order_dt_id[]"  />
                                        <input type="hidden" name="quantity_item[]"     />
                                        <?php 
                                            $orderOk =false; 
                                            $outstanding = false;
                                            $totalOutstanding = 0;
                                        ?>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>
                                                <?php 
                                                    
                                                    $totalOutstanding =  $order->quantity_request - $order->total_send_quantity ;
                                                    
                                                    if( $totalOutstanding > 0){
                                                        $outstanding = true;
                                                    }

                                                    if(  $totalOutstanding > 0 && $order->total_receive_quantity > 0){
                                                        $orderOk = true;
                                                ?>
                                                  
                                                    <input type="checkbox" name="chkSendOrder[]" onclick="checkOk({{ $order->id }})" id="chkSendOrder{{  $order->id  }}" value="1" />
                                                 
                                                <?php
                                                    }else{
                                                ?>
                                                    <input type="checkbox" name="chkSendOrder" disabled>
                                                    
                                                <?php 
                                                    }
                                                ?>
                                                    <input type="hidden" name="name_product[]" value="{{ $order->product_name }}" />
                                                    <input type="hidden" name="purchase_order_dt_id[]" value="{{ $order->id }}" />

                                                    </td>
                                                <td>{{ $order->product_name }}</td>
                                                <td>{{ $order->color }}</td>
                                                <td><div class="float-right">{{ $order->quantity_request }}</div></td>
                                                <td><div class="float-right">{{ $order->total_receive_quantity }}</div></td>
                                                <td><div class="float-right">
                                                    {{  $order->total_send_quantity }}
                                                </td>
                                                <td><div class="float-right"><input type="text" class="form-control" name="quantity_item[]" readonly="true"
                                                    value="{{  $order->quantity_request - $order->total_send_quantity  }}" id="qty{{ $order->id }}"
                                                    /></div></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            @if($orderOk)
                                                <td  colspan="6"><button class="btn btn-primary" type="submit"> Kirim Po</button></td>
                                            @endif
                                        </form>
                                            @if($outstanding == false)
                                                <td  colspan="6">
                                                    @if($data->sc_status_orderid != 9 &&  $data->sc_status_orderid != 10  )  {{-- close dan void --}} 
                                                <form method="POST" action="{{ route('order.update.status') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $order->purchase_order_id }}" />
                                                    <input type="hidden" value="close" name="type" />
                                                    <button class="btn btn-primary" type="submit">Close PO</button></td>
                                                </form>
                                                  @endif
                                            @endif
                                        </tr>
                                  
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <h2>History Pengiriman</h2>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>No Surat Jalan</td>
                                            <td>Tanggal</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0;?>
                                        @foreach ($sendpo as $row)
                                      
                                            <tr>
                                                <td>{{ $row->sj_no }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>
                                                    {{-- <a href="#" class="btn btn-primary">Lihat Detail</a> --}}
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sjmodal" onclick="GetDetailSj({{ $row->id }})">
                                                        Lihat Detail
                                                     </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--modal detail pengiriman -->
                        <div class="modal fade " id="sjmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2"  aria-hidden="true"  data-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered mw-100 w-75" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sj-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="sj-body"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>
                        <!--pengiriman-->
                        <!--profile-payment-tab -->
                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="profile-basic-tab">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-header">
                                            Konfirmasi Pembayaran
                                        </div>
                                        <div class="card-body">
                                                <form method="POST" action="{{ route('order.inv.store') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Invoice No</label>
                                                        
                                                        <input type="hidden" class="form-control" name="purchase_order_id" value="{{ $data->id }}" />
                                                        <input type="hidden" class="form-control" name="id" value="{{ $formInv->id }}" />
                                                        <input type="text" class="form-control" name="inv_no" value="{{ $formInv->inv_no }}" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Pembayaran</label>
                                                        <input type="text" class="form-control datepicker" name="date_payment" value="{{ $formInv->date_payment }}" />
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Bank</label>
                                                       <select class="form-control" name="bank_id">
                                                        <option></option>
                                                        @foreach ($bank as $bankData )
                                                            <option
                                                            @if ($bankData->id == $formInv->bank_id)
                                                            selected
                                                            @endif
                                                            value="{{$bankData->id }}"> {{ $bankData->rek_no  }} - {{ $bankData->account_name }} - {{ $bankData->bank_name  }}</option>
                                                        @endforeach
                                                       </select>
                                                    </div>
                                                   
                                                    <div class="form-group">
                                                        <label>Nomor Refrensi</label>
                                                        <input type="text" class="form-control" name="ref_no" value="{{ $formInv->ref_no }}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Total Pembayaran</label>
                                                        <input type="text" class="form-control" name="total_payment" value="{{ $formInv->total_payment }}" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Catatan</label>
                                                        <input type="text" class="form-control" name="notes"  value="{{ $formInv->notes }}" />
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Status</label>
                                                       <select class="form-control" name="sc_statuspayment">
                                                           @foreach ($sc_payment as $sc )
                                                           <option value="{{ $sc->id }}"
                                                            @if ($sc->id == $formInv->sc_statuspayment)
                                                                selected
                                                            @endif
                                                            >{{ $sc->standard_code_name }}</option>
                                                           @endforeach
                                                          
                                                       </select>
                                                    </div>
                                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-header">Informasi Invoice</div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th>No Inv</th>
                                                    <td>{{ $formInv->inv_no }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Customer</th>
                                                    <td>{{ $formInv->customer_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Tagihan</th>
                                                    <td>Rp.  @currency($formInv->total_inv)</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>{{ $formInv->statuspayment }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment -->
                    </div>
                </div>
            </div>
            
        </div>
    </div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    function GetDetailSj(id){
        $("#sj-title").empty();
        $("#sj-body").empty();

        $("#sj-title").append("Detail Surat Jalan");
        var GetUrl = "{{ route('sendorder.view', ':id') }}".replace(':id', id);
        $.ajax({
            url: GetUrl,
            success: function (data) {  
               $("#sj-body").append(data);
            },
            dataType: 'html'
        });
       
    }
    function GetInprogressDt(id, NoPo, namavendor){
        $("#inProgressdt-title").empty();
        $("#inProgessdt-body").empty();

        $("#inProgressdt-title").append(namavendor  + ' (' + NoPo +')');
        var GetUrl = "{{ route('order.vendordt', ':id') }}".replace(':id', id);
        $.ajax({
            url: GetUrl,
            success: function (data) {  
               $("#inProgessdt-body").append(data);
            },
            dataType: 'html'
        });
       
    }
    function checkOk(id){
        $('#chkSendOrder'+id).change(function() {
            if(this.checked) {
                $("#qty"+id).removeAttr("readonly"); 
            }else{
                $("#qty"+id).prop("readonly", true); 
            }
        });
 
    }
    $('#formSendOrder').submit(function(){
        var checked = false;
        $("input[name='chkSendOrder[]']:checked").each(function ()
        {
            checked = true;
        });

        if(checked == false){
            swal({
                type: 'error',
                title: 'Error!',
                text: 'Silahkan di pilih dahulu produk yang akan dikirim!',
                confirmButtonText: 'Ok',
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-lg btn-danger'
            });
        }else{
            return true;
        }
       
        return false;
    });

</script>

@endsection
