<?php $__env->startSection('content'); ?>

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

            <form class="signup-form needs-validation" method="POST" action="<?php echo e(route('signup')); ?>" novalidate>
    <?php echo csrf_field(); ?>
    <div class="row g-4">

        <!-- Full Name -->
        <div class="col-md-6">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   id="name" name="name" required pattern="[A-Za-z\s]+"
                   value="<?php echo e(old('name')); ?>" placeholder="Enter your name">
            <div class="invalid-feedback">Only letters and spaces allowed.</div>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Address -->
        <div class="col-md-6">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   id="address" name="address" required value="<?php echo e(old('address')); ?>"
                   placeholder="Enter your address">
            <div class="invalid-feedback">Please enter your address.</div>
            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- District -->
       <!-- District -->
<div class="col-md-6">
    <label for="district" class="form-label">District</label>
    <select class="form-select <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
            id="district" name="district" required style="height:48px;border:1px solid #b9b8b8">
        <option selected disabled value="">Select your district</option>
        <option value="Ampara" <?php echo e(old('district') == 'Ampara' ? 'selected' : ''); ?>>Ampara</option>
        <option value="Anuradhapura" <?php echo e(old('district') == 'Anuradhapura' ? 'selected' : ''); ?>>Anuradhapura</option>
        <option value="Badulla" <?php echo e(old('district') == 'Badulla' ? 'selected' : ''); ?>>Badulla</option>
        <option value="Batticaloa" <?php echo e(old('district') == 'Batticaloa' ? 'selected' : ''); ?>>Batticaloa</option>
        <option value="Colombo" <?php echo e(old('district') == 'Colombo' ? 'selected' : ''); ?>>Colombo</option>
        <option value="Galle" <?php echo e(old('district') == 'Galle' ? 'selected' : ''); ?>>Galle</option>
        <option value="Gampaha" <?php echo e(old('district') == 'Gampaha' ? 'selected' : ''); ?>>Gampaha</option>
        <option value="Hambantota" <?php echo e(old('district') == 'Hambantota' ? 'selected' : ''); ?>>Hambantota</option>
        <option value="Jaffna" <?php echo e(old('district') == 'Jaffna' ? 'selected' : ''); ?>>Jaffna</option>
        <option value="Kalutara" <?php echo e(old('district') == 'Kalutara' ? 'selected' : ''); ?>>Kalutara</option>
        <option value="Kandy" <?php echo e(old('district') == 'Kandy' ? 'selected' : ''); ?>>Kandy</option>
        <option value="Kegalle" <?php echo e(old('district') == 'Kegalle' ? 'selected' : ''); ?>>Kegalle</option>
        <option value="Kilinochchi" <?php echo e(old('district') == 'Kilinochchi' ? 'selected' : ''); ?>>Kilinochchi</option>
        <option value="Kurunegala" <?php echo e(old('district') == 'Kurunegala' ? 'selected' : ''); ?>>Kurunegala</option>
        <option value="Mannar" <?php echo e(old('district') == 'Mannar' ? 'selected' : ''); ?>>Mannar</option>
        <option value="Matale" <?php echo e(old('district') == 'Matale' ? 'selected' : ''); ?>>Matale</option>
        <option value="Matara" <?php echo e(old('district') == 'Matara' ? 'selected' : ''); ?>>Matara</option>
        <option value="Monaragala" <?php echo e(old('district') == 'Monaragala' ? 'selected' : ''); ?>>Monaragala</option>
        <option value="Mullaitivu" <?php echo e(old('district') == 'Mullaitivu' ? 'selected' : ''); ?>>Mullaitivu</option>
        <option value="Nuwara Eliya" <?php echo e(old('district') == 'Nuwara Eliya' ? 'selected' : ''); ?>>Nuwara Eliya</option>
        <option value="Polonnaruwa" <?php echo e(old('district') == 'Polonnaruwa' ? 'selected' : ''); ?>>Polonnaruwa</option>
        <option value="Puttalam" <?php echo e(old('district') == 'Puttalam' ? 'selected' : ''); ?>>Puttalam</option>
        <option value="Ratnapura" <?php echo e(old('district') == 'Ratnapura' ? 'selected' : ''); ?>>Ratnapura</option>
        <option value="Trincomalee" <?php echo e(old('district') == 'Trincomalee' ? 'selected' : ''); ?>>Trincomalee</option>
        <option value="Vavuniya" <?php echo e(old('district') == 'Vavuniya' ? 'selected' : ''); ?>>Vavuniya</option>
    </select>
    <div class="invalid-feedback">Please select a district.</div>
    <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>



        <!-- Date of Birth -->
        <?php $today = date('Y-m-d'); ?>
        <div class="col-md-6">
            <label for="DOB" class="form-label">Date of Birth</label>
            <input type="date" class="form-control <?php $__errorArgs = ['DOB'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   id="DOB" name="DOB" required value="<?php echo e(old('DOB')); ?>" max="<?php echo e($today); ?>">
            <div class="invalid-feedback">Date must be in the past.</div>
            <?php $__errorArgs = ['DOB'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Phone Number -->
        <div class="col-md-6">
            <label for="phone_num" class="form-label">Phone Number</label>
            <input type="tel" class="form-control <?php $__errorArgs = ['phone_num'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   id="phone_num" name="phone_num" required pattern="^0\d{9}$"
                   value="<?php echo e(old('phone_num')); ?>" placeholder="Enter your phone number">
            <div class="invalid-feedback">Must be 10 digits starting with 0.</div>
            <?php $__errorArgs = ['phone_num'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Email -->
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   id="email" name="email" required
                   value="<?php echo e(old('email')); ?>" placeholder="Enter your email"
                   pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
            <div class="invalid-feedback">Enter a valid email address.</div>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Password -->
        <div class="col-md-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   id="password" name="password" required
                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$"
                   placeholder="Enter your password">
            <div class="invalid-feedback">
                Must include upper, lower, digit, symbol, and be 8+ chars.
            </div>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Confirm Password -->
        <div class="col-md-6">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   id="password_confirmation" name="password_confirmation"
                   required placeholder="Confirm your password">
            <div class="invalid-feedback">Passwords must match.</div>
            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
            <a href="<?php echo e(route('home')); ?>" class="d-block mt-2">or Return to Store</a>
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
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
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
document.getElementById("password").addEventListener("input", function () {
    const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    if (!pattern.test(this.value)) {
        this.setCustomValidity("Weak password: Must be 8+ chars, include upper/lower, number, and symbol.");
    } else {
        this.setCustomValidity("");
    }
});

// Confirm password match
document.getElementById("password_confirmation").addEventListener("input", function () {
    const pw = document.getElementById("password").value;
    if (this.value !== pw) {
        this.setCustomValidity("Passwords do not match.");
    } else {
        this.setCustomValidity("");
    }
});

// Show/hide password
function togglePassword() {
    const pw = document.getElementById("password");
    const confirm = document.getElementById("password_confirmation");
    const type = pw.type === "password" ? "text" : "password";
    pw.type = confirm.type = type;
}
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\OMC\OMCNEW\resources\views/frontend/signup.blade.php ENDPATH**/ ?>