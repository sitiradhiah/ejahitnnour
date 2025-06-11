@extends('layouts.admin-main')

@section('css')
<style>
</style>
@endsection

@section('content')
<div class="container mb-5">
    <div class="page-heading">
        <h3>Tetapan Sistem (Setting)</h3>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $activeTab = session('active_tab') ?? old('active_tab', 'maklumat-kedai');
    @endphp
    <ul class="nav nav-tabs mb-3" id="tetapanTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $activeTab === 'maklumat-kedai' ? 'active' : '' }}" id="maklumat-kedai-tab" data-bs-toggle="tab" data-bs-target="#maklumat-kedai" type="button" role="tab" aria-controls="maklumat-kedai" aria-selected="false">
                Maklumat Kedai
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $activeTab === 'announcement' ? 'active' : '' }}" id="announcement-tab" data-bs-toggle="tab" data-bs-target="#announcement" type="button" role="tab" aria-controls="announcement" aria-selected="true">
                Pengumuman
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $activeTab === 'email' ? 'active' : '' }}" id="email-tab" data-bs-toggle="tab" data-bs-target="#email" type="button" role="tab" aria-controls="email" aria-selected="false">
                Emel
            </button>
        </li>
    </ul>
    <div class="tab-content" id="tetapanTabContent">
        <div class="tab-pane fade {{ $activeTab === 'maklumat-kedai' ? 'show active' : '' }}" id="maklumat-kedai" role="tabpanel" aria-labelledby="maklumat-kedai-tab">
            @include('admin.maklumatsistem.tetapan.maklumat-kedai')
        </div>
        <div class="tab-pane fade {{ $activeTab === 'announcement' ? 'show active' : '' }}" id="announcement" role="tabpanel" aria-labelledby="announcement-tab">
            @include('admin.maklumatsistem.tetapan.announcement')
        </div>
        <div class="tab-pane fade {{ $activeTab === 'email' ? 'show active' : '' }}" id="email" role="tabpanel" aria-labelledby="email-tab">
            @include('admin.maklumatsistem.tetapan.email')
        </div>
    </div>

</div>
@endsection
@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const activeTab = "{{ session('active_tab') ?? old('active_tab', 'maklumat-kedai') }}";
        const triggerEl = document.querySelector(`#${activeTab}-tab`);
        if (triggerEl) {
            const tab = new bootstrap.Tab(triggerEl);
            tab.show();
        }
    });
</script>

@endsection
