@extends ('frontend.master')

@section('content')


    <style>
        /* Improved Button Styles */
        .btn-cart {
            background-color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-cart i {
            font-size: 1.5rem;
            color: black;
            transition: color 0.3s ease;
        }

        .btn-cart:hover {
            background-color: black;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-cart:hover i {
            color: white;
        }

        /* Color Selection Styles */
        .color-option {
            transition: all 0.2s ease;
        }

        .color-option.selected-color {
            border: 2px solid #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.6);
            transform: scale(1.1);
        }

        /* Product Card Enhancements */
        .single-products-box {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 8px;
            overflow: hidden;

        }

        .single-products-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .products-image {
            position: relative;
            overflow: hidden;
        }

        .hover-image {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .single-products-box:hover .hover-image {
            opacity: 1;
        }

        .single-products-box:hover .main-image {
            opacity: 0;
        }

        /* Price Styling */
        .old-price {
            text-decoration: line-through;
            color: #999;
            margin-right: 8px;
        }

        .new-price {
            color: #f55b29;
            font-weight: 600;
            margin-right: 80px;
        }

        /* Filter Widget Styling */
        .woocommerce-widget {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .woocommerce-widget-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }

        /* Pagination Styling */
        .pagination-area .page-numbers {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            margin: 0 5px;
            border-radius: 50%;
            background: #f5f5f5;
            color: #333;
            transition: all 0.3s ease;
        }

        .pagination-area .page-numbers:hover,
        .pagination-area .page-numbers.current {
            background: #007bff;
            color: white;
            font-size: 1.1rem
        }

        /* Modal Enhancements */
        .modal-content {
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-custom-cart {
            transition: all 0.3s ease;
            border-radius: 4px;
            font-weight: 500;
        }

        .btn-custom-cart:hover {
            background-color: #0069d9 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Adjustments */
        @media (max-width: 767px) {
            .products-col-item {
                margin-bottom: 30px;
            }

            .woocommerce-widget-area {
                margin-bottom: 30px;
            }
        }
        .product-availability-on-hover-hide { display: block; transition: opacity 0.2s; }
        .single-products-box:hover .product-availability-on-hover-hide { display: none; }
    </style>
    <!-- Start Page Title -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>All Items</h2>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>All Items</li>
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

                            <a href="{{ route('all-items') }}" class="delete-selected-filters"><i
                                    class='fa-solid fa-trash'></i> <span>Clear All</span></a>

                        </div>

                        <div class="woocommerce-widget collections-list-widget">
                            <h3 class="woocommerce-widget-title">Categories</h3>

                            <ul class="collections-list-row">
                                @foreach ($categories as $category)
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
                                @foreach ($sizes as $size)
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
                                @foreach ($colors as $color)
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

                <div class="col-lg-9 col-md-12">
                    <div class="products-filter-options">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-lg-4 col-md-4">
                                <div class="d-lg-flex d-md-flex align-items-center">
                                    <span class="sub-title d-lg-none"><a href="#" data-bs-toggle="modal"
                                            data-bs-target="#productsFilterModal"><i class='fa-solid fa-filter '></i>
                                            Filter</a></span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <p>Showing {{ $products->firstItem() }} – {{ $products->lastItem() }} of
                                    {{ $products->total() }}</p>
                            </div>


                        </div>
                    </div>

                    <div id="products-collections-filter" class="row">
                        @if ($products->isEmpty())
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
                                            <a
                                                href="{{ route('product-description', ['product_id' => $product->product_id]) }}">
                                                @if ($product->images->isNotEmpty())
                                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                                        class="main-image" alt="image" style="width: 90%; height:270px">
                                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                                        class="hover-image" alt="image" style="width: 90%; height:270px">
                                                @else
                                                    <img src="{{ asset('storage/default-image.jpg') }}" class="main-image"
                                                        alt="image">
                                                @endif
                                            </a>
                                            @if (
                                                ($product->sale && $product->sale->status === 'active') ||
                                                    ($product->specialOffer && $product->specialOffer->status === 'active'))
                                                <div class="sale-tag">
                                                    @if ($product->sale && $product->sale->status === 'active')
                                                        @php
                                                            $saleRate =
                                                                (($product->normal_price - $product->sale->sale_price) /
                                                                    $product->normal_price) *
                                                                100;
                                                        @endphp
                                                        - {{ round($saleRate) }}% <span class="off-txt">OFF</span>
                                                    @elseif($product->specialOffer && $product->specialOffer->status === 'active')
                                                        @php
                                                            $offerRate =
                                                                (($product->normal_price -
                                                                    $product->specialOffer->offer_price) /
                                                                    $product->normal_price) *
                                                                100;
                                                        @endphp
                                                        - {{ round($offerRate) }}% <span class="off-txt">OFF</span>
                                                    @endif
                                                </div>
                                            @endif


                                        </div>

                                        <div class="products-content" style="margin-left: 20px;">
                                            <h3><a
                                                    href="{{ route('product-description', ['product_id' => $product->product_id]) }}">
                                                    {{ \Illuminate\Support\Str::limit($product->product_name, 25) }}</a>
                                            </h3>
                                            <div class="price">
                                                @if ($product->sale && $product->sale->status === 'active')
                                                    <span class="old-price">Rs.
                                                        {{ number_format($product->normal_price, 2) }}</span>
                                                    <span class="new-price">Rs.
                                                        {{ number_format($product->sale->sale_price, 2) }}</span>
                                                @elseif($product->specialOffer && $product->specialOffer->status === 'active')
                                                    <span class="old-price">Rs.
                                                        {{ number_format($product->normal_price, 2) }}</span>
                                                    <span class="new-price">Rs.
                                                        {{ number_format($product->specialOffer->offer_price, 2) }}</span>
                                                @else
                                                    <span class="new-price">Rs.
                                                        {{ number_format($product->normal_price, 2) }}</span>
                                                @endif
                                            </div>
                                            <div class="product-availability-on-hover-hide product-availability mt-2 mb-1">
                                                <span>Availability :</span>
                                                @if ($product->quantity > 100)
                                                    <span class="ms-1" style="color:#4caf50;">100+ Available</span>
                                                @elseif ($product->quantity < 10 && $product->quantity > 0)
                                                    <span class="ms-1" style="color:red;">Only {{ $product->quantity }} left - Very low stock!</span>
                                                @elseif ($product->quantity > 0)
                                                    <span class="ms-1" style="color:#4caf50;">{{ $product->quantity }} Available</span>
                                                @else
                                                    <span class="ms-1" style="color:red;">Out of stock</span>
                                                @endif
                                            </div>

                                            <div class="star-rating" style="margin-right: 10px;">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= floor($product->average_rating))
                                                        <i class='fa-solid fa-star'></i>
                                                    @elseif ($i == ceil($product->average_rating) && fmod($product->average_rating, 1) >= 0.5)
                                                        <i class='fa-solid fa-star-half'></i>
                                                    @else
                                                        <i class='fa-solid fa-star'></i>
                                                    @endif
                                                @endfor

                                            </div>

                                            <a href="" class="add-to-cart" data-bs-toggle="modal"
                                                data-bs-target="#cartModal_{{ $product->product_id }}">Add to Cart</a>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>


                    @php
                        $currentPage = $products->currentPage();
                        $lastPage = $products->lastPage();
                        $pageWindow = 8;

                        // Calculate start and end of visible pages
                        $start = max(1, $currentPage - floor($pageWindow / 2));
                        $end = min($lastPage, $start + $pageWindow - 1);

                        // Adjust start if not enough pages at the end
                        if ($end - $start + 1 < $pageWindow) {
                            $start = max(1, $end - $pageWindow + 1);
                        }
                    @endphp

                    <div class="pagination-area text-center">
                        <!-- Previous Page Link -->
                        @if ($products->onFirstPage())
                            <span class="prev page-numbers disabled"><i class='fa fa-chevron-left'></i></span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}" class="prev page-numbers"><i
                                    class='fa fa-chevron-left'></i></a>
                        @endif

                        <!-- Page Numbers (max 8) -->
                        @for ($page = $start; $page <= $end; $page++)
                            @if ($page == $products->currentPage())
                                <span class="page-numbers current" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $products->url($page) }}" class="page-numbers">{{ $page }}</a>
                            @endif
                        @endfor

                        <!-- Next Page Link -->
                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" class="next page-numbers"><i
                                    class='fa fa-chevron-right'></i></a>
                        @else
                            <span class="next page-numbers disabled"><i class='fa fa-chevron-right'></i></span>
                        @endif
                    </div>



                </div>
            </div>
        </div>
    </section>
    <!-- End Products Area -->

    <!-- cart modal-->
    @foreach ($products as $product)
        <div class="modal fade" id="cartModal_{{ $product->product_id }}" tabindex="-1" aria-labelledby="cartModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  modal-lg">
                <div class="modal-content" style="border-radius: 0;">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row gx-5">
                            <aside class="col-lg-5">
                                <div class="rounded-4 mb-3 d-flex justify-content-center">
                                    @if ($product->images->first())
                                        <a class="rounded-4 main-image-link"
                                            href="{{ asset('storage/' . $product->images->first()->image_path) }}">
                                            <img id="mainImage" class="rounded-4 fit" style="width:280px; height:auto"
                                                src="{{ asset('storage/' . $product->images->first()->image_path) }}" />
                                        </a>
                                    @else
                                        <a class="rounded-4 main-image-link" href="{{ asset('images/default.jpg') }}">
                                            <img id="mainImage" class="rounded-4 fit"
                                                src="{{ asset('images/default.jpg') }}" />
                                        </a>
                                    @endif
                                </div>

                                <div class="d-flex justify-content-center mb-3">
                                    @foreach ($product->images as $image)
                                        <a class="mx-1 rounded-2 thumbnail-image"
                                            data-image="{{ asset('storage/' . $image->image_path) }}"
                                            href="javascript:void(0);">
                                            <img class="thumbnail rounded-2"
                                                src="{{ asset('storage/' . $image->image_path) }}"
                                                style="width:70px; height:auto" />
                                        </a>
                                    @endforeach
                                </div>
                            </aside>

                            <main class="col-lg-7">
                                <h4>{{ $product->product_name }}</h4>
                                <p class="description">
                                    {{ str_replace('&nbsp;', ' ', strip_tags($product->product_description)) }}
                                </p>
                                <div class="d-flex flex-row my-3">
                                    <div class="text-warning mb-1 me-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($product->average_rating))
                                                <i class='fa fa-star'></i>
                                            @elseif ($i == ceil($product->average_rating) && fmod($product->average_rating, 1) >= 0.5)
                                                <i class='fa fa-star-half'></i>
                                            @else
                                                <i class='fa fa-star'></i>
                                            @endif
                                        @endfor
                                        <span class="ms-1">{{ number_format($product->average_rating, 1) }}</span>
                                    </div>
                                    <span class="text-primary">{{ $product->rating_count }} Ratings </span>

                                </div>
                                <hr />

                                <div class="product-availability mt-3 mb-1">
                                    <span>Availability :</span>
                                    @if ($product->quantity > 100)
                                        <span class="ms-1" style="color:#4caf50;">100+ Available</span>
                                    @elseif ($product->quantity < 10 && $product->quantity > 0)
                                        <span class="ms-1" style="color:red;">Only {{ $product->quantity }} left - Very low stock!</span>
                                    @elseif ($product->quantity > 0)
                                        <span class="ms-1" style="color:#4caf50;">{{ $product->quantity }} Available</span>
                                    @else
                                        <span class="ms-1" style="color:red;">Out of stock</span>
                                    @endif
                                </div>

                                <div class="product-container">
                                    <!-- Size Options -->
                                    @if ($product->variations->where('type', 'Size')->isNotEmpty())
                                        <div class="mb-2">
                                            <span>Size: </span>
                                            @foreach ($product->variations->where('type', 'Size') as $size)
                                                @if ($size->quantity > 0)
                                                    <button class="btn btn-outline-secondary btn-sm me-1 size-option"
                                                        style="height:28px;" data-size="{{ $size->value }}">
                                                        {{ $size->value }}
                                                    </button>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                    <!-- Color Options -->
                                    @if ($product->variations->where('type', 'Color')->isNotEmpty())
                                        <div class="mb-2">
                                            <span>Color: </span>
                                            @foreach ($product->variations->where('type', 'Color') as $color)
                                                @if ($color->quantity > 0)
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
                                            @if ($product->sale && $product->sale->status === 'active')
                                                <span class="sale-price">Rs.
                                                    {{ number_format($product->sale->sale_price, 2) }}</span>
                                            @elseif($product->specialOffer && $product->specialOffer->status === 'active')
                                                <span class="offer-price">Rs.
                                                    {{ number_format($product->specialOffer->offer_price, 2) }}</span>
                                            @else
                                                Rs. {{ number_format($product->normal_price, 2) }}
                                            @endif
                                        </span>
                                    </div>

                                    @auth
                                        <a href="#"
                                            class="btn btn-custom-cart mb-3 add-to-cart-modal shadow-0 {{ $product->quantity <= 1 ? 'btn-disabled' : '' }}"
                                            data-product-id="{{ $product->product_id }}" data-auth="true"
                                            style="width: 40%; background-color: #007bff; color: white;">
                                            <i class="me-1 fa fa-shopping-basket"></i>Add to cart
                                        </a>
                                    @else
                                        <a href="#"
                                            class="btn btn-custom-cart mb-3 add-to-cart-modal shadow-0 {{ $product->quantity <= 1 ? 'btn-disabled' : '' }}"
                                            data-product-id="{{ $product->product_id }}" data-auth="false"
                                            style="width: 40%; background-color: #007bff; color: white;">
                                            <i class="me-1 fa fa-shopping-basket"></i>Add to cart
                                        </a>
                                    @endauth

                                </div>

                                <a href="{{ route('product-description', $product->product_id) }}"
                                    style="text-decoration: none; font-size:14px; color: #297aa5">
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
                    <span aria-hidden="true"><i class='fa fa-x'></i> Close</span>
                </button>

                <div class="modal-body">
                    <div class="woocommerce-widget-area">
                        <div class="woocommerce-widget filter-list-widget">

                            <a href="{{ route('all-items') }}" class="delete-selected-filters"><i
                                    class='fa fa-trash'></i> <span>Clear All</span></a>

                        </div>

                        <div class="woocommerce-widget collections-list-widget">
                            <h3 class="woocommerce-widget-title">Categories</h3>

                            <ul class="collections-list-row">
                                @foreach ($categories as $category)
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
                                @foreach ($sizes as $size)
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
                                @foreach ($colors as $color)
                                    <li>
                                        <a href="{{ route('all-items') }}?color={{ $color->value }}"
                                            style="background-color: {{ $color->hex_value }};"
                                            class="{{ request('color') === $color->value ? 'active' : '' }}"
                                            title="{{ $color->value }}">
                                        </a>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced color selection with animation
            const colorButtons = document.querySelectorAll('.color-option');

            colorButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove the selected class from all buttons
                    colorButtons.forEach(btn => {
                        btn.classList.remove('selected-color');
                        btn.style.transform = 'scale(1)';
                    });

                    // Add animation to selected button
                    this.classList.add('selected-color');
                    this.style.transform = 'scale(1.1)';

                    // Optional: Add ripple effect
                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple-effect');
                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Product card hover effects
            const productCards = document.querySelectorAll('.single-products-box');
            productCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Smooth scroll for filter modal
            const filterLinks = document.querySelectorAll(
                '.collections-list-row a, .size-list-row a, .color-list-row a');
            filterLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (window.innerWidth < 992) {
                        e.preventDefault();
                        const targetModal = document.getElementById('productsFilterModal');
                        const bsModal = bootstrap.Modal.getInstance(targetModal);
                        if (bsModal) {
                            bsModal.hide();
                        }
                        setTimeout(() => {
                            window.location.href = this.href;
                        }, 300);
                    }
                });
            });

            // Image gallery in modal with smooth transitions
            document.querySelectorAll('.thumbnail-image').forEach(thumb => {
                thumb.addEventListener('click', function() {
                    const mainImage = document.getElementById('mainImage');
                    mainImage.style.opacity = 0;

                    setTimeout(() => {
                        mainImage.src = this.getAttribute('data-image');
                        mainImage.style.opacity = 1;
                    }, 200);
                });
            });
        });

        // Enhanced AJAX cart functionality with better feedback
        $(document).ready(function() {
            $('.add-to-cart-modal').on('click', function(e) {
                e.preventDefault();

                const productId = $(this).data('product-id');
                const isAuth = $(this).data('auth');
                const productContainer = $(this).closest('.product-container');
                const sizeOptions = productContainer.find('button.size-option');
                const colorOptions = productContainer.find('button.color-option');
                const hasSizeOptions = sizeOptions.length > 0;
                const hasColorOptions = colorOptions.length > 0;

                const selectedSize = hasSizeOptions ? sizeOptions.filter('.active').data('size') : null;
                const selectedColor = hasColorOptions ? colorOptions.filter('.active').data('color') : null;

                // Check requirements
                if (hasSizeOptions && !selectedSize) {
                    toastr.warning('Please select a size option before adding this product to the cart.',
                        'Size Required', {
                            positionClass: 'toast-top-right',
                            timeOut: 3000,
                            closeButton: true,
                            progressBar: true
                        });
                    return;
                }

                if (hasColorOptions && !selectedColor) {
                    toastr.warning('Please select a color option before adding this product to the cart.',
                        'Color Required', {
                            positionClass: 'toast-top-right',
                            timeOut: 3000,
                            closeButton: true,
                            progressBar: true
                        });
                    return;
                }

                if (isAuth === true || isAuth === "true") {
                    const btn = $(this);
                    btn.html('<i class="fa fa-spinner fa-spin me-1"></i> Adding...');
                    btn.prop('disabled', true);

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
                            // Update cart count
                            $.get("{{ route('cart.count') }}", function(data) {
                                $('#cart-count').text(data.cart_count);

                                // Add animation to cart icon
                                const cartIcon = $('.cart-icon');
                                cartIcon.addClass('animate-bounce');
                                setTimeout(() => {
                                    cartIcon.removeClass('animate-bounce');
                                }, 1000);
                            });

                            toastr.success('Item successfully added to your cart!',
                                'Added to Cart', {
                                    positionClass: 'toast-top-right',
                                    timeOut: 3000,
                                    closeButton: true,
                                    progressBar: true,
                                    onHidden: function() {
                                        btn.html(
                                            '<i class="me-1 fa fa-shopping-basket"></i>Add to cart'
                                            );
                                        btn.prop('disabled', false);
                                    }
                                });

                            // Reset selections
                            productContainer.find('button.size-option.active').removeClass(
                                'active');
                            productContainer.find('button.color-option.active').removeClass(
                                'active');
                        },
                        error: function(xhr) {
                            toastr.error('Something went wrong. Please try again.', 'Error', {
                                positionClass: 'toast-top-right',
                                timeOut: 3000,
                                closeButton: true,
                                progressBar: true
                            });
                            btn.html('<i class="me-1 fa fa-shopping-basket"></i>Add to cart');
                            btn.prop('disabled', false);
                        }
                    });
                } else {
                    toastr.warning('Please log in to add items to your cart.', 'Login Required', {
                        positionClass: 'toast-top-right',
                        timeOut: 3000,
                        closeButton: true,
                        progressBar: true,
                        onclick: function() {
                            window.location.href = "{{ route('login') }}";
                        }
                    });
                }
            });

            // Enhanced selection with animation
            $('.size-option').on('click', function() {
                $('.size-option').removeClass('active');
                $(this).addClass('active');
                $(this).css('transform', 'scale(1.05)');
                setTimeout(() => {
                    $(this).css('transform', 'scale(1)');
                }, 200);
            });

            $('.color-option').on('click', function() {
                $('.color-option').removeClass('active selected-color');
                $(this).addClass('active selected-color');
                $(this).css('transform', 'scale(1.1)');
            });
        });
    </script>


@endsection
