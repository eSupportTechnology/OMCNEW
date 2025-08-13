@extends ('frontend.master')

@section('content')
    <!-- Start Page Title -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>Cart</h2>
                <ul>
                    <li><a href="/">Home</a></li>
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
    let shippingUpdateTimeout;

    $('.plus-btn, .minus-btn').off('click').on('click', function() {
        const quantityInput = $(this).siblings('.quantity-input');
        let currentValue = parseInt(quantityInput.val());
        const maxValue = parseInt(quantityInput.data('max')) || 999;

        if (!isNaN(currentValue)) {
            if ($(this).hasClass('plus-btn')) {
                if (currentValue >= maxValue) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Stock Limit',
                        text: 'Cannot increase beyond available stock (' + maxValue + ').',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
                quantityInput.val(currentValue + 1);
            } else if ($(this).hasClass('minus-btn') && currentValue > 1) {
                quantityInput.val(currentValue - 1);
            }
            handleQuantityChange(quantityInput);
        }
    });

    $(document).off('input change', '.quantity-input').on('input change', '.quantity-input', function() {
        let val = parseInt($(this).val());
        const maxValue = parseInt($(this).data('max')) || 999;

        if (isNaN(val) || val < 1) {
            $(this).val(1);
            val = 1;
        } else if (val > maxValue) {
            $(this).val(maxValue);
            val = maxValue;
            Swal.fire({
                icon: 'warning',
                title: 'Stock Limit',
                text: 'Quantity adjusted to maximum available stock (' + maxValue + ').',
                confirmButtonText: 'OK'
            });
        }
        handleQuantityChange($(this));
    });

    function handleQuantityChange(quantityInput) {
        const productId = getProductIdFromElement(quantityInput);
        const quantity = parseInt(quantityInput.val());

        // Clear any pending refresh
        clearTimeout(shippingUpdateTimeout);

        // Update quantity on server, then refresh totals after success
        updateCartQuantityOnServer(productId, quantity, function() {
            // Refresh cart totals and shipping calculations from server
            shippingUpdateTimeout = setTimeout(() => {
                refreshCartTotalsFromServer();
            }, 300);
        });
    }

    function getProductIdFromElement(element) {
        let productId = element.data('product-id');
        if (!productId) {
            productId = element.siblings('.plus-btn, .minus-btn').first().data('product-id');
        }
        if (!productId) {
            const container = element.closest('.cart-item-mobile, tr');
            productId = container.find('.plus-btn, .minus-btn').first().data('product-id');
        }
        return productId;
    }

    function updateCartQuantityOnServer(productId, quantity, callback) {
        $.ajax({
            url: '{{ route('cart.update') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: quantity
            },
            success: function() {
                if (callback) callback();
            },
            error: function(xhr, status, error) {
                console.error('Error updating cart quantity:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: 'Failed to update cart. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        });
    }

    function refreshCartTotalsFromServer() {
        console.log('Refreshing cart totals from server...');

        const items = collectCartItems();
        console.log('Collected items:', items);

        $.ajax({
            url: '{{ route('cart.calculateShipping') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                items: items
            },
            success: function(response) {
                console.log('Server response:', response);
                if (response.success) {
                    updateCartTotalsFromServerResponse(response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error refreshing cart totals:', error);
                console.error('XHR:', xhr.responseText);
            }
        });
    }

    function collectCartItems() {
        let items = [];
        let isMobile = window.innerWidth < 768;

        if (isMobile) {
            $('.mobile-cart .cart-item-mobile').each(function() {
                const productId = $(this).find('.plus-btn, .minus-btn').first().data('product-id');
                const quantity = parseInt($(this).find('.quantity-input').val()) || 0;
                if (productId && quantity > 0) {
                    items.push({
                        product_id: productId,
                        quantity: quantity
                    });
                }
            });
        } else {
            $('.cart-table tbody tr').each(function() {
                const productId = $(this).find('.plus-btn, .minus-btn').first().data('product-id');
                const quantity = parseInt($(this).find('.quantity-input').val()) || 0;
                if (productId && quantity > 0) {
                    items.push({
                        product_id: productId,
                        quantity: quantity
                    });
                }
            });
        }
        return items;
    }

    function updateCartTotalsFromServerResponse(response) {
        console.log('Updating cart display with server response:', response);

        // Update shipping charges
        if (response.delivery_fee !== undefined) {
            $('.cart-totals li:contains("Shipping Charges") span').text('Rs. ' + response.delivery_fee);
        }

        // Update subtotal
        if (response.subtotal !== undefined) {
            $('.cart-totals li:contains("Subtotal") span').text('LKR ' + response.subtotal);
        }

        // Update final total
        if (response.total !== undefined) {
            $('.cart-totals li:contains("Total") span').text('LKR ' + response.total);
        }

        // Update individual line item totals
        if (response.item_totals) {
            updateIndividualItemTotals(response.item_totals);
        }
    }

    function updateIndividualItemTotals(itemTotals) {
        let isMobile = window.innerWidth < 768;

        if (isMobile) {
            $('.mobile-cart .cart-item-mobile').each(function() {
                const productId = $(this).find('.plus-btn, .minus-btn').first().data('product-id');
                if (itemTotals[productId] !== undefined) {
                    $(this).find('.subtotal-amount').text('LKR ' + itemTotals[productId]);
                }
            });
        } else {
            $('.cart-table tbody tr').each(function() {
                const productId = $(this).find('.plus-btn, .minus-btn').first().data('product-id');
                if (itemTotals[productId] !== undefined) {
                    $(this).find('.subtotal-amount').text('LKR ' + itemTotals[productId]);
                }
            });
        }
    }

    // Remove item functionality
    $(document).on('click', '.btn-delete-item', function(e) {
        e.preventDefault();
        const btn = $(this);
        const productId = btn.data('product-id');
        const url = "{{ url('cart') }}/" + productId;
        const originalHtml = btn.html();

        btn.html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);

        $.ajax({
            url: url,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function() {
                location.reload();
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again.',
                    confirmButtonText: 'OK'
                });
                btn.html(originalHtml).prop('disabled', false);
            }
        });
    });

    // Handle window resize
    $(window).resize(function() {
        clearTimeout(shippingUpdateTimeout);
        shippingUpdateTimeout = setTimeout(() => {
            refreshCartTotalsFromServer();
        }, 300);
    });
});
    </script>
@endsection
