<?php $__env->startSection('content'); ?>
    <!--
                                                                                                                                                                        ==============================================================================================================================================================


                                                                                                                                                                        home page


                                                                                                                                                                        ===============================================================================================================================================================
                                                                                                                                                                        -->



    <style>
        /* Custom styles */
        .carousel-item {
            background-size: cover;
            background-position: center;
            height: 650px;
            /* Adjust height as needed */
            width: 100%;
            position: relative;
        }

        /* Mobile (up to 576px) */
        @media (max-width: 576px) {
            .carousel-item {
                height: 200px;
                /* Adjust height for mobile */
            }

            .carousel {
                margin-top: 65px;
            }
        }

        /* Tablet (576px to 768px) */
        @media (min-width: 577px) and (max-width: 768px) {
            .carousel-item {
                height: 500px;
                /* Adjust height for tablets */
            }
        }



        /* Each carousel item with a different image */
        .carousel-item:nth-child(1) {
            background-image: url('frontend/newstyle/assets/images/public.jpg');
            /* Replace with your image path */
        }

        .carousel-item:nth-child(2) {
            background-image: url('frontend/newstyle/assets/images/public.jpg');
            /* Replace with your image path */
        }

        .carousel-item:nth-child(3) {
            background-image: url('frontend/newstyle/assets/images/public.jpg');
            /* Replace with your image path */
        }

        .carousel-item-next,
        .carousel-item-prev,
        .carousel-item.active {
            transition: transform 0.5s ease;
        }

        /* Optional: Ensure the carousel controls are visible */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black;
            /* For better visibility */
        }

        /* Hide the carousel control buttons */
        .carousel-control-prev,
        .carousel-control-next {
            display: none;
        }

        /* Style the dots (indicators) */
        .carousel-indicators li {
            background-color: transparent;
            width: 20px;
            height: 20px;
            border-radius: 0;
            border: 2px solid white;
            margin: 0 5px;
            /* Adds some space between dots */
        }

        .carousel-indicators .active {
            background-color: white;
            transform: scale(1.2);
        }


        .owl-carousel .owl-nav button.owl-next,
        .owl-carousel .owl-nav button.owl-prev,
        .owl-carousel button.owl-dot {
            background: 0 0;
            color: inherit;
            border: none;
            padding: 0 !important;
            font: inherit;
            font-size: 37px !important;
        }


        .product-image {
            width: 100% !important;
            height: auto !important;
            object-fit: cover !important;
        }

        /* Discount Tag Styling for Product Carousel */
        .normal-pro-promo-tags {
            position: absolute;
            top: 10px;
            left: 20px;
            z-index: 10;
            pointer-events: none;
            /* Allows clicks to pass through to elements below */
        }

        .discout-tag {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #ff6666, #cc0000);
            width: 70px;
            height: 70px;
            color: white;
            border-radius: 50px;
            padding: 4px 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            transform: rotate(-5deg);
            transition: all 0.3s ease;
        }

        .discount-amount {
            font-size: 12px;
            font-weight: 700;
            margin-right: 2px;
            letter-spacing: 0.5px;
        }

        .off-txt {
            font-size: 15px;
            font-weight: 600;
            text-transform: uppercase;
        }

        /* Make sure the grid-product-wapper has relative positioning */
        .grid-product-wapper {
            position: relative;
            overflow: hidden;
        }

        /* Animation for the discount tag */
        @keyframes bounce-light {

            0%,
            100% {
                transform: rotate(-5deg);
            }

            50% {
                transform: rotate(-3deg) scale(1.05);
            }
        }

        /* Apply animation when hovering over the product */
        .grid-product-wapper:hover .discout-tag {
            animation: bounce-light 2s infinite ease-in-out;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .discout-tag {
                padding: 3px 6px;
            }

            .discount-amount {
                font-size: 12px;
            }

            .off-txt {
                font-size: 15px;
            }
        }

