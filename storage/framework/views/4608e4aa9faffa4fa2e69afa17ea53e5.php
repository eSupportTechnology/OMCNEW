<?php $__env->startSection('content'); ?>

<style>
    .btn-create {
        font-size: 0.8rem;
    }

    input[type="text"], input[type="number"], input[type="datetime-local"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 20px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .product-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }
</style>

<main style="margin-top: 20px">
    <div class="container py-5">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="py-2 mb-0 ms-4">Edit Sales</h4>
        </div>

        <div class="card-container px-4">
            <div class="card py-2 px-4">
                <div class="card-body">
                    <form action="<?php echo e(route('update_sale', $sale->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('POST'); ?> <!-- Ensure to include this for the update route -->
                        <div class="row mb-4">
                            <div class="form-group col-4">
                                <label for="end_date">Flash Sale End Date and Time *</label>
                                <input type="datetime-local" id="end_date" name="end_date" value="<?php echo e(\Carbon\Carbon::parse($sale->end_date)->format('Y-m-d\TH:i')); ?>" required>
                            </div>
                        </div>

                        <table class="table table-bordered" id="products-table">
                            <thead>
                                <tr>
                                    <th style="width: 30%">Product Image & ID *</th>
                                    <th>Normal Price</th>
                                    <th>Sale Rate (%)</th>
                                    <th>Sale Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <td>
                            <select name="products[0][product_id]" class="form-control product-select" required>
                                <option value="">Select a product</option>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($product->product_id); ?>" data-price="<?php echo e($product->normal_price); ?>" <?php echo e($product->product_id == $sale->product->product_id ? 'selected' : ''); ?>>
                                        <?php echo e($product->product_id); ?> - <?php echo e($product->product_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>

                                <td>
                                    <input type="text" name="products[0][normal_price]" class="form-control product-price" value="<?php echo e($sale->normal_price); ?>" required readonly>
                                </td>
                                <td>
                                <input type="text" name="products[0][sale_rate]" class="form-control sale-rate" value="<?php echo e($sale->sale_rate); ?>" required>
                                </td>
                                <td>
                                    <input type="text" name="products[0][sale_price]" class="form-control sale-price" value="<?php echo e($sale->sale_price); ?>" required readonly>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger remove-row">Delete</button>
                                </td>
                            </tr>
                        </tbody>

                        </table>

                        <button type="button" class="btn btn-primary" id="add-row">Add New Product</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // If the sale has a product, set rowIndex to 1, else 0
    let rowIndex = <?php echo e($sale->product ? 1 : 0); ?>; 

    document.getElementById('add-row').addEventListener('click', function() {
        const table = document.getElementById('products-table').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        newRow.innerHTML = `
            <tr>
                <td>
                    <select name="products[${rowIndex}][product_id]" class="form-control product-select" required>
                        <option value="">Select a product</option>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($product->product_id); ?>" data-price="<?php echo e($product->normal_price); ?>">
                                <img src="<?php echo e(asset('storage/'.$product->image)); ?>" class="product-image" alt="<?php echo e($product->product_name); ?>">
                                <?php echo e($product->product_id); ?> - <?php echo e($product->product_name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </td>
                <td><input type="text" name="products[${rowIndex}][normal_price]" class="form-control product-price" required readonly></td>
                <td><input type="text" name="products[${rowIndex}][sale_rate]" class="form-control sale-rate" required></td>
                <td><input type="text" name="products[${rowIndex}][sale_price]" class="form-control sale-price" required readonly></td>
                <td><button type="button" class="btn btn-danger remove-row">Delete</button></td>
            </tr>
        `;
        rowIndex++;
    });

    document.getElementById('products-table').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });

    document.getElementById('products-table').addEventListener('change', function(e) {
        if (e.target.classList.contains('product-select')) {
            const select = e.target;
            const selectedOption = select.options[select.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            const row = select.closest('tr');
            const priceInput = row.querySelector('.product-price');

            priceInput.value = price ? price : '';
            updateSalePrice(row);
        }
    });

    document.getElementById('products-table').addEventListener('input', function(e) {
    if (e.target.classList.contains('sale-rate')) {
        const row = e.target.closest('tr');
        updateSalePrice(row); // Function to recalculate the sale price
    }
});


    function updateSalePrice(row) {
        const normalPrice = parseFloat(row.querySelector('.product-price').value) || 0;
        const saleRate = parseFloat(row.querySelector('.sale-rate').value) || 0;
        const salePriceInput = row.querySelector('.sale-price');

        if (normalPrice > 0 && saleRate >= 0) {
            const salePrice = normalPrice - (normalPrice * (saleRate / 100));
            salePriceInput.value = salePrice.toFixed(2);
        } else {
            salePriceInput.value = '';
        }
    }
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/admin_dashboard/edit_sales.blade.php ENDPATH**/ ?>