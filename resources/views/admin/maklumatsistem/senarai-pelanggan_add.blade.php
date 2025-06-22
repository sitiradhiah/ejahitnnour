@extends('layouts.admin-main')

@section('css')
<style>
    .card {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
    }

    .btn-add {
        background-color: #28a745;
        color: white;
        font-weight: bold;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-add:hover {
        background-color: #218838;
    }

    .btn-info, .btn-edit, .btn-delete {
        font-weight: bold;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .btn-info {
        background-color: #17a2b8;
        color: white;
    }

    .btn-edit {
        background-color: #007bff;
        color: white;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    .btn-edit:hover {
        background-color: #0056b3;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    }
</style>
@endsection

@section('content')
<div class="page-heading">
    <h3>Senarai Pekerja</h3>
</div>
<div class="container">
    <div class="card shadow p-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Senarai Pelanggan</h4>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Nama Pelanggan</label>
                    <input type="text" class="form-control" id="name" name="name" value="" required>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group mb-3">
                            <label for="phone">No Telefon</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="" required>
                        </div>
                    </div>
                </div>
               
                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
