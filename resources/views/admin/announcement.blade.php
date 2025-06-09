@extends('layouts.admin-main') {{-- Or your admin layout --}}

@section('content')
<div class="container mb-5">
    <h3>Kemaskini Pengumuman</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('announcement.update') }}">
        @csrf

        <div class="form-group mt-5">
            <label class="mb-3">Mesej Pengumuman </label>
            <textarea name="message" class="form-control" rows="4" style="width:100%;">{{ old('message', $announcement->message ?? '') }}</textarea>
        </div>

        <div class="form-check my-2">
            <input type="checkbox" name="is_active" class="form-check-input" id="activeCheck" {{ isset($announcement) && $announcement->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="activeCheck">Paparkn Pengumuman ?</label>
        </div>

        <button type="submit" class="btn btn-primary mt-1 mb-2">Kemaskini</button>
    </form>
</div>
@endsection
