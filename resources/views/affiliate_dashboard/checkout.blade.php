@extends('layouts.affiliate_main.master')

@section('content')
<style>
    /* Enhanced Checkout Page Styles */

/* Page Title Area */
.page-title-area {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 3rem 0;
    border-bottom: 1px solid #dee2e6;
}

.page-title-content h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #343a40;
    margin-bottom: 1rem;
}

.page-title-content ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.page-title-content ul li {
    color: #6c757d;
    font-size: 1rem;
}

.page-title-content ul li:not(:last-child)::after {
    content: '/';
    margin-left: 0.5rem;
    color: #adb5bd;
}

.page-title-content ul li a {
    color: #007bff;
    text-decoration: none;
    transition: color 0.3s ease;
}

.page-title-content ul li a:hover {
    color: #0056b3;
}

/* Main Checkout Area */
.checkout-area {
    padding: 4rem 0;
    background-color: #f8f9fa;
    min-height: calc(100vh - 200px);
}

@media (min-width: 992px) {
    .checkout-area {
        margin-left: 250px;
        padding: 4rem 2rem;
    }
}

/* Form Container */
.checkout-area form {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 100%;
    display: flex;
    flex-wrap: wrap;
}

/* Billing Details Section */
.billing-details {
    background: white;
    padding: 2.5rem;
    border-right: 1px solid #e9ecef;
    height: 100%;
}

@media (max-width: 991px) {
    .billing-details {
        border-right: none;
        border-bottom: 1px solid #e9ecef;
    }
}

.billing-details .title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #343a40;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #007bff;
    position: relative;
}

.billing-details .title::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 60px;
    height: 2px;
    background: #28a745;
}

/* Form Groups */
.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
    display: block;
    font-size: 0.95rem;
}

.required {
    color: #dc3545;
    font-weight: bold;
}

/* Form Controls */
.form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background-color: #ffffff;
    width: 100%;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    outline: none;
}

.form-control[readonly] {
    background-color: #f8f9fa;
    color: #6c757d;
    cursor: not-allowed;
}

/* Quantity Controls */
.input-group {
    display: flex;
    align-items: center;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    overflow: hidden;
    max-width: 160px;
}

.input-group .btn {
    border: none;
    background: #f8f9fa;
    color: #495057;
    padding: 0.75rem 1rem;
    font-weight: 600;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    border-radius: 0;
}

.input-group .btn:hover {
    background: #007bff;
    color: white;
}

.input-group .form-control {
    border: none;
    border-left: 1px solid #e9ecef;
    border-right: 1px solid #e9ecef;
    border-radius: 0;
    text-align: center;
    font-weight: 600;
    padding: 0.75rem 0.5rem;
}

.input-group .form-control:focus {
    box-shadow: none;
    border-color: #e9ecef;
}

/* Order Details Section */
.order-details {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    padding: 2.5rem;
    height: 100%;
}

.order-details .title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #343a40;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #28a745;
    position: relative;
}

.order-details .title::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 60px;
    height: 2px;
    background: #007bff;
}

