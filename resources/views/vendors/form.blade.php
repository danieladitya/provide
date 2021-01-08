@extends('layout.app')
@section('content')
<div class="breadcrumb"><h1>Vendor</h1> </div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">Form Vendor</div>
            <div class="card-body">
                <form action="{{ route('master.vendor.store') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $form->id }}" name="id"/>
                    <div class="form-group">
                        <label>Nama vendor</label>
                        <input type="text" class="form-control" value="{{ $form->vendor_name }}"  name="vendor_name" />
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" class="form-control"  value="{{ $form->vendor_phone }}"  name="vendor_phone" />
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control"  value="{{ $form->vendor_alamat }}" name="vendor_alamat" />
                    </div>
                    <button type="submit" class="btn btn-primary"> simpan </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
