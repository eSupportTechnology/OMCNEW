<div class="cart-scroll">
    <?php $__empty_1 = true; $__currentLoopData = $miniCart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="cart-product">
            <div class="main-pro-details">
                <div class="product-img">

                    <img src="<?php echo e(Storage::url($item['image'])); ?>" alt="product">

                </div>
                <div class="product-title"><?php echo e(Str::limit($item['name'], 10)); ?></div>
                <div class="product-title">Qty: <?php echo e($item['quantity']); ?></div>
                <div class="product-title">Rs. <?php echo e($item['subtotal']); ?></div>
                <div class="product-title btn-delete-item remove">
                    <form action="<?php echo e(route('cart.remove', $item['product_id'])); ?>" method="POST"
                        style="display: inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                            <i class="fa fa-trash" style="color: red;"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="cart-product">
            <div class="main-pro-details">
                <div class="product-img">
                    <img src="https://buyabans.com/vendor/webkul/ui/assets/images/product/small-product-placeholder.png"
                        alt="product">
                </div>
                <div class="product-title">No Product Added</div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\OMCNEW\resources\views/frontend/partials/mini-cart.blade.php ENDPATH**/ ?>