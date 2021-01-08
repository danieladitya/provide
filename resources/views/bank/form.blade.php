@extends('layout.app')
@section('content')
<div class="breadcrumb"><h1>Akun Bank</h1> </div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">Form Akun Bank</div>
            <div class="card-body">
                <form action="{{ route('master.bank.store') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $form->id }}" name="id"/>
                    <div class="form-group">
                        <label>Nama Bank</label>
                        <input type="text" class="form-control" value="{{ $form->bank_name }}"  name="bank_name" />
                    </div>
                    <div class="form-group">
                        <label>No Rekening</label>
                        <input type="text" class="form-control"  value="{{ $form->rek_no }}"  name="rek_no" />
                    </div>
                    <div class="form-group">
                        <label>Nama Akun</label>
                        <input type="text" class="form-control"  value="{{ $form->account_name }}" name="account_name" />
                    </div>
                    <button type="submit" class="btn btn-primary"> simpan </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
