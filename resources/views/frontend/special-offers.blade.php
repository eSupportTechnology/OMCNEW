@extends ('frontend.master')

@section('content')
<style>
   

    .btn-cart {
        background-color: white; 
        border: none;
        border-radius: 50%;
        width: 40px; 
        height: 40px; 
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s, color 0.3s; 
    }

    .btn-cart i {
        font-size: 1.5rem; 
        color: black;
    }

    .btn-cart:hover {
        background-color: black; 
    }

    .btn-cart:hover i {
        color: white; 
    }
    .color-option.selected-color {
    border: 2px solid #007bff; /* Blue border for the selected color */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Optional: adds a glow effect */
}

</style>
        <!-- Start Page Title -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>Special Offers</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li>Special Offers</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- Start Products Area -->
        <section class="products-area pt-100 pb-70">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-12">
                        <div class="woocommerce-widget-area">
                            <div class="woocommerce-widget filter-list-widget">
                              
                                    <a href="{{ route('special-offers') }}" class="delete-selected-filters"><i class='bx bx-trash'></i> <span>Clear All</span></a>
                               
                            </div>

                            <div class="woocommerce-widget collections-list-widget">
                                <h3 class="woocommerce-widget-title">Categories</h3>

                                <ul class="collections-list-row">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('special-offers') }}?category={{ $category->parent_category }}" 
                                        class="{{ request('category') === $category->parent_category ? 'active' : '' }}">
                                            {{ $category->parent_category }}
                                        </a>
                                    </li>
                                @endforeach
                                </ul>
                            </div>

                            <!-- Size Filter -->
                            <div class="woocommerce-widget size-list-widget">
                                <h3 class="woocommerce-widget-title">Size</h3>
                                <ul class="size-list-row">
                                    @foreach($sizes as $size)
                                        <li>
                                            <a href="{{ route('special-offers') }}?size={{ $size->value }}" 
                                            class="{{ request('size') === $size->value ? 'active' : '' }}">
                                                {{ $size->value }}
                                            </a>
                                        </li>
                                    @endforeach
                                       
                                </ul>
                              
                            </div>

                            

                            <!-- Color Filter -->
                            <div class="woocommerce-widget color-list-widget">
                                <h3 class="woocommerce-widget-title">Color</h3>
                                <ul class="color-list-row">
                                    @foreach($colors as $color)
                                        <li>
                                            <a href="{{ route('special-offers') }}?color={{ $color->value }}" 
                                            style="background-color: {{ $color->hex_value }};" 
                                            class="{{ request('color') === $color->value ? 'active' : '' }}" 
                                            title="{{ $color->value }}"></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                           
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12">
                        <div class="products-filter-options">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-lg-4 col-md-4">
                                    <div class="d-lg-flex d-md-flex align-items-center">
                                        <span class="sub-title d-lg-none"><a href="#" data-bs-toggle="modal" data-bs-target="#productsFilterModal"><i class='bx bx-filter-alt'></i> Filter</a></span>
                                        
                                        <!--<span class="sub-title d-none d-lg-block d-md-block">View:</span>

                                        <div class="view-list-row d-none d-lg-block d-md-block">
                                            <div class="view-column">
                                                <a href="#" class="icon-view-one">
                                                    <span></span>
                                                </a>

                                                <a href="#" class="icon-view-two active">
                                                    <span></span>
                                                    <span></span>
                                                </a>

                                                <a href="#" class="icon-view-three">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </a>

                                                <a href="#" class="view-grid-switch">
                                                    <span></span>
                                                    <span></span>
                                                </a>
                                            </div>
                                        </div>-->
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <p>Showing {{ $products->firstItem() }} – {{ $products->lastItem() }} of {{ $products->total() }}</p>
                                </div>


                            </div>
                        </div>

                        <div id="products-collections-filter" class="row">
                                @if($products->isEmpty())
                                    <div class="col-12">
                                        <div class="no-products">
                                            <p>No products found.</p>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($products as $product)
                                        <div class="col-lg-4 col-md-4 col-sm-6 products-col-item">
                                            <div class="single-products-box">
                                                <div class="products-image">
                                                <a href="{{ route('product-description', ['product_id' => $product->product_id]) }}">
                                                    @if($product->images->isNotEmpty())
                                                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" class="main-image" alt="image" style="width: 90%; height:270px">
                                                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" class="hover-image" alt="image"  style="width: 90%; height:270px">
                                                    @else
                                                        <img src="{{ asset('storage/default-image.jpg') }}" class="main-image" alt="image">
                                                    @endif
                                                </a>


                                                <div class="products-button">
                                                        <ul>
                                                            <li>
                                                                <div class="wishlist-btn">
                                                                    <a href="#" class="wishlist-toggle" data-product-id="{{ $product->product_id }}" id="wishlist-{{ $product->product_id }}">
                                                                        <i class="bx bx-heart {{ in_array($product->product_id, $wishlistProductIds) ? 'filled' : '' }}"></i> 
                                                                        <span class="tooltip-label">Add to Wishlist</span>
                                                                    </a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                               
                                                @if(($product->sale && $product->sale->status === 'active') || ($product->specialOffer && $product->specialOffer->status === 'active'))
                                                    <div class="sale-tag">
                                                        @if($product->sale && $product->sale->status === 'active')
                                                            @php
                                                                $saleRate = (($product->normal_price - $product->sale->sale_price) / $product->normal_price) * 100;
                                                            @endphp
                                                            - {{ round($saleRate) }}%
                                                        @elseif($product->specialOffer && $product->specialOffer->status === 'active')
                                                            @php
                                                                $offerRate = (($product->normal_price - $product->specialOffer->offer_price) / $product->normal_price) * 100;
                                                            @endphp
                                                            - {{ round($offerRate) }}%
                                                        @endif
                                                    </div>
                                                @endif


                                            </div>

                                            <div class="products-content">
                                                <h3><a href="{{ route('product-description', ['product_id' => $product->product_id]) }}">
                                                {{ \Illuminate\Support\Str::limit($product->product_name, 25) }}</a></h3>
                                                <div class="price">
                                                    @if($product->sale && $product->sale->status === 'active')
                                                        <span class="old-price">Rs. {{ number_format($product->normal_price, 2) }}</span>
                                                        <span class="new-price">Rs. {{ number_format($product->sale->sale_price, 2) }}</span>
                                                    @elseif($product->specialOffer && $product->specialOffer->status === 'active')
                                                        <span class="old-price">Rs. {{ number_format($product->normal_price, 2) }}</span>
                                                        <span class="new-price">Rs. {{ number_format($product->specialOffer->offer_price, 2) }}</span>
                                                    @else
                                                        <span class="new-price">Rs. {{ number_format($product->normal_price, 2) }}</span>
                                                    @endif
                                                </div>
                                                <div class="star-rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $product->average_rating)
                                                            <i class='bx bxs-star'></i> <!-- Full star -->
                                                        @else
                                                            <i class='bx bx-star'></i> <!-- Empty star -->
                                                        @endif
                                                    @endfor
                                                </div>

                                                <a href="/cart" class="add-to-cart"  data-bs-toggle="modal" data-bs-target="#cartModal_{{ $product->product_id }}">Add to Cart</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>


                        <div class="pagination-area text-center">
                            <!-- Previous Page Link -->
                            @if ($products->onFirstPage())
                                <span class="prev page-numbers disabled"><i class='bx bx-chevron-left'></i></span>
                            @else
                                <a href="{{ $products->previousPageUrl() }}" class="prev page-numbers"><i class='bx bx-chevron-left'></i></a>
                            @endif

                            <!-- Page Numbers -->
                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if ($page == $products->currentPage())
                                    <span class="page-numbers current" aria-current="page">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="page-numbers">{{ $page }}</a>
                                @endif
                            @endforeach

                            <!-- Next Page Link -->
                            @if ($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}" class="next page-numbers"><i class='bx bx-chevron-right'></i></a>
                            @else
                                <span class="next page-numbers disabled"><i class='bx bx-chevron-right'></i></span>
                            @endif
                        </div>


                    </div>
                </div>
            </div>
        </section>
        <!-- End Products Area -->

        <!-- cart modal-->
    @foreach ($products as $product)
    <div class="modal fade" id="cartModal_{{ $product->product_id }}" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content" style="border-radius: 0;">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gx-5">
                        <aside class="col-lg-5">
                        <div class="rounded-4 mb-3 d-flex justify-content-center">
                            @if($product->images->first())
                                <a class="rounded-4 main-image-link" href="{{ asset('storage/' . $product->images->first()->image_path) }}">
                                    <img id="mainImage" class="rounded-4 fit" style="width:280px; height:auto"
                                        src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                    />
                                </a>
                            @else
                                <a class="rounded-4 main-image-link" href="{{ asset('images/default.jpg') }}">
                                    <img id="mainImage" class="rounded-4 fit" 
                                        src="{{ asset('images/default.jpg') }}" 
                                    />
                                </a>
                            @endif
                        </div>

                            <div class="d-flex justify-content-center mb-3">
                                @foreach($product->images as $image)
                                <a class="mx-1 rounded-2 thumbnail-image" data-image="{{ asset('storage/' . $image->image_path) }}" href="javascript:void(0);">
                                    <img class="thumbnail rounded-2" src="{{ asset('storage/' . $image->image_path) }}"  style="width:70px; height:auto"/>
                                </a>
                                @endforeach
                            </div>
                        </aside>

                        <main class="col-lg-7">
                            <h4>{{ $product->product_name }}</h4>
                            <p class="description">
                                {{ (str_replace('&nbsp;', ' ', strip_tags($product->product_description))) }}
                            </p>  
                            <div class="d-flex flex-row my-3">
                                <div class="text-warning mb-1 me-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($product->average_rating)) 
                                            <i class='bx bxs-star'></i> 
                                        @elseif ($i == ceil($product->average_rating) && fmod($product->average_rating, 1) >= 0.5)
                                            <i class='bx bxs-star-half'></i> 
                                        @else
                                            <i class='bx bx-star'></i>
                                        @endif
                                    @endfor
                                    <span class="ms-1">{{ number_format($product->average_rating, 1) }}</span>
                                </div>
                                <span class="text-primary">{{ $product->rating_count }} Ratings  </span>
                               
                            </div>
                            <hr />
                            
                            <div class="product-availability mt-3 mb-1">
                                <span>Availability :</span>
                                @if($product->quantity > 1)
                                    <span class="ms-1" style="color:#4caf50;">In stock</span>
                                @else
                                    <span class="ms-1" style="color:red;">Out of stock</span>
                                @endif
                            </div>

                            <div class="product-container">
                            <!-- Size Options -->
                            @if($product->variations->where('type', 'Size')->isNotEmpty())
                                <div class="mb-2">
                                    <span>Size: </span>
                                    @foreach($product->variations->where('type', 'Size') as $size)
                                        @if($size->quantity > 0)  
                                            <button class="btn btn-outline-secondary btn-sm me-1 size-option" style="height:28px;" data-size="{{ $size->value }}">
                                                {{ $size->value }}
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            <!-- Color Options -->
                            @if($product->variations->where('type', 'Color')->isNotEmpty())
                                <div class="mb-2">
                                    <span>Color: </span>
                                    @foreach($product->variations->where('type', 'Color') as $color)
                                        @if($color->quantity > 0)  
                                            <button class="btn btn-outline-secondary btn-sm color-option" 
                                                style="background-color: {{ $color->hex_value }}; border-color: #e8ebec; height: 17px; width: 15px;" 
                                                data-color="{{ $color->hex_value }}" 
                                                data-color-name="{{ $color->value }}">
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            <div class="product-price mb-3 mt-3 d-flex align-items-center">
                                <span class="h4" style="color:#f55b29; margin-right: 10px;">
                                    @if($product->sale && $product->sale->status === 'active')
                                        <span class="sale-price">Rs. {{ number_format($product->sale->sale_price, 2) }}</span>
                                    @elseif($product->specialOffer && $product->specialOffer->status === 'active')
                                        <span class="offer-price">Rs. {{ number_format($product->specialOffer->offer_price, 2) }}</span>
                                    @else
                                        Rs. {{ number_format($product->normal_price, 2) }}
                                    @endif
                                </span>
                            </div>

                            @auth
                                <a href="#" class="btn btn-custom-cart mb-3 add-to-cart-modal shadow-0 {{ $product->quantity <= 1 ? 'btn-disabled' : '' }}"
                                    data-product-id="{{ $product->product_id }}" data-auth="true" style="width: 40%; background-color: #007bff; color: white;">
                                    <i class="me-1 fa fa-shopping-basket"></i>Add to cart
                                </a>
                            @else
                                <a href="#" class="btn btn-custom-cart mb-3 add-to-cart-modal shadow-0 {{ $product->quantity <= 1 ? 'btn-disabled' : '' }}" 
                                    data-product-id="{{ $product->product_id }}" data-auth="false" style="width: 40%; background-color: #007bff; color: white;">
                                    <i class="me-1 fa fa-shopping-basket"></i>Add to cart
                                </a>
                            @endauth

                        </div>

                            <a href="{{ route('product-description', $product->product_id ) }}" style="text-decoration: none; font-size:14px; color: #297aa5">
                            View Full Details<i class="fa-solid fa-circle-right ms-1"></i></a>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>

