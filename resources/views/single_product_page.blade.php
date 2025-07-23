@extends('layouts.app')

@section('content')

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<style>
  
    .product-price span {
        display: inline-block;
        margin-right: 10px;
    }
    
    .reviews-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    margin: 0 auto; 
    }

    @media (min-width: 769px) {
    .col-md-2 {
        flex: 0 0 19%; 
        max-width: 19%;
    }
}

.review-summary {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-left: 20px;
}

.rating-score h2 {
    font-size: 40px;
    margin: 0;
}

.star-rating span {
    font-size: 24px;
}

.rating-bars {
    flex-grow: 1;
    margin-left: 20px;
}

.rating-bar {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
}

.rating-bar span {
    font-size: 14px;
    margin-right: 10px;
}

.bar {
    width: 70%;
    height: 8px;
    background-color: #e0e0e0;
    border-radius: 5px;
    position: relative;
}

.fill {
    background-color: #fad21e; 
    height: 100%;
    border-radius: 5px;
}

.rating-categories {
    margin: 20px 0;
    display: flex;
    gap: 10px;
}

.rating-categories .badge {
    background-color: #f5f5f5;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 14px;
}

.review-list {
    margin-top: 20px;
}

.review-item {
    padding: 5px;
    margin-bottom: 15px;
}

