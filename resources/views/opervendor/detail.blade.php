@extends('layout.app')
@section('content')
<div class="breadcrumb"><h1>PO Vendor</h1> </div>
<div class="separator-breadcrumb border-top"></div>
<div class="row mb-12">
 <div class="col-sm-12">
    <div class="card text-left">
        <div class="card-body"> 
           <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item"> <a class="nav-link active show" id="home-basic-tab" data-toggle="tab" href="#homeBasic" role="tab" aria-controls="homeBasic" aria-selected="true"> PO Vendor</a></li>
                <li class="nav-item"><a class="nav-link" id="profile-basic-tab" data-toggle="tab" href="#profileBasic" role="tab" aria-controls="profileBasic" aria-selected="false">Detail PO Customer</a></li>
                 <li class="nav-item"><a class="nav-link" id="recivePo-basic-tab" data-toggle="tab" href="#recivePo" role="tab" aria-controls="recivePo" aria-selected="false">Terima Barang</a></li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="homeBasic" role="tabpanel" aria-labelledby="home-basic-tab">
                   <!--form po vendor-->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>No. PO Customer</label>
                                                <input type="text" readonly="true" class="form-control" value=" {{ $data->purchase_order_no }}" />
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>No. PO Vendor</label>
                                            <input  class="form-control" readonly="true"   name="purchase_request_no" value="{{ $data->purchase_request_no }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Vendor</label>
                                            <input type="text" readonly="true" class="form-control" value="{{ $data->vendor_name }}" />
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Buat PO</label>
                                            <input class="form-control  " readonly="true" value="{{ $data->date_createpo }}"   value=""/>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <input class="form-control  " readonly="true" value="{{ $data->statuspo }}"   value=""/>
                                        </div>
                                        @if ($open_id == $data->sc_statuspo)
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <form method="POST" action="{{ route('operoder.update.status') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{ $approve_id }}" name="type" />
                                                        <input type="hidden" value="{{ $data->id }}" name="id" />
                                                        <button class="btn btn-primary" type="submit" id="add" >Approve</button>
                                                    </form>
                                                </div>
                                                <div class="col-sm-2">
                                                <form method="POST" action="{{ route('operoder.update.status') }}">
                                                    @csrf
                                                    <input type="hidden" value="{{ $void_id }}" name="type" />
                                                    <input type="hidden" value="{{ $data->id }}" name="id" />
                                                    <button class="btn btn-danger" type="submit">Void</button>
                                                </form>
                                                </div>
                                            </div>
                                            @elseif ($approve_id == $data->sc_statuspo)
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <form method="POST" action="{{ route('operoder.update.status') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{ $inprogress_id }}" name="type" />
                                                        <input type="hidden" value="{{ $data->id }}" name="id" />
                                                        <button class="btn btn-primary" type="submit" id="add" >Kirim Ke Vendor</button>
                                                    </form>
                                                </div>
                                            </div>
                                            @else
                                             <div class="row">
                                                <div class="col-sm-2">
                                                    <a target="_blank" href="{{ route('operorder.print.po', $data->id) }}" class="btn btn-primary">Print PO Vendor</a>
                                                    {{-- <form method="POST" action="{{ route('operoder.update.status') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{ $approve_id }}" name="type" />
                                                        <input type="hidden" value="{{ $data->id }}" name="id" />
                                                        <button class="btn btn-primary" type="submit" id="add" >Cetak PO</button>
                                                    </form> --}}
                                                </div>
                                                </div>
                                        @endif
                                    
                                </div>
                                <div class="col-sm-6">
                                    <table class="table table-striped"  >
                                        <thead>
                                        <tr>
                                            <td>Produk</td>
                                            <td>Warna</td>
                                            <td><div class="float-right">Qty</div></td>
                                            <td><div class="float-right">Harga</div></td>
                                            <td><div class="float-right">Total</div></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $total = 0 ; ?>
                                        @foreach ($podtdata as $row)
                                         <?php $total += $row->perunit_amount * $row->request_quantity  ?>
                                            <tr>
                                                <td>{{ $row->product_name }}</td>
                                                <td>{{ $row->color }}</td>
                                                <td><div class="float-right">{{ $row->request_quantity }}</div></td>
                                                <td><div class="float-right">@currency($row->perunit_amount) </div></td>
                                                <td><div class="float-right">@currency($row->perunit_amount * $row->request_quantity ) </div></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2"> <b>TOTAL </b></td>
                                            <td><div class="float-right">{{$podtdata->sum('request_quantity')}}</div></td>
                                            <td></td>
                                            <td ><div class="float-right">@currency($total)<div></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
               
                   <!--end form-->
                </div>
                <div class="tab-pane fade" id="profileBasic" role="tabpanel" aria-labelledby="profile-basic-tab"> 
                   <!--form po-->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group ">
                            <label>No PO</label>
                            <input type="text"  class="form-control" name="purchase_order_no" readonly="true" value="{{ $pocust->purchase_order_no }}"/>
                        </div>
                        <div class="form-group">
                            <label>Customer</label>
                            <input type="text"  class="form-control" name="customer"  readonly="true" value="{{ $pocust->customer_name }}"/>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Order</label>
                            <input class="  form-control"   class="form-control"  type="text"  name="order_date"  readonly="true" value="{{ $pocust->order_date }}">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Jatuh Tempo</label>
                            <input class="  form-control"  class="form-control"  type="text"  name="close_date"  readonly="true" value="{{ $pocust->close_date }}">
                        </div>
                          <div class="form-group">
                            <label>Tanggal Kirim</label>
                            <input class="  form-control"  class="form-control"  type="text"  name="close_date"  readonly="true" value="{{ $pocust->send_date }}">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input class="  form-control"  class="form-control"  type="text"  name="close_date"  readonly="true" value="{{ $pocust->status_order }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                    <table class="table table striped">
                        <thead>
                            <tr>
                                <td>Produk</td>
                                <td>Warna</td>
                                <td><div class="float-right">Qty</div></td>
                                <td><div class="float-right">Harga</div></td>
                                <td><div class="float-right">Total</div></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            @foreach ($pocustdata as $row)
                            <?php $total += $row->perunit_amount * $row->quantity_request  ?>
                            <tr>
                                <td>{{ $row->product_name }}</td>
                                <td>{{ $row->color }}</td>
                                <td><div class="float-right"><div class="float-right">{{ $row->quantity_request }}</div></td>
                                <td><div class="float-right"><div class="float-right">@currency($row->perunit_amount) </div></td>
                                <td><div class="float-right"><div class="float-right">@currency($row->perunit_amount * $row->quantity_request )</div></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"> <b>TOTAL </b></td>
                                <td><div class="float-right"><div class="float-right">{{$pocustdata->sum('quantity_request')}}</div></td>
                                <td></td>
                                <td ><div class="float-right"><div class="float-right">@currency( $total)<div></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <!--end form-->
                </div>
                <div class="tab-pane fade" id="recivePo" role="tabpanel" aria-labelledby="recivePo-basic-tab"> 
                <div class="row">
                    <div class="col-sm-12">
                    <!--detail-->
                    
                        <div class="accordion" id="accordionRightIcon">
                            <div class="card ">
                                <div class="card-header header-elements-inline">
                                <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                    <a data-toggle="collapse" class="text-default " href="#accordion-item-icon-right-1"
                                        aria-expanded="true">Detail PO Customer</a>
                                </h6>
                                </div>
                                <div id="accordion-item-icon-right-1" class="collapse in show" data-parent="#accordionRightIcon" style="">
                                <div class="card-body">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>No. PO Customer</label>
                                            <input type="text" readonly="true" class="form-control" value=" {{ $data->purchase_order_no }}" />
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>No. PO Vendor</label>
                                            <input  class="form-control" readonly="true"   name="purchase_request_no" value="{{ $data->purchase_request_no }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Vendor</label>
                                            <input type="text" readonly="true" class="form-control" value="{{ $data->customer_name }}" />
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Buat PO</label>
                                            <input class="form-control  " readonly="true" value="{{ $data->date_createpo }}"   value=""/>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <input class="form-control  " readonly="true" value="{{ $data->statuspo }}"   value=""/>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- /right control icon -->
                    

                    <!-- end-->
                    </div>
                </div>
                <div class="row">
                <div class="col-sm-12">
                   @if ($inprogress_id == $data->sc_statuspo || $close_id == $data->sc_statuspo)
                                    <table class="table table-striped"  >
                                        <thead>
                                        <tr>
                                            <td>Produk</td>
                                            <td>Warna</td>
                                            <td><div class="float-right">Jumlah Pesan</div></td>
                                            <td><div class="float-right">Jumlah Terima</div></td>
                                            <td><div class="float-right">Biaya</div></td>
                                            <td><div class="float-right">Total Biaya</div></td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $total = 0 ; ?>
                                        @foreach ($podtdata as $row)
                                         <?php $total += $row->perunit_amount * $row->request_quantity  ?>
                                            <tr>
                                                <td>{{ $row->product_name }}</td>
                                                <td>{{ $row->color }}</td>
                                                <td><div class="float-right">{{ $row->request_quantity }}</div></td>
                                                <td><div class="float-right">{{ $row->receive_quantiy }}</div></td>
                                                <td><div class="float-right">@currency($row->perunit_amount) </div></td>
                                                <td><div class="float-right">@currency($row->perunit_amount * $row->receive_quantiy ) </div></td>
                                                <td>
                                                 @if ($inprogress_id == $data->sc_statuspo)
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form{{ $row->id }}">
                                                    Jumlah Yang Diterima
                                                </button>
                                                @endif
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="form{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true"  data-backdrop="static" data-keyboard="false"  >
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle-2">Form Penerimaan Barang</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                       
                                                        <div class="modal-body">
                                                         <form action="{{ route('operoder.update.dt') }}" method="post" >
                                                         @csrf
                                                            <input type="hidden" name="id" value="{{ $row->id }}" />
                                                            <div class="form-group">
                                                                <label>Nama Produk</label>
                                                                <input type="text" value="{{ $row->product_name }}" class="form-control" readonly="true"  />
                                                           </div>
                                                            <div class="form-group">
                                                                <label>Warna</label>
                                                                <input type="text" value="{{ $row->color }}" class="form-control" readonly="true"  />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Jumlah dipesan</label>
                                                                <input type="text" value="{{ $row->request_quantity }}" class="form-control" readonly="true" name="request_quantity" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Jumlah diterima</label>
                                                                <input type="text" value="{{ $row->receive_quantiy }}" class="form-control" name="receive_quantiy" />
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                           
                                                                <button type="submit" class="btn btn-primary ml-2">Simpan</button>
                                                           
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--modal-->
                                        @endforeach
                                        
                                        </tbody>
                                    </table>
                                @if ($inprogress_id == $data->sc_statuspo)
                                             <div class="row">
                                                <div class="col-sm-2">
                                                    <form method="POST" action="{{ route('operoder.update.status') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{ $close_id }}" name="type" />
                                                        <input type="hidden" value="{{ $data->id }}" name="id" />
                                                        <button class="btn btn-primary" type="submit" id="add" >Close PO</button>
                                                    </form>
                                                </div>
                                                </div>
                                        @endif
                            @else
                            <p>Po belum dikirim ke vendor </p>
                        @endif
                        </div>
                   </div>
                   
                </div>
             </div>
        </div>
     </div>
    </div>
 
 </div>
 

@endsection