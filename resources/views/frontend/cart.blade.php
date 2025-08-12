@extends ('frontend.master')

@section('content')
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
            @auth
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-8">
                        <!-- Desktop Cart - Visible on md screens and up -->
                        <div class="cart-table table-responsive d-none d-md-block">
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
                                    @forelse ($cart as $item)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a
                                                    href="{{ route('product-description', ['product_id' => $item->product_id]) }}">
                                                    <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                                        alt="item">
                                                </a>
                                            </td>

                                            <td class="product-name">
                                                <a
                                                    href="{{ route('product-description', ['product_id' => $item->product_id]) }}">{{ $item->product->product_name }}</a>
                                                <ul>
                                                    <li>Color: <span
                                                            style="background-color: {{ $item->color }}; width: 15px; height: 15px; display: inline-block; border-radius: 50%; margin-left: 5px; vertical-align: middle;"></span>
                                                    </li>
                                                    <li>Size: <span>{{ $item->size }}</span></li>
                                                </ul>
                                            </td>

                                            <td class="product-price">
                                                <span class="unit-amount">
                                                    @php
                                                        // Check if there's an active special offer, otherwise check for sale, else use normal price
$price =
    $item->product->specialOffer &&
    $item->product->specialOffer->status === 'active'
        ? $item->product->specialOffer->offer_price
        : ($item->product->sale &&
        $item->product->sale->status === 'active'
                                                                    ? $item->product->sale->sale_price
                                                                    : $item->product->normal_price);
                                                    @endphp
                                                    LKR {{ number_format($price, 2) }}
                                                </span>
                                            </td>

                                            <td class="product-quantity">
                                                <div class="input-counter">
                                                    <span class="minus-btn" data-product-id="{{ $item->product_id }}"><i
                                                            class='fa fa-minus'></i></span>
                                                    <input type="text" min="1" max="{{ $item->product->quantity }}"
                                                        value="{{ $item->quantity }}" data-max="{{ $item->product->quantity }}"
                                                        name="quantity[{{ $item->id }}]" class="quantity-input">

                                                    <span class="plus-btn" data-product-id="{{ $item->product_id }}"><i
                                                            class='fa fa-plus'></i></span>
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="subtotal-amount">LKR
                                                    {{ number_format($price * $item->quantity, 2) }}</span>

                                            </td>
                                            <td class="product-subtotal">
                                                <a href="javascript:void(0);" class="btn-delete-item remove"
                                                    data-product-id="{{ $item->product_id }}">
                                                    <i class='fa fa-trash'></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No items in the cart</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Cart - Visible only on smaller screens -->
                        <div class="mobile-cart d-md-none">
                            @forelse ($cart as $item)
                                <div class="cart-item-mobile">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="product-thumbnail">
                                                <a
                                                    href="{{ route('product-description', ['product_id' => $item->product_id]) }}">
                                                    <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                                        alt="item" class="img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="product-info">
                                                <h5 class="product-name">
                                                    <a
                                                        href="{{ route('product-description', ['product_id' => $item->product_id]) }}">
                                                        {{ $item->product->product_name }}
                                                    </a>
                                                </h5>
                                                <div class="product-meta">
                                                    <div>Color:
                                                        <span
                                                            style="background-color: {{ $item->color }}; width: 15px; height: 15px; display: inline-block; border-radius: 50%; margin-left: 5px; vertical-align: middle;"></span>
                                                    </div>
                                                    <div>Size: <span>{{ $item->size }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <div class="price-info">
                                                <div><strong>Unit Price:</strong></div>
                                                <div class="unit-amount">
                                                    @php
                                                        $price =
                                                            $item->product->specialOffer &&
                                                            $item->product->specialOffer->status === 'active'
                                                                ? $item->product->specialOffer->offer_price
                                                                : ($item->product->sale &&
                                                                $item->product->sale->status === 'active'
                                                                    ? $item->product->sale->sale_price
                                                                    : $item->product->normal_price);
                                                    @endphp
                                                    LKR {{ number_format($price, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="quantity-info text-right">
                                                <div style="padding-right: 20px"><strong>Quantity:</strong></div>
                                                <div class="input-counter" style="float: right;">

                                                    <span class="minus-btn" data-product-id="{{ $item->product_id }}">
                                                        <i class='fa fa-minus'></i>
                                                    </span>
                                                    <input type="text" min="1" value="{{ $item->quantity }}"
                                                        name="quantity[{{ $item->id }}]" class="quantity-input">
                                                    <span class="plus-btn" data-product-id="{{ $item->product_id }}">
                                                        <i class='fa fa-plus'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <div class="total-info">
                                                <div><strong>Total:</strong></div>
                                                <div class="subtotal-amount">
                                                    LKR {{ number_format($price * $item->quantity, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <div class="action-buttons">
                                                <a href="javascript:void(0);"
                                                    class="btn-delete-item remove btn btn-danger btn-sm"
                                                    data-product-id="{{ $item->product_id }}">
                                                    <i class='fa fa-trash'></i> Remove
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <p>No items in the cart</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-4 w-full">
                        <div class="cart-totals" style="margin-top: -10px; margin-left: 10px;">
                            <h3>Cart Totals</h3>
                            <ul>
                                <li>Subtotal <span>LKR
                                        {{ number_format(
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
                                        ) }}</span>
                                </li>

                                <li>Shipping Charges<span>Rs. {{ number_format($deliveryFee, 2) }}</span></li>

                                <li>Total <span>LKR
                                        {{ number_format(
                                            $cart->sum(function ($item) {
                                                // Check for active special offer, then sale, otherwise normal price
                                                $price =
                                                    $item->product->specialOffer && $item->product->specialOffer->status === 'active'
                                                        ? $item->product->specialOffer->offer_price
                                                        : ($item->product->sale && $item->product->sale->status === 'active'
                                                            ? $item->product->sale->sale_price
                                                            : $item->product->normal_price);
                                                return $price * $item->quantity;
                                            }) + $deliveryFee,
                                            2,
                                        ) }}</span>
                                </li>
                            </ul>

                            <a href="/cart/checkout" class="default-btn">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-10 col-md-8 col-lg-6 pl-lg-5"> <!-- Added pl-lg-5 -->
                            <div class="empty-cart-wrapper">
                                <div class="card p-4 text-center">
                                    <img src="assets/images/cart.png" class="mx-auto" style="width: 100px;">
                                    <h4 class="mt-3">Your cart is empty</h4>
                                    <p>Sign in to view your cart and start shopping.</p>
                                    <a href="{{ route('signup') }}" class="btn btn-dark w-50 mx-auto">SIGN UP</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            @endauth
        </div>
    </section>
    <!-- End Cart Area -->

    <style>
        /* Mobile Cart Styles */
        .cart-item-mobile {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .mobile-cart .product-thumbnail img {
            max-width: 100%;
            border-radius: 6px;
        }

        .mobile-cart .product-name {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .mobile-cart .product-name a {
            color: #333;
            text-decoration: none;
        }

        .mobile-cart .product-meta {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }

        .mobile-cart .input-counter {
            display: flex;
            align-items: center;
            max-width: 100px;
        }

        .mobile-cart .input-counter .minus-btn,
        .mobile-cart .input-counter .plus-btn {
            width: 25px;
            height: 25px;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 3px;
        }

        .mobile-cart .input-counter .quantity-input {
            width: 40px;
            height: 30px;
            text-align: center;
            border: 1px solid #ddd;
            margin: 0 5px;
        }

        .mobile-cart .total-info,
        .mobile-cart .price-info {
            font-size: 14px;
        }

        .mobile-cart .action-buttons {
            display: flex;
            justify-content: flex-end;
        }

        .empty-cart-wrapper {
            display: flex;
            /* make it a flex container */
            align-items: center;

            /* vertical centering */
            :contentReference[oaicite:0] {
                index=0
            }

            justify-content: center;

            /* horizontal centering */
            :contentReference[oaicite:1] {
                index=1
            }
        }


        /* Responsive adjustments */
        @media (max-width: 767px) {
            .cart-totals {
                margin-top: 20px !important;
                margin-left: 0 !important;
            }

            /* Fix signup button on small screens */
            .btn.mx-auto.d-block {
                width: 50% !important;
            }
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Store current delivery fee for immediate updates
            let currentDeliveryFee = {{ $deliveryFee }};

            // Debounce function to prevent excessive AJAX calls
            let shippingUpdateTimeout;

            // Ensure no duplicate event bindings
            $('.plus-btn, .minus-btn').off('click').on('click', function() {
                const quantityInput = $(this).siblings('.quantity-input');
                let currentValue = parseInt(quantityInput.val());

                if (!isNaN(currentValue)) {
                    if ($(this).hasClass('plus-btn')) {
                        quantityInput.val(currentValue + 1);
                    } else if ($(this).hasClass('minus-btn') && currentValue > 1) {
                        quantityInput.val(currentValue - 1);
                    }

                    updatePrice($(this));
                }
            });

            function updatePrice(element) {
                let isMobile = window.innerWidth < 768;
                let cartItem, productId, quantity;

                if (isMobile) {
                    cartItem = element.closest('.cart-item-mobile');
                    productId = element.data('product-id');
                    quantity = parseInt(cartItem.find('.quantity-input').val());

                    let priceText = cartItem.find('.unit-amount').text();
                    let cleanedPrice = priceText.replace(/[^\d.]/g, '');
                    let price = parseFloat(cleanedPrice);

                    let subtotal = quantity * price;
                    cartItem.find('.subtotal-amount').text('LKR ' + subtotal.toFixed(2).replace(
                        /\B(?=(\d{3})+(?!\d))/g, ","));
                } else {
                    cartItem = element.closest('tr');
                    productId = element.data('product-id');
                    quantity = parseInt(cartItem.find('.quantity-input').val());

                    let priceText = cartItem.find('.product-price .unit-amount').text();
                    let cleanedPrice = priceText.replace(/[^\d.]/g, '');
                    let price = parseFloat(cleanedPrice);

                    let subtotal = quantity * price;
                    cartItem.find('.product-subtotal .subtotal-amount').text('LKR ' + subtotal.toFixed(2).replace(
                        /\B(?=(\d{3})+(?!\d))/g, ","));
                }

                // First update totals with current delivery fee for immediate feedback
                updateCartTotalsDisplay();

                // Then recalculate shipping charges with debouncing
                clearTimeout(shippingUpdateTimeout);
                shippingUpdateTimeout = setTimeout(() => {
                    recalculateShippingCharges();
                }, 300); // Wait 300ms before making the AJAX call

                // AJAX update to backend for cart quantity
                updateCartQuantityOnServer(productId, quantity);
            }

            function updateCartTotalsDisplay() {
                let subtotal = 0;
                let isMobile = window.innerWidth < 768;

                if (isMobile) {
                    $('.mobile-cart .subtotal-amount').each(function() {
                        let text = $(this).text().replace(/[^\d.]/g, '');
                        subtotal += parseFloat(text) || 0;
                    });
                } else {
                    $('.cart-table .product-subtotal .subtotal-amount').each(function() {
                        let text = $(this).text().replace(/[^\d.]/g, '');
                        subtotal += parseFloat(text) || 0;
                    });
                }

                // Update subtotal display
                $('.cart-totals li:contains("Subtotal") span').text('LKR ' + subtotal.toFixed(2).replace(
                    /\B(?=(\d{3})+(?!\d))/g, ","));

                // Update total with current delivery fee
                let finalTotal = subtotal + currentDeliveryFee;
                $('.cart-totals li:contains("Total") span').text('LKR ' + finalTotal.toFixed(2).replace(
                    /\B(?=(\d{3})+(?!\d))/g, ","));
            }

            function recalculateShippingCharges() {
                let totalQuantity = 0;
                let isMobile = window.innerWidth < 768;

                if (isMobile) {
                    $('.mobile-cart .quantity-input').each(function() {
                        totalQuantity += parseInt($(this).val()) || 0;
                    });
                } else {
                    $('.cart-table .quantity-input').each(function() {
                        totalQuantity += parseInt($(this).val()) || 0;
                    });
                }

                // Show loading indicator (optional)
                $('.cart-totals li:contains("Shipping Charges") span').html(
                    '<i class="fa fa-spinner fa-spin"></i>');

                // Calculate shipping charges based on total quantity
                $.ajax({
                    url: '{{ route('cart.calculateShipping') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        total_quantity: totalQuantity
                    },
                    timeout: 5000, // 5 second timeout
                    success: function(response) {
                        currentDeliveryFee = parseFloat(response.delivery_fee) || 0;

                        // Update shipping charges display
                        $('.cart-totals li:contains("Shipping Charges") span').text('Rs. ' +
                            currentDeliveryFee.toFixed(2).replace(
                                /\B(?=(\d{3})+(?!\d))/g, ","));

                        // Recalculate and update final total
                        updateCartTotalsDisplay();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error calculating shipping:', error);

                        // Restore shipping charges display on error
                        $('.cart-totals li:contains("Shipping Charges") span').text('Rs. ' +
                            currentDeliveryFee.toFixed(2).replace(
                                /\B(?=(\d{3})+(?!\d))/g, ","));

                        // Show user-friendly error message
                        if (status === 'timeout') {
                            console.warn('Shipping calculation timed out, using current rate');
                        } else {
                            console.warn('Failed to update shipping charges, using current rate');
                        }
                    }
                });
            }

            function updateCartQuantityOnServer(productId, quantity) {
                $.ajax({
                    url: '{{ route('cart.update') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('Cart updated successfully');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error updating cart:', xhr.responseText);
                        // Optionally show user notification about update failure
                    }
                });
            }

            $(document).off('click', '.plus-btn').on('click', '.plus-btn', function(e) {
                e.preventDefault(); // stop default
                var input = $(this).siblings('.quantity-input');
                var currentValue = parseInt(input.val(), 10) || 0;
                var maxValue = parseInt(input.data('max'), 10) || 0;

                // If already at max, show modal and STOP execution
                if (currentValue >= maxValue) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Stock Limit',
                        text: 'Cannot increase beyond available stock (' + maxValue + ').',
                        confirmButtonText: 'OK'
                    });
                    return; // **THIS stops incrementing**
                }
            });

            $(document).off('click', '.minus-btn').on('click', '.minus-btn', function(e) {
                e.preventDefault();
                var input = $(this).siblings('.quantity-input');
                var currentValue = parseInt(input.val(), 10) || 0;

                if (currentValue > 1) {
                    input.val(currentValue).trigger('change');
                }
            });


            $(document).on('click', '.btn-delete-item', function(e) {
                e.preventDefault();

                var btn = $(this);
                var productId = btn.data('product-id');

                // build URL (adjust if your route path differs)
                var url = "{{ url('cart') }}/" + productId;

                // save original HTML for restore on error
                var originalHtml = btn.html();
                btn.html('<i class="fa fa-spinner fa-spin"></i>');

                $.ajax({
                    url: url,
                    type: 'DELETE', // or method: 'DELETE'
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // either remove the item from DOM or reload
                        // btn.closest('.cart-item').remove();
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Something went wrong. Please try again.');
                        btn.html(originalHtml);
                    }
                });
            });


            // Handle responsive recalculation when window resizes
            $(window).resize(function() {
                updateCartTotalsDisplay();
            });

            // Initial setup - ensure totals are calculated correctly on page load
            updateCartTotalsDisplay();
        });
    </script>
@endsection
