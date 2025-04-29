@extends('frontend.master')

@section('content')

<!-- Start Page Title -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>My Account</h2>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li>Login</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Success Message -->
@if (session('success'))
<div class="alert alert-success" id="successMessage">
    {{ session('success') }}
</div>
@endif

<!-- Start Login Area -->
<section class="login-area ptb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="login-content">
                    <h2>Login</h2>

                    <form class="login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Username or email address" value="{{ old('email') }}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group position-relative">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" required>                           
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Show Password Checkbox -->
                        <div class="form-group d-flex align-items-center">
                            <input type="checkbox" id="show_password" onclick="togglePassword()" style="transform: scale(1.3)">
                            <span for="show_password" class="mx-2" style="font-size: 17px; font-weight:500">Show Password</span>
                        </div>

                        <button type="submit" class="default-btn">Login</button>

                        <a href="{{route('lost_password')}}" class="forgot-password">Lost your password?</a>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="new-customer-content">
                    <h2>New Customer</h2>

                    <span>Create An Account</span>
                    <p>Sign up for a free account at our store. Registration is quick and easy. It allows you to be able to order from our shop. To start shopping, click register.</p>
                    <a href="{{ route('signup') }}" class="optional-btn">Create An Account</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Login Area -->


<!-- Password Toggle Script -->
<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");

        // Toggle visibility of the password field
        if (document.getElementById("show_password").checked) {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>

@endsection




