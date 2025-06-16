<?php $__env->startSection('dashboard-content'); ?>

<h3 class="py-2 px-2">Change Password</h3>
<div class="container p-3">
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <form action="<?php echo e(route('password.update')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        
        <!-- Current Password -->
        <div class="mb-3 position-relative">
            <label for="current_password" class="form-label">Current Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current password">
                <span class="input-group-text" id="toggleCurrentPassword" onclick="togglePassword('current_password', 'eyeCurrentPassword')">
                    <!-- Eye Icon (closed) -->
                    <i id="eyeCurrentPassword" class="fas fa-eye-slash"></i>
                </span>
            </div>
            <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- New Password -->
        <div class="mb-3 position-relative">
            <label for="new_password" class="form-label">New Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New password">
                <span class="input-group-text" id="toggleNewPassword" onclick="togglePassword('new_password', 'eyeNewPassword')">
                    <!-- Eye Icon (closed) -->
                    <i id="eyeNewPassword" class="fas fa-eye-slash"></i>
                </span>
            </div>
            <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Retype New Password -->
        <div class="mb-3 position-relative">
            <label for="new_password_confirmation" class="form-label">Retype New Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Retype new password">
                <span class="input-group-text" id="toggleNewPasswordConfirmation" onclick="togglePassword('new_password_confirmation', 'eyeNewPasswordConfirmation')">
                    <!-- Eye Icon (closed) -->
                    <i id="eyeNewPasswordConfirmation" class="fas fa-eye-slash"></i>
                </span>
            </div>
            <?php $__errorArgs = ['new_password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Show Password Checkbox -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="show_password" onclick="toggleAllPasswords()">
            <label class="form-check-label" for="show_password">
                Show Password
            </label>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Change Password</button>
    </form>
</div>

<script>
    // Toggle password visibility for individual fields
    function togglePassword(inputId, iconId) {
        var passwordField = document.getElementById(inputId);
        var icon = document.getElementById(iconId);

        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        }
    }

    // Toggle all password fields visibility when the checkbox is checked
    function toggleAllPasswords() {
        var showPasswordCheckbox = document.getElementById('show_password');
        var passwordFields = ['current_password', 'new_password', 'new_password_confirmation'];

        // Show/hide all password fields based on checkbox status
        passwordFields.forEach(function(fieldId) {
            var passwordField = document.getElementById(fieldId);
            passwordField.type = showPasswordCheckbox.checked ? 'text' : 'password';
        });

        // Change the icons based on checkbox status
        if (showPasswordCheckbox.checked) {
            document.getElementById('eyeCurrentPassword').classList.remove('fa-eye-slash');
            document.getElementById('eyeCurrentPassword').classList.add('fa-eye');
            document.getElementById('eyeNewPassword').classList.remove('fa-eye-slash');
            document.getElementById('eyeNewPassword').classList.add('fa-eye');
            document.getElementById('eyeNewPasswordConfirmation').classList.remove('fa-eye-slash');
            document.getElementById('eyeNewPasswordConfirmation').classList.add('fa-eye');
        } else {
            document.getElementById('eyeCurrentPassword').classList.remove('fa-eye');
            document.getElementById('eyeCurrentPassword').classList.add('fa-eye-slash');
            document.getElementById('eyeNewPassword').classList.remove('fa-eye');
            document.getElementById('eyeNewPassword').classList.add('fa-eye-slash');
            document.getElementById('eyeNewPasswordConfirmation').classList.remove('fa-eye');
            document.getElementById('eyeNewPasswordConfirmation').classList.add('fa-eye-slash');
        }
    }
</script>






<?php $__env->stopSection(); ?>

<?php echo $__env->make('member_dashboard.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/member_dashboard/change-password.blade.php ENDPATH**/ ?>