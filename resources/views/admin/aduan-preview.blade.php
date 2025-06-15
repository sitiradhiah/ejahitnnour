@extends('layouts.admin-main')

@section('content')
<div class="page-heading">
    <h3>Preview Aduan / Cadangan</h3>
</div>
<div class="container">
    <div class="card shadow p-4">
        <h5><strong>Nama Pelanggan:</strong> {{ $aduan->nama_pelanggan }}</h5>
        <h5><strong>Tajuk:</strong> {{ $aduan->tajuk }}</h5>
        <h5><strong>Kategori:</strong> {{ $aduan->kategori }}</h5>
        <h5><strong>Tarikh:</strong> {{ $aduan->tarikh->format('Y-m-d') }}</h5>
        <h5><strong>Status:</strong> {{ $aduan->status }}</h5>
        <hr>
        <h5><strong>Isi Mesej:</strong></h5>
        <p>{{ $aduan->message }}</p>
        <a href="{{ route('aduan-cadangan.index') }}" class="btn btn-sm btn-secondary mt-3">Kembali ke Senarai</a>
    </div>
</div>
@endsection
