<?php $__env->startSection('content'); ?>
    <style>
        .responsive-brand-image {
            width: 100px;
            height: auto;
            border-radius: 8px;
        }

        @media (max-width: 576px) {
            .responsive-brand-wrapper {
                margin-top: 1rem;
            }
        }
    </style>

    <main style="margin-top: 58px">
        <div class="container py-4 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="py-2 mb-0 ms-4">Edit Brand</h4>
            </div>
            <div class="card-container px-4">
                <div class="card py-3 px-5">
                    <div class="card-body">
                        <form action="<?php echo e(route('brands.update', $brand->id)); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="mb-3">
                                <label for="brandName" class="form-label text-black">Brand Name</label>
                                <input type="text" class="form-control" id="brandName" name="name"
                                    value="<?php echo e(old('name', $brand->name)); ?>" placeholder="Enter brand name" required>
                            </div>

                            <div class="mb-3">
                                <label for="brandSlug" class="form-label text-black">Slug</label>
                                <input type="text" class="form-control" id="brandSlug" name="slug"
                                    value="<?php echo e(old('slug', $brand->slug)); ?>" placeholder="Enter brand slug" required>
                            </div>

                            <div class="mb-3 responsive-brand-wrapper">
                                <label for="brandImage" class="form-label text-black">Brand Image</label>
                                <?php if($brand->image): ?>
                                    <div>
                                        <img src="<?php echo e(asset('storage/' . $brand->image)); ?>" alt="<?php echo e($brand->name); ?>"
                                            class="responsive-brand-image">
                                    </div>
                                    <br>
                                <?php endif; ?>
                                <input type="file" class="form-control" id="brandImage" name="image" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label for="isTopBrand" class="form-label text-black">Top Brand</label>
                                <select class="form-select" id="isTopBrand" name="is_top_brand">
                                    <option value="1" <?php echo e($brand->is_top_brand ? 'selected' : ''); ?>>Yes</option>
                                    <option value="0" <?php echo e(!$brand->is_top_brand ? 'selected' : ''); ?>>No</option>
                                </select>
                            </div>

                            <div class="d-flex mt-3">
                                <button type="submit" class="btn btn-success">Update Brand</button>
                                <a href="<?php echo e(route('brand_list')); ?>" class="btn btn-secondary ms-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/admin_dashboard/edit_brand.blade.php ENDPATH**/ ?>