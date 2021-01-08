@extends('layout.app')
@section('content')
<div class="breadcrumb"><h1>Customer</h1> </div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">Form Customer</div>
            <div class="card-body">
                <form action="{{ route('master.customer.store') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $form->id }}" name="id"/>
                    <div class="form-group">
                        <label>Nama Customer</label>
                        <input type="text" class="form-control" value="{{ $form->customer_name }}"  name="customer_name" />
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" class="form-control"  value="{{ $form->customer_phone }}"  name="customer_phone" />
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control"  value="{{ $form->customer_address }}" name="customer_address" />
                    </div>
                    <button type="submit" class="btn btn-primary"> simpan </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
