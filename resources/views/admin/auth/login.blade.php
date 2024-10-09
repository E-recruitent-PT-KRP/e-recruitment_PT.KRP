@extends('layout.app')

@section('konten')

<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mainlogin.css') }}">
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form method="POST" class="login100-form validate-form" action="{{ route('login') }}">
                    @csrf
                    <span class="login100-form-title p-b-43">
                        Login Admin
                    </span>
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Alamat Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                                <span class="input-group-text" id="togglePassword">
                                    <i class="bi bi-eye-slash"></i>
                                </span>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                    old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary me-2">
                                Login
                            </button>

                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                Lupa Password ?
                            </a>
                            @endif
                        </div>
                    </div>
                </form>
                <div class="login100-more" style="background-image: url('{{ asset('assets/img/menu/tambang.jpg') }}');">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('asset/js/main.js') }}"></script>
</body>

@endsection