/* Order Table */
.order-table {
    margin-bottom: 2rem;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.table {
    margin-bottom: 0;
    background: white;
}

.table thead th {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    font-weight: 600;
    padding: 1.25rem 1rem;
    border: none;
    font-size: 1rem;
}

.table tbody td {
    padding: 1.25rem 1rem;
    border-color: #e9ecef;
    vertical-align: middle;
}

.product-name a {
    color: #495057;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.product-name a:hover {
    color: #007bff;
}

.product-total {
    font-weight: 700;
    color: #28a745;
    font-size: 1.1rem;
}

/* Payment Box */
.payment-box {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid #e9ecef;
}

.payment-box .d-flex {
    margin-bottom: 1rem;
    padding: 0.5rem 0;
}

.payment-box .d-flex:not(:last-of-type) {
    border-bottom: 1px solid #f1f3f4;
}

.payment-box p {
    margin: 0;
    font-size: 1rem;
    color: #495057;
}

.payment-box h5 {
    margin: 0;
    font-size: 1.25rem;
    color: #343a40;
    padding-top: 1rem;
    border-top: 2px solid #e9ecef;
}

.payment-box .fw-bold {
    color: #28a745 !important;
    font-weight: 700 !important;
}

/* Submit Button */
.default-btn {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 1rem 2rem;
    font-weight: 700;
    font-size: 1.1rem;
    border: none;
    border-radius: 10px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.default-btn:hover {
    background: linear-gradient(135deg, #218838, #1abc9c);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    color: white;
}

.default-btn:active {
    transform: translateY(0);
}

/* Responsive Design */
@media (max-width: 768px) {
    .checkout-area {
        padding: 2rem 0;
        margin-left: 0;
    }
    
    .page-title-content h2 {
        font-size: 2rem;
    }
    
    .billing-details,
    .order-details {
        padding: 1.5rem;
    }
    
    .billing-details .title,
    .order-details .title {
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .form-control {
        padding: 0.65rem 0.85rem;
        font-size: 0.95rem;
    }
    
    .input-group {
        max-width: 140px;
    }
    
    .input-group .btn {
        padding: 0.65rem 0.85rem;
        font-size: 1rem;
    }
    
    .table thead th,
    .table tbody td {
        padding: 1rem 0.75rem;
        font-size: 0.9rem;
    }
    
    .payment-box {
        padding: 1.5rem;
    }
    
    .default-btn {
        padding: 0.85rem 1.5rem;
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .checkout-area {
        padding: 1.5rem 0;
    }
    
    .page-title-area {
        padding: 2rem 0;
    }
    
    .page-title-content h2 {
        font-size: 1.75rem;
    }
    
    .billing-details,
    .order-details {
        padding: 1rem;
    }
    
    .checkout-area form {
        border-radius: 10px;
        margin: 0 0.5rem;
    }
    
    .form-group {
        margin-bottom: 1.25rem;
    }
    
    .payment-box {
        padding: 1.25rem;
    }
    
    .payment-box .d-flex {
        font-size: 0.9rem;
    }
    
    .default-btn {
        padding: 0.75rem 1.25rem;
        font-size: 0.95rem;
    }
}

/* Loading States */
.default-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.default-btn.loading {
    position: relative;
    color: transparent;
}

.default-btn.loading::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    top: 50%;
    left: 50%;
    margin-left: -10px;
    margin-top: -10px;
    border: 2px solid transparent;
    border-top-color: #ffffff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Form Validation Styles */
.form-control.is-invalid {
    border-color: #dc3545;
}

.form-control.is-valid {
    border-color: #28a745;
}

.invalid-feedback {
    display: block;
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.valid-feedback {
    display: block;
    color: #28a745;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

/* Custom Scrollbar */
.checkout-area::-webkit-scrollbar {
    width: 8px;
}

.checkout-area::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.checkout-area::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

.checkout-area::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Accessibility Improvements */
.form-control:focus,
.btn:focus {
    outline: 2px solid #007bff;
    outline-offset: 2px;
}

/* Print Styles */
@media print {
    .checkout-area {
        margin-left: 0;
        padding: 1rem;
    }
    
    .default-btn {
        display: none;
    }
    
    .page-title-area {
        background: none;
        padding: 1rem 0;
    }
}
</style>



<!-- Start Checkout Area -->
<section class="checkout-area ptb-100">
    <div class="container">
        <div class="row gx-5 justify-content-center">
            <form action="{{ route('affiliate.buynow.store') }}" method="POST">
                @csrf

                <!-- Hidden product inputs -->
                <input type="hidden" name="product_id" value="{{ $productData['product_id'] }}">
                {{-- <input type="hidden" name="size" value="{{ $productData['size'] ?? '' }}">
                <input type="hidden" name="color" value="{{ $productData['color'] ?? '' }}"> --}}

                <!-- Billing Details -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="billing-details">
                        <h3 class="title">Billing Details</h3>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Name <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="first_name" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Company Name (Optional)</label>
                                    <input type="text" class="form-control" name="company_name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Street Address <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="address" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Apartment, Suite, Unit etc. (Optional)</label>
                                    <input type="text" class="form-control" name="apartment">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="city" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Postcode / Zip <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="postal_code" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Address <span class="required">*</span></label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="phone" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Selected Size</label>
                                <input type="text" class="form-control" value="{{ $productData['size'] ?? 'N/A' }}" readonly>
                                <input type="hidden" name="size" value="{{ $productData['size'] ?? '' }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Selected Color</label>
                                <input type="text" class="form-control" value="{{ $productData['color'] ?? 'N/A' }}" readonly>
                                <input type="hidden" name="color" value="{{ $productData['color'] ?? '' }}">
                            </div>

                            <!-- Quantity Selector -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <div class="input-group" style="max-width: 150px;">
                                        <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity(-1)">−</button>
                                        <input type="number" name="quantity" id="quantity" class="form-control text-center" value="{{ $productData['quantity'] ?? 1 }}" min="1" readonly>
                                        <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity(1)">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-6 col-md-12">
                    <div class="order-details">
                        <h3 class="title">Your Order</h3>
                        <div class="order-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="product-name">
                                            <a href="#">{{ $productData['product_name'] }} x <span id="qty-display">{{ $productData['quantity'] ?? 1 }}</span></a>
                                        </td>
                                        <td class="product-total">
                                            <span class="subtotal-amount" id="subtotal-amount">
                                                Rs. {{ number_format($productData['price'] * ($productData['quantity'] ?? 1), 2) }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="payment-box mt-4">
                            <div class="d-flex justify-content-between">
                                <p>Subtotal:</p>
                                <p id="subtotal-text">Rs. {{ number_format($productData['price'] * ($productData['quantity'] ?? 1), 2) }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p>Delivery Fee:</p>
                                <p>Rs. 300.00</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5>Total:</h5>
                                <h5 class="fw-bold" id="total-amount">
                                    Rs. {{ number_format(($productData['price'] * ($productData['quantity'] ?? 1)) + 300, 2) }}
                                </h5>
                            </div>

                            <button type="submit" class="default-btn w-100 mt-3">Proceed to Pay</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Custom CSS -->
<style>
.checkout-area {
    padding: 20px;
}
@media (min-width: 992px) {
    .checkout-area {
        margin-left: 250px;
    }
}
.default-btn {
    background-color: #28a745;
    color: #fff;
    padding: 12px 15px;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    transition: all 0.3s;
}
.default-btn:hover {
    background-color: #218838;
    color: white;
}
</style>

<!-- JS for Quantity & Price Update -->
<script>
function updateQuantity(change) {
    const qtyInput = document.getElementById('quantity');
    const qtyDisplay = document.getElementById('qty-display');
    const subtotalAmount = document.getElementById('subtotal-amount');
    const subtotalText = document.getElementById('subtotal-text');
    const totalAmount = document.getElementById('total-amount');

    let currentQty = parseInt(qtyInput.value);
    if (!isNaN(currentQty)) {
        let newQty = currentQty + change;
        if (newQty < 1) newQty = 1;

        qtyInput.value = newQty;
        qtyDisplay.innerText = newQty;

        const price = {{ $productData['price'] }};
        const subtotal = price * newQty;
        const total = subtotal + 300;

        subtotalAmount.innerText = 'Rs. ' + subtotal.toFixed(2);
        subtotalText.innerText = 'Rs. ' + subtotal.toFixed(2);
        totalAmount.innerText = 'Rs. ' + total.toFixed(2);
    }
}
</script>

@endsection
