@extends('layouts.main')

@section('content')
{{-- style="background: linear-gradient(to right, purple, pink);" --}}
<div class="container" style="min-height: 60vh;">
    <div class="row justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><h2>
                    Log Masuk Pekerja
                </h2></div>

                <div class="card-body">
                    {{-- Display general error message at the top --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('authenticate') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Emel') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control"
                                    name="email" value="{{ old('email') }}" autocomplete="email" autofocus required placeholder="Emel">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Kata Laluan') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ingat Saya') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    {{ __('Log Masuk') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-sm btn-link" href="{{ route('password.request') }}">
                                    {{ __('Lupa Kata Laluan?') }}
                                </a>
                                @endif

                                <!-- Button Daftar Pekerja Baru -->
                                <a class="btn btn-sm btn-link" href="{{ route('register') }}">
                                    {{ __('Daftar Pekerja Baru') }}
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
