@extends ('frontend.master')

@section('content')

<!-- Start Page Title -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>My Account</h2>
            <ul>
                <li><a href="/">Home</a></li>
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

            <form class="signup-form needs-validation" method="POST" action="{{ route('signup') }}" novalidate>
    @csrf
    <div class="row g-4">

        <!-- Full Name -->
        <div class="col-md-6">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" required pattern="[A-Za-z\s]+"
                   value="{{ old('name') }}" placeholder="Enter your name">
            <div class="invalid-feedback">Only letters and spaces allowed.</div>
            @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <!-- Address -->
        <div class="col-md-6">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror"
                   id="address" name="address" required value="{{ old('address') }}"
                   placeholder="Enter your address">
            <div class="invalid-feedback">Please enter your address.</div>
            @error('address') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <!-- District -->
       <!-- District -->
<div class="col-md-6">
    <label for="district" class="form-label">District</label>
    <select class="form-select @error('district') is-invalid @enderror"
            id="district" name="district" required style="height:48px;border:1px solid #b9b8b8">
        <option selected disabled value="">Select your district</option>
        <option value="Ampara" {{ old('district') == 'Ampara' ? 'selected' : '' }}>Ampara</option>
        <option value="Anuradhapura" {{ old('district') == 'Anuradhapura' ? 'selected' : '' }}>Anuradhapura</option>
        <option value="Badulla" {{ old('district') == 'Badulla' ? 'selected' : '' }}>Badulla</option>
        <option value="Batticaloa" {{ old('district') == 'Batticaloa' ? 'selected' : '' }}>Batticaloa</option>
        <option value="Colombo" {{ old('district') == 'Colombo' ? 'selected' : '' }}>Colombo</option>
        <option value="Galle" {{ old('district') == 'Galle' ? 'selected' : '' }}>Galle</option>
        <option value="Gampaha" {{ old('district') == 'Gampaha' ? 'selected' : '' }}>Gampaha</option>
        <option value="Hambantota" {{ old('district') == 'Hambantota' ? 'selected' : '' }}>Hambantota</option>
        <option value="Jaffna" {{ old('district') == 'Jaffna' ? 'selected' : '' }}>Jaffna</option>
        <option value="Kalutara" {{ old('district') == 'Kalutara' ? 'selected' : '' }}>Kalutara</option>
        <option value="Kandy" {{ old('district') == 'Kandy' ? 'selected' : '' }}>Kandy</option>
        <option value="Kegalle" {{ old('district') == 'Kegalle' ? 'selected' : '' }}>Kegalle</option>
        <option value="Kilinochchi" {{ old('district') == 'Kilinochchi' ? 'selected' : '' }}>Kilinochchi</option>
        <option value="Kurunegala" {{ old('district') == 'Kurunegala' ? 'selected' : '' }}>Kurunegala</option>
        <option value="Mannar" {{ old('district') == 'Mannar' ? 'selected' : '' }}>Mannar</option>
        <option value="Matale" {{ old('district') == 'Matale' ? 'selected' : '' }}>Matale</option>
        <option value="Matara" {{ old('district') == 'Matara' ? 'selected' : '' }}>Matara</option>
        <option value="Monaragala" {{ old('district') == 'Monaragala' ? 'selected' : '' }}>Monaragala</option>
        <option value="Mullaitivu" {{ old('district') == 'Mullaitivu' ? 'selected' : '' }}>Mullaitivu</option>
        <option value="Nuwara Eliya" {{ old('district') == 'Nuwara Eliya' ? 'selected' : '' }}>Nuwara Eliya</option>
        <option value="Polonnaruwa" {{ old('district') == 'Polonnaruwa' ? 'selected' : '' }}>Polonnaruwa</option>
        <option value="Puttalam" {{ old('district') == 'Puttalam' ? 'selected' : '' }}>Puttalam</option>
        <option value="Ratnapura" {{ old('district') == 'Ratnapura' ? 'selected' : '' }}>Ratnapura</option>
        <option value="Trincomalee" {{ old('district') == 'Trincomalee' ? 'selected' : '' }}>Trincomalee</option>
        <option value="Vavuniya" {{ old('district') == 'Vavuniya' ? 'selected' : '' }}>Vavuniya</option>
    </select>
    <div class="invalid-feedback">Please select a district.</div>
    @error('district')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>



        <!-- Date of Birth -->
        @php $today = date('Y-m-d'); @endphp
        <div class="col-md-6">
            <label for="DOB" class="form-label">Date of Birth</label>
            <input type="date" class="form-control @error('DOB') is-invalid @enderror"
                   id="DOB" name="DOB" required value="{{ old('DOB') }}" max="{{ $today }}">
            <div class="invalid-feedback">Date must be in the past.</div>
            @error('DOB') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <!-- Phone Number -->
        <div class="col-md-6">
            <label for="phone_num" class="form-label">Phone Number</label>
            <input type="tel" class="form-control @error('phone_num') is-invalid @enderror"
                   id="phone_num" name="phone_num" required pattern="^0\d{9}$"
                   value="{{ old('phone_num') }}" placeholder="Enter your phone number">
            <div class="invalid-feedback">Must be 10 digits starting with 0.</div>
            @error('phone_num') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <!-- Email -->
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   id="email" name="email" required
                   value="{{ old('email') }}" placeholder="Enter your email"
                   pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
            <div class="invalid-feedback">Enter a valid email address.</div>
            @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <!-- Password -->
        <div class="col-md-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                   id="password" name="password" required
                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$"
                   placeholder="Enter your password">
            <div class="invalid-feedback">
                Must include upper, lower, digit, symbol, and be 8+ chars.
            </div>
            @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <!-- Confirm Password -->
        <div class="col-md-6">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                   id="password_confirmation" name="password_confirmation"
                   required placeholder="Confirm your password">
            <div class="invalid-feedback">Passwords must match.</div>
            @error('password_confirmation') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <!-- Show Password -->
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="show_password" onclick="togglePassword()">
                <label class="form-check-label" for="show_password">Show Password</label>
            </div>
        </div>

        <!-- Submit -->
        <div class="col-12 text-center mt-3">
            <button type="submit" class="btn btn-primary px-5 py-2">Signup</button>
            <br>
            <a href="{{ route('home') }}" class="d-block mt-2">or Return to Store</a>
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
<script>
// Bootstrap 5 validation
(() => {
    'use strict';

    const form = document.querySelector('.needs-validation');

    // Add input/change listeners to each form field for real-time feedback
    Array.from(form.elements).forEach(field => {
        if (field.tagName !== 'BUTTON' && field.type !== 'hidden') {
            const eventType = ['checkbox', 'radio', 'select-one'].includes(field.type) ? 'change' : 'input';
            field.addEventListener(eventType, () => {
                if (field.checkValidity()) {
                    field.classList.remove('is-invalid');
                    field.classList.add('is-valid');
                } else {
                    field.classList.remove('is-valid');
                    field.classList.add('is-invalid');
                }
            });
        }
    });

    // Prevent form submission if any field is invalid
    form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        form.classList.add('was-validated');
    });
})();

