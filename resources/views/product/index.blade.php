@extends('layout.app')
@section('content')
<div class="breadcrumb"><h1>Produk</h1> </div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
<div class="col-sm-5">
<a href="{{ route('master.product.add') }}" class="btn btn-primary">Tambah</a>
</div>
</div>

<div class="separator-breadcrumb"></div>
<div class="row">
    <div class="col-sm-10">
    <div class="card">
        <div class="card-header">Daftar Produk</div>
        <div class="card-body">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>
                @foreach ($products as $row)
                      <tr>
                        <td>{{ $row->product_name }}</td>
                        <td><a href="{{ route('master.product.edit', $row->id) }}" class="btn btn-success">Edit</a> | <a href="{{  route('master.product.delete', $row->id) }}" class="btn btn-danger">Hapus</a></td>
                    </tr>
                @endforeach
                  
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>

@endsection