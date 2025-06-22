@extends('layouts.admin-main')

@section('css')

@endsection

@section('content')
<div class="page-heading">
    <h3>Kemaskini Testimonial</h3>
</div>
<div class="container">
    <div class="card shadow p-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Borang Kemaskini Testimoni</h5>
            <a href="{{ route('testimonial.index') }}" class="btn btn-sm btn-secondary ms-2">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('testimonial.update', $testimonial->id) }}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $testimonial->name }}" required>
                </div>

                <div class="form-group">
                    <label for="feedback">Kata-Kata Pelanggan</label>
                    <textarea name="feedback" class="form-control" required>{{ $testimonial->feedback }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Gambar</label>
                    <input type="file" name="image" class="form-control">
                    @if($testimonial->image)
                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Testimonial Image" class="mt-2" width="100">
                    @endif
                </div>

                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