@media (max-width: 576px) {
  .home-product-list {
    display: flex;
    flex-wrap: wrap;
  }
  .home-product-list .item {
    width: 50%;
    box-sizing: border-box;
    padding: 5px;
  }

 .normal-pro-promo-tags {
    top: 6px;       /* move badge closer to the corner */
    left: 8px;
  }
.discout-tag {
    width: 50px;    /* smaller circle */
    height: 50px;
    padding: 2px 6px;
    transform: rotate(-5deg) scale(0.9);
  }

  .discount-amount {
    font-size: 10px;     /* smaller text */
    margin-right: 1px;
  }

  .off-txt {
    display: none;       /* hide “OFF” text when it’s just “Sale!” */
  }
}


        /* Make sure the discount tag doesn't overlap with other UI elements */
        .owl-item .grid-product-wapper .normal-pro-promo-tags {
            z-index: 5;
        }

        /* Special styling for higher discounts */
        .discout-tag .discount-amount[class*="discount-amount"]:not([class*="0%"]):not([class*="1%"]):not([class*="2%"]) {
            font-weight: 800;
            letter-spacing: 0.8px;
        }
    </style>

    <!-- Carousel Section -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" ">
                                                                                                                                                                                                <div class="carousel-inner">

                                                         <?php $__currentLoopData = $carousels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>
        $carousel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>"
            style="background-image: url('<?php echo e(asset('storage/carousel_images/' . $carousel->image_path)); ?>');">
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    </div>
    <div class="carousel-indicators">
        <?php $__currentLoopData = $carousels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $carousel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="<?php echo e($index); ?>"
                class="<?php echo e($index === 0 ? 'active' : ''); ?>" aria-current="<?php echo e($index === 0 ? 'true' : 'false'); ?>"
                aria-label="Slide <?php echo e($index + 1); ?>"></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    </div>

    <div class="site-common-con">
        <div class="home-product d-flex">
            <div class="home-product-title exclusive">
                <p class="home-page-product-title">Online Exclusive</p>
            </div>
            <div class="view-all-txt">
                <a class="view-all-link" href="<?php echo e(route('special_offerproducts')); ?>">VIEW ALL</a>
            </div>
        </div>

        <div id="category_products_list_28" class="products-grid row">
            <div class="home-product-list owl-carousel owl-theme owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all; width: 2600px;">


                        <?php $__currentLoopData = $specialOffers->slice(0, 10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="owl-item active" style="width: 216.638px;">
                                <div class="item items-28">
                                    <div class="grid-product-wapper">
                                        <!-- Discount Tag -->
                                        <?php if($product->product->specialOffer && $product->product->specialOffer->status === 'active'): ?>
                                            <div class="normal-pro-promo-tags">
                                                <div class="discout-tag">
                                                    <span
                                                        class="discount-amount"><?php echo e($product->product->specialOffer->offer_rate); ?>%</span>
                                                    <span class="off-txt">OFF</span>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Product Image -->
                                        <div class="product-image">
                                            <a href="<?php echo e(route('product-description', $product->product_id)); ?>">

                                                <?php if($product->product->images->isEmpty()): ?>
                                                    <img src="<?php echo e(asset('frontend/newstyle/assets/images/loader.gif')); ?>"
                                                        alt="<?php echo e($product->product_name); ?>" class="grid-product-img"
                                                        loading="eager" width="178" height="178">
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('storage/' . $product->product->images->first()->image_path)); ?>"
                                                        alt="<?php echo e($product->product_name); ?>" class="grid-product-img"
                                                        loading="eager" width="178" height="178">
                                                <?php endif; ?>
                                            </a>
                                            <div class="products-btn-set">
                                                <a href="<?php echo e(route('product-description', $product->product_id)); ?>"
                                                    class="home-buynow">BUY
                                                    NOW</a>
                                            </div>
                                        </div>

                                        <!-- Product Title & Prices -->
                                        <div class="grid-pro-drtail-con">
                                            <div class="col-md-12 grid-product-title">
                                                <div class="pro-name-compact"
                                                    title="<?php echo e($product->product->product_name); ?>">
                                                    <?php echo e($product->product->product_name); ?>

                                                </div>
                                            </div>
                                            <div class="u">
                                                <?php if($product->product->specialOffer && $product->product->specialOffer->status === 'active'): ?>
                                                    <span class="market-price">Rs.
                                                        <?php echo e(number_format($product->normal_price, 2)); ?></span>
                                                    <span class="selling-price">Rs.
                                                        <?php echo e(number_format($product->product->specialOffer->offer_price, 2)); ?></span>
                                                <?php else: ?>
                                                    <span class="market-price">Rs.
                                                        <?php echo e(number_format($product->normal_price, 2)); ?></span>
                                                <?php endif; ?>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Owl Carousel CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/frontend/newstyle/assets/owl.carousel.min.css">
                                                                                                                                                                                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.theme.default.min.css"> -->

    <!-- Include Owl Carousel JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script> -->


    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                loop: true, // Enable looping
                margin: 10, // Margin between items
                nav: true, // Show next/prev arrows

                dots: false, // Disable dots navigation
                autoplay: false, // Enable auto-scrolling
                autoplayTimeout: 2000, // Auto-scroll interval in ms
                responsive: {
                    0: {
                        items: 1 // Show 1 item for small screens
                    },
                    600: {
                        items: 3 // Show 3 items for medium screens
                    },
                    1000: {
                        items: 5 // Show 5 items for large screens
                    }
                }
            });
        });
    </script>

