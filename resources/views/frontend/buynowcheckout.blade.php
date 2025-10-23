@extends ('frontend.master')

@section('content')
<!-- Start Page Title -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Checkout</h2>
            <ul>
                <li><a href="/">Home</a></li>
                <li>Checkout</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Start Checkout Area -->
<section class="checkout-area ptb-100">
    <div class="container">
        <form action="{{ route('buynoworder.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $productData['product_id'] }}">

            <!-- Hidden fields for size, color, and quantity -->
            @if(session()->has('tracking_id'))
            <input type="hidden" name="tracking_id" value="{{ session('tracking_id') }}">
            @endif


            <input type="hidden" name="size" id="size" value="{{ old('size', $productData['size'] ?? '') }}">
            <input type="hidden" name="color" id="color" value="{{ old('color', $productData['color'] ?? '') }}">
            <input type="hidden" name="quantity" id="quantity"
                value="{{ old('quantity', $productData['quantity'] ?? 1) }}">


            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-12">
                    <div class="billing-details">
                        <h3 class="title">Billing Details</h3>
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Name <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="first_name" id="firstName"
                                        value="{{ old('first_name', optional($defaultAddress)->full_name ?? '') }}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Company Name (Optional)</label>
                                    <input type="text" class="form-control" name="company_name"
                                        value="{{ old('company_name', optional($defaultAddress)->company_name ?? '') }}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <label>Street Address <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ old('address', optional($defaultAddress)->address ?? '') }}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <label>Apartment, Suite, unit etc.(Optional)</label>
                                    <input type="text" class="form-control" name="apartment"
                                        value="{{ old('apartment', optional($defaultAddress)->apartment ?? '') }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>City <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="city"
                                        value="{{ old('city', optional($defaultAddress)->city ?? '') }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Postcode / Zip <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="postal_code"
                                        value="{{ old('postal_code', optional($defaultAddress)->postal_code ?? '') }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Email Address <span class="required">*</span></label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email', optional($defaultAddress)->email ?? '') }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Phone <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ old('phone', optional($defaultAddress)->phone_num ?? '') }}">
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
                                    @if ($productData)
                                    <tr>
                                        <td class="product-name">
                                            <a href="#">{{ $productData['product_name'] }} x
                                                {{ $productData['quantity'] }}</a>
                                        </td>
                                        <td class="product-total">
                                            <span class="subtotal-amount">
                                                Rs.
                                                {{ number_format($productData['price'] * $productData['quantity'], 2) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="2">No product data available</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="payment-box">
                            <div class="d-flex justify-content-between">
                                <p>Subtotal:</p>
                                <p>Rs. {{ number_format($productData['price'] * $productData['quantity'], 2) }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p>Delivery Fee:</p>
                                <p>Rs. {{ number_format($deliveryFee, 2) }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5>Total:</h5>
                                <h5 class="fw-bold">
                                    Rs.
                                    {{ number_format($productData['price'] * $productData['quantity'] + $deliveryFee, 2) }}
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
@endsection