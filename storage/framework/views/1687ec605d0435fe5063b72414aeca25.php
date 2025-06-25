<?php $__env->startSection('content'); ?>

<style>


</style>

<main style="margin-top: 58px">
    <div class="container pt-4 px-4">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="py-3 mb-0">Products</h3>
            <a href="<?php echo e(route('add_products')); ?>" class="btn btn-primary btn-create">Add Products</a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="container  mb-4">
                    <div class="d-flex justify-content-between mb-4">
                    <select id="category-filter" class="form-select w-25" style="font-size:15px;">
                        <option value="all">All Categories</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->parent_category); ?>"><?php echo e($category->parent_category); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                        <div style="font-size:15px;">
                            <label for="affiliate-only" class="form-check-label">View Affiliate Products Only</label>
                            <input type="checkbox" id="affiliate-only" class="form-check-input">
                        </div>
                    </div>

                    <div class="table-responsive p-0">
                        <table id="example" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:5%">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col" style="width:15%">Category</th>
                                    <th scope="col" style="width:10%">Brand</th>
                                    <th scope="col" style="width:10%">Quantity</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col" style="width:12%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="product-row"
                                    data-category="<?php echo e($product->product_category); ?>"
                                    data-affiliate="<?php echo e($product->is_affiliate ? 'true' : 'false'); ?>"
                                    data-id="<?php echo e($product->product_id); ?>"
                                    data-images="<?php echo e($product->images->toJson()); ?>"
                                    data-variations="<?php echo e($product->variations->toJson()); ?>">
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($product->product_id); ?></td>
                                    <td><?php echo e($product->product_name); ?></td>
                                    <td>
                                        <?php if($product->images->isNotEmpty()): ?>
                                            <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" alt="Product Image" style="max-width: 50px;">
                                        <?php else: ?>
                                            No Image
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($product->product_category ?? 'No Category'); ?></td>
                                    <td><?php echo e($product->brand->name ?? 'No Brand'); ?></td>
                                    <td><?php echo e($product->quantity); ?></td>
                                    <td>Rs <?php echo e(number_format($product->total_price, 2)); ?></td>
                                    <td class="action-buttons">
                                        <a href="<?php echo e(route('product-details', $product->id)); ?>" class="btn btn-info btn-sm view-btn mb-1"
                                        style="font-size: 0.75rem; padding: 0.25rem 0.5rem;"> <i class="fas fa-eye"></i></a>
                                        <a href="<?php echo e(route('edit_product', $product->id)); ?>" class="btn btn-warning btn-sm mb-1" style="font-size: 0.75rem; padding: 0.25rem 0.5rem;"><i class="fas fa-edit"></i></a>
                                        <form id="delete-form-<?php echo e($product->id); ?>" action="<?php echo e(route('delete_product', $product->id)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" class="btn btn-danger btn-sm mb-1" style="font-size: 0.75rem; padding: 0.25rem 0.5rem;" onclick="confirmDelete('delete-form-<?php echo e($product->id); ?>', 'you want to delete this product?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>






<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryFilter = document.getElementById('category-filter');
        const affiliateCheckbox = document.getElementById('affiliate-only');
        const productRows = document.querySelectorAll('.product-row');

        function filterProducts() {
            const selectedCategory = categoryFilter.value;
            const isAffiliateOnly = affiliateCheckbox.checked;

            productRows.forEach(row => {
                const category = row.getAttribute('data-category');
                const isAffiliate = row.getAttribute('data-affiliate') === 'true';

                const showCategory = (selectedCategory === 'all' || category === selectedCategory);
                const showAffiliate = !isAffiliateOnly || isAffiliate;

                if (showCategory && showAffiliate) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        categoryFilter.addEventListener('change', filterProducts);
        affiliateCheckbox.addEventListener('change', filterProducts);
    });
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\OMCNEW\resources\views/admin_dashboard/products.blade.php ENDPATH**/ ?>