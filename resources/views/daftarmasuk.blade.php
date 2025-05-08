@extends('layouts.main')

@section('content')
<div class="container" style="min-height: 60vh;">
    <div class="row justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><h2>
                    Daftar Pekerja Baru
                </h2></div>

                <div class="card-body">
                    {{-- Papar mesej ralat jika ada --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" 
                                    class="form-control" 
                                    name="name" value="{{ old('name') }}" required autofocus placeholder="Nama Pekerja">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Emel') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" 
                                    class="form-control" 
                                    name="email" value="{{ old('email') }}" required placeholder="Emel Pekerja">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Kata Laluan') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Pengesahan Kata Laluan') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Daftar') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('logmasuk') }}">
                                    {{ __('Sudah ada akaun? Log Masuk') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
