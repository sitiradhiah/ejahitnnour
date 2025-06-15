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
                <h4 class="mb-0">Senarai Pekerja</h4>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(isset($worker))
            <form action="{{ route('senarai-pekerja.update', $worker->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name">Nama Pekerja</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $worker->name) }}" required>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group mb-3">
                            <label for="phone">No Telefon</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $worker->phone) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $worker->email) }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group mb-3">
                            <label for="peranan">Jawatan (Peranan di dalam sistem)</label>
                            <select class="form-control" id="peranan" name="peranan" required {{ auth()->id() == $worker->id ? 'disabled' : '' }}>
                                <option value="pekerja" {{ old('peranan', $worker->peranan) == 'pekerja' ? 'selected' : '' }}>Pekerja</option>
                                <option value="pentadbir" {{ old('peranan', $worker->peranan) == 'pentadbir' ? 'selected' : '' }}>Pentadbir</option>
                                <!-- <option value="pelanggan" {{ old('peranan', $worker->peranan) == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option> -->
                            </select>
                            @if(auth()->id() == $worker->id)
                                <input type="hidden" name="peranan" value="{{ $worker->peranan }}">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group mb-3">
                            <label for="status">Status Pengguna</label>
                            @if(auth()->id() == $worker->id)
                                <select class="form-control" id="status" name="status" disabled>
                                    <option value="Aktif" {{ old('status', $worker->status ?? 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('status', $worker->status ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                <input type="hidden" name="status" value="{{ $worker->status }}">
                            @else
                                <select class="form-control" id="status" name="status">
                                    <option value="Aktif" {{ old('status', $worker->status ?? 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('status', $worker->status ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                <a href="{{ route('senarai-pekerja.index') }}" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
            </form>
            @else
                <div class="alert alert-warning">Pekerja tidak dijumpai.</div>
            @endif
        </div>
    </div>
</div>
@endsection
