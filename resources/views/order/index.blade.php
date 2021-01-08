@extends('layout.app')
@section('content')
<div class="breadcrumb"><h1>Order PO</h1> </div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <div class="col-sm-6">
       @if( $back)
       <a class="btn btn-primary" href="{{ route('order.index') }}"><i class="nav-i  i-Arrow-Back-3 "></i> Kembali</a> 
       @endif
       <a href="{{ route('order.add') }}"   class="btn btn-primary">Tambah PO</a>
    </div>
    <div class="col-sm-6">
    <form method="GET" action="{{ route("order.search") }}">
      <div class="input-group">
        <span class="input-group-prepend">
            <div class="input-group-text bg-transparent border-right-0">
            <i class="nav-icon   i-Folder-Search "></i>
            </div>
        </span>
        <input class="form-control" name="keyword" placeholder="silahkan masukan no po" type="text"/>
        <span class="input-group-append">
            <button class="btn btn-primary" type="submit">
            Search
            </button>
        </span>
        </div>
    </form>
    </div>
</div>

<div class="separator-breadcrumb"></div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">Order</div>
            <div class="card-body">
            <div class="table-responsive">
                 <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>No Po</th>
                        <th>Customer</th>
                        <th>Tanggal Order</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                         <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($purchaseOrders as $row )
                        <tr>
                            <td>{{ $row->purchase_order_no }}</td>
                            <td>{{ $row->customer_name }}</td>
                            <td>{{ $row->order_date }}</td>
                            <td>{{ $row->close_date }}</td>
                            <td> {{ $row->status_order }} </td>
                            <td>
                               <a href="{{ route('order.view', $row->id) }}" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                 </table>
                 {{ $purchaseOrders->links() }}
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection