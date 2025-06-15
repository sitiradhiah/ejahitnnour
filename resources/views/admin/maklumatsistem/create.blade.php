@extends('layouts.admin-main')

@section('content')
<div class="page-heading">
    <h3>Tambah Pekerja Baru</h3>
</div>
<div class="container">
    <div class="card shadow p-3">
        <div class="card-header">
            <h4>Tambah Pekerja Baru</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('senarai-pekerja.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Pekerja</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="role">Peranan</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="">-- Pilih Peranan --</option>
                        <option value="pekerja">Pekerja</option>
                        <option value="pentadbir">Pentadbir</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">No. Telefon</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Kata Laluan</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Pengesahan Kata Laluan</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-sm btn-success">Daftar Pekerja</button>
                <a href="{{ route('senarai-pekerja.index') }}" class="btn btn-sm btn-secondary ml-2">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
