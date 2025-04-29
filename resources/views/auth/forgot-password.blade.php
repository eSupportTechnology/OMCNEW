@extends('frontend.master')

@section('content')

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6">
            <div class="login-content">
                <h2>Forgot Password</h2>

                @if (session('status'))
                    <!-- Show success message -->
                    <div class="alert alert-success fw-bold text-center">
                        {{ session('status') }}
                    </div>
                @else
                    <!-- Show the form -->
                    <form class="login-form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   placeholder="Email address" 
                                   value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="default-btn">Send Password Reset Link</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
