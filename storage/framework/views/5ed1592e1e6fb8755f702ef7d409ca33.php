<?php $__env->startSection('content'); ?>

<style>
 

  .card {
    border-radius: 0; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .checkout-card {
    flex: 1; 
  }

  .error-message {
    color: red;
    font-size: 0.875rem;
  }

    .square-input {
        border-radius: 0; 
        font-size: 14px;
    }

</style>


       <!-- Start Page Title -->
       <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>Payment</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li>Payment</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

<div class="container mt-4 mb-5">
  
  <section class="py-3">

        <div class="row checkout-summary-container">

            <!-- Payment -->
            <div class="col-md-8 mb-4">
                <div class="card shadow-0 border checkout-card">
                    <?php echo csrf_field(); ?>
                    <div class="p-4">
                        <h5 class="card-title mb-3">Select Payment Method</h5>

                        <!-- Payment Tabs -->
                        <ul class="nav nav-tabs" id="paymentTabs" role="tablist" style="text-align: center;">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active p-3" id="credit-card-tab" data-bs-toggle="tab" href="#credit-card" role="tab" aria-controls="credit-card" aria-selected="true">
                                    <div class="mb-2">
                                        <img src="\assets\images\card.png" style="width: 40px; height: auto; display: block; margin: 0 auto;">
                                    </div>
                                    <span>Credit/Debit Card</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link p-3" id="cash-on-delivery-tab" data-bs-toggle="tab" href="#cash-on-delivery" role="tab" aria-controls="cash-on-delivery" aria-selected="false">
                                    <div class="mb-2">
                                        <img src="\assets\images\cod.png" style="width: 60px; height: auto; display: block; margin: 0 auto;">
                                    </div>
                                    <span>Cash on Delivery</span>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content mt-4" id="paymentTabsContent">
                            <!-- Credit/Debit Card Payment -->
                              <div class="tab-pane fade show active" id="credit-card" role="tabpanel" aria-labelledby="credit-card-tab" style="width:60%;">
                                  <div class="mb-3">
                                      <label for="cardName" class="form-label"><span class="text-danger me-1">*</span>Name on Card</label>
                                      <input type="text" class="form-control square-input" id="cardName" name="card_name" placeholder="Name on Card" required>
                                  </div>
                                  <div class="mb-3">
                                      <label for="cardNumber" class="form-label"><span class="text-danger me-1">*</span>Card Number</label>
                                      <input type="text" class="form-control square-input" id="cardNumber" name="card_number" placeholder="Card Number" required>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6 mb-3">
                                          <label for="expiryDate" class="form-label"><span class="text-danger me-1">*</span>Expiry Date</label>
                                          <input type="text" class="form-control square-input" id="expiryDate" name="expiry_date" placeholder="MM/YY" required>
                                      </div>
                                      <div class="col-md-6 mb-3">
                                          <label for="cvv" class="form-label"><span class="text-danger me-1">*</span>CVV</label>
                                          <input type="text" class="form-control square-input" id="cvv" name="cvv" placeholder="123" required>
                                      </div>
                                  </div>
                                  <button type="submit" class="btn btn-primary w-50 mt-3">Pay Now</button>
                              </div>



                            <!-- Cash on Delivery -->
                            <div class="tab-pane fade" id="cash-on-delivery" role="tabpanel" aria-labelledby="cash-on-delivery-tab">
                                <div class="mb-3">
                                    <p>- You may pay in cash to our courier upon receiving your parcel at the doorstep.<br>
                                    - Before agreeing to receive the parcel, check if your delivery status has been updated to 'Out for Delivery'
                                    </p>
                                </div>
                                <form action="<?php echo e(route('order.confirm.cod', ['order_code' => $order_code])); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-primary w-40 mt-3">Confirm Order</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary -->
            <div class="col-md-4">
                <div class="card shadow-0 border summary-card">
                    <div class="p-4">
                        <h5 class="mb-3">Order Summary</h5>
                        <div class="d-flex justify-content-between">
                            <p class="mb-2">Subtotal:</p>
                            <p class="mb-2">
                                Rs. <?php echo e(number_format($cart->sum(function($item) {
                                    $price = $item->product->sale && $item->product->sale->status === 'active' 
                                        ? $item->product->sale->sale_price 
                                        : ($item->product->specialOffer && $item->product->specialOffer->status === 'active'
                                            ? $item->product->specialOffer->offer_price
                                            : $item->product->normal_price);
                                    return $price * $item->quantity;
                                }), 2)); ?>

                            </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="mb-2">Delivery Fee:</p>
                            <p class="mb-2">Rs. 300</p>
                        </div>
                        <hr />
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Total Amount:</h6>
                            <h6 class="mb-2 fw-bold">
                                Rs. <?php echo e(number_format($cart->sum(function($item) {
                                    $price = $item->product->sale && $item->product->sale->status === 'active' 
                                        ? $item->product->sale->sale_price 
                                        : ($item->product->specialOffer && $item->product->specialOffer->status === 'active'
                                            ? $item->product->specialOffer->offer_price
                                            : $item->product->normal_price);
                                    return $price * $item->quantity;
                                }) + 300, 2)); ?>

                            </h6>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</section>


  <?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
  <?php endif; ?>
</div>

<!-- Confirmation Modal 
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Order Confirmation</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to place this order?
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-success" id="confirmButton">Yes, Order</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>-->




<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/frontend/payment.blade.php ENDPATH**/ ?>