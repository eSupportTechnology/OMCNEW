<?php $__env->startSection('content'); ?>
    <style>
        .brand-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>

    <main style="margin-top: 58px">
        <div class="container py-4 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="py-3 mb-0">Manage Brands</h3>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBrandModal">Add New Brand</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="brandsTable" class="table category-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Brand Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Top Brand</th>
                                    <th style="width:20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($brand->name); ?></td>
                                        <td><?php echo e($brand->slug); ?></td>
                                        <td>
                                            <?php if($brand->image): ?>
                                                <img src="<?php echo e(asset('storage/' . $brand->image)); ?>" class="brand-image" alt="<?php echo e($brand->name); ?>">
                                            <?php else: ?>
                                                <span class="text-muted">No image</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?php echo e($brand->is_top_brand ? 'success' : 'secondary'); ?>">
                                                <?php echo e($brand->is_top_brand ? 'Yes' : 'No'); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <div class="category-actions">
                                                <a href="<?php echo e(route('brands.edit', $brand->id)); ?>" class="btn btn-sm btn-warning me-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form id="deleteForm<?php echo e($brand->id); ?>"
                                                    action="<?php echo e(route('brands.destroy', $brand->id)); ?>" method="POST"
                                                    style="display: inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete('deleteForm<?php echo e($brand->id); ?>', 'Are you sure you want to delete this brand?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
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

    <!-- Create Brand Modal -->
    <div class="modal fade" id="createBrandModal" tabindex="-1" aria-labelledby="createBrandLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-2">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createBrandForm" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="brandName" class="form-label text-black">Brand Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="brandName" placeholder="Enter brand name" required>
                        </div>

                        <div class="mb-3">
                            <label for="brandSlug" class="form-label text-black">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="slug" id="brandSlug" placeholder="Enter brand slug" required>
                        </div>

                        <div class="mb-3">
                            <label for="brandImage" class="form-label text-black">Brand Image</label>
                            <input type="file" class="form-control" name="image" id="brandImage" accept="image/*">
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="is_top_brand" id="isTopBrand" value="1">
                            <label class="form-check-label" for="isTopBrand">Top Brand</label>
                        </div>

                        <button type="button" class="btn btn-success mt-2" id="saveBrandBtn">Save Brand</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // AJAX Submit for Create Brand
        document.getElementById('saveBrandBtn').addEventListener('click', function() {
            const form = document.getElementById('createBrandForm');
            const formData = new FormData(form);

            fetch('<?php echo e(route('brands.store')); ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('createBrandModal'));
                    modal.hide();
                    Swal.fire('Success', 'Brand created successfully!', 'success').then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', data.message || 'Failed to create brand.', 'error');
                }
            })
            .catch(error => {
                console.error(error);
                Swal.fire('Error', 'An error occurred while saving.', 'error');
            });
        });

        function confirmDelete(formId, message) {
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/admin_dashboard/brands_list.blade.php ENDPATH**/ ?>