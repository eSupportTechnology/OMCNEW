<?php $__env->startSection('content'); ?>
    <style>
        .arrow-toggle {
            margin-right: 5px;
        }
    </style>

    <main style="margin-top: 58px">
        <div class="container py-4 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="py-3 mb-0">Manage Carousels</h3>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add New
                    Carousel</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table category-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th style="width:20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $carousels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carousel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($carousel->title); ?></td>
                                        <td>
                                            <?php if($carousel->image_path): ?>
                                                <img src="<?php echo e(asset('storage/carousel_images/' . basename($carousel->image_path))); ?>"
                                                    alt="Carousel Image" style="max-width: 70px;">
                                            <?php else: ?>
                                                No Image
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <div class="category-actions">
                                                <a href="<?php echo e(route('edit_carousel', $carousel->id)); ?>"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-sm btn-danger delete-category"
                                                    data-id="<?php echo e($carousel->id); ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>







    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-2">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Carousel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="carouselForm" method="POST" action="<?php echo e(route('carousel_add')); ?>"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="title" class="form-label text-black">Carousel Title <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Enter carousel name" required>
                        </div>
                        <div class="mb-3">
                            <label for="image_path" class="form-label text-black">Carousel Image <span
                                    class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="image_path" name="image_path" required>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Add Carousel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        //delete the categories
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-category').forEach(function(button) {
                button.addEventListener('click', function() {
                    const carouselId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        customClass: {
                            container: 'delete-confirm-modal'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/admin/carousel/${carouselId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute(
                                            'content'),
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok.');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.status) {
                                        Swal.fire(
                                            'Deleted!',
                                            'Carousel has been deleted.',
                                            'success'
                                        ).then(() => {
                                            this.closest('tr').remove();
                                        });
                                    } else {
                                        console.error(
                                            'Server response does not indicate success:',
                                            data);
                                        Swal.fire(
                                            'Failed!',
                                            data.message ||
                                            'Failed to delete the category.',
                                            'error'
                                        );
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire(
                                        'Error!',
                                        'An error occurred while deleting the category.',
                                        'error'
                                    );
                                });
                        }
                    });
                });
            });
        });
    </script>



    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/admin_dashboard/carousel.blade.php ENDPATH**/ ?>