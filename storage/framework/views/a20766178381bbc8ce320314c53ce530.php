<?php $__env->startSection('dashboard-content'); ?>
<style>
.custom-select {
    border: 1px solid #ced4da; 
    border-radius: 5px; 
    padding: 4px 13px; 
    background-color: #ffffff; 
    font-size: 14px; 
    width: 150px;
    color: #495057; 
    transition: border-color 0.2s ease-in-out;
}

.custom-select:focus {
    border-color: #80bdff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.25); 
    outline: none; 
}

.custom-select option {
    color: #495057; 
}

</style>

<h4 class="py-2 px-2">My Orders</h4>
<div class="d-flex justify-content-between align-items-center mt-4">
    <div class="button-tabs">
        <button class="tab-button mb-1 active" data-target="all-orders">All Orders</button>
        <button class="tab-button mb-1" data-target="in-progress-orders">In Progress</button>
        <button class="tab-button" data-target="shipped-orders">Shipped</button>
        <button class="tab-button" data-target="delivered-orders">Delivered</button>
    </div>
    <div class="order-filter ms-auto mb-3">
        <select class="form-select custom-select" aria-label="Order Time Filter">
            <option value="all" selected>All</option>
            <option value="last_year">Last Year</option>
            <option value="last_6_months">Last 6 Months</option>
            <option value="last_2_years">Last 2 Years</option>
        </select>
    </div>
</div>

<!-- All Orders Tab -->
<div id="all-orders" class="tab-content active">
    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="order-card">
            <div class="order-card-header">
                <span class="status <?php echo e(strtolower(str_replace(' ', '-', $order->status))); ?>">
                    <?php echo e($order->status); ?>

                </span>
                <a href="<?php echo e(route('myorder-details', ['order_code' => $order->order_code])); ?>" class="order-details-link">Order Details ></a>
            </div>
            <div class="order-card-body">
                <div class="order-image" style="position: relative;">
                    <?php
                        $firstItem = $order->items->first();
                        $productImage = $firstItem && $firstItem->product ? $firstItem->product->images->first() : null;
                        $additionalCount = $order->items->count() - 1;
                    ?>
                    <?php if($productImage): ?>
                        <img src="<?php echo e(asset('storage/' . $productImage->image_path)); ?>" alt="Product Image" width="50">
                    <?php else: ?>
                        <p>No image available</p>
                    <?php endif; ?>
                    <?php if($additionalCount > 0): ?>
                        <span class="additional-count" style="position: absolute; top: 58px; right: 20px; background: rgba(0, 0, 0, 0.3); color: white; padding: 5px; border-radius: 5px;">+<?php echo e($additionalCount); ?></span>
                    <?php endif; ?>
                </div>

                <div class="order-info">
                    <h6 class="order-id">Order ID: <?php echo e($order->order_code); ?></h6>
                    <h6 class="order-date">Order date: <?php echo e($order->date); ?></h6>

                    <p class="order-summary">
                        <?php
                            $itemCount = $order->items->count();
                            $itemsToShow = $order->items->take(2);
                        ?>
                        <?php $__currentLoopData = $itemsToShow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($item->product): ?>
                                <?php echo e($item->product->product_name); ?><?php echo e(!$loop->last ? ' | ' : ''); ?>

                            <?php else: ?>
                                <span class="text-muted">Product not found</span><?php echo e(!$loop->last ? ' | ' : ''); ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($itemCount > 2): ?>
                            <strong style="font-weight: 500;">& <?php echo e($itemCount - 2); ?> more items</strong>
                        <?php endif; ?>
                    </p>

                    <h6 class="order-price">Rs <?php echo e($order->total_cost); ?></h6>
                </div>
                <!-- Action Buttons -->
                <div style="text-align: right; margin-top: 5px;">
                    <?php if($order->status === 'Confirmed'): ?>
                        <a href="#" class="btn-cancel mt-1" onclick="openCancelModal('<?php echo e($order->order_code); ?>')">Cancel</a>
                    <?php elseif($order->status === 'In Progress'): ?>
                        <a href="#" class="btn-cancel mt-1" onclick="openCancelModal('<?php echo e($order->order_code); ?>')">Cancel</a>
                    <?php elseif($order->status === 'Paid'): ?>
                        <a href="#" class="btn-cancel mt-1" onclick="openCancelModal('<?php echo e($order->order_code); ?>')">Cancel</a>
                    <?php elseif($order->status === 'Shipped'): ?>
                        <a href="javascript:void(0);" class="btn-confirm" onclick="openConfirmDeliveryModal('<?php echo e($order->order_code); ?>')">Confirm Delivery</a>
                        <br>
                        <a href="#" class="btn-cancel mt-1" onclick="openCancelModal('<?php echo e($order->order_code); ?>')">Cancel</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    <!-- Pagination -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center mb-4" id="pagination">
        <?php if($orders->currentPage() > 1): ?>
            <li class="page-item" id="prevPage">
                <a class="page-link" href="#" aria-label="Previous" data-page="<?php echo e($orders->currentPage() - 1); ?>">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php endif; ?>

        <?php for($i = 1; $i <= $orders->lastPage(); $i++): ?>
            <li class="page-item <?php if($i == $orders->currentPage()): ?> active <?php endif; ?>">
                <a class="page-link" href="#" data-page="<?php echo e($i); ?>"><?php echo e($i); ?></a>
            </li>
        <?php endfor; ?>

        <?php if($orders->hasMorePages()): ?>
            <li class="page-item" id="nextPage">
                <a class="page-link" href="#" aria-label="Next" data-page="<?php echo e($orders->currentPage() + 1); ?>">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

