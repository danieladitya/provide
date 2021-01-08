@extends('layout.app')
@section('content')
<div class="breadcrumb"><h1>Po Vendor</h1> </div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <div class="col-sm-10">
        <a href="{{ route('operoder.add') }}"   class="btn btn-primary">Tambah PO</a>
    </div>
</div>
<div class="separator-breadcrumb"></div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">Daftar PO</div>
            <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No Po Vendor</th>
                        <th>No Po Customer</th>
                        <th>Nama Customer</th>
                        <th>Nama Vendor</th>
                        <th>Tanggal Kirim</th>
                        <th>Tanggal Terima</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prdatas   as $row )
                        <tr>
                            <td>{{ $row->purchase_request_no }}</td>
                            <td>{{ $row->purchase_order_no }}</td>
                            <td>{{ $row->customer_name }}</td>
                             <td>{{ $row->vendor_name }}</td>
                           <td>{{ $row->date_send }}</td>
                            <td>{{ $row->date_recive }}</td>
                           <td>{{ $row->statuspo }}</td>
                           <td><a href="{{ route('operoder.view', $row->id) }}" class="btn btn-primary">Detail</a></td>
                        </tr>
                    @endforeach
                   
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection