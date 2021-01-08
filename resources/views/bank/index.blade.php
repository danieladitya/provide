@extends('layout.app')
@section('content')
<div class="breadcrumb"><h1>Akun Bank</h1> </div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
<div class="col-sm-5">
<a href="{{ route('master.bank.add') }}" class="btn btn-primary">Tambah</a>
</div>
</div>

<div class="separator-breadcrumb"></div>
<div class="row">
    <div class="col-sm-10">
    <div class="card">
        <div class="card-header">Daftar Akun Bank</div>
        <div class="card-body">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Nama Bank</th>
                        <th>No Rekening</th>
                        <th>Nama Account</th>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>
                @foreach ($bank as $row)
                      <tr>
                        <td>{{ $row->bank_name }}</td>
                        <td>{{ $row->rek_no }}</td>
                        <td>{{ $row->account_name }}</td>
                        <td><a href="{{ route('master.bank.edit', $row->id) }}" class="btn btn-success">Edit</a> | <a href="{{  route('master.bank.delete', $row->id) }}" class="btn btn-danger">Hapus</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>

@endsection