</div>



<!-- Shipped Orders Tab -->
<div id="shipped-orders" class="tab-content">
    <?php $__currentLoopData = $shippedOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="order-card">
            <div class="order-card-header">
                <span class="status <?php echo e(strtolower(str_replace(' ', '-', $order->status))); ?>">
                    <?php echo e($order->status); ?>

                </span>
                <a href="<?php echo e(route('myorder-details', ['order_code' => $order->order_code])); ?>" class="order-details-link">Order Details ></a>
            </div>
            <div class="order-card-body">
                <div class="order-image" style="position: relative;">
                    <?php
                        $firstItem = $order->items->first();
                        $productImage = $firstItem->product->images->first();
                        $additionalCount = $order->items->count() - 1;
                    ?>
                    <?php if($productImage): ?>
                        <img src="<?php echo e(asset('storage/' . $productImage->image_path)); ?>" alt="Product Image" width="50">
                    <?php else: ?>
                        <p>No image available</p>
                    <?php endif; ?>
                    <?php if($additionalCount > 0): ?>
                        <span class="additional-count" style="position: absolute; top: 58px; right: 20px; background: rgba(0, 0, 0, 0.3); color: white; padding: 5px; border-radius: 5px;">+<?php echo e($additionalCount); ?></span>
                    <?php endif; ?>
                </div>
                <div class="order-info">
                    <h6 class="order-id">Order ID: <?php echo e($order->order_code); ?></h6>
                    <h6 class="order-date">Order date: <?php echo e($order->date); ?></h6>

                    <!-- Product Summary -->
                    <p class="order-summary">
                        <?php
                            $itemCount = $order->items->count();
                            $itemsToShow = $order->items->take(2);
                        ?>
                        <?php $__currentLoopData = $itemsToShow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($item->product->product_name); ?><?php echo e(!$loop->last ? ' | ' : ''); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($itemCount > 2): ?>
                            <strong style="font-weight: 500;">& <?php echo e($itemCount - 2); ?> more items</strong>
                        <?php endif; ?>
                    </p>

                    <h6 class="order-price">Rs <?php echo e($order->total_cost); ?></h6>
                </div>

                <div style="text-align: right; margin-top: 5px;">
                    <a href="javascript:void(0);" class="btn-confirm" onclick="openConfirmDeliveryModal('<?php echo e($order->order_code); ?>')">Confirm Delivery</a>
                    <br>
                    <a href="#" class="btn-cancel mt-1" onclick="openCancelModal('<?php echo e($order->order_code); ?>')">Cancel</a>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<!-- In Progress Orders -->
