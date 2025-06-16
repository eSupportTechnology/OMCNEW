<?php $__env->startSection('dashboard-content'); ?>

<h3 class="py-2 px-2">Edit Profile</h3>
<div class="container p-4">
    <form action="<?php echo e(route('user.updateProfile')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="col-md-3 text-left mb-3">
            <?php if(auth()->user()->profile_image): ?>
                <img src="<?php echo e(asset('storage/' . auth()->user()->profile_image)); ?>" alt="Profile Image" class="rounded-circle" id="profileImagePreview" width="120" height="120" style="cursor: pointer;">
            <?php else: ?>
                <img src="<?php echo e(asset('assets/images/default-user.png')); ?>" alt="Default Profile Image" class="rounded-circle" id="profileImagePreview" width="120" height="120" style="cursor: pointer;">
            <?php endif; ?>
            <!-- Hidden file input for image upload -->
            <input type="file" id="profileImageInput" name="profile_image" accept="image/*" style="display: none;">
        </div>

        <div class="mb-3">
            <label for="fullName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="full_name" value="<?php echo e(old('full_name', auth()->user()->name)); ?>" placeholder="Enter your full name">
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email', auth()->user()->email)); ?>" placeholder="Enter your email">
            </div>
            <div class="col-md-6 mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="tel" class="form-control" id="mobile" name="phone_num" value="<?php echo e(old('phone_num', auth()->user()->phone_num)); ?>" placeholder="Enter your mobile number">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="birthday" class="form-label">Birthday</label>
                <input type="date" class="form-control" id="birthday" name="date_of_birth" value="<?php echo e(old('date_of_birth', auth()->user()->date_of_birth)); ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" id="gender" name="gender">
                    <option selected disabled>Select your gender</option>
                    <option value="male" <?php echo e(auth()->user()->gender == 'male' ? 'selected' : ''); ?>>Male</option>
                    <option value="female" <?php echo e(auth()->user()->gender == 'female' ? 'selected' : ''); ?>>Female</option>
                    <option value="other" <?php echo e(auth()->user()->gender == 'other' ? 'selected' : ''); ?>>Other</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
    </form>
</div>

<script>
    const profileImagePreview = document.getElementById('profileImagePreview');
    const profileImageInput = document.getElementById('profileImageInput');

    // Open file input when profile image is clicked
    profileImagePreview.addEventListener('click', function() {
        profileImageInput.click();
    });

    // Preview the selected image
    profileImageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profileImagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('member_dashboard.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\nilan\OneDrive\Desktop\OMC project\OMC_new\OMCNEW\resources\views/member_dashboard/edit-profile.blade.php ENDPATH**/ ?>