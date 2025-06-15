@extends('layouts.admin-main')

@section('content')
<div class="page-heading">
    <h3>Tambah Pekerja atau Pentadbir Baru</h3>
</div>
<div class="container">
    <div class="card shadow p-3">

        <div class="card-body">
            <form method="POST" action="{{ route('senarai-pekerja.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Pengguna Sistem </label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="peranan">Peranan</label>
                    <select name="peranan" id="peranan" class="form-control @error('peranan') is-invalid @enderror" required>
                        <option value="">-- Pilih Peranan --</option>
                        <option value="pekerja" {{ old('role') == 'pekerja' ? 'selected' : '' }}>Pekerja</option>
                        <option value="pentadbir" {{ old('role') == 'pentadbir' ? 'selected' : '' }}>Pentadbir</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">No. Telefon</label>
                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Kata Laluan (min 8 aksara)</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Pengesahan Kata Laluan (min 8 aksara)</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