<!-- Start Products Filter Modal Area -->
<div class="modal left fade productsFilterModal" id="productsFilterModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class='bx bx-x'></i> Close</span>
                    </button>

                    <div class="modal-body">
                    <div class="woocommerce-widget-area">
                            <div class="woocommerce-widget filter-list-widget">
                              
                                    <a href="{{ route('all-items') }}" class="delete-selected-filters"><i class='bx bx-trash'></i> <span>Clear All</span></a>
                               
                            </div>

                            <div class="woocommerce-widget collections-list-widget">
                                <h3 class="woocommerce-widget-title">Categories</h3>

                                <ul class="collections-list-row">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('all-items') }}?category={{ $category->parent_category }}" 
                                        class="{{ request('category') === $category->parent_category ? 'active' : '' }}">
                                            {{ $category->parent_category }}
                                        </a>
                                    </li>
                                @endforeach
                                </ul>
                            </div>

                            <!-- Size Filter -->
                            <div class="woocommerce-widget size-list-widget">
                                <h3 class="woocommerce-widget-title">Size</h3>
                                <ul class="size-list-row">
                                    @foreach($sizes as $size)
                                        <li>
                                            <a href="{{ route('all-items') }}?size={{ $size->value }}" 
                                            class="{{ request('size') === $size->value ? 'active' : '' }}">
                                                {{ $size->value }}
                                            </a>
                                        </li>
                                    @endforeach
                                       
                                </ul>
                              
                            </div>

                            

                            <!-- Color Filter -->
                            <div class="woocommerce-widget color-list-widget">
                                <h3 class="woocommerce-widget-title">Color</h3>
                                <ul class="color-list-row">
                                    @foreach($colors as $color)
                                        <li>
                                            <a href="{{ route('all-items') }}?color={{ $color->value }}" 
                                            style="background-color: {{ $color->hex_value }};" 
                                            class="{{ request('color') === $color->value ? 'active' : '' }}" 
                                            title="{{ $color->value }}"></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Products Filter Modal Area -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>


