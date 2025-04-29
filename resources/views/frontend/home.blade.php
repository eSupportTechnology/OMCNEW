@extends ('frontend.master')

@section('content')
<style>
 

</style>
        <!-- Start Main Banner Area -->
        <div class="home-slides owl-carousel owl-theme">
            <div class="main-banner banner-bg1">
                <div class="d-table">
                    <div class="d-table-cell">
                        <div class="container">
                            <div class="main-banner-content text-center">
                                <span class="sub-title">Limited Time Offer!</span>
                                <h1>Winter-Spring!</h1>
                                <p class="text-light">Take 20% Off ‘Sale Must-Haves'</p>
                                <div class="btn-box">
                                    <a href="products-left-sidebar.html" class="default-btn">Shop Women's</a>
                                    <a href="products-right-sidebar-2.html" class="optional-btn">Shop Men's</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-banner banner-bg2">
                <div class="d-table">
                    <div class="d-table-cell">
                        <div class="container">
                            <div class="main-banner-content">
                                <span class="sub-title">Exclusive Offer!</span>
                                <h1>Spring-Show!</h1>
                                <p class="text-light">Leap year offer ‘Sale Must-Haves'</p>
                                <div class="btn-box">
                                    <a href="products-left-sidebar.html" class="default-btn">Shop Women's</a>
                                    <a href="products-right-sidebar-2.html" class="optional-btn">Shop Men's</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-banner banner-bg3">
                <div class="d-table">
                    <div class="d-table-cell">
                        <div class="container">
                            <div class="main-banner-content">
                                <span class="sub-title">Buy Now From OMC!</span>
                                <h1>New Season Canvas</h1>
                                <p class="text-light">Take 20% Off ‘Sale Must-Haves'</p>
                                <div class="btn-box">
                                    <a href="products-left-sidebar.html" class="default-btn">Shop Women's</a>
                                    <a href="products-right-sidebar-2.html" class="optional-btn">Shop Men's</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Banner Area -->

        <!-- Start Categories Banner Area -->
        <section class="categories-banner-area pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <h2>Shop by Categories</h2>
                </div>
                <div class="row justify-content-center" style="margin-left: -10px; margin-right: -10px;">
                    @foreach($categories->take(12) as $category)
                        <div class="col-lg-2 col-md-3 col-sm-3" style="padding-left: 10px; padding-right: 10px;">
                            <div class="single-categories-box position-relative" style="border-radius: 0;">
                                <!-- Display Category Image -->
                                <img src="{{ asset('storage/category_images/' . basename($category->image)) }}" 
                                    alt="{{ $category->parent_category }} image" 
                                    style="width: 100%; height: 150px; object-fit: cover; border-radius: 0;">

                                <div class="content text-white position-absolute w-100 h-100 top-0 left-0 d-flex align-items-center justify-content-center">
                                    <a href="{{ url('/all-items?category=' . urlencode($category->parent_category)) }}" 
                                    class="default-btn" 
                                    style="padding: 8px 18px; font-size: 12px; text-align: center; border-radius: 0;">
                                        {{ $category->parent_category }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Categories Banner Area -->


        <!-- Start Products Area -->
        <section class="products-area pb-70">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">See Our Collection</span>
                    <h2>Recent Products</h2>
                </div>

                <div class="row justify-content-center">
                @foreach($recentProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
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

                            @if($product->sale)
                                <div class="sale-tag">Sale!</div>
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
                                        @if ($i <= floor($product->average_rating)) 
                                            <i class='bx bxs-star'></i> 
                                        @elseif ($i == ceil($product->average_rating) && fmod($product->average_rating, 1) >= 0.5)
                                            <i class='bx bxs-star-half'></i> 
                                        @else
                                            <i class='bx bx-star'></i>
                                        @endif
                                    @endfor

                                </div>
                                <a href="" class="add-to-cart"> @if($product->sale && $product->sale->status === 'active')
                                        <span class="new-price">Rs. {{ number_format($product->sale->sale_price, 2) }}</span>
                                    @elseif($product->specialOffer && $product->specialOffer->status === 'active')
                                        <span class="new-price">Rs. {{ number_format($product->specialOffer->offer_price, 2) }}</span>
                                    @else
                                        <span class="new-price">Rs. {{ number_format($product->normal_price, 2) }}</span>
                                    @endif
                                </a>

                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Products Area -->

        <!-- Start Offer Area -->
        <section class="offer-area bg-image1 ptb-100 jarallax" data-jarallax='{"speed": 0.3}'>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <div class="offer-content">
                            <span class="sub-title">Limited Time Offer!</span>
                            <h2>-40% OFF</h2>
                            <p>Get The Best Deals Now</p>
                            <a href="products-one-row.html" class="default-btn">Discover Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Offer Area -->

        <!-- Start Products Area -->
        <section class="products-area pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">See Our Collection</span>
                    <h2>Popular Products</h2>
                </div>

                <div class="row justify-content-center">
                @foreach($orderedProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
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
                                @if($product->sale)
                                <div class="sale-tag">Sale!</div>
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
                                        @if ($i <= floor($product->average_rating)) 
                                            <i class='bx bxs-star'></i> 
                                        @elseif ($i == ceil($product->average_rating) && fmod($product->average_rating, 1) >= 0.5)
                                            <i class='bx bxs-star-half'></i> 
                                        @else
                                            <i class='bx bx-star'></i>
                                        @endif
                                    @endfor

                                </div>
                                <a href="" class="add-to-cart"> @if($product->sale && $product->sale->status === 'active')
                                        <span class="new-price">Rs. {{ number_format($product->sale->sale_price, 2) }}</span>
                                    @elseif($product->specialOffer && $product->specialOffer->status === 'active')
                                        <span class="new-price">Rs. {{ number_format($product->specialOffer->offer_price, 2) }}</span>
                                    @else
                                        <span class="new-price">Rs. {{ number_format($product->normal_price, 2) }}</span>
                                    @endif
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </section>
        <!-- End Products Area -->

        


               <!-- Start Products Area -->
               <section class="products-area pt-70 pb-70 mb-5"  style="background-color: #fafafa;">
                    <div class="container">
                        <div class="section-title text-start">
                            <span class="sub-title">See Our Collection</span>
                            <h2>Special Offers</h2>
                            <a href="{{ route('special-offers') }}" class="default-btn">Shop More</a>
                        </div>

                        <div class="products-slides owl-carousel owl-theme">
                        @foreach($specialOffers as $offer)
                            <div class="single-products-box">
                                <div class="products-image">
                                <a href="{{ route('product-description', ['product_id' => $offer->product->product_id]) }}">
                                @if($offer->product->images && $offer->product->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $offer->product->images->first()->image_path) }}" class="main-image" alt="image" style="width: 70%; height:270px">
                                    <img src="{{ asset('storage/' . $offer->product->images->first()->image_path) }}" class="hover-image" alt="image"  style="width: 70%; height:270px">
                                @else
                                    <img src="{{ asset('storage/default-image.jpg') }}" class="main-image" alt="image">
                                @endif
                                </a>
    
                                <div class="products-button">
                                <ul>
                                    <li>
                                        <div class="wishlist-btn">
                                            <a href="#" class="wishlist-toggle" data-product-id="{{ $offer->product->product_id }}" id="wishlist-{{  $offer->product->product_id }}">
                                                <i class="bx bx-heart {{ in_array( $offer->product->product_id, $wishlistProductIds) ? 'filled' : '' }}"></i> 
                                                <span class="tooltip-label">Add to Wishlist</span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                                    <div class="sale-tag">-{{ floor($offer->product->specialOffer->offer_rate) }}%</div>
                                </div>
    
                                <div class="products-content">
                        <h3><a href="{{ route('product-description', ['product_id' => $offer->product->product_id]) }}">
                        {{ \Illuminate\Support\Str::limit($product->product_name, 25) }}</a></a></h3>
                        <div class="price">
                            @if($offer->product->specialOffer && $offer->product->specialOffer->status === 'active')
                                <span class="old-price">Rs. {{ number_format($offer->product->normal_price, 2) }}</span>
                                <span class="new-price">Rs. {{ number_format($offer->product->specialOffer->offer_price, 2) }}</span>
                            @else
                                <span class="new-price">Rs. {{ number_format($offer->product->normal_price, 2) }}</span>
                            @endif
                        </div>
                        <div class="star-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($offer->product->average_rating)) 
                                    <i class='bx bxs-star'></i> 
                                @elseif ($i == ceil($offer->product->average_rating) && fmod($offer->product->average_rating, 1) >= 0.5)
                                    <i class='bx bxs-star-half'></i> 
                                @else
                                    <i class='bx bx-star'></i>
                                @endif
                            @endfor
                        </div>
                        <a href="" class="add-to-cart"> 
                            @if($offer->product->specialOffer && $offer->product->specialOffer->status === 'active')
                                <span class="new-price">Rs. {{ number_format($offer->product->specialOffer->offer_price, 2) }}</span>
                            @else
                                <span class="new-price">Rs. {{ number_format($offer->product->normal_price, 2) }}</span>
                            @endif
                        </a>

                    </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                <!-- End Products Area -->


      
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
@endsection       