.user-info {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.user-image {
    width: 4%;
    height: auto;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 15px;
}

.user-details {
    flex: 1;
}

.user-rating {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.rating {
    display: flex;
    gap: 5px;
}


.review-images {
    display: flex;
    gap: 10px;
}

.review-images img {
    width: 5%;
    height: auto;
    object-fit: cover;
}


.read-all-reviews {
    display: block;
    text-align: right;
    color: #6c63ff;
    text-decoration none;
    margin-top: 10px;
}


   

</style>

<div class="container mt-4 mb-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page" id="breadcrumb-product">Product</li>
            <li class="breadcrumb-item active " aria-current="page" id="breadcrumb-description">Description</li>
            <li class="breadcrumb-item active d-none" aria-current="page" id="breadcrumb-specification">Specification</li>
            <li class="breadcrumb-item active d-none" aria-current="page" id="breadcrumb-review">Reviews</li>
            <li class="breadcrumb-item active d-none" aria-current="page" id="breadcrumb-QA">Q & A</li>
        </ol>
    </nav>


    <section class="py-3">
    <div class="container" style="width: 80%;">
        <div class="row gx-5">
        <aside class="col-lg-5 d-flex">
            <div class="d-flex flex-column justify-content-start align-items-center me-3">
                @foreach($product->images as $image)
                    <a class="glightbox mb-2 rounded-2" style="border: none;" data-type="image" href="{{ asset('storage/' . $image->image_path) }}">
                        <img class="thumbnail rounded-2" style="width: 80px; height: 80px; object-fit: cover;" src="{{ asset('storage/' . $image->image_path) }}" />
                    </a>
                @endforeach
            </div>

            <div class="rounded-4 mb-3 d-flex justify-content-center" style="flex-grow: 1;">
                <a class="rounded-4 glightbox" data-type="image" href="{{ asset('storage/' . $product->images->first()->image_path) }}">
                    <img id="product-image" style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="{{ asset('storage/' . $product->images->first()->image_path) }}" />
                </a>
            </div>
        </aside>


            <main class="col-lg-7">
                <div class="ps-lg-3">
                    <h4 class="title text-dark">{{ $product->product_name }}</h4>  
                    <p class="description">
                        {{ (str_replace('&nbsp;', ' ', strip_tags($product->product_description))) }}
                    </p>       
                    <div class="d-flex flex-row my-3">
                        <div class="text-warning mb-1 me-2">
                            <span class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $averageRating)
                                        <i class="fa fa-star"></i>
                                    @elseif($i - $averageRating < 1)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="fa fa-star-o"></i>
                                    @endif
                                @endfor
                            </span>
                            <span class="ms-1">{{ number_format($averageRating, 1) }}</span>
                        </div>
                        <span class="text-primary">{{ $totalReviews }} Ratings </span>
                       
                    </div>
                    
                    <hr />
                    <div class="product-availability mt-3">
                        <span class="">Availability :</span>
                        @if($product->quantity > 100)
                            <span class="ms-1" style="color:#4caf50;">100+ Available</span>
                        @elseif($product->quantity < 10 && $product->quantity > 0)
                            <span class="ms-1" style="color:red;">Only {{ $product->quantity }} left - Very low stock!</span>
                        @elseif($product->quantity > 0)
                            <span class="ms-1" style="color:#4caf50;">{{ $product->quantity }} Available</span>
                        @else
                            <span class="ms-1" style="color:red;">Out of stock</span>
                        @endif
                    </div>
                    <div class="product-variations mt-3">
                       
                    @if($product->variations->where('type', 'Size')->isNotEmpty())
                        <div class="mb-3">
                            <span>Size: </span>
                            @foreach($product->variations->where('type', 'Size') as $size)
                                @if($size->quantity > 0) 
                                    <button class="btn btn-outline-secondary btn-sm me-1 ms-1 size-option" style="height:28px;" required>
                                        {{ $size->value }}
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    @if($product->variations->where('type', 'Color')->isNotEmpty())
                        <div class="mb-2">
                            <span>Color: </span>
                            <span id="selected-color-name" class="fw-bold"></span>
                            <br>
                            @foreach($product->variations->where('type', 'Color') as $color)
                                @if($color->quantity > 0)  
                                    <button class="btn btn-outline-secondary btn-sm mt-2 me-1 color-option" 
                                        style="background-color: {{ $color->hex_value }}; border-color: #e8ebec; height: 20px; width: 20px;" 
                                        data-color="{{ $color->hex_value }}" 
                                        data-color-name="{{ $color->value }}">
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    @endif

                        @if($product->variations->where('type', 'Material')->isNotEmpty())
                            <div class="mb-3 mt-3 d-flex align-items-center"> 
                                <span class="me-2">Material:</span>
                                @foreach($product->variations->where('type', 'Material') as $material)
                                    <span class="me-3">{{ $material->value }}</span> 
                                @endforeach
                            </div>
                        @endif

                    </div>
                    <div class="product-price mb-3 mt-3">
                        <span class="h4" style="color:#f55b29; display: flex; align-items: center;">
                            @if($sale)
                                Rs. {{ number_format($sale->sale_price, 2) }}
                                <s style="font-size: 14px; color: #989595; font-weight: 500; margin-left: 10px;">
                                    Rs. {{ number_format($sale->normal_price, 2) }}
                                </s>
                                <div class="discount" style="color:red; font-size: 18px; margin-left: 10px;">
                                    {{ number_format($sale->sale_rate, 0) }}% off
                                </div>
                            @elseif($specialOffer)
                                Rs. {{ number_format($specialOffer->offer_price, 2) }}
                                <s style="font-size: 14px; color: #989595; font-weight: 500; margin-left: 10px;">
                                    Rs. {{ number_format($specialOffer->normal_price, 2) }}
                                </s>
                                <div class="discount" style="color:red; font-size: 18px; margin-left: 10px;">
                                    {{ number_format($specialOffer->offer_rate, 0) }}% off
                                </div>
                            @else
                                Rs. {{ number_format($product->normal_price, 2) }}
                            @endif
                        </span>
                    </div>

                    <div class="d-flex">
                        @auth
                            <a href="#" class="btn btn-custom-buy shadow-0 me-2 {{ $product->quantity <= 1 ? 'btn-disabled' : '' }}" data-product-id="{{ $product->product_id }}" data-auth="true" onclick="buyNow()">Buy now</a>
                            <a href="#" class="btn btn-custom-cart shadow-0 {{ $product->quantity <= 1 ? 'btn-disabled' : '' }}" data-product-id="{{ $product->product_id }}" data-auth="true">
                                <i class="me-1 fa fa-shopping-basket"></i>Add to cart
                            </a>
                        @else
                            <a href="#" class="btn btn-custom-buy shadow-0 me-2 {{ $product->quantity <= 1 ? 'btn-disabled' : '' }}" data-product-id="{{ $product->product_id }}" data-auth="false" onclick="buyNow()">Buy now</a>
                            <a href="#" class="btn btn-custom-cart shadow-0 {{ $product->quantity <= 1 ? 'btn-disabled' : '' }}" data-product-id="{{ $product->product_id }}" data-auth="false">
                                <i class="me-1 fa fa-shopping-basket"></i>Add to cart
                            </a>
                        @endauth
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>




    <section class="bg-light border-top py-4" >
        <div class="container">
            <div class="row gx-4">
                <div class="col-lg-12 mb-4">
                    <div class="border rounded-2 px-3 py-2 bg-white">
                        <!-- Pills navs -->
                        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center w-100 active" id="ex1-tab-description" data-bs-toggle="pill" href="#ex1-pills-description" role="tab" aria-controls="ex1-pills-1" aria-selected="true">Description</a>
                            </li>
                            <!-- 
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-specification" data-bs-toggle="pill" href="#ex1-pills-specification" role="tab" aria-controls="ex1-pills-2" aria-selected="false">Specification</a>
                            </li> -->
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-review" data-bs-toggle="pill" href="#ex1-pills-review" role="tab" aria-controls="ex1-pills-3" aria-selected="false">Reviews</a>
                            </li>
                            <!--  <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-QA" data-bs-toggle="pill" href="#ex1-pills-QA" role="tab" aria-controls="ex1-pills-4" aria-selected="false"> Q & A</a>
                            </li>-->
                        </ul>

                        <!-- Pills content -->
                        <div class="tab-content" id="ex1-content">

                            <div class="tab-pane fade p-4" id="ex1-pills-specification" role="tabpanel" aria-labelledby="ex1-tab-specification">
                                <p>
                                    With supporting text below as a natural lead-in to additional content. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                </p>
                                <div class="row mb-2">
                                    <div class="col-12 col-md-6">
                                        <ul class="list-unstyled mb-0">
                                            <li><i class="fas fa-check text-success me-2"></i>Some great feature name here</li>
                                            <li><i class="fas fa-check text-success me-2"></i>Lorem ipsum dolor sit amet, consectetur</li>
                                            <li><i class="fas fa-check text-success me-2"></i>Duis aute irure dolor in reprehenderit</li>
                                            <li><i class="fas fa-check text-success me-2"></i>Optical heart sensor</li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-6 mb-0">
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-check text-success me-2"></i>Easy fast and very good</li>
                                            <li><i class="fas fa-check text-success me-2"></i>Some great feature name here</li>
                                            <li><i class="fas fa-check text-success me-2"></i>Modern style and design</li>
                                        </ul>
                                    </div>
                                </div>
                                <table class="table border mt-3 mb-2">
                                    <tr>
                                        <th class="py-1">OSTizen:</th>
                                        <td class="py-2">4.0</td>
                                    </tr>
                                    <tr>
                                        <th class="py-2">Wireless communication technologies:</th>
                                        <td class="py-2">Bluetooth</td>
                                    </tr>
                                    <tr>
                                        <th class="py-2">Connectivity technologies:</th>
                                        <td class="py-2">Bluetooth</td>
                                    </tr>
                                    <tr>
                                        <th class="py-2">Special features</th>
                                        <td class="py-2">Time Display, GPS, Camera</td>
                                    </tr>
                                    <tr>
                                        <th class="py-2">Human Interface</th>
                                        <td class="py-2">InputTouchscreen</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane fade mb-2 show active p-4" id="ex1-pills-description" role="tabpanel" aria-labelledby="ex1-tab-description">
                                <h5>Product Full Description</h5>
                                {!! $product->product_description !!}
                            </div>

                            <!-- Reviews Section -->
                            <div class="tab-pane fade mb-2" id="ex1-pills-review" role="tabpanel" aria-labelledby="ex1-tab-review">
                                <div class="reviews-container" style="width: 90%;">
                                    <div class="review-summary">
                                        <div class="rating-score">
                                            <h2>{{ number_format($averageRating, 1) }}</h2>
                                            <div class="star-rating">
                                                <span class="text-warning">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $averageRating)
                                                            <i class="fa fa-star"></i>
                                                        @elseif($i - $averageRating < 1)
                                                            <i class="fas fa-star-half-alt"></i>
                                                        @else
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                    @endfor
                                                </span>
                                            </div>
                                            <p>{{ $totalReviews }} Ratings</p>
                                        </div>
                                        <div class="rating-bars ms-5">
                                            @foreach([5, 4, 3, 2, 1] as $star)
                                                <div class="rating-bar">
                                                    <div class="bar">
                                                        <div class="fill" style="width: {{ $totalReviews ? ($ratingsCount[$star] / $totalReviews) * 100 : 0 }}%;"></div>
                                                    </div>
                                                    <span class="ms-3">{{ $star }}.0</span><span class="text-secondary">{{ $ratingsCount[$star] }} reviews</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr/>

                                    <!-- Review List -->
                                    <div class="review-list">
                                        @foreach($reviews as $review)
                                            <div class="review-item">
                                                <div class="user-info">
                                                    <img src="{{ $review->is_anonymous ? asset('assets/images/default-user.png') : asset('storage/' . $review->user->profile_image) }}" alt="User image" class="user-image">
                                                    <div class="user-details mt-3">
                                                        <h6>
                                                            {{ $review->is_anonymous ? 'Anonymous' : $review->user->name }}
                                                            <span class="text-secondary" style="font-size: 0.8em; margin-left:15px;">{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}</span>
                                                        </h6>
                                                    </div>
                                                    <div class="user-rating">
                                                        <span class="me-1">{{ $review->rating }}.0</span>
                                                        <span class="rating text-warning">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($i <= $review->rating)
                                                                    <i class="fa fa-star"></i>
                                                                @elseif($i - $review->rating < 1)
                                                                    <i class="fas fa-star-half-alt"></i>
                                                                @else
                                                                    <i class="fa fa-star-o"></i>
                                                                @endif
                                                            @endfor
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="user-review mt-2">
                                                    <p>{{ $review->comment }}</p>
                                                    <div class="review-images mt-2 d-flex flex-wrap">
                                                        @if($review->images->isNotEmpty())
                                                            @foreach($review->images as $image)
                                                                <img src="{{ asset('storage/' . $image->media_path) }}" alt="Review image" class="review-img" width="100" onclick="showReviewImage('{{ asset('storage/' . $image->media_path) }}', {{ $review->id }})">
                                                            @endforeach
                                                        @endif
                                                        @if($review->videos->isNotEmpty())
                                                            @foreach($review->videos as $video)
                                                                <video width="100" height="75" controls style="margin-right: 5px;">
                                                                    <source src="{{ asset('storage/' . $video->media_path) }}" type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <!-- Display Larger Image -->
                                                    <div class="main-review-image mt-3">
                                                        <img id="mainReviewImage-{{ $review->id }}" src="" alt="Larger Review Image" style="display:none; width:350px;">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr /> 
                                        @endforeach
                                    </div>

                                </div>
                            </div>



                            <div class="tab-pane fade mb-2" id="ex1-pills-QA" role="tabpanel" aria-labelledby="ex1-tab-QA">
                                Some other tab content or sample information now <br />
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                        </div>
                        <!-- Pills content -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- Related products section -->
