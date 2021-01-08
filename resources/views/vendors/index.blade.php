@extends('layout.app')
@section('content')
<div class="breadcrumb"><h1>Vendor</h1> </div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
<div class="col-sm-5">
<a href="{{ route('master.vendor.add') }}" class="btn btn-primary">Tambah</a>
</div>
</div>

<div class="separator-breadcrumb"></div>
<div class="row">
    <div class="col-sm-10">
    <div class="card">
        <div class="card-header">Daftar Vendor</div>
        <div class="card-body">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Nama Vendor</th>
                        <th>Telpon</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($vendors as $row)
                      <tr>
                        <td>{{ $row->vendor_name }}</td>
                        <td>{{ $row->vendor_phone }}</td>
                        <td>{{ $row->vendor_alamat }}</td>
                        <td><a href="{{ route('master.vendor.edit', $row->id) }}" class="btn btn-success">Edit</a> | <a href="{{  route('master.vendor.delete', $row->id) }}" class="btn btn-danger">Hapus</a></td>
                    </tr>
                @endforeach
                  
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>

@endsection