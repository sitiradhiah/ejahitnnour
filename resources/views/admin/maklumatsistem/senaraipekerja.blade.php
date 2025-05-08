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
            <h4>Senarai Pekerja</h4>
            <a href="{{ route('pekerja.create') }}" class="btn btn-success">Tambah Pekerja</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pekerja</th>
                        <th>Jawatan</th>
                        <th>No Telefon</th>
                        <th>Email</th>
                        <th>Tindakan</th>
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
                        <td>
                            <a href="{{ route('pekerja.edit', $worker->id) }}" class="btn btn-primary btn-edit">Edit</a>
                
                            <form action="{{ route('pekerja.destroy', $worker->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-delete" onclick="return confirm('Anda pasti untuk memadam pekerja ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
