<?php $__env->startSection('content'); ?>
    <style>
        /* Ensure image scales within container */
        .responsive-carousel-image {
            width: 100%;
            height: auto;
            max-width: 750px;
            /* Optional limit for large screens */
            border-radius: 8px;
        }

        /* Margin adjustments for smaller screens */
        @media (max-width: 576px) {
            .responsive-carousel-wrapper {
                margin-top: 1rem;
            }
        }
    </style>

    <main style="margin-top: 58px">
        <div class="container py-4 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="py-2 mb-0 ms-4">Edit Carousels</h4>
            </div>
            <div class="card-container px-4">
                <div class="card py-3 px-5">
                    <div class="card-body">
                        <form action="<?php echo e(route('update_carousel', $carousel->id)); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="mb-3">
                                <label for="carouselName" class="form-label text-black">Carousel Title</label>
                                <input type="text" class="form-control" id="carouselName" name="title"
                                    value="<?php echo e(old('title', $carousel->title)); ?>" placeholder="Enter carousel title">
                            </div>

                            <div class="mb-3 responsive-carousel-wrapper">
                                <label for="image" class="form-label text-black">Carousel Image</label>
                                <?php if($carousel->image_path): ?>
                                    <div>
                                        <img src="<?php echo e(asset('storage/carousel_images/' . $carousel->image_path)); ?>"
                                            alt="Carousel Image" class="responsive-carousel-image">
                                    </div>
                                    <br>
                                <?php endif; ?>
                                <input type="file" class="form-control" id="image_path" name="image_path">
                            </div>


                            <div class="mb-3">
                                <label for="carouselIsActive" class="form-label text-black">Status</label>
                                <select class="form-select" id="carouselIsActive" name="is_active">
                                    <option value="1" <?php echo e($carousel->is_active == 1 ? 'selected' : ''); ?>>Active</option>
                                    <option value="0" <?php echo e($carousel->is_active == 0 ? 'selected' : ''); ?>>Inactive
                                    </option>
                                </select>
                            </div>


                            <button type="submit" class="btn btn-success mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/admin_dashboard/edit_carousel.blade.php ENDPATH**/ ?>