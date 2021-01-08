@extends('layout.app')
@section('content')
<div class="breadcrumb"><h1>Customer</h1> </div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
<div class="col-sm-5">
<a href="{{ route('master.customer.add') }}" class="btn btn-primary">Tambah</a>
</div>
</div>

<div class="separator-breadcrumb"></div>
<div class="row">
    <div class="col-sm-10">
    <div class="card">
        <div class="card-header">Daftar Customer</div>
        <div class="card-body">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Nama Customer</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>
                @foreach ($customers as $row)
                      <tr>
                        <td>{{ $row->customer_name }}</td>
                        <td>{{ $row->customer_phone }}</td>
                        <td>{{ $row->customer_address }}</td>
                        <td><a href="{{ route('master.customer.edit', $row->id) }}" class="btn btn-success">Edit</a> | <a href="{{  route('master.customer.delete', $row->id) }}" class="btn btn-danger">Hapus</a></td>
                    </tr>
                @endforeach
                  
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>

@endsection