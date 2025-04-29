@extends('layouts.app')

@section('content')
<style>

</style>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Welcome to OMC! Please login.</h2>
                @if (Route::has('register'))
                    <a class="btn btn-link-reg" href="{{ route('register') }}">
                        New member? Register here
                    </a>
                @endif
            </div>
            <div class="card logincard p-4 mt-3 mb-5">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Email Address') }}<i class="text-danger">*</i></label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }} <i class="text-danger">*</i></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-primary w-100 mt-4 mb-3">
                                    {{ __('Login') }}
                                </button>

                                <!-- Social Media Buttons -->
                                <div class="mb-3">
                                    <a class="btn btn-secondary w-100 mb-3" href="#" role="button">
                                        <i class="fab fa-facebook-f"></i> Facebook
                                    </a>
                                    <a class="btn btn-danger w-100" href="#" role="button">
                                        <i class="fab fa-google"></i> Google
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
