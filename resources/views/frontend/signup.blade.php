@extends ('frontend.master')

@section('content')

<!-- Start Page Title -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>My Account</h2>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li>Signup</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Start SignUP Area -->
<section class="signup-area ptb-100" style="background-color: #f9f9f9;">
    <div class="container-fluid px-5">
        <div class="signup-content mx-auto" style="max-width: 1400px;">
            <h2 class="text-center mb-5">Create an Account</h2>

            <form class="signup-form" method="POST" action="{{ route('signup') }}">
                @csrf
                <div class="row g-4">
                    <!-- Full Name -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}" required>
                            @error('name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter your address" value="{{ old('address') }}" required>
                            @error('address')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <!-- District -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="district">District</label>
                            <input type="text" class="form-control @error('district') is-invalid @enderror" id="district" name="district" placeholder="Enter your district" value="{{ old('district') }}" required>
                            @error('district')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <!-- Date of Birth -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="DOB">Date of Birth</label>
                            <input type="date" class="form-control @error('DOB') is-invalid @enderror" id="DOB" name="DOB" value="{{ old('DOB') }}" required>
                            @error('DOB')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone Number -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_num">Phone Number</label>
                            <input type="tel" class="form-control @error('phone_num') is-invalid @enderror" id="phone_num" name="phone_num" placeholder="Enter your phone number" value="{{ old('phone_num') }}" required>
                            @error('phone_num')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                            @error('email')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" required>
                            @error('password')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                            @error('password_confirmation')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <!-- Show Password -->
                    <div class="col-12">
                        <div class="form-group d-flex align-items-center">
                            <input type="checkbox" id="show_password" onclick="togglePassword()" style="transform: scale(1.3)">
                            <label for="show_password" class="ms-2" style="font-size: 17px; font-weight:500">Show Password</label>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="default-btn px-5 py-3">Signup</button>
                        <br>
                        <a href="{{ route('home') }}" class="return-store mt-3 d-inline-block">or Return to Store</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- End SignUP Area -->




<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        var confirmPasswordField = document.getElementById("password_confirmation");

        // Toggle visibility of password fields
        if (document.getElementById("show_password").checked) {
            passwordField.type = "text";
            confirmPasswordField.type = "text";
        } else {
            passwordField.type = "password";
            confirmPasswordField.type = "password";
        }
    }
</script>

@endsection
