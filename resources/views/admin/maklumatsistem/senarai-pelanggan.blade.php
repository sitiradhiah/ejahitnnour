@extends('layouts.admin-main')

@section('css')
<style>
     .card {
        margin-bottom: 20px;
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

    /* .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    } */
</style>
@endsection

@section('content')
<div class="page-heading">
    <h3>Senarai Pelanggan</h3>
</div>
<div class="container">
    <div class="card shadow p-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Senarai Pelanggan</h4>
                <a href="#" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Pelanggan</a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th >Nama Pelanggan</th>
                        <th>No Phone</th>
                        <th>Email</th>
                        <th style="width: 15%; text-align: center;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pelanggan as $index => $item)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->phone ?? '-' }}</td>
                        <td>{{ $item->email ?? '-' }}</td>
                        <td style="text-align: center;">
                            <a href="#" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
