<?php $__env->startSection('content'); ?>




<main style="margin-top: 20px">
    <div class="container p-5">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="py-2 mb-0 ms-4">Profile Details</h2></h4>
        </div>

        <div class="card-container px-4">
            <div class="card py-3 px-5">
                <div class="card-body">
                    <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
        
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="personal-data-tab" data-bs-toggle="tab" href="#personal-data" role="tab" aria-controls="personal-data" aria-selected="true">Personal Data</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Password</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="personal-data" role="tabpanel" aria-labelledby="personal-data-tab">
                        <div class="mt-4">
                            <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group text-center">
                                            <div>
                                                <img id="profileImage" src="<?php echo e(asset('storage/user_images/' . session('image_path'))); ?>" alt="Profile Image" class="img-fluid mb-2" style="max-height: 150px; max-width: 150px; border-radius: 50%; cursor: pointer;" onclick="document.getElementById('image').click();">
                                            </div>
                                            <input type="file" class="form-control mt-2" id="image" name="image" style="display: none;" accept="image/*" onchange="displayImage(event)">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo e($admin->name); ?>" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo e($admin->email); ?>" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="contact">Contact</label>
                                            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo e($admin->contact); ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 float-end">Update Profile</button>
                            </form>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                        <div class="mt-4">
                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php if(session('status')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('status')); ?>

                                </div>
                            <?php endif; ?>

                            <form action="<?php echo e(route('admin.profile.password.update')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="togglePasswordVisibility('current_password', this)">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="togglePasswordVisibility('new_password', this)">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="new_password_confirmation">Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="togglePasswordVisibility('new_password_confirmation', this)">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small id="passwordError" class="text-danger d-none">Passwords do not match</small>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </div>
</main>


<script>
    function displayImage(event) {
        const image = document.getElementById('profileImage');
        const file = event.target.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            image.src = e.target.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    function togglePasswordVisibility(inputId, icon) {
        const input = document.getElementById(inputId);
        const iconElement = icon.querySelector('i');
        
        // Toggle the type attribute
        if (input.type === "password") {
            input.type = "text";
            iconElement.classList.remove('fa-eye');
            iconElement.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            iconElement.classList.remove('fa-eye-slash');
            iconElement.classList.add('fa-eye');
        }
    }

// Check if passwords match
document.getElementById('new_password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('new_password').value;
    const confirmPassword = this.value;
    const passwordError = document.getElementById('passwordError');

    if (password !== confirmPassword) {
        passwordError.classList.remove('d-none');
    } else {
        passwordError.classList.add('d-none');
    }
});



</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/admin_dashboard/admin_profile.blade.php ENDPATH**/ ?>