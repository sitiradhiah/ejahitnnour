@extends('layouts.admin-main') {{-- Or your admin layout --}}

@section('content')
<div class="container">
    <h3>Edit Announcement</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('announcement.update') }}">
        @csrf

        <div class="form-group">
            <label>Announcement Message</label>
            <input type="text" name="message" class="form-control" value="{{ old('message', $announcement->message ?? '') }}">
        </div>

        <div class="form-check my-2">
            <input type="checkbox" name="is_active" class="form-check-input" id="activeCheck" {{ isset($announcement) && $announcement->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="activeCheck">Show Announcement</label>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
