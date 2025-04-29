@extends('layouts.app')

@section('content')

<style>
  body {
    background-color: #fafafa; 
  }

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
</style>

<div class="container mt-4 mb-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
      <li class="breadcrumb-item" aria-current="page" id="breadcrumb-product"><a href="{{ url('/shopping-cart') }}">Shopping Cart</a></li>
      <li class="breadcrumb-item active" aria-current="page" id="breadcrumb-product">Checkout</li>
    </ol>
  </nav>

  <section class="py-3">
    <form id="orderForm" action="{{ route('order.store') }}" method="POST" novalidate>
      <div class="row checkout-summary-container">
        
       <!-- Checkout -->
<div class="col-md-8 mb-4">
    <div class="card shadow-0 border checkout-card">
        @csrf
        <div class="p-4">
            <h5 class="card-title mb-3" style="color:red">Billing Details</h5>
            <div class="row">
                <div class="col-12 mb-3">
                    <p class="mb-0">Full name</p>
                    <div class="form-outline">
                        <input type="text" name="first_name" id="firstName" placeholder="" class="form-control" 
                              value="{{ old('first_name', optional($defaultAddress)->full_name ?? optional($user)->name) }}" required />
                        <span class="error-message" id="firstNameError"></span>
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <p class="mb-0">Phone</p>
                    <div class="form-outline">
                        <input type="tel" name="phone" id="phone" class="form-control" 
                              value="{{ old('phone', optional($defaultAddress)->phone_num ?? optional($user)->phone_num) }}" required />
                        <span class="error-message" id="phoneError"></span>
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <p class="mb-0">Email</p>
                    <div class="form-outline">
                        <input type="email" name="email" id="billingEmail" placeholder="" class="form-control" 
                              value="{{ old('email', optional($defaultAddress)->email ?? optional($user)->email) }}" required />
                        <span class="error-message" id="billingEmailError"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <p class="mb-0">Company Name (Optional)</p>
                    <div class="form-outline">
                        <input type="text" name="company_name" id="companyName" placeholder="" class="form-control" 
                              value="{{ old('company_name', optional($defaultAddress)->company_name ?? '') }}" />
                    </div>
                </div>
            </div>
            <div class="col-sm-12 mb-3">
                <p class="mb-0">Street Address</p>
                <div class="form-outline">
                    <input type="text" name="address" id="address" placeholder="" class="form-control" 
                          value="{{ old('address', optional($defaultAddress)->address ?? '') }}" required />
                    <span class="error-message" id="addressError"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <p class="mb-0">Apartment, Suite, unit etc.(Optional)</p>
                    <div class="form-outline">
                        <input type="text" name="apartment" id="apartment" placeholder="" class="form-control" 
                              value="{{ old('apartment', optional($defaultAddress)->apartment ?? '') }}" />
                    </div>
                </div>
                <div class="col-sm-6 mb-3">
                    <p class="mb-0">City</p>
                    <div class="form-outline">
                        <input type="text" name="city" id="city" placeholder="" class="form-control" 
                              value="{{ old('city', optional($defaultAddress)->city ?? '') }}" required />
                        <span class="error-message" id="cityError"></span>
                    </div>
                </div>
                <div class="col-sm-6 mb-3">
                    <p class="mb-0">Postal code</p>
                    <div class="form-outline">
                        <input type="text" name="postal_code" id="postalCode" class="form-control" 
                              value="{{ old('postal_code', optional($defaultAddress)->postal_code ?? '') }}" required />
                        <span class="error-message" id="postalCodeError"></span>
                    </div>
                </div>
            </div>
            <hr class="my-4" />
            <h5 class="card-title mb-3" style="color:red">Shipping Details</h5>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                <label class="form-check-label" for="flexCheckDefault1">Ship to a different address ?</label>
            </div>
            <div class="mb-3">
                <p class="mb-0">Order notes (optional)</p>
                <div class="form-outline">
                    <textarea class="form-control" name="order_notes" id="textAreaExample1" rows="2"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>



         <!-- Summary -->
            <div class="col-md-4">
                <div class="card shadow-0 border summary-card">
                    <div class="p-4">
                        <h5 class="mb-3">Your Order</h5>
                        @forelse ($cart as $item)
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">{{ $item->product->product_name }} x {{ $item->quantity ?? 1 }}</p>
                                <p class="mb-2">
                                    @php
                                        $price = $item->product->sale && $item->product->sale->status === 'active' 
                                            ? $item->product->sale->sale_price 
                                            : ($item->product->specialOffer && $item->product->specialOffer->status === 'active'
                                                ? $item->product->specialOffer->offer_price
                                                : $item->product->normal_price);
                                    @endphp
                                    Rs. {{ number_format($price * ($item->quantity ?? 1), 2) }}
                                </p>
                            </div>
                        @empty
                            <p>No items in the cart</p>
                        @endforelse
                        <hr />
                        <div class="d-flex justify-content-between">
                            <p class="mb-2">Subtotal:</p>
                            <p class="mb-2">
                                Rs. {{ number_format($cart->sum(function($item) {
                                    return ($item->product->sale && $item->product->sale->status === 'active' 
                                            ? $item->product->sale->sale_price 
                                            : ($item->product->specialOffer && $item->product->specialOffer->status === 'active'
                                                ? $item->product->specialOffer->offer_price
                                                : $item->product->normal_price)) 
                                        * ($item->quantity ?? 1);
                                }), 2) }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="mb-2">Delivery Fee:</p>
                            <p class="mb-2">Rs. 300.00</p>
                        </div>
                        <hr />
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-2">Total:</h5>
                            <h5 class="mb-2 fw-bold">
                                Rs. {{ number_format($cart->sum(function($item) {
                                    return ($item->product->sale && $item->product->sale->status === 'active' 
                                            ? $item->product->sale->sale_price 
                                            : ($item->product->specialOffer && $item->product->specialOffer->status === 'active'
                                                ? $item->product->specialOffer->offer_price
                                                : $item->product->normal_price)) 
                                        * ($item->quantity ?? 1);
                                }) + 300, 2) }}
                            </h5>
                        </div>
                        <button type="submit" class="btn w-100" style="background-color:#4A2FF4; color:white;">Proceed to Pay</button>
                    </div>
                </div>
            </div>

      </div>
    </form>
  </section>

  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('confirmButton').addEventListener('click', function() {
      let formValid = true;

      ['firstName', 'lastName', 'phone', 'billingEmail', 'address', 'city', 'postalCode'].forEach(function(id) {
        let input = document.getElementById(id);
        let error = document.getElementById(id + 'Error');
        
        if (input.value.trim() === '') {
          error.textContent = 'This field is required';
          formValid = false;
        } else {
          error.textContent = '';
        }
      });

      if (formValid) {
        document.getElementById('orderForm').submit();
      }
    });
  });

</script>

@endsection
