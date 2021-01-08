@extends('layout.app')
@section('content')
<div class="breadcrumb"><h1>Produk</h1> </div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <div class="col-sm-8">
        <div class="card">
        <div class="card-header">Form Produk</div>
            <div class="card-body">
                <form action="{{ route('master.product.store') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $form->id }}" name="id"/>
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" value="{{ $form->product_name }}"  name="product_name" />
                    </div>
                    <button type="submit" class="btn btn-primary"> simpan </button>
                </form>
            </div>
        </div>
        </div>
    </div>
 
 
@endsection