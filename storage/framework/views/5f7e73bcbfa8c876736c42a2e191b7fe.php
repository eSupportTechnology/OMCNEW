<?php $__env->startSection('dashboard-content'); ?>


<style>
    .card-order {
        margin: 10px; 
        padding: 15px;
        display: flex; 
        flex-direction: column;
        justify-content: space-between;
    }

    .card-title {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .orderdetail-cards-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .orderdetail-cards-row .card {
        width: 48%; 
    }


    .order-card {
    border: 1px solid #e8ebec;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
}



</style>

<h4 class="py-2 px-4">Order Details</h4>
<h6 class="px-4">Order ID: <?php echo e($order->order_code); ?></h6>
<h6 class="px-4 order-date">Order date: <?php echo e($order->date); ?></h6>
<h6 class="px-4 order-date">
    <span class="status <?php echo e(strtolower(str_replace(' ', '-', $order->status))); ?>">
        <?php echo e($order->status); ?>

    </span>
</h6>


<div class="card" style="z-index: 0; border:none;">
    <div class="d-flex justify-content-center">
        <div class="col-12">
            <div class="container">
                <div class="card-body px-5 mt-4 mb-3">
                    <ul id="progressbar-2" class="d-flex justify-content-between mx-0 mt-0 px-0 pt-0">
                        <li class="step0 <?php echo e($order->status === 'confirmed' ? '' : 'active'); ?>" id="step1"></li>
                        <li class="step0 <?php echo e(in_array($order->status, ['In Progress', 'Shipped', 'Delivered']) ? 'active' : ''); ?>" id="step2"></li>
                        <li class="step0 <?php echo e(in_array($order->status, ['Shipped', 'Delivered']) ? 'active' : ''); ?>" id="step3"></li>
                        <li class="step0 <?php echo e($order->status === 'Delivered' ? 'active' : ''); ?>" id="step4"></li>
                    </ul>
                    <div class="d-flex justify-content-between">
                        <div class="d-lg-flex align-items-center">
                            <i class="fas fa-check-circle me-lg-2 mb-lg-0"></i>
                            <div>
                                <p class="mb-0">Order Confirmed</p>
                            </div>
                        </div>
                        <div class="d-lg-flex align-items-center">
                            <i class="fas fa-clipboard-list me-lg-2 mb-lg-0"></i>
                            <div>
                                <p class="mb-0">Order Processed</p>
                            </div>
                        </div>
                        <div class="d-lg-flex align-items-center">
                            <i class="fas fa-shipping-fast me-lg-2 mb-lg-0"></i>
                            <div>
                                <p class="mb-0">Order Shipped</p>
                            </div>
                        </div>
                        <div class="d-lg-flex align-items-center">
                            <i class="fas fa-home me-lg-2 mb-lg-0"></i>
                            <div>
                                <p class="mb-0">Order Delivered</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="orderdetail-cards-row mx-3">
    <div class="card card-order" style="height: auto; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1); position: relative;">
        <i class="fa-solid fa-location-dot fa-2x" style="position: absolute; top: 10px; right: 20px; color: #0056b3"></i>
        <div class="card-body p-0">
            <p class="mb-1"><?php echo e($order->customer_fname); ?> <?php echo e($order->customer_lname); ?></p>
            <p class="mb-1"><?php echo e($order->email); ?></p>
            <p class="mb-1"><?php echo e($order->phone); ?></p>
            <p class="mb-1"><?php echo e($order->address); ?>, <?php echo e($order->apartment); ?>, <?php echo e($order->city); ?></p>
            <p class="mb-1"><?php echo e($order->postal_code); ?></p>
        </div>
    </div>

    <div class="card card-order" style="height: auto; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">
        <i class="fa-solid fa-clipboard-list fa-2x" style="position: absolute; top: 10px; right: 20px; color: #0056b3"></i>
        <div class="card-body p-0">
            <p class="mb-1">Payment Method: <?php echo e($order->payment_method); ?></p>
            <p class="mb-1">Sub Total: Rs <?php echo e(number_format($order->total_cost - 300, 2)); ?></p>
            <p class="mb-1">Delivery Charge: Rs 300.00</p>
            <p class="mb-1">Total: Rs <?php echo e(number_format($order->total_cost, 2)); ?></p>
        </div>
    </div>
</div>

<div class="order-items mt-3">
    <h6 class="px-4">Order Items: <?php echo e($order->items->count()); ?></h6>
    <div class="order-items-list px-3">
        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="order-item" style="display: flex; align-items: center; padding: 10px; border-bottom: 1px solid #eaeaea;">
                <div style="margin-right: 15px;">
                    <?php if($item->product->images->isNotEmpty()): ?>
                        <a href="<?php echo e(route('product-description', ['product_id' =>  $item->product->product_id])); ?>"><img src="<?php echo e(asset('storage/' . $item->product->images->first()->image_path)); ?>" alt="Product Image" width="70" height="auto"></a>
                    <?php endif; ?>
                </div>
                <div style="line-height: 1.5;">
                    <span style="font-weight: 600; font-size: 15px;"><?php echo e($item->product->product_name); ?></span><br>
                    <div class="d-flex align-items-center">
                        <?php if($item->color): ?>
                            <span class="d-flex align-items-center me-2">
                                <strong>Color:</strong> 
                                <span style="display: inline-block; background-color: <?php echo e($item->color); ?>; border: 1px solid #e8ebec; height: 15px; width: 15px; border-radius: 50%;" 
                                    title="<?php echo e($item->color); ?>"></span>
                            </span>
                            |
                        <?php endif; ?>
                        <?php if($item->size): ?>
                            <span class="me-2 ms-2">Size: <span style="font-weight: 600;"><?php echo e($item->size ? $item->size : '-'); ?></span></span>
                            |
                        <?php endif; ?> 
                        <?php if($item->quantity): ?>
                        <span class="ms-2">Qty: <span style="font-weight: 600;"><?php echo e($item->quantity); ?></span></span>
                        <?php endif; ?>
                    </div>

                    <h6 class="mt-2" style="font-weight: bold;">Rs <?php echo e(number_format($item->cost, 2)); ?></h6>  
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>





<?php $__env->stopSection(); ?>

<?php echo $__env->make('member_dashboard.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/member_dashboard/order-details.blade.php ENDPATH**/ ?>