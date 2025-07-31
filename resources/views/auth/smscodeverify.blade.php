<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SMS Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height:100vh;">

    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
        <h4 class="mb-3 text-center">Verify Your SMS</h4>

        {{-- Success and Error Messages --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('sms-verify.code') }}">
            @csrf
{{-- {{ dd(session('phone')) }} --}}
            <input type="hidden" name="phone" value="{{ session('phone') }}">

            <div class="mb-3">
                <label for="code" class="form-label">Enter Verification Code</label>
                <input
                    type="text"
                    name="code"
                    id="code"
                    class="form-control @error('code') is-invalid @enderror"
                    placeholder="e.g. 123456"
                    required
                    autofocus
                >
                @error('code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Verify</button>

            {{-- Uncomment if needed --}}
            {{--
            <div class="text-center mt-3">
                <small>Didn’t receive a code? <a href="{{ route('resend.code') }}">Resend</a></small>
            </div>
            --}}
        </form>
    </div>

</body>
</html>