<script>
        $(document).ready(function() {
    // Handle the click event on the heart icon
    $('.wishlist-toggle').on('click', function(e) {
        e.preventDefault(); 

        var productId = $(this).data('product-id'); 
        var heartIcon = $(this).find('i'); 

        $.ajax({
            url: '{{ route('wishlist.toggle') }}',
            method: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content'),  // Ensure CSRF token is correct
            },
            success: function(response) {
                if (response.message === 'Product added to wishlist') {
                    heartIcon.addClass('filled');
                    alert(response.message);
                } else if (response.message === 'Product removed from wishlist') {
                    heartIcon.removeClass('filled');
                    alert(response.message);
                }
            },
            error: function() {
                alert('You must be logged in to add to wishlist');
            }
        });

    });
});

</script>     
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-cart').forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation();
                event.preventDefault();
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
    const colorButtons = document.querySelectorAll('.color-option');

    colorButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove the selected class from all buttons
            colorButtons.forEach(btn => btn.classList.remove('selected-color'));
            
            this.classList.add('selected-color');

            const selectedColor = this.getAttribute('data-color');
            console.log('Selected Color: ', selectedColor);

        });
    });
});


</script>


<script>
$(document).ready(function() {
    // Add to Cart click event
    $('.add-to-cart-modal').on('click', function(e) {
        e.preventDefault();
        console.log('Button clicked');  // Debugging line to check if the click event is firing

        const productId = $(this).data('product-id');
        const isAuth = $(this).data('auth');
        const productContainer = $(this).closest('.product-container');
        const sizeOptions = productContainer.find('button.size-option');
        const colorOptions = productContainer.find('button.color-option');
        const hasSizeOptions = sizeOptions.length > 0;
        const hasColorOptions = colorOptions.length > 0;

        const selectedSize = hasSizeOptions ? sizeOptions.filter('.active').data('size') : null;
        const selectedColor = hasColorOptions ? colorOptions.filter('.active').data('color') : null;

        // Check if size is required and not selected
        if (hasSizeOptions && !selectedSize) {
            toastr.warning('Please select a size option before adding this product to the cart.', 'Warning', {
                positionClass: 'toast-top-right',
                timeOut: 3000,
            });
            return; // Stop further execution
        }

        // Check if color is required and not selected
        if (hasColorOptions && !selectedColor) {
            toastr.warning('Please select a color option before adding this product to the cart.', 'Warning', {
                positionClass: 'toast-top-right',
                timeOut: 3000,
            });
            return; // Stop further execution
        }

        // Check if the user is authenticated
        if (isAuth === true || isAuth === "true") { 
            $.ajax({
                url: "{{ route('cart.add') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    size: selectedSize,
                    color: selectedColor
                },
                success: function(response) {
                    $.get("{{ route('cart.count') }}", function(data) {
                        $('#cart-count').text(data.cart_count);
                    });

                    toastr.success('Item added to cart!', 'Success', {
                        positionClass: 'toast-top-right',
                        timeOut: 3000,
                    });

                    productContainer.find('button.size-option.active').removeClass('active');
                    productContainer.find('button.color-option.active').removeClass('active');
                },
                error: function(xhr) {
                    toastr.error('Something went wrong. Please try again.', 'Error', {
                        positionClass: 'toast-top-right',
                        timeOut: 3000,
                    });
                }
            });
        } else {
            toastr.warning('Please log in to add items to your cart.', 'Warning', {
                positionClass: 'toast-top-right',
                timeOut: 3000,
            });
        }
    });

    // Size selection click event
    $('.size-option').on('click', function() {
        $('.size-option').removeClass('active');
        $(this).addClass('active');
    });

    // Color selection click event
    $('.color-option').on('click', function() {
        // Reset previous color selection
        $('.color-option').removeClass('active');
        $(this).addClass('active');
    });
});


</script>


<script>

$('.js-range-of-price').on('input', function() {
    var minPrice = $(this).data('min');
    var maxPrice = $(this).data('max');
    var priceRange = $(this).val();

    // Update the URL with the price range filter
    var url = new URL(window.location);
    url.searchParams.set('price', priceRange);
    window.location.href = url.toString();
});

    </script>
@endsection
        