<div id="in-progress-orders" class="tab-content">
    <?php $__currentLoopData = $inProgressOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="order-card">
            <div class="order-card-header">
                <span class="status <?php echo e(strtolower(str_replace(' ', '-', $order->status))); ?>">
                    <?php echo e($order->status); ?>

                </span>
                <a href="<?php echo e(route('myorder-details', ['order_code' => $order->order_code])); ?>" class="order-details-link">Order Details ></a>
            </div>
            <div class="order-card-body">
                <div class="order-image" style="position: relative;">
                    <?php
                        $firstItem = $order->items->first();
                        $productImage = $firstItem->product->images->first();
                        $additionalCount = $order->items->count() - 1;
                    ?>
                    <?php if($productImage): ?>
                        <img src="<?php echo e(asset('storage/' . $productImage->image_path)); ?>" alt="Product Image" width="50">
                    <?php else: ?>
                        <p>No image available</p>
                    <?php endif; ?>
                    <?php if($additionalCount > 0): ?>
                        <span class="additional-count" style="position: absolute; top: 58px; right: 20px; background: rgba(0, 0, 0, 0.3); color: white; padding: 5px; border-radius: 5px;">+<?php echo e($additionalCount); ?></span>
                    <?php endif; ?>
                </div>
                <div class="order-info">
                    <h6 class="order-id">Order ID: <?php echo e($order->order_code); ?></h6>
                    <h6 class="order-date">Order date: <?php echo e($order->date); ?></h6>

                    <!-- Product Summary -->
                    <p class="order-summary">
                        <?php
                            $itemCount = $order->items->count();
                            $itemsToShow = $order->items->take(3);
                        ?>
                        
                        <?php $__currentLoopData = $itemsToShow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($item->product->product_name); ?><?php echo e(!$loop->last ? ' | ' : ''); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        <?php if($itemCount > 3): ?>
                            <strong style="font-weight: 500;">& <?php echo e($itemCount - 3); ?> more items</strong>
                        <?php endif; ?>
                    </p>
                    
                    <h6 class="order-price">Rs <?php echo e($order->total_cost); ?></h6>
                </div>
                    <div style="text-align: right; margin-top: 10px;">
                        <a href="#" class="btn-cancel mt-1" onclick="openCancelModal('<?php echo e($order->order_code); ?>')">Cancel</a>
                    </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>




<!-- Delivered Orders -->
<div id="delivered-orders" class="tab-content">
    <?php $__currentLoopData = $deliveredOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="order-card">
        <div class="order-card-header">
            <span class="status <?php echo e(strtolower(str_replace(' ', '-', $order->status))); ?>">
                <?php echo e($order->status); ?>

            </span>
            <a href="<?php echo e(route('myorder-details', ['order_code' => $order->order_code])); ?>" class="order-details-link">Order Details ></a>
        </div>
        <div class="order-card-body">
            <div class="order-image" style="position: relative;">
                <?php
                    $firstItem = $order->items->first();
                    $productImage = $firstItem->product->images->first();
                    $additionalCount = $order->items->count() - 1;
                ?>
                <?php if($productImage): ?>
                    <img src="<?php echo e(asset('storage/' . $productImage->image_path)); ?>" alt="Product Image" width="50">
                <?php else: ?>
                    <p>No image available</p>
                <?php endif; ?>
                <?php if($additionalCount > 0): ?>
                    <span class="additional-count" style="position: absolute; top: 58px; right: 20px; background: rgba(0, 0, 0, 0.3); color: white; padding: 5px; border-radius: 5px;">+<?php echo e($additionalCount); ?></span>
                <?php endif; ?>
            </div>
            <div class="order-info">
                <h6 class="order-id">Order ID: <?php echo e($order->order_code); ?></h6>
                <h6 class="order-date">Order date: <?php echo e($order->date); ?></h6>
                
                <!-- Product Summary -->
                <p class="order-summary">
                    <?php
                        $itemCount = $order->items->count();
                        $itemsToShow = $order->items->take(3);
                    ?>
                    
                    <?php $__currentLoopData = $itemsToShow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($item->product->product_name); ?><?php echo e(!$loop->last ? ' | ' : ''); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php if($itemCount > 3): ?>
                        <strong style="font-weight: 500;">& <?php echo e($itemCount - 3); ?> more items</strong>
                    <?php endif; ?>
                </p>
                
                <h6 class="order-price">Rs <?php echo e($order->total_cost); ?></h6>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>



