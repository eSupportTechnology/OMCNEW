@extends ('frontend.master')

@section('content')
    <style>
        /* Global Styles */
        :root {
            --primary-color: #3a86ff;
            --secondary-color: #ff006e;
            --accent-color: #8338ec;
            --light-bg: #f7f9fc;
            --dark-text: #2b2d42;
            --light-text: #8d99ae;
            --success-color: #11e469;
            --danger-color: #e3342f;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        /* Base Toast Styles */
        .toast {
            opacity: 1 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            padding: 15px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            max-width: 350px;
            margin-bottom: 12px;
            border-left: 4px solid;
            position: relative;
            animation: toast-in-right 0.5s;
        }

        /* Toast Animation */
        @keyframes toast-in-right {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }

        /* Toast types */
        .toast-success {
            background-color: #28a745 !important;
            color: white !important;
            border-color: #28a745;
        }

        .toast-info {
            background-color: #17a2b8 !important;
            color: white !important;
            border-color: #17a2b8;
        }

        .toast-warning {
            background-color: #dc3545 !important;
            color: white !important;
            border-color: #dc3545;
        }

        .toast-error {
            background-color: #dc3545 !important;
            color: white !important;
            border-color: #dc3545;
        }



        .wishlist-toggle::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to right, rgba(var(--secondary-color-rgb, 255, 0, 110), 0.05), rgba(var(--secondary-color-rgb, 255, 0, 110), 0.01));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 0;
        }

        .wishlist-toggle:hover {
            border-color: var(--secondary-color);
            color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .wishlist-toggle:hover::before {
            opacity: 1;
        }

        .wishlist-toggle i {
            font-size: 1.3rem;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .wishlist-toggle span {
            position: relative;
            z-index: 1;
        }

        .wishlist-toggle:active {
            transform: translateY(0);
        }

        /* Heart animation */
        .wishlist-toggle i.bx-heart {
            color: var(--light-text);
        }

        .wishlist-toggle:hover i.bx-heart {
            transform: scale(1.15);
            color: var(--secondary-color);
        }

        .wishlist-toggle i.filled,
        .wishlist-toggle i.bxs-heart {
            color: var(--secondary-color);
            animation: heartPulse 0.4s ease-out;
        }

        /* Tab Content */
        .tab.products-details-tab {
            margin-top: 40px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .tabs {
            display: flex;
            border-bottom: 1px solid #e8ebec;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .tabs li {
            flex: 1;
        }

        .tabs li a {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 15px;
            color: var(--dark-text);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            border-bottom: 3px solid transparent;
        }

        .tabs li a:hover {
            color: var(--primary-color);
        }

        .tabs li a.active {
            color: var(--primary-color);
            border-color: var(--primary-color);

        }



        .tab-content {
            padding: 30px;
        }

        .tabs-item {
            display: none;
        }

        .tabs-item.active {
            display: block;
        }

        /* Reviews */
        .review-item {
            border-bottom: 1px solid #e8ebec;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .review-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .review-item h3 {
            margin: 10px 0;
            font-size: 1.1rem;
            color: var(--dark-text);
        }

        .review-item span {
            color: var(--light-text);
            font-size: 0.9rem;
        }

        .review-item p {
            margin-top: 15px;
            color: var(--dark-text);
        }


        /* Availability Badge */
        .availability-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 800;

        }

        .instock {
            background-color: var(--success-color);
            color: white
        }

        .out-of-stock {
            background-color: rgba(227, 52, 47, 0.1);
            color: var(--danger-color);
        }

        /* Product Description */
        .product-description {
            line-height: 1.6;
            color: var(--dark-text);
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .buttons-row {
                flex-direction: column;
            }

            .tabs {
                flex-direction: column;
            }

            .tabs li a {
                justify-content: flex-start;
            }
        }




        /* Product Page Container */
        .product-details-area {
            background-color: var(--light-bg);
            padding: 60px 0;
        }

        /* Page Title */
        .page-title-area {
            background: linear-gradient(to right, #3a86ff, #8338ec);
            padding-top: 50px;
            margin-bottom: 30px;

        }

        .page-title-content {
            text-align: center;
        }

        .page-title-content h2 {
            color: white;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 2.2rem;
            padding-right: 100px
        }

        .page-title-content ul {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0;

        }

        .page-title-content ul li {
            color: rgba(255, 255, 255, 0.8);
            margin: 0 5px;

        }

        .page-title-content ul li a {
            color: white;
            text-decoration: none;
        }

        /* Product Images */
        .product-image-gallery {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
        }

        .main-image-container {
            position: relative;
            overflow: hidden;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
        }

        .main-image-container img {
            transition: transform 0.5s ease;
            width: 475px;
            height: 450px;
            /* object-fit: cover; */
        }

        .main-image-container:hover img {
            transform: scale(1.05);
        }

        .slick-thumbs {
            display: flex;
            justify-content: flex-start;
            gap: 15px;
            flex-wrap: wrap;
        }

        .slick-thumbs ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 15px;
        }

        .slick-thumbs li {
            cursor: pointer;
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: var(--transition);
        }

        .slick-thumbs li:hover {
            transform: translateY(-3px);
        }

        .slick-thumbs li img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: var(--border-radius);
            border: 2px solid transparent;
            transition: var(--transition);
        }

        .slick-thumbs li:hover img {
            border-color: var(--primary-color);
        }

        /* Product Details */
        .products-details-desc {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--box-shadow);
        }

        .products-details-desc h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: var(--dark-text);
            font-weight: 600;
        }

        .price {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .new-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .old-price {
            text-decoration: line-through;
            color: var(--light-text);
        }

        .discount {
            background-color: var(--secondary-color);
            color: white;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Ratings */
        .products-review {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .rating {
            color: #ffc107;
            margin-right: 10px;
        }

        .rating-count {
            color: var(--light-text);
            text-decoration: none;
        }

        /* Product Info */
        .products-info {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
        }

        .products-info li {
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
        }

        .products-info li span:first-child {
            min-width: 120px;
            font-weight: 600;
            color: var(--dark-text);
        }

        /* Color Options */
        .products-color-switch {
            margin-bottom: 20px;
        }

        .products-color-switch span {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--dark-text);
        }

        .color-options-container {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .color-option {
            height: 30px;
            width: 30px;
            border-radius: 50%;
            cursor: pointer;
            transition: var(--transition);
            border: 2px solid transparent;
        }

        .color-option:hover {
            transform: scale(1.15);
        }

        .color-option.selected {
            border: 2px solid var(--dark-text);
            box-shadow: 0 0 0 2px white, 0 0 0 4px var(--primary-color);
        }

        /* Size Options */
        .products-size-wrapper {
            margin-bottom: 25px;
        }

        .products-size-wrapper span {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--dark-text);
        }

        .products-size-wrapper ul {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            list-style: none;
            padding: 0;
        }

        .products-size-wrapper li {
            margin: 0;
        }

        .size-option {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 35px;
            border: 1px solid #e8ebec;
            border-radius: var(--border-radius);
            color: var(--light-text);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
        }

        .size-option:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .size-option.selected {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Quantity Input */
        .input-counter {
            display: flex;
            align-items: center;
            border: 1px solid #e8ebec;
            border-radius: var(--border-radius);
            max-width: 150px;
            overflow: hidden;
        }

        .input-counter span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 45px;
            background-color: #f7f7f7;
            color: var(--dark-text);
            cursor: pointer;
            transition: var(--transition);
        }

        .input-counter span:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .input-counter input {
            width: 70px;
            text-align: center;
            border: none;
            height: 45px;
            font-size: 1rem;
        }

        /* Action Buttons */
        .products-add-to-cart {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .buttons-row {
            display: flex;
            gap: 15px;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between;
            margin-top: 15px;
            width: 100%;
            /* Ensure container uses full width */

        }

        .Add-to-Cart {
            padding: 12px 25px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            flex: 1;
            text-align: center;
            white-space: nowrap;
            display: inline-block;
            /* Ensure buttons display properly */
            min-width: 150px;
            /* Set minimum width for buttons */
            position: relative;
        }

        .Add-to-Cart:hover {
            background-color: #0d439b;
            transform: translateY(-2px);
        }

        .buy-nowbtn {
            background-color: var(--success-color);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            flex: 1;
            text-align: center;
            white-space: nowrap;
            display: inline-block;
            /* Ensure buttons display properly */
            min-width: 150px;
            /* Set minimum width for buttons */
            position: relative;
        }

        .buy-nowbtn:hover {
            background-color: #099b46;
            color: white;
            transform: translateY(-2px);
        }

        /* Fix for mobile responsiveness */
        @media (max-width: 576px) {
            .buttons-row {
                flex-direction: column;
            }

            .default-btn {
                width: 100%;
            }
        }


        .wishlist-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 20px;
            background-color: #f8f9fa;
            border: 1px solid #e8ebec;
            border-radius: var(--border-radius);
            color: var(--dark-text);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            height: 48px;
            /* Match height with other buttons */
        }

        .wishlist-toggle::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to right, rgba(var(--secondary-color-rgb, 255, 0, 110), 0.05), rgba(var(--secondary-color-rgb, 255, 0, 110), 0.01));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 0;
        }

        .wishlist-toggle:hover {
            border-color: var(--secondary-color);
            color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .wishlist-toggle:hover::before {
            opacity: 1;
        }

        .wishlist-toggle i {
            font-size: 1.3rem;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .wishlist-toggle span {
            position: relative;
            z-index: 1;
        }

        .wishlist-toggle:active {
            transform: translateY(0);
        }

        /* Heart animation */
        .wishlist-toggle i.bx-heart {
            color: var(--light-text);
        }

        .wishlist-toggle:hover i.bx-heart {
            transform: scale(1.15);
            color: var(--secondary-color);
        }

        .wishlist-toggle i.filled,
        .wishlist-toggle i.bxs-heart {
            color: var(--secondary-color);
            animation: heartPulse 0.4s ease-out;
        }

        /* Tab Content */
        .tab.products-details-tab {
            margin-top: 40px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .tabs {
            display: flex;
            border-bottom: 1px solid #e8ebec;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .tabs li {
            flex: 1;
        }

        .tabs li a {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 15px;
            color: var(--dark-text);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            border-bottom: 3px solid transparent;
        }

        .tabs li a:hover {
            color: var(--primary-color);
        }

        .tabs li a.active {
            color: var(--primary-color);
            border-color: var(--primary-color);

        }



        .tab-content {
            padding: 30px;
        }

        .tabs-item {
            display: none;
        }

        .tabs-item.active {
            display: block;
        }

        /* Reviews */
        .review-item {
            border-bottom: 1px solid #e8ebec;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .review-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .review-item h3 {
            margin: 10px 0;
            font-size: 1.1rem;
            color: var(--dark-text);
        }

        .review-item span {
            color: var(--light-text);
            font-size: 0.9rem;
        }

        .review-item p {
            margin-top: 15px;
            color: var(--dark-text);
        }

        .review-media {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .review-media img,
        .review-media video {
            height: 100px;
            width: auto;
            object-fit: cover;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .review-media img:hover,
        .review-media video:hover {
            transform: scale(1.05);
        }

        /* Availability Badge */
        .availability-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 800;

        }

        .instock {
            background-color: var(--success-color);
            color: white
        }

        .out-of-stock {
            background-color: rgba(227, 52, 47, 0.1);
            color: var(--danger-color);
        }

        /* Product Description */
        .product-description {
            line-height: 1.6;
            color: var(--dark-text);
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .buttons-row {
                flex-direction: column;
            }

            .tabs {
                flex-direction: column;
            }

            .tabs li a {
                justify-content: flex-start;
            }

            .page-title-area {
                display: none;
            }





        }
    </style>

    <!-- Start Page Title -->
    {{--  <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>{{ $product->product_name }}</h2>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>Products Details</li>
                </ul>

            </div>
        </div>
    </div>  --}}
    <!-- End Page Title -->

    <!-- Start Product Details Area -->
    <section class="product-details-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-12">
                    <div class="product-image-gallery">
                        <!-- Main Image -->
                        <div class="main-image-container">
                            @if ($product->images->isNotEmpty())
                                <a href="{{ asset('storage/' . $product->images->first()->image_path) }}" class="glightbox">
                                    <img id="main-product-image"
                                        src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                        alt="{{ $product->product_name }}">
                                </a>
                            @endif
                        </div>

                        <!-- Thumbnails -->
                        <div class="slick-thumbs">
                            <ul>
                                @foreach ($product->images as $image)
                                    <li>
                                        <a href="javascript:void(0)" class="thumbnail-link"
                                            data-src="{{ asset('storage/' . $image->image_path) }}">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="thumbnail">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12">
                    <div class="products-details-desc">
                        <h3>{{ $product->product_name }}</h3>

                        <div class="price">
                            @if ($sale)
                                <span class="new-price">Rs. {{ number_format($sale->sale_price, 2) }}</span>
                                <span class="old-price">Rs. {{ number_format($sale->normal_price, 2) }}</span>
                                <span class="discount">{{ number_format($sale->sale_rate, 0) }}% off</span>
                            @elseif($specialOffer)
                                <span class="new-price">Rs. {{ number_format($specialOffer->offer_price, 2) }}</span>
                                <span class="old-price">Rs. {{ number_format($specialOffer->normal_price, 2) }}</span>
                                <span class="discount">{{ number_format($specialOffer->offer_rate, 0) }}% off</span>
                            @else
                                <span class="new-price">Rs. {{ number_format($product->normal_price, 2) }}</span>
                            @endif
                        </div>

                        <div class="products-review">
                            <div class="rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($averageRating >= $i)
                                        <i class="fa-solid fa-star text-yellow-500"></i> <!-- Full star -->
                                    @elseif ($averageRating >= $i - 0.5)
                                        <i class="fa-solid fa-star-half-stroke text-yellow-500"></i> <!-- Half star -->
                                    @else
                                        <i class="fa-regular fa-star text-yellow-500"></i> <!-- Empty star -->
                                    @endif
                                @endfor
                            </div>

                            <a href="javascript:void(0)" class="rating-count" data-bs-toggle="modal"
                                data-bs-target="#ratingsModal">
                                {{ $totalReviews }} Ratings
                            </a>
                        </div>

                        <!-- Ratings Modal -->
                        <div class="modal fade" id="ratingsModal" tabindex="-1" aria-labelledby="ratingsModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ratingsModalLabel">All Reviews & Ratings</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        @if ($reviews->count())
                                            @foreach ($reviews as $review)
                                                <div class="border-bottom mb-3 pb-2">
                                                    <div class="d-flex align-items-center mb-1">
                                                        <strong>{{ $review->user->name ?? 'Anonymous' }}</strong>
                                                        <span
                                                            class="ms-2 text-muted small">{{ $review->created_at->diffForHumans() }}</span>
                                                    </div>

                                                    <div class="mb-1">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($review->rating >= $i)
                                                                <i class="fa-solid fa-star text-yellow-500"></i>
                                                            @else
                                                                <i class="fa-regular fa-star text-yellow-500"></i>
                                                            @endif
                                                        @endfor
                                                    </div>

                                                    <p>{{ $review->comment }}</p>

                                                    @if ($review->media && $review->media->count())
                                                        <div class="d-flex gap-2 mt-2">
                                                            @foreach ($review->media as $media)
                                                                <img src="{{ asset('storage/' . $media->file_path) }}"
                                                                    alt="Review Media" width="80">
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted">No reviews available for this product.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>


                        <ul class="products-info">
                            <li>
                                <span>Availability:</span>
                                @if ($product->quantity > 0)
                                    @if ($product->quantity > 100)
                                        <span class="availability-badge instock">
                                            <i class='fa-solid fa-circle-check'></i> 100+ Available
                                        </span>
                                    @elseif ($product->quantity < 10)
                                        <span class="availability-badge instock" style="color: red; font-weight: bold;">
                                            <i class='fa-solid fa-circle-exclamation'></i> {{ $product->quantity }}
                                            Available - Very low stock!
                                        </span>
                                    @else
                                        <span class="availability-badge instock">
                                            <i class='fa-solid fa-circle-check'></i> {{ $product->quantity }} Available
                                        </span>
                                    @endif
                                @else
                                    <span class="availability-badge out-of-stock">
                                        <i class='fa-solid fa-circle-xmark'></i> Out of stock
                                    </span>
                                @endif
                            </li>

                            <li>
                                <span>Description:</span>
                                <span class="product-description">
                                    {{ Str::limit(strip_tags($product->product_description), 150) }}
                                </span>
                            </li>
                        </ul>


                        <!-- Color Options -->
                        @if ($product->variations->where('type', 'Color')->isNotEmpty())
                            <div class="products-color-switch">
                                <span>Color:</span>
                                <div class="color-options-container">
                                    @foreach ($product->variations->where('type', 'Color') as $color)
                                        @if ($color->quantity > 0)
                                            <button class="color-option" style="background-color: {{ $color->hex_value }};"
                                                data-color="{{ $color->hex_value }}" data-color-name="{{ $color->value }}"
                                                title="{{ $color->value }}">
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Size Options -->
                        @if ($product->variations->where('type', 'Size')->isNotEmpty())
                            <div class="products-size-wrapper">
                                <span>Size:</span>
                                <ul>
                                    @foreach ($product->variations->where('type', 'Size') as $size)
                                        @if ($size->quantity > 0)
                                            <li>
                                                <a href="javascript:void(0)" class="size-option"
                                                    data-size="{{ $size->value }}">
                                                    {{ $size->value }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Material Options -->
                        @if ($product->variations->where('type', 'Material')->isNotEmpty())
                            <div class="products-size-wrapper">
                                <span>Material</span>
                                <ul>
                                    @foreach ($product->variations->where('type', 'Material') as $material)
                                        @if ($material->quantity > 0)
                                            <li>
                                                <a href="javascript:void(0)" class="material-option"
                                                    data-material="{{ $material->value }}">
                                                    {{ $material->value }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="products-add-to-cart">
                            <div class="input-counter">
                                <span class="minus-btn">
                                    <us class="fa-solid fa-minus"></us>
                                </span>
                                <input type="number" id="quantity" value="1" min="1"
                                    max="{{ $product->quantity }}">
                                <span class="plus-btn"><i class="fa-solid fa-plus"></i></span>
                            </div>

                            <div class="buttons-row">
                                @auth
                                    <button class="Add-to-Cart" data-product-id="{{ $product->product_id }}" id="addToCartBtn"
                                        @if ($product->quantity <= 0) disabled @endif>
                                        <i class='fa-solid fa-cart-shopping'></i> Add to Cart
                                    </button>

                                    <button class="buy-nowbtn" id="buyNowBtn" data-product-id="{{ $product->product_id }}"
                                        @if ($product->quantity <= 0) disabled @endif>
                                        <i class='fa-solid fa-bag-shopping'></i> Buy Now
                                    </button>
                                @else
                                    <button class="Add-to-Cart" onclick="alert('Please log in to add to cart.')">
                                        <i class='fa-solid fa-cart-shopping'></i> Add to Cart
                                    </button>
                                    <button class="buy-nowbtn" onclick="alert('Please log in to proceed to checkout.')">
                                        <i class='fa-solid fa-bag-shopping'></i> Buy Now
                                    </button>
                                @endauth
                            </div>





                            {{-- <a href="javascript:void(0)" class="wishlist-toggle"
                                data-product-id="{{ $product->product_id }}" id="wishlist-{{ $product->product_id }}">
                                <i
                                    class="fa-solid fa-heart {{ in_array($product->product_id, $wishlistProductIds) ? 'filled' : '' }}"></i>
                                Add to Wishlist
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab products-details-tab">
                <ul class="tabs">
                    <li><a href="#description-tab" class="active">
                            Description
                        </a></li>

                    <li><a href="#info-tab">
                            Additional Information
                        </a></li>

                    <li>
                        <a href="#QA-tab">
                            Q & A
                        </a>
                    </li>

                    <li><a href="#reviews-tab">
                            Reviews
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tabs-item active" id="description-tab">
                        <div class="products-details-tab-content">
                            <p>{{ strip_tags($product->product_description) }}</p>
                        </div>
                    </div>

                    <div class="tabs-item" id="info-tab">
                        <div class="products-details-tab-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Color:</td>
                                            <td>
                                                @foreach ($product->variations->where('type', 'Color') as $color)
                                                    @if ($color->quantity > 0)
                                                        <span
                                                            style="background-color: {{ $color->hex_value }}; width: 20px; height: 20px; display: inline-block; border-radius: 50%; margin-right: 5px;"
                                                            title="{{ $color->value }}"></span>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Size:</td>
                                            <td>
                                                @foreach ($product->variations->where('type', 'Size') as $size)
                                                    @if ($size->quantity > 0)
                                                        <span
                                                            class="badge bg-light text-dark me-1">{{ $size->value }}</span>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Material:</td>
                                            <td>
                                                @foreach ($product->variations->where('type', 'Material') as $material)
                                                    @if ($material->quantity > 0)
                                                        <span
                                                            class="badge bg-light text-dark me-1">{{ $material->value }}</span>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tabs-item" id="QA-tab">
    <div class="products-details-tab-content">
        @if($faqs->count())
            <div class="list-group">
                @foreach($faqs as $faq)
                    <div class="list-group-item mb-3">
                        <p><strong>Q:</strong> {{ $faq->question }}</p>
                        <p><strong>A:</strong> {{ $faq->answer }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p>There are no Q & A available for this product.</p>
        @endif
    </div>
</div>


                    <div class="tabs-item" id="reviews-tab">
                        <div class="products-details-tab-content">
                            <div class="products-review-form">
                                <h3>Customer Reviews</h3>

                                <div class="review-title">
                                    <div class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($averageRating >= $i)
                                                <i class='bx bxs-star'></i> <!-- Full star -->
                                            @elseif ($averageRating >= $i - 0.5)
                                                <i class='bx bxs-star-half'></i> <!-- Half star -->
                                            @else
                                                <i class='bx bx-star'></i> <!-- Empty star -->
                                            @endif
                                        @endfor
                                    </div>
                                    <p>Based on {{ $totalReviews }} reviews</p>
                                </div>

                                <div class="review-comments">
                                    @foreach ($reviews as $review)
                                        <div class="review-item">
                                            <div class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($review->rating >= $i)
                                                        <i class='fa-solid fa-star'></i>
                                                    @elseif ($review->rating >= $i - 0.5)
                                                        <i class='bx bxs-star-half'></i>
                                                    @else
                                                        <i class='bx bx-star'></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <h3>{{ $review->comment_title ?? 'Review' }}</h3>
                                            <span>
                                                @if ($review->is_anonymous)
                                                    <strong> {{ ucfirst(substr($review->user->name, 0, 1)) }}***</strong>
                                                @else
                                                    <strong>{{ $review->user->name ?? 'User' }}</strong>
                                                @endif
                                                on <strong>{{ $review->created_at->format('M d, Y') }}</strong>
                                            </span>
                                            <p>{{ $review->comment }}</p>

                                            @if ($review->media->isNotEmpty())
                                                <div class="review-media">
                                                    @foreach ($review->media as $media)
                                                        @if ($media->media_type === 'image')
                                                            <a href="{{ asset('storage/' . $media->media_path) }}"
                                                                class="glightbox">
                                                                <img src="{{ asset('storage/' . $media->media_path) }}"
                                                                    alt="Review Media" class="review-image">
                                                            </a>
                                                        @elseif ($media->media_type === 'video')
                                                            <video controls>
                                                                <source src="{{ asset('storage/' . $media->media_path) }}"
                                                                    type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Details Area -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Tab functionality
            $('.tabs li a').on('click', function(e) {
                e.preventDefault();
                const target = $(this).attr('href');

                // Remove active class from all tabs and content
                $('.tabs li a').removeClass('active');
                $('.tabs-item').removeClass('active');

                // Add active class to clicked tab and corresponding content
                $(this).addClass('active');
                $(target).addClass('active');
            });

            // Thumbnail gallery functionality
            $('.thumbnail-link').on('click', function() {
                const newImageSrc = $(this).data('src');
                $('#main-product-image').attr('src', newImageSrc);

                // Add some animation
                $('#main-product-image').css('opacity', '0.5');
                setTimeout(function() {
                    $('#main-product-image').css('opacity', '1');
                }, 300);
            });

            // Quantity input functionality
            $('.plus-btn').on('click', function() {
                const quantityInput = $('#quantity');
                const currentVal = parseInt(quantityInput.val());
                const max = parseInt(quantityInput.attr('max'));

                if (currentVal < max) {
                    quantityInput.val(currentVal + 1);
                } else {
                    toastr.warning('Maximum quantity reached', 'Warning', {
                        positionClass: 'toast-top-right',
                        timeOut: 2000,
                    });
                }
            });

            $('.minus-btn').on('click', function() {
                const quantityInput = $('#quantity');
                const currentVal = parseInt(quantityInput.val());

                if (currentVal > 1) {
                    quantityInput.val(currentVal - 1);
                }
            });

            // Color selection
            $('.color-option').on('click', function() {
                $('.color-option').removeClass('selected');
                $(this).addClass('selected');

                const colorName = $(this).data('color-name');
                toastr.info(`Selected color: ${colorName}`, '', {
                    positionClass: 'toast-top-right',
                    timeOut: 1500
                });
            });

            // Size selection
            $('.size-option').on('click', function(e) {
                e.preventDefault();
                $('.size-option').removeClass('selected');
                $(this).addClass('selected');

                const size = $(this).data('size');
                toastr.info(`Selected size: ${size}`, '', {
                    positionClass: 'toast-top-right',
                    timeOut: 1500
                });
            });

            // Material selction
            $('.material-option').on('click', function(e) {
                e.preventDefault();
                $('.material-option').removeClass('selected');
                $(this).addClass('selected');

                const material = $(this).data('material');
                toastr.info(`Selected material: ${material}`, '', {
                    positionClass: 'toast-top-right',
                    timeOut: 1500
                });
            })

            // Wishlist toggle
            $('.wishlist-toggle').on('click', function(e) {
                e.preventDefault();

                const productId = $(this).data('product-id');
                const heartIcon = $(this).find('i');

                $.ajax({
                    url: '{{ route('wishlist.toggle') }}',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.message === 'Product added to wishlist') {
                            heartIcon.addClass('filled');
                            heartIcon.removeClass('bx-heart').addClass('bxs-heart');
                            toastr.success('Added to your wishlist', '', {
                                positionClass: 'toast-top-right',
                                timeOut: 2000
                            });
                        } else if (response.message === 'Product removed from wishlist') {
                            heartIcon.removeClass('filled');
                            heartIcon.removeClass('bxs-heart').addClass('bx-heart');
                            toastr.info('Removed from your wishlist', '', {
                                positionClass: 'toast-top-right',
                                timeOut: 2000
                            });
                        }
                    },
                    error: function() {
                        toastr.error('You must be logged in to add to wishlist', '', {
                            positionClass: 'toast-top-right',
                            timeOut: 2500
                        });
                    }
                });
            });

            // Add to Cart Button
            // Add to Cart Button - Fixed Version
            // Add to Cart Button - Fixed Version
            $('#addToCartBtn').on('click', function(e) {
                e.preventDefault();

                const productId = $(this).data('product-id');
                const isAuth = "{{ Auth::check() ? 'true' : 'false' }}";
                const selectedSize = $('.size-option.selected').data('size');
                const selectedColor = $('.color-option.selected').data('color-name');
                const selectedMaterial = $('.material-option.selected').data('material');

                // Parse quantity as integer and ensure it's valid
                let quantity = parseInt($('#quantity').val());
                console.log('Raw quantity value:', $('#quantity').val());
                console.log('Parsed quantity:', quantity);

                if (isNaN(quantity) || quantity < 1) {
                    quantity = 1;
                    console.log('Invalid quantity detected, defaulting to 1');
                }

                // Check if there are size or color options for this product
                const hasSize = $('.size-option').length > 0;
                const hasColor = $('.color-option').length > 0;
                const hasMaterial = $('.material-option').length > 0;

                // If the product has size options, check if size is selected
                if (hasSize && !selectedSize) {
                    toastr.warning('Please select a size before adding to cart', '', {
                        positionClass: 'toast-top-right',
                        timeOut: 2500
                    });
                    return;
                }

                // If the product has color options, check if color is selected
                if (hasColor && !selectedColor) {
                    toastr.warning('Please select a color before adding to cart', '', {
                        positionClass: 'toast-top-right',
                        timeOut: 2500
                    });
                    return;
                }

                // Proceed to add product to cart
                if (isAuth === 'true') {
                    // Add button animation
                    const btn = $(this);
                    btn.prop('disabled', true);
                    btn.html('<i class="bx bx-loader-alt bx-spin"></i> Adding...');

                    // Debug: Log the data being sent
                    console.log('Sending cart data:', {
                        product_id: productId,
                        size: selectedSize || null,
                        color: selectedColor || null,
                        material: selectedMaterial || null,
                        quantity: quantity
                    });

                    $.ajax({
                        url: "{{ route('cart.add') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            product_id: productId,
                            size: selectedSize || null,
                            color: selectedColor || null,
                            material: selectedMaterial || null,
                            quantity: quantity
                        },
                        success: function(response) {
                            // Debug: Log server response
                            console.log('Server response:', response);

                            // Update cart count
                            $.get("{{ route('cart.count') }}", function(data) {
                                $('#cart-count').text(data.cart_count);
                            });

                            // Reset button
                            btn.prop('disabled', false);
                            btn.html('<i class="bx bx-cart-add"></i> Add to Cart');

                            // Show success message
                            toastr.success('Item added to your cart!', '', {
                                positionClass: 'toast-top-right',
                                timeOut: 2500
                            });

                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        },
                        error: function(xhr) {
                            console.log('Error response:', xhr.responseText);

                            // Reset button
                            btn.prop('disabled', false);
                            btn.html('<i class="bx bx-cart-add"></i> Add to Cart');

                            toastr.error('Something went wrong. Please try again.', '', {
                                positionClass: 'toast-top-right',
                                timeOut: 2500
                            });
                        }
                    });
                } else {
                    toastr.warning('Please log in to add items to your cart', '', {
                        positionClass: 'toast-top-right',
                        timeOut: 2500
                    });
                }
            });

            // Buy Now Button
            $('#buyNowBtn').on('click', function(e) {
                e.preventDefault();

                const productId = $(this).data('product-id');
                const isAuth = "{{ Auth::check() ? 'true' : 'false' }}";
                const selectedSize = $('.size-option.selected').data('size');
                const selectedColor = $('.color-option.selected').data('color-name');
                const selectedMaterial = $('.material-option.selected').data('material-name');
                const quantity = $('#quantity').val() || 1;

                // Check if there are size or color options for this product
                const hasSize = $('.size-option').length > 0;
                const hasColor = $('.color-option').length > 0;
                const hasMaterial = $('.material-option').length > 0;

                // If the product has size options, check if size is selected
                if (hasSize && !selectedSize) {
                    toastr.warning('Please select a size before proceeding', '', {
                        positionClass: 'toast-top-right',
                        timeOut: 2500
                    });
                    return;
                }

                // If the product has color options, check if color is selected
                if (hasColor && !selectedColor) {
                    toastr.warning('Please select a color before proceeding', '', {
                        positionClass: 'toast-top-right',
                        timeOut: 2500
                    });
                    return;
                }

                // Proceed to checkout
                if (isAuth === 'true') {
                    // Add button animation
                    const btn = $(this);
                    btn.prop('disabled', true);
                    btn.html('<i class="bx bx-loader-alt bx-spin"></i> Processing...');

                    $.ajax({
                        url: "{{ route('buynow.checkout') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            product_id: productId,
                            size: selectedSize || null,
                            color: selectedColor || null,
                            material: selectedMaterial || null,
                            quantity: quantity
                        },
                        success: function(response) {
                            console.log("Response from server:", response);
                            window.location.href = response.redirect_url;
                        },
                        error: function(xhr) {
                            console.log("Error response:", xhr.responseText);

                            // Reset button
                            btn.prop('disabled', false);
                            btn.html('<i class="bx bx-purchase-tag"></i> Buy Now');

                            toastr.error('Something went wrong. Please try again.', '', {
                                positionClass: 'toast-top-right',
                                timeOut: 2500
                            });
                        }
                    });
                } else {
                    toastr.warning('Please log in to proceed to checkout', '', {
                        positionClass: 'toast-top-right',
                        timeOut: 2500
                    });
                }
            });

            // Smooth scroll to reviews tab when clicking on ratings link
            $('.rating-count').on('click', function(e) {
                e.preventDefault();

                // Activate the reviews tab
                $('.tabs li a').removeClass('active');
                $('.tabs-item').removeClass('active');
                $('a[href="#reviews-tab"]').addClass('active');
                $('#reviews-tab').addClass('active');

                // Scroll to reviews section
                $('html, body').animate({
                    scrollTop: $('.products-review-form').offset().top - 100
                }, 500);
            });
        });
    </script>

@endsection