// Restrict Full Name to letters and space
document.getElementById("name").addEventListener("input", function () {
    this.value = this.value.replace(/[^A-Za-z\s]/g, '');
});

// Validate DOB (must be past)
document.getElementById("DOB").addEventListener("input", function () {
    const inputDate = new Date(this.value);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    if (inputDate > today) {
        this.setCustomValidity("Date of Birth must be in the past.");
    } else {
        this.setCustomValidity("");
    }
});

// Restrict phone to digits and max 10
document.getElementById("phone_num").addEventListener("input", function () {
    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
});

// Live password validation
passwordField.addEventListener("input", function () {
    const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    if (!pattern.test(this.value)) {
        this.setCustomValidity("Weak password: Must be 8+ chars, include upper/lower, number, and symbol.");
    } else {
        this.setCustomValidity("");
    }

    // Re-check confirmation field too
    confirmPasswordField.dispatchEvent(new Event('input'));
});

// Confirm password match
confirmPasswordField.addEventListener("input", function () {
    if (this.value !== passwordField.value) {
        this.setCustomValidity("Passwords do not match.");
    } else {
        this.setCustomValidity("");
    }
});

// Show/hide password
// function togglePassword() {
//     const pw = document.getElementById("password");
//     const confirm = document.getElementById("password_confirmation");
//     const type = pw.type === "password" ? "text" : "password";
//     pw.type = confirm.type = type;
// }
</script>

@endsection
