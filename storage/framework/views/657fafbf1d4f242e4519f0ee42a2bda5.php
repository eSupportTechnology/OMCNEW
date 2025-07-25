<?php $__env->startSection('content'); ?>
    <!-- In your <head> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <style>
        :root {
            --primary: #2b96c5;
            --primary-dark: #1e7ba8;
            --text-dark: #1a202c;
            --text-light: #718096;
            --bg-light: #f7fafc;
            --white: #ffffff;
            --border: #e2e8f0;
            --shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            --radius: 12px;
            --transition: all 0.2s ease;
            --orange: #ff6b35;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: var(--bg-light);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .carousel-wrapper {
            margin-bottom: 30px;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .carousel-item img {
            width: 100%;
            height: auto;
            display: block;
        }

        .carousel-indicators [data-bs-target] {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.5);
            margin: 0 4px;
        }

        .carousel-indicators .active {
            background: var(--primary);
        }

        .categories-section {
            margin-bottom: 40px;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 30px;
        }

        .category-button {
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: var(--radius);
            padding: 16px 12px;
            text-align: center;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: var(--transition);
            display: block;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .category-button:hover {
            background: var(--primary-dark);
            color: var(--white);
            text-decoration: none;
            transform: translateY(-1px);
        }

        .section-header {
            background: var(--text-dark);
            color: var(--white);
            padding: 15px 20px;
            margin: 30px 0 20px 0;
            border-radius: var(--radius) var(--radius) 0 0;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .products-container {
            background: var(--white);
            border-radius: 0 0 var(--radius) var(--radius);
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: var(--shadow);
        }

        .products-grid {
            display: flex;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;

        }

        .product-card {
            width: 250px;
            /* fixed width */
            height: 400px;
            /* fixed height */
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            position: relative;
            transition: var(--transition);
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .product-image-container {
            position: relative;
            background: var(--white);
            padding: 20px;
            text-align: center;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 50px;
            margin-right: 10px;

        }

        .product-image {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            display: block;
            margin: 10px;
        }


        .wishlist-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .wishlist-btn:hover {
            background: var(--bg-light);
        }

        .wishlist-btn i {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .product-info {
            padding: 15px;
            background: var(--white);
        }

        .product-name {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-dark);
            margin: 0 0 8px 0;
            line-height: 1.3;
            height: 2.6em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .product-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--orange);
            margin: 8px 0;
        }

        .price-crossed {
            font-size: 0.85rem;
            color: var(--text-light);
            text-decoration: line-through;
            margin-right: 8px;
        }

        .extra-offer {
            font-size: 0.75rem;
            color: var(--orange);
            margin: 5px 0;
        }

        .discount-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: var(--orange);
            color: var(--white);
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .section-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .nav-btn {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: var(--radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .nav-btn:hover {
            background: var(--primary-dark);
        }

        .nav-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .category-button {
                padding: 12px 8px;
                font-size: 0.8rem;
                min-height: 45px;
            }

            .products-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;



            }

            .product-image {
                height: 120px;
            }

            .product-info {
                padding: 12px;
            }

            .section-header {
                padding: 12px 15px;
                font-size: 1.1rem;
            }

            .products-container {
                padding: 15px;

            }
        }

        @media (max-width: 480px) {
            .category-button {
                font-size: 0.75rem;
                padding: 10px 6px;
            }

            .product-name {
                font-size: 0.8rem;
            }

            .product-price {
                font-size: 1rem;
            }
        }

       @media (max-width: 600px) {
    .owl-carousel .owl-stage {
        display: flex !important;
        justify-content: center !important;
    }

    .owl-carousel .owl-item {
        display: flex;
        justify-content: center;
    }

    .product-card {
        margin: 0 auto;
    }
}


.owl-nav button.owl-prev,
.owl-nav button.owl-next {
    width: 40px;              /* Adjust width */
    height: 40px;             /* Adjust height */
    font-size: 24px;          /* Size of the arrow symbol */
    background-color: #fff;
    color: #333;
    border: 1px solid #ccc;
    border-radius: 50%;       /* Make it circular */
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    transition: all 0.3s;
}

.owl-nav button.owl-prev {
    left: -25px;
}

.owl-nav button.owl-next {
    right: -25px;
}







    </style>



    <div class="container">
        <div class="carousel-wrapper">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php $__currentLoopData = $carousels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $carousel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>">
                            <img src="<?php echo e(asset('storage/carousel_images/' . $carousel->image_path)); ?>"
                                alt="Slide <?php echo e($index + 1); ?>" loading="<?php echo e($index === 0 ? 'eager' : 'lazy'); ?>">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php if(count($carousels) > 1): ?>
                    <div class="carousel-indicators">
                        <?php $__currentLoopData = $carousels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $carousel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="<?php echo e($index); ?>"
                                class="<?php echo e($index === 0 ? 'active' : ''); ?>" aria-label="Slide <?php echo e($index + 1); ?>"></button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="categories-section">
            <div class="categories-grid">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/all-items?category=<?php echo e(urlencode($category->parent_category)); ?>" class="category-button">
                        <?php echo e($category->parent_category); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="section-header">Special Offers</div>
        <div class="products-container">
            <div class="owl-carousel special-offer-slider owl-theme  ">

                <?php $__currentLoopData = $specialOffers->slice(0, 8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product-card">
                        <?php if($product->product->specialOffer && $product->product->specialOffer->status === 'active'): ?>
                            <div class="discount-badge"><?php echo e($product->product->specialOffer->offer_rate); ?>% OFF</div>
                        <?php endif; ?>

                        <div class="product-image-container">
                            <button class="wishlist-btn heart-icon" id="wishlist-icon-<?php echo e($product->product_id); ?>"
                                onclick="toggleWishlist(this, <?php echo e($product->product_id); ?>)">
                                <i class="fa-regular fa-heart"></i>
                            </button>

                            <a href="<?php echo e(route('product-description', $product->product_id)); ?>">
                                <?php if($product->product->images->isEmpty()): ?>
                                    <img src="<?php echo e(asset('frontend/newstyle/assets/images/loader.gif')); ?>"
                                        alt="<?php echo e($product->product_name); ?>" class="product-image" loading="lazy">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('storage/' . $product->product->images->first()->image_path)); ?>"
                                        alt="<?php echo e($product->product_name); ?>" class="product-image" loading="lazy">
                                <?php endif; ?>
                            </a>
                        </div>

                        <div class="product-info">
                            <h4 class="product-name"><?php echo e($product->product->product_name); ?></h4>

                            <div class="product-price">
                                <?php if($product->product->specialOffer && $product->product->specialOffer->status === 'active'): ?>
                                    <span class="price-crossed">Rs.<?php echo e(number_format($product->normal_price, 0)); ?></span>
                                    Rs.<?php echo e(number_format($product->product->specialOffer->offer_price, 0)); ?>

                                <?php else: ?>
                                    Rs.<?php echo e(number_format($product->normal_price, 0)); ?>

                                <?php endif; ?>
                            </div>

                            <div class="extra-offer">Extra 2% off with coins</div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>

        <div class="section-header">Top Selling</div>
        <div class="products-container">
            <div class="owl-carousel special-offer-slider owl-theme">
                <?php $__currentLoopData = $orderedProducts->slice(0, 8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product-card">
                        <?php if($product->sale): ?>
                            <div class="discount-badge">Sale!</div>
                        <?php endif; ?>

                        <div class="product-image-container">
                            <button class="wishlist-btn heart-icon" id="wishlist-icon-<?php echo e($product->product_id); ?>"
                                onclick="toggleWishlist(this, <?php echo e($product->product_id); ?>)">
                                <i class="fa-regular fa-heart"></i>
                            </button>

                            <a href="<?php echo e(route('product-description', $product->product_id)); ?>">
                                <?php if($product->images->isEmpty()): ?>
                                    <img src="<?php echo e(asset('frontend/newstyle/assets/images/loader.gif')); ?>"
                                        alt="<?php echo e($product->product_name); ?>" class="product-image" loading="lazy">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>"
                                        alt="<?php echo e($product->product_name); ?>" class="product-image" loading="lazy">
                                <?php endif; ?>
                            </a>
                        </div>

                        <div class="product-info">
                            <h4 class="product-name"><?php echo e($product->product_name); ?></h4>

                            <div class="product-price">
                                <?php if($product->sale && $product->sale->status === 'active'): ?>
                                    <span class="price-crossed">Rs.<?php echo e(number_format($product->normal_price, 0)); ?></span>
                                    Rs.<?php echo e(number_format($product->sale->sale_price, 0)); ?>

                                <?php elseif($product->specialOffer && $product->specialOffer->status === 'active'): ?>
                                    <span class="price-crossed">Rs.<?php echo e(number_format($product->normal_price, 0)); ?></span>
                                    Rs.<?php echo e(number_format($product->specialOffer->offer_price, 0)); ?>

                                <?php else: ?>
                                    Rs.<?php echo e(number_format($product->normal_price, 0)); ?>

                                <?php endif; ?>
                            </div>

                            <div class="extra-offer">Extra 2% off with coins</div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
        </div>

        <div class="section-header">Flash Sale</div>
        <div class="products-container">
            <div class="owl-carousel special-offer-slider owl-theme">
                <?php $__currentLoopData = $recentProducts->slice(0, 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product-card">
                        <?php if($product->sale): ?>
                            <div class="discount-badge">
                                <?php if($product->sale && $product->sale->status === 'active'): ?>
                                    <?php echo e(round((($product->normal_price - $product->sale->sale_price) / $product->normal_price) * 100)); ?>%
                                <?php else: ?>
                                    Sale!
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="product-image-container">
                            <button class="wishlist-btn heart-icon" id="wishlist-icon-<?php echo e($product->product_id); ?>"
                                onclick="toggleWishlist(this, <?php echo e($product->product_id); ?>)">
                                <i class="fa-regular fa-heart"></i>
                            </button>

                            <a href="<?php echo e(route('product-description', $product->product_id)); ?>">
                                <?php if($product->images->isEmpty()): ?>
                                    <img src="<?php echo e(asset('frontend/newstyle/assets/images/loader.gif')); ?>"
                                        alt="<?php echo e($product->product_name); ?>" class="product-image" loading="lazy">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>"
                                        alt="<?php echo e($product->product_name); ?>" class="product-image" loading="lazy">
                                <?php endif; ?>
                            </a>
                        </div>

                        <div class="product-info">
                            <h4 class="product-name"><?php echo e($product->product_name); ?></h4>

                            <div class="product-price">
                                <?php if($product->sale && $product->sale->status === 'active'): ?>
                                    <span class="price-crossed">Rs.<?php echo e(number_format($product->normal_price, 0)); ?></span>
                                    Rs.<?php echo e(number_format($product->sale->sale_price, 0)); ?>

                                <?php elseif($product->specialOffer && $product->specialOffer->status === 'active'): ?>
                                    <span class="price-crossed">Rs.<?php echo e(number_format($product->normal_price, 0)); ?></span>
                                    Rs.<?php echo e(number_format($product->specialOffer->offer_price, 0)); ?>

                                <?php else: ?>
                                    Rs.<?php echo e(number_format($product->normal_price, 0)); ?>

                                <?php endif; ?>
                            </div>

                            <div class="extra-offer">Extra 2% off with coins</div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
        </div>
    </div>







    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth <= 576) {
                const carousels = document.querySelectorAll('.owl-carousel');
                carousels.forEach(carousel => {
                    carousel.classList.remove('owl-carousel', 'owl-theme', 'owl-loaded', 'owl-drag');

                    const stages = carousel.querySelectorAll('.owl-stage-outer, .owl-stage');
                    stages.forEach(stage => {
                        if (stage.parentNode) {
                            while (stage.firstChild) {
                                stage.parentNode.insertBefore(stage.firstChild, stage);
                            }
                            stage.remove();
                        }
                    });

                    const items = carousel.querySelectorAll('.owl-item');
                    items.forEach(item => {
                        item.classList.remove('owl-item', 'active');
                        item.style.width = 'auto';
                    });
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const productIds = [...document.querySelectorAll('.heart-icon')].map(button =>
                button.id.replace('wishlist-icon-', ''));

            if (productIds.length > 0) {
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
                        data.wishlist.forEach(productId => {
                            const heartIcon = document.querySelector(`#wishlist-icon-${productId}`);
                            if (heartIcon) {
                                heartIcon.classList.add('active');
                                const icon = heartIcon.querySelector('i');
                                if (icon) {
                                    icon.classList.replace('fa-regular', 'fa-solid');
                                    icon.style.color = 'red';
                                }
                            }
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }
        });

        function toggleWishlist(button, productId) {
            button.classList.toggle('active');
            const icon = button.querySelector('i');

            if (button.classList.contains('active')) {
                icon.classList.replace('fa-regular', 'fa-solid');
                icon.style.color = 'red';
            } else {
                icon.classList.replace('fa-solid', 'fa-regular');
                icon.style.color = '#718096';
            }

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
                        alert(data.error);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

    <script>
    $(document).ready(function () {
        // Initialize carousel and assign to variable
        var owl = $('.special-offer-slider').owlCarousel({
            loop: true,
            margin: 10,
            nav: true, // set to true if you want built-in buttons

            dots: false,
            autoplay: true, // ✅ enables auto movement
            autoplayTimeout: 3000, // ✅ moves every 3 seconds
            autoplayHoverPause: true, // ✅ pauses on hover
            responsive: {
                0: { items: 1 },
                400: { items: 1 },
                600: { items: 2 },
                768: { items: 2 },
                992: { items: 3 },
                1200: { items: 4 },
                1400: { items: 4 }
            }
        });

        // Custom buttons trigger

    });
</script>


    <!-- Before closing </body> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\OMC\OMCNEW\resources\views/frontend/home.blade.php ENDPATH**/ ?>