<script>
 $(document).ready(function() {
  var $carousel = $(".home-product-list.owl-carousel");

  if ($(window).width() <= 576) {
    // Properly destroy, but leave your HTML in place
    $carousel.trigger('destroy.owl.carousel');

    // Remove only Owl’s classes so your grid CSS kicks in
    $carousel
      .removeClass('owl-carousel owl-loaded')
      .find('.owl-stage-outer, .owl-stage, .owl-item')
      .removeAttr('style')
      .removeClass('owl-stage-outer owl-stage owl-item active');

    // Now your fallback CSS (the 2-column flex/grid) will display them
  }
});

</script>



















    <div class="site-common-con">
        <div class="home-product d-flex">
            <div class="home-product-title">
                <p class="home-page-product-title">Top Selling</p>
            </div>
            <div class="view-all-txt">
                <a class="view-all-link" href="<?php echo e(route('sale_products')); ?>">VIEW ALL</a>
            </div>
        </div>

        <div id="category_products_list_28" class="products-grid row">
            <div class="home-product-list owl-carousel owl-theme owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all; width: 2600px;">
                        <?php $__currentLoopData = $orderedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="owl-item active" style="width: 216.638px;">
                                <div class="item items-28">
                                    <div class="grid-product-wapper">
                                        <!-- Discount Tag -->
                                        <?php if($product->sale): ?>
                                            <div class="normal-pro-promo-tags">
                                                <div class="discout-tag">
                                                    <span class="discount-amount">Sale!</span>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Product Image -->
                                        <div class="product-image">
                                            <a href="<?php echo e(route('product-description', $product->product_id)); ?>">

                                                <?php if($product->images->isEmpty()): ?>
                                                    <img src="<?php echo e(asset('frontend/newstyle/assets/images/loader.gif')); ?>"
                                                        alt="<?php echo e($product->product_name); ?>" class="grid-product-img"
                                                        loading="eager" width="178" height="178">
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>"
                                                        alt="<?php echo e($product->product_name); ?>" class="grid-product-img"
                                                        loading="eager" width="178" height="178">
                                                <?php endif; ?>
                                            </a>
                                            <div class="products-btn-set">
                                                <a href="<?php echo e(route('product-description', $product->product_id)); ?>"
                                                    class="home-buynow">BUY
                                                    NOW</a>
                                            </div>
                                        </div>

                                        <!-- Product Title & Prices -->
                                        <div class="grid-pro-drtail-con">
                                            <div class="col-md-12 grid-product-title">
                                                <div class="pro-name-compact" title="<?php echo e($product->product_name); ?>">
                                                    <?php echo e($product->product_name); ?>

                                                </div>
                                            </div>
                                            <div class="u">

                                                <?php if($product->sale && $product->sale->status === 'active'): ?>
                                                    <span class="market-price">Rs.
                                                        <?php echo e(number_format($product->normal_price, 2)); ?></span>
                                                    <span class="selling-price">Rs.
                                                        <?php echo e(number_format($product->sale->sale_price, 2)); ?></span>
                                                <?php elseif($product->specialOffer && $product->specialOffer->status === 'active'): ?>
                                                    <span class="market-price">Rs.
                                                        <?php echo e(number_format($product->normal_price, 2)); ?></span>
                                                    <span class="selling-price">Rs.
                                                        <?php echo e(number_format($product->specialOffer->offer_price, 2)); ?></span>
                                                <?php else: ?>
                                                    <span class="market-price">Rs.
                                                        <?php echo e(number_format($product->normal_price, 2)); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="site-common-con">
        <div class="home-product d-flex">
            <div class="home-product-title">
                <p class="home-page-product-title">Most Recent</p>
            </div>
            <div class="view-all-txt">
                <a class="view-all-link" href="<?php echo e(route('all-items')); ?>">VIEW ALL</a>
            </div>
        </div>

        <div id="category_products_list_28" class="products-grid row">
            <div class="home-product-list owl-carousel owl-theme owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all; width: 2600px;">
                        <?php $__currentLoopData = $recentProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="owl-item active" style="width: 216.638px;">
                                <div class="item items-28">
                                    <div class="grid-product-wapper">
                                        <!-- Discount Tag -->
                                        <?php if($product->sale): ?>
                                            <div class="normal-pro-promo-tags">
                                                <div class="discout-tag">
                                                    <span class="discount-amount">Sale!</span>
                                                    <span class="off-txt"></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Product Image -->
                                        <div class="product-image">
                                            <a href="<?php echo e(route('product-description', $product->product_id)); ?>">
                                                <?php if($product->images->isEmpty()): ?>
                                                    <img src="<?php echo e(asset('frontend/newstyle/assets/images/loader.gif')); ?>"
                                                        alt="<?php echo e($product->product_name); ?>" class="grid-product-img"
                                                        loading="eager" width="178" height="178">
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>"
                                                        alt="<?php echo e($product->product_name); ?>" class="grid-product-img"
                                                        loading="eager" width="178" height="178">
                                                <?php endif; ?>
                                            </a>
                                            <div class="products-btn-set">
                                                <a href="<?php echo e(route('product-description', $product->product_id)); ?>"
                                                    class="home-buynow">BUY
                                                    NOW</a>
                                            </div>
                                        </div>

                                        <!-- Product Title & Prices -->
                                        <div class="grid-pro-drtail-con">
                                            <div class="col-md-12 grid-product-title">
                                                <div class="pro-name-compact" title="<?php echo e($product->product_name); ?>">
                                                    <?php echo e($product->product_name); ?>

                                                </div>
                                            </div>
                                            <div class="u">
                                                <?php if($product->sale && $product->sale->status === 'active'): ?>
                                                    <span class="market-price">Rs.
                                                        <?php echo e(number_format($product->normal_price, 2)); ?></span>
                                                    <span class="selling-price">Rs.
                                                        <?php echo e(number_format($product->sale->sale_price, 2)); ?></span>
                                                <?php elseif($product->specialOffer && $product->specialOffer->status === 'active'): ?>
                                                    <span class="market-price">Rs.
                                                        <?php echo e(number_format($product->normal_price, 2)); ?></span>
                                                    <span class="selling-price">Rs.
                                                        <?php echo e(number_format($product->specialOffer->offer_price, 2)); ?></span>
                                                <?php else: ?>
                                                    <span class="market-price">Rs.
                                                        <?php echo e(number_format($product->normal_price, 2)); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-common-con" style="margin-bottom: 50px;">
        <div class="row m-0">
            <!-- First Banner Image (Left Side) -->
            <div class="col-12 col-sm-6 custom-4-banner">
                <?php if($leftBanner): ?>
                    <img src="<?php echo e(asset('storage/banner_images/' . $leftBanner->image_path)); ?>" class="img-fluid"
                        alt="Banner Left">
                <?php endif; ?>
            </div>

            <!-- Second Banner Image (Right Side) -->
            <div class="col-12 col-sm-6 custom-4-banner">
                <?php if($rightBanner): ?>
                    <img src="<?php echo e(asset('storage/banner_images/' . $rightBanner->image_path)); ?>" class="img-fluid"
                        alt="Banner Right">
                <?php endif; ?>
            </div>
        </div>

        <!-- Single Banner Image (Full Width) -->
        <!-- Bottom Banner with Optional Link -->
        <?php if($bottomBanner): ?>
            <a href="<?php echo e($bottomBanner->link ?? '#'); ?>">
                <div class="col-12 col-sm-12 single-banner-m">
                    <img src="<?php echo e(asset('storage/banner_images/' . $bottomBanner->image_path)); ?>" class="img-fluid"
                        alt="Bottom Banner">
                </div>
            </a>
        <?php endif; ?>
    </div>

































































    <!--

                                                                                                                                                                                        =====================================================================================================================================================
                                                                                                                                                                                                                             Home page end

                                                                                                                                                                                        ===================================================================================================================================================== -->





    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productIds = [...document.querySelectorAll('.heart-icon')].map(button => button.id.replace(
                'wishlist-icon-', ''));

            // Fetch wishlist status for all products on the page
            fetch('/wishlist/check-multiple', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({
                        product_ids: productIds
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Loop through each product and update the icon if it's in the wishlist
                    data.wishlist.forEach(productId => {
                        const heartIcon = document.querySelector(`#wishlist-icon-${productId}`);
                        if (heartIcon) {
                            heartIcon.classList.add('active');
                            const icon = heartIcon.querySelector('i');
                            icon.classList.replace('fa-regular', 'fa-solid');
                            icon.style.color = 'red';
                        }
                    });
                })
                .catch(error => console.error('Error:', error));
        });

        function toggleWishlist(button, productId) {
            // Toggle active state
            button.classList.toggle('active');
            const icon = button.querySelector('i');

            if (button.classList.contains('active')) {
                icon.classList.replace('fa-regular', 'fa-solid');
                icon.style.color = 'red';
            } else {
                icon.classList.replace('fa-solid', 'fa-regular');
                icon.style.color = '#ccc';
            }

            // Send AJAX request to toggle wishlist status
            fetch('/wishlist/toggle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error); // If not logged in or another error
                    } else {
                        alert(data.message); // Display success message
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\nilan\OneDrive\Desktop\OMC project\OMC_new\OMCNEW\resources\views/frontend/home.blade.php ENDPATH**/ ?>