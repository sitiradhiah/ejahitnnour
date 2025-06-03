@extends('layouts.admin-main')

@section('css')

<style>
    .page-heading {
        margin-bottom: 20px;
        text-align: center;
    }

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
                <h4 class="mb-0">Senarai Pekerja</h4>
                <a href="#" class="btn btn-success">Tambah Pekerja</a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped" style="min-width: 1000px;">
                    <thead>
                        <tr class="tindakan-bg">
                            <th>No</th>
                            <th>Nama Pekerja</th>
                            <th>Jawatan</th>
                            <th>No Telefon</th>
                            <th>Email</th>
                            <th>Status Pengguna</th>
                            <th>Pengesahan Admin?</th>
                            <th class="sticky-col sticky-right tindakan-bg">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($workers as $worker)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $worker->name }}</td>
                            <td>{{ $worker->peranan }}</td>
                            <td>{{ $worker->phone }}</td>
                            <td>{{ $worker->email }}</td>
                            <td>{{ $worker->status }}</td>
                            <td>
                                @if($worker->disahkan == 0)
                                    Sudah Disahkan
                                @else
                                    Belum Disahkan
                                @endif
                            </td>
                            <td class="sticky-col sticky-right tindakan-bg">
                                <a href="{{ route('senarai-pekerja.edit', $worker->id) }}" class="btn btn-primary btn-edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form action="{{ route('senarai-pekerja.destroy', $worker->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-delete" onclick="return confirm('Anda pasti untuk memadam pekerja ini?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