@if($relatedProducts->isNotEmpty())
    <div class="container mt-5 mb-4 related-products">
        <h4 class="title1">Related Products</h4>
        <div class="row">
            @foreach ($relatedProducts as $index => $relatedProduct)
                <div class="col-md-2">
                    <div class="related-products-item position-relative">
                        <a href="{{ route('single_product_page', ['product_id' => $relatedProduct->product_id]) }}" class="d-block text-decoration-none">
                            @if($relatedProduct->images->isNotEmpty())
                                <div class="product-image-wrapper position-relative">
                                    <img src="{{ asset('storage/' . $relatedProduct->images->first()->image_path) }}" alt="Product Image" class="img-fluid">
                                </div>
                            @else
                                <img src="{{ asset('storage/default-image.jpg') }}" alt="Default Image" class="img-fluid">
                            @endif
                            <h6>{{ $relatedProduct->product_name }}</h6>
                            <div class="price">
                                Rs.{{ number_format($relatedProduct->offer_price ?? $relatedProduct->normal_price) }}
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif



</div>


<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>

const lightbox = GLightbox({
        touchNavigation: true,
        loop: true,
        zoomable: true,
        draggable: true,
        autoplayVideos: true
    });


    document.querySelectorAll('.nav-link').forEach(function(tabLink) {
        tabLink.addEventListener('click', function() {
            setTimeout(function() { 
                var activeTab = document.querySelector('.nav-link.active').getAttribute('id');
                document.getElementById('breadcrumb-description').classList.add('d-none');
                document.getElementById('breadcrumb-specification').classList.add('d-none');
                document.getElementById('breadcrumb-review').classList.add('d-none');
                document.getElementById('breadcrumb-QA').classList.add('d-none');
                
                if (activeTab == 'ex1-tab-description') {
                    document.getElementById('breadcrumb-description').classList.remove('d-none');
                } else if (activeTab == 'ex1-tab-specification') {
                    document.getElementById('breadcrumb-specification').classList.remove('d-none');
                } else if (activeTab == 'ex1-tab-review') {
                    document.getElementById('breadcrumb-review').classList.remove('d-none');
                } else if (activeTab == 'ex1-tab-QA') {
                    document.getElementById('breadcrumb-QA').classList.remove('d-none');
                }
            }, 100);
        });
    });
