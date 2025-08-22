@extends('frontend.master')

@section('content')
<style>
    body, html {
        height: 100%;
    }
    .login-page {
        min-height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background: #f5f5f5;
    }
    .logincard {
        max-width: 400px;
        width: 100%;
        text-align: center;
    }
    .logincard .form-control {
        text-align: center;
    }
    .footer-full {
        width: 100%;
        color: #fff;
        padding: 20px 0;
        text-align: center;
        margin-top: auto;
    }
</style>

<div class="login-page">
    <h2 class="mb-4">Welcome to OMC! Please login.</h2>

    <div class="card logincard p-4 mb-5 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }} <i class="text-danger">*</i></label>
                    <input id="email" type="email" placeholder="Email address"
                           class="form-control @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }} <i class="text-danger">*</i></label>
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror" name="password"
                           required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3 form-check text-start">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                           {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">{{ __('Login') }}</button>

                @if (Route::has('password.request'))
                    <div class="mb-3">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                @endif

                <div class="text-center">
                    <small>Don't have an account? <a href="{{ route('signup') }}">Register here</a></small>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="footer-full">
    <p>© 2025 Online Marketing Complex. All rights reserved.</p>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const emailField = document.getElementById("email");
    emailField.addEventListener("input", function() {
        const email = emailField.value.trim();
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (regex.test(email)) {
            emailField.classList.remove("is-invalid");
            emailField.classList.add("is-valid");
        } else {
            emailField.classList.remove("is-valid");
            emailField.classList.add("is-invalid");
        }
    });
});
</script>
@endsection
