@extends('layout.app')
@section('content')
<div class="breadcrumb"><h1>Pengiriman Po</h1> </div>
<div class="separator-breadcrumb border-top"></div>
<form action="{{ route('master.vendor.store') }}" method="POST">
<div class="row">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">Form Pengiriman</div>
            <div class="card-body">
                @csrf
                    <div class="form-group">
                        <input type="text" readonly="true" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Po Customer</label>
                        <select>
                            <option></option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"> simpan </button>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