</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function() {
    // Add to Cart click event
    $('.btn-custom-cart').on('click', function(e) {
        e.preventDefault();

        const productId = $(this).data('product-id');
        const isAuth = $(this).data('auth');
        const selectedSize = $('button.size-option.active').text();  
        const selectedColor = $('button.color-option.active').data('color');

        // Check if size and color are selected
        if ($('button.size-option').length > 0 && $('button.color-option').length > 0) {
            if (!selectedSize || !selectedColor) {
                toastr.warning('Please select both size and color options before adding this product to the cart.', 'Warning', {
                    positionClass: 'toast-top-right',
                    timeOut: 3000,
                });
                return;
            }
        }

        if (isAuth) {
            $.ajax({
                url: "{{ route('cart.add') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    size: selectedSize || null,   // Allow null if no size selected
                    color: selectedColor || null    // Allow null if no color selected
                },
                success: function(response) {
                    $.get("{{ route('cart.count') }}", function(data) {
                        $('#cart-count').text(data.cart_count);
                    });
                    
                    toastr.success('Item added to cart!', 'Success', {
                        positionClass: 'toast-top-right',
                        timeOut: 3000, 
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
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

    // Size option click event
    $('.size-option').on('click', function() {
        $('.size-option').removeClass('active');
        $(this).addClass('active');
    });

    // Color option click event
    $('.color-option').on('click', function() {
        $('.color-option').removeClass('active');
        $(this).addClass('active');
        $('#selected-color-name').text($(this).data('color-name'));
    });

    // Buy Now function
    window.buyNow = function() {
        const productId = $('.btn-custom-buy').data('product-id');
        const isAuth = $('.btn-custom-buy').data('auth');
        const selectedSize = $('button.size-option.active').text();  
        const selectedColor = $('button.color-option.active').data('color');

        // Check if size and color are selected
        if ($('button.size-option').length > 0 && $('button.color-option').length > 0) {
            if (!selectedSize || !selectedColor) {
                toastr.warning('Please select both size and color options before proceeding with the purchase.', 'Warning', {
                    positionClass: 'toast-top-right',
                    timeOut: 3000,
                });
                return;
            }
        }

        if (isAuth) {
            $.ajax({
                url: "{{ route('cart.add') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    size: selectedSize || null,  // Allow null if no size selected
                    color: selectedColor || null   // Allow null if no color selected
                },
                success: function(response) {
                    $.get("{{ route('cart.count') }}", function(data) {
                        $('#cart-count').text(data.cart_count);
                    });
                    window.location.href = "{{ route('shopping_cart') }}";
                },
                error: function(xhr) {
                    toastr.error('Something went wrong. Please try again.', 'Error', {
                        positionClass: 'toast-top-right',
                        timeOut: 3000,
                    });
                }
            });
        } else {
            toastr.warning('Please log in to proceed with your purchase.', 'Warning', {
                positionClass: 'toast-top-right',
                timeOut: 3000,
            });
        }
    }
});



$(document).ready(function() {

    $('.color-option').on('click', function() {
        $('.color-option').removeClass('selected-color');
        $(this).addClass('selected-color');
    });
});



</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorButtons = document.querySelectorAll('.color-option');
        const colorNameDisplay = document.getElementById('selected-color-name');

        colorButtons.forEach(button => {
            button.addEventListener('click', function() {
                const colorName = this.getAttribute('data-color-name');
                colorNameDisplay.textContent = colorName;
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

</script>



<!-- review image-->
<script>
    function showReviewImage(imagePath, reviewId) {
        const mainImage = document.getElementById(`mainReviewImage-${reviewId}`);

        if (mainImage.style.display === 'block' && mainImage.src === imagePath) {
            // Hide the image
            mainImage.style.display = 'none';
            mainImage.src = '';
        } else {
            mainImage.src = imagePath;
            mainImage.style.display = 'block';
        }
    }
</script>
@endsection
