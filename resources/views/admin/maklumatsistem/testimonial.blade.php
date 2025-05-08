@extends('layouts.admin-main')

@section('css')
<style>
    .page-heading {
        margin-bottom: 20px;
        text-align: center;
    }
</style>
@endsection

@section('content')
<div class="page-heading">
    <h3>Pengurusan Testimonial</h3>
</div>
<div class="container">
    <div class="card shadow p-3">
        <div class="card-header">
            <h4>Pengurusan Testimonial</h4>
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
            
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
