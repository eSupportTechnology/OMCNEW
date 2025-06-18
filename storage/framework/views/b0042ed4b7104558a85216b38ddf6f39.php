<?php $__env->startSection('content'); ?>

<style>

    .action-buttons  {
        padding: 5px;
        width: 35px;
    }

    .tab-content .table {
        margin-top: 20px;
    }

   
</style>

<main style="margin-top: 58px">
    <div class="container pt-4 px-4"> 
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center">
            <h3 class="py-3 mb-0">Manage Orders</h3>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active fw-bold" id="all-orders-tab" data-bs-toggle="tab" href="#all-orders" role="tab" aria-controls="all-orders" aria-selected="true">All Orders</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold" id="paid-tab" data-bs-toggle="tab" href="#paid" role="tab" aria-controls="paid" aria-selected="false">Paid</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold" id="inprogress-tab" data-bs-toggle="tab" href="#inprogress" role="tab" aria-controls="inprogress" aria-selected="false">In Progress</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold" id="shipped-tab" data-bs-toggle="tab" href="#shipped" role="tab" aria-controls="shipped" aria-selected="false">Shipped</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold" id="delivered-tab" data-bs-toggle="tab" href="#delivered" role="tab" aria-controls="delivered" aria-selected="false">Delivered</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold" id="cancelled-tab" data-bs-toggle="tab" href="#cancelled" role="tab" aria-controls="cancelled" aria-selected="false">Cancelled</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- All Orders Tab -->
            <div class="tab-pane fade show active" id="all-orders" role="tabpanel" aria-labelledby="all-orders-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $allOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($order->order_code); ?></td>
                                            <td><?php echo e($order->customer_fname); ?> <?php echo e($order->customer_lname); ?></td>
                                            <td><?php echo e($order->date); ?></td>
                                            <td><span class="status <?php echo e(strtolower(str_replace(' ', '-', $order->status))); ?>">
                                                    <?php echo e($order->status); ?>

                                                </span></td>
                                            <td><?php echo e($order->total_cost); ?></td>
                                            <td><?php echo e($order->payment_method); ?></td>
                                            <td class="action-buttons">
                                                <button class="btn btn-info btn-sm" onclick="setOrderCode('<?php echo e($order->order_code); ?>')"><i class="fas fa-eye"></i></button>
                                                <form id="delete-form-<?php echo e($order->id); ?>" action="<?php echo e(route('orders.destroy', $order->id)); ?>" method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('delete-form-<?php echo e($order->id); ?>', 'Do you want to delete this order?')">
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

           

            <!-- In Progress Orders Tab -->
            <div class="tab-pane fade" id="inprogress" role="tabpanel" aria-labelledby="inprogress-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $inProgressOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($order->order_code); ?></td>
                                            <td><?php echo e($order->customer_fname); ?> <?php echo e($order->customer_lname); ?></td>
                                            <td><?php echo e($order->date); ?></td>
                                            <td><?php echo e($order->total_cost); ?></td>
                                            <td><?php echo e($order->payment_method); ?></td>
                                            <td class="action-buttons">
                                                <button class="btn btn-info btn-sm" onclick="setOrderCode('<?php echo e($order->order_code); ?>')"><i class="fas fa-eye"></i></button>
                                                <form id="delete-form-<?php echo e($order->id); ?>" action="<?php echo e(route('orders.destroy', $order->id)); ?>" method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('delete-form-<?php echo e($order->id); ?>', 'Do you want to delete this order?')">
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

             <!-- Paid Tab -->
            <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $paidOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($order->order_code); ?></td>
                                            <td><?php echo e($order->customer_fname); ?> <?php echo e($order->customer_lname); ?></td>
                                            <td><?php echo e($order->date); ?></td>
                                            <td><?php echo e($order->total_cost); ?></td>
                                            <td><?php echo e($order->payment_method); ?></td>
                                            <td class="action-buttons">
                                                <button class="btn btn-info btn-sm" onclick="setOrderCode('<?php echo e($order->order_code); ?>')"><i class="fas fa-eye"></i></button>
                                                <form id="delete-form-<?php echo e($order->id); ?>" action="<?php echo e(route('orders.destroy', $order->id)); ?>" method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('delete-form-<?php echo e($order->id); ?>', 'Do you want to delete this order?')">
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


            <!-- Shipped Tab -->
            <div class="tab-pane fade" id="shipped" role="tabpanel" aria-labelledby="shipped-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $shippedOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($order->order_code); ?></td>
                                            <td><?php echo e($order->customer_fname); ?> <?php echo e($order->customer_lname); ?></td>
                                            <td><?php echo e($order->date); ?></td>
                                            <td><?php echo e($order->total_cost); ?></td>
                                            <td><?php echo e($order->payment_method); ?></td>
                                            <td class="action-buttons">
                                                <button class="btn btn-info btn-sm" onclick="setOrderCode('<?php echo e($order->order_code); ?>')"><i class="fas fa-eye"></i></button>
                                                <form id="delete-form-<?php echo e($order->id); ?>" action="<?php echo e(route('orders.destroy', $order->id)); ?>" method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('delete-form-<?php echo e($order->id); ?>', 'Do you want to delete this order?')">
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
            

            <!-- Delivered Orders Tab -->
            <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $deliveredOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($order->order_code); ?></td>
                                            <td><?php echo e($order->customer_fname); ?> <?php echo e($order->customer_lname); ?></td>
                                            <td><?php echo e($order->date); ?></td>
                                            <td><?php echo e($order->total_cost); ?></td>
                                            <td><?php echo e($order->payment_method); ?></td>
                                            <td class="action-buttons">
                                                <button class="btn btn-info btn-sm" onclick="setOrderCode('<?php echo e($order->order_code); ?>')"><i class="fas fa-eye"></i></button>
                                                <form id="delete-form-<?php echo e($order->id); ?>" action="<?php echo e(route('orders.destroy', $order->id)); ?>" method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('delete-form-<?php echo e($order->id); ?>', 'Do you want to delete this order?')">
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

            <!-- Cancelled Orders Tab -->
            <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $cancelledOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($order->order_code); ?></td>
                                            <td><?php echo e($order->customer_fname); ?> <?php echo e($order->customer_lname); ?></td>
                                            <td><?php echo e($order->date); ?></td>
                                            <td><?php echo e($order->total_cost); ?></td>
                                            <td><?php echo e($order->payment_method); ?></td>
                                            <td class="action-buttons">
                                                <button class="btn btn-info btn-sm" onclick="setOrderCode('<?php echo e($order->order_code); ?>')"><i class="fas fa-eye"></i></button>
                                                <form id="delete-form-<?php echo e($order->id); ?>" action="<?php echo e(route('orders.destroy', $order->id)); ?>" method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('delete-form-<?php echo e($order->id); ?>', 'Do you want to delete this order?')">
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
    </div>
</main>


<script>
function setOrderCode(orderCode) {
    fetch('<?php echo e(route('set-order-code')); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        },
        body: JSON.stringify({ order_code: orderCode })
    }).then(response => {
        if (response.ok) {
            window.location.href = '<?php echo e(route('customerorder_details')); ?>';
        } else {
            alert('Failed to set order code');
        }
    });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\OMCNEW\resources\views/admin_dashboard/orders.blade.php ENDPATH**/ ?>