<?php $__env->startSection('content'); ?>
<main style="margin-top: 58px">
    <div class="container py-4 px-4">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="py-2 mb-0 ms-4">Edit User</h4>
        </div>
        <div class="card-container px-4">
            <div class="card py-3 px-5">
                <div class="card-body">
                    <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="contact">Contact</label>
                                <input type="text" name="contact" class="form-control" value="<?php echo e(old('contact', $user->contact)); ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="role">Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>Admin</option>
                                    <option value="user" <?php echo e($user->role == 'user' ? 'selected' : ''); ?>>User</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Current Image</label><br>
                                <img id="imagePreview" src="<?php echo e(asset('storage/user_images/' . $user->image_path)); ?>" alt="User Image" width="100" class="img-thumbnail"><br>
                                <label for="userImage">Upload New Image</label>
                                <input type="file" name="userImage" class="form-control-file" id="userImage">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-check-label" for="status">Status</label>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="status" value="0">
                                    <input class="form-check-input" type="checkbox" name="status" value="1" <?php echo e($user->status ? 'checked' : ''); ?>>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>



<script>
    document.getElementById('userImage').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/admin_dashboard/edit_users.blade.php ENDPATH**/ ?>