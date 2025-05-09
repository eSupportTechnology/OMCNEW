<?php $__env->startSection('content'); ?>

       
       <!-- Start Page Title -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>Checkout</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li>Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- Start Checkout Area -->
		<section class="checkout-area ptb-100">
            <div class="container">
         
            <form action="<?php echo e(route('order.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-12">
                        <div class="billing-details">
                            <h3 class="title">Billing Details</h3>
                            <div class="row justify-content-center">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="first_name" id="firstName" 
                                            value="<?php echo e(old('first_name', optional($defaultAddress)->full_name ?? optional($user)->name)); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Company Name (Optional)</label>
                                        <input type="text" class="form-control" name="company_name" 
                                            value="<?php echo e(old('company_name', optional($defaultAddress)->company_name ?? '')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6">
                                    <div class="form-group">
                                        <label>Street Address <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="address" 
                                            value="<?php echo e(old('address', optional($defaultAddress)->address ?? '')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6">
                                    <div class="form-group">
                                        <label>Apartment, Suite, unit etc.(Optional)</label>
                                        <input type="text" class="form-control" name="apartment" 
                                           value="<?php echo e(old('apartment', optional($defaultAddress)->apartment ?? '')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>City <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="city" 
                                            value="<?php echo e(old('city', optional($defaultAddress)->city ?? '')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Postcode / Zip <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="postal_code" 
                                            value="<?php echo e(old('postal_code', optional($defaultAddress)->postal_code ?? '')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input type="email" class="form-control" name="email" 
                                            value="<?php echo e(old('email', optional($defaultAddress)->email ?? optional($user)->email)); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="phone" 
                                            value="<?php echo e(old('phone', optional($defaultAddress)->phone_num ?? optional($user)->phone_num)); ?>">
                                    </div>
                                </div>
                              
                            </div>
                        </div>

                        </div>

                        <div class="col-lg-6 col-md-12">
                        <div class="order-details">
                            <h3 class="title">Your Order</h3>

                            <div class="order-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td class="product-name">
                                                    <a href="#"><?php echo e($item->product->product_name); ?> x <?php echo e($item->quantity ?? 1); ?></a>
                                                </td>

                                                <td class="product-total">
                                                    <span class="subtotal-amount">
                                                        Rs. <?php echo e(number_format($item->product->sale && $item->product->sale->status === 'active' 
                                                            ? $item->product->sale->sale_price 
                                                            : ($item->product->specialOffer && $item->product->specialOffer->status === 'active'
                                                                ? $item->product->specialOffer->offer_price
                                                                : $item->product->normal_price) * ($item->quantity ?? 1), 2)); ?>

                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="2">No items in the cart</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                                <div class="payment-box">
                                    <div class="d-flex justify-content-between">
                                        <p>Subtotal:</p>
                                        <p>Rs. <?php echo e(number_format($cart->sum(function($item) {
                                            return ($item->product->sale && $item->product->sale->status === 'active' 
                                                    ? $item->product->sale->sale_price 
                                                    : ($item->product->specialOffer && $item->product->specialOffer->status === 'active'
                                                        ? $item->product->specialOffer->offer_price
                                                        : $item->product->normal_price)) 
                                                * ($item->quantity ?? 1);
                                        }), 2)); ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Delivery Fee:</p>
                                        <p>Rs. 300.00</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h5>Total:</h5>
                                        <h5 class="fw-bold">
                                            Rs. <?php echo e(number_format($cart->sum(function($item) {
                                                return ($item->product->sale && $item->product->sale->status === 'active' 
                                                        ? $item->product->sale->sale_price 
                                                        : ($item->product->specialOffer && $item->product->specialOffer->status === 'active'
                                                            ? $item->product->specialOffer->offer_price
                                                            : $item->product->normal_price)) 
                                                    * ($item->quantity ?? 1);
                                            }) + 300, 2)); ?>

                                        </h5>
                                    </div>

                                    <button type="submit" class="default-btn w-100">Proceed to Pay</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </section>
		<!-- End Checkout Area -->

       
        
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\nilan\OneDrive\Desktop\OMC project\OMC_new\OMCNEW\resources\views/frontend/checkout.blade.php ENDPATH**/ ?>