<!-- cancel Confirmation Modal -->
<div class="modal fade" id="cancel-confirmation-modal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Cancellation</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel this order?
            </div>
            <div class="modal-footer">
                <button type="button" id="confirm-cancel" class="btn btn-success" style="font-size: 13px">Confirm</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="font-size: 13px">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Confirm Delivery Modal -->
<div class="modal fade" id="confirmDeliveryModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeliveryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeliveryModalLabel">Confirm Delivery</h5>
            </div>
            <div class="modal-body" id="confirmDeliveryMessage">
                Are you sure you want to confirm delivery for this order?
            </div>
            <div class="modal-footer">
                <button type="button" id="confirmDeliveryBtn" class="btn btn-success" style="font-size: 13px">Confirm</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="font-size: 13px">Cancel</button>
            </div>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            this.classList.add('active');
            document.getElementById(this.getAttribute('data-target')).classList.add('active');
        });
    });
</script>
<script>
let orderToCancel = '';

function openCancelModal(orderCode) {
    orderToCancel = orderCode;
    $('#cancel-confirmation-modal').modal('show'); 
}

document.getElementById('confirm-cancel').onclick = function() {
    updateOrderStatus(orderToCancel, 'Cancelled');
};

function updateOrderStatus(orderCode, status) {
    fetch(`/order/cancel/${orderCode}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Failed to cancel the order. Please try again.');
        }
    })
    .catch(error => console.error('Error:', error));
}

</script>
<script>
  let selectedOrderCode;

function openConfirmDeliveryModal(orderCode) {
    selectedOrderCode = orderCode;
    $('#confirmDeliveryModal').modal('show');
}

$('#confirmDeliveryBtn').on('click', function() {
    console.log("Confirm delivery button clicked!");
    
    $.ajax({
        url: '<?php echo e(route("confirm-delivery")); ?>',
        type: 'POST',
        data: {
            _token: '<?php echo e(csrf_token()); ?>',
            order_code: selectedOrderCode
        },
        success: function(response) {
            console.log(response); // Debug the response here
            if (response.success) {
                $('#confirmDeliveryMessage').html(`
                    <p>Delivery confirmed! Would you like to leave a review?</p>
                    <a href="<?php echo e(route('myreviews')); ?>" class="btn btn-primary" style="font-size: 13px">Leave a Review</a>
                `);
                $('.modal-footer').html('');
            } else {
                alert('Failed to confirm delivery. Please try again.');
            }
        },
        error: function(xhr, status, error) {
            console.log(error); // Debug the error here
            alert('An error occurred. Please try again.');
        }
    });
});



document.addEventListener('DOMContentLoaded', function () {
    const orderList = document.getElementById('all-orders');
    const paginationButtons = document.getElementById('pagination');

    // Attach event listener for pagination links
    paginationButtons.addEventListener('click', function (event) {
        if (event.target.closest('.page-link')) {
            event.preventDefault(); // Prevent default link behavior
            const page = event.target.closest('.page-link').getAttribute('data-page');
            fetchOrders(page);
        }
    });

    function fetchOrders(page) {
    fetch(`/my-orders?page=${page}`) // Ensure this matches your defined route
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(data, 'text/html');

            // Update the order list and pagination
            orderList.innerHTML = doc.getElementById('all-orders').innerHTML;

            const newPagination = doc.getElementById('pagination');
            paginationButtons.innerHTML = newPagination.innerHTML;

            // Re-attach event listener to the new pagination buttons
            reattachPaginationListener();
        })
        .catch(error => console.error('Error fetching orders:', error));
}


    function reattachPaginationListener() {
        paginationButtons.addEventListener('click', function (event) {
            if (event.target.closest('.page-link')) {
                event.preventDefault();
                const page = event.target.closest('.page-link').getAttribute('data-page');
                fetchOrders(page);
            }
        });
    }
});


</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('member_dashboard.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\OMC\OMCNEW\resources\views/member_dashboard/myorders.blade.php ENDPATH**/ ?>