<?php $__env->startSection('content'); ?>
    <!-- Start Page Title -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>Cart</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li>Cart</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Start Cart Area -->
    <section class="cart-area ptb-100">
        <div class="container">
            <?php if(auth()->guard()->check()): ?>
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-8">
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a
                                                    href="<?php echo e(route('product-description', ['product_id' => $item->product_id])); ?>">
                                                    <img src="<?php echo e(asset('storage/' . $item->product->images->first()->image_path)); ?>"
                                                        alt="item">
                                                </a>
                                            </td>

                                            <td class="product-name">
                                                <a
                                                    href="<?php echo e(route('product-description', ['product_id' => $item->product_id])); ?>"><?php echo e($item->product->product_name); ?></a>
                                                <ul>
                                                    <li>Color: <span
                                                            style="background-color: <?php echo e($item->color); ?>; width: 15px; height: 15px; display: inline-block; border-radius: 50%; margin-left: 5px; vertical-align: middle;"></span>
                                                    </li>
                                                    <li>Size: <span><?php echo e($item->size); ?></span></li>
                                                </ul>
                                            </td>

                                            <td class="product-price">
                                                <span class="unit-amount">
                                                    <?php
                                                        // Check if there's an active special offer, otherwise check for sale, else use normal price
$price =
    $item->product->specialOffer &&
    $item->product->specialOffer->status === 'active'
        ? $item->product->specialOffer->offer_price
        : ($item->product->sale &&
        $item->product->sale->status === 'active'
                                                                    ? $item->product->sale->sale_price
                                                                    : $item->product->normal_price);
                                                    ?>
                                                    LKR <?php echo e(number_format($price, 2)); ?>

                                                </span>
                                            </td>

                                            <td class="product-quantity">
                                                <div class="input-counter">
                                                    <span class="minus-btn" data-product-id="<?php echo e($item->product_id); ?>"><i
                                                            class='fa fa-minus'></i></span>
                                                    <input type="text" min="1" value="<?php echo e($item->quantity); ?>"
                                                        name="quantity[<?php echo e($item->id); ?>]" class="quantity-input">
                                                    <span class="plus-btn" data-product-id="<?php echo e($item->product_id); ?>"><i
                                                            class='fa fa-plus'></i></span>
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="subtotal-amount">LKR
                                                    <?php echo e(number_format($price * $item->quantity, 2)); ?></span>

                                            </td>
                                            <td class="product-subtotal">
                                                <a href="javascript:void(0);" class="btn-delete-item remove"
                                                    data-product-id="<?php echo e($item->product_id); ?>">
                                                    <i class='fa fa-trash'></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5">No items in the cart</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-4 w-full">
                        <div class="cart-totals" style="margin-top: -10px; margin-left: 10px;">
                            <h3>Cart Totals</h3>
                            <ul>
                                <li>Subtotal <span>LKR
                                        <?php echo e(number_format(
                                            $cart->sum(function ($item) {
                                                // Check for active special offer, then sale, otherwise normal price
                                                $price =
                                                    $item->product->specialOffer && $item->product->specialOffer->status === 'active'
                                                        ? $item->product->specialOffer->offer_price
                                                        : ($item->product->sale && $item->product->sale->status === 'active'
                                                            ? $item->product->sale->sale_price
                                                            : $item->product->normal_price);
                                                return $price * $item->quantity;
                                            }),
                                            2,
                                        )); ?></span>
                                </li>

                                <li>Shipping <span>LKR 300.00</span></li>

                                <li>Total <span>LKR
                                        <?php echo e(number_format(
                                            $cart->sum(function ($item) {
                                                // Check for active special offer, then sale, otherwise normal price
                                                $price =
                                                    $item->product->specialOffer && $item->product->specialOffer->status === 'active'
                                                        ? $item->product->specialOffer->offer_price
                                                        : ($item->product->sale && $item->product->sale->status === 'active'
                                                            ? $item->product->sale->sale_price
                                                            : $item->product->normal_price);
                                                return $price * $item->quantity;
                                            }) + 300,
                                            2,
                                        )); ?></span>
                                </li>
                            </ul>

                            <a href="/cart/checkout" class="default-btn">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-lg-12">
                    <div class="card p-4 text-center">
                        <img src="assets/images/cart.png" style="width: 100px; display: block; margin: 0 auto;">
                        <h4 class="mt-3">Your cart is empty</h4>
                        <p>Sign in to view your cart and start shopping.</p>
                        <a href="<?php echo e(route('signup')); ?>" class="btn btn-primary mx-auto d-block"
                            style="width: 10%; background-color: black; border: black;">SIGN UP</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <!-- End Cart Area -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Ensure no duplicate event bindings
            $('.plus-btn, .minus-btn').off('click').on('click', function() {
                const quantityInput = $(this).siblings(
                '.quantity-input'); // Get the corresponding input field
                let currentValue = parseInt(quantityInput.val());

                // Ensure the current value is a number
                if (!isNaN(currentValue)) {
                    // For the plus button, increase the value by 1
                    if ($(this).hasClass('plus-btn')) {
                        quantityInput.val(currentValue + 1);
                    }
                    // For the minus button, decrease the value by 1 (avoid going below 1)
                    else if ($(this).hasClass('minus-btn') && currentValue > 1) {
                        quantityInput.val(currentValue - 1);
                    }

                    // Update price and totals after quantity change
                    updatePrice($(this).closest('tr'));
                }
            });

            // Function to update the price when quantity changes
            function updatePrice(itemRow) {
                let quantity = parseInt(itemRow.find('.quantity-input').val());

                // Get and clean the price string
                let priceText = itemRow.find('.product-price .unit-amount').text(); // Ex: "LKR 1,500.00"
                let cleanedPrice = priceText.replace(/[^\d.]/g, ''); // Remove everything except digits and dot
                let price = parseFloat(cleanedPrice); // Now it should be 1500.00

                // Update subtotal for the item
                let subtotal = quantity * price;
                itemRow.find('.product-subtotal .subtotal-amount').text('LKR ' + subtotal.toFixed(2));

                // Recalculate cart total
                let total = 0;
                $('.cart-table .product-subtotal .subtotal-amount').each(function() {
                    let text = $(this).text().replace(/[^\d.]/g, '');
                    total += parseFloat(text);
                });

                // Update subtotal and total
                $('.cart-totals li:contains("Subtotal") span').text('LKR ' + total.toFixed(2));
                $('.cart-totals li:contains("Total") span').text('LKR ' + (total + 300).toFixed(
                2)); // Shipping = 300

                // AJAX update to backend
                const productId = itemRow.find('.plus-btn, .minus-btn').data('product-id');
                const updatedQuantity = quantity;

                $.ajax({
                    url: '<?php echo e(route('cart.update')); ?>',
                    method: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        product_id: productId,
                        quantity: updatedQuantity
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log(response.message);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error updating cart:', xhr.responseText);
                    }
                });
            }


            $('.btn-delete-item').off('click').on('click', function(e) {
                e.preventDefault();

                const productId = $(this).data('product-id');

                $.ajax({
                    url: `<?php echo e(route('cart.remove', '')); ?>/${productId}`,
                    method: 'DELETE',
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(response) {
                        location.reload(); // Reload the page after deleting an item
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Something went wrong. Please try again.');
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/frontend/cart.blade.php ENDPATH**/ ?>