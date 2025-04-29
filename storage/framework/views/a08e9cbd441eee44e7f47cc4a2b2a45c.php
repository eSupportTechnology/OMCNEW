<?php $__env->startSection('content'); ?>
<style>
/* Style for selected color */
.color-option.selected {
    border: 2px solid #000; 
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); 
}


/* Style for selected size */
.products-size-wrapper a.selected {
    color: #000; 
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); 
}


.review-media {
    display: flex;
    gap: 10px;
    align-items: center;
}

.review-media img,
.review-media video {
    height: 100px;
    object-fit: cover;
}

</style>


<!-- Start Page Title -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2><?php echo e($product->product_name); ?></h2>
            <ul>
                <li><a href="/home">Home</a></li>
                <li>Products Details</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Start Product Details Area -->
<section class="product-details-area pt-100 pb-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-12">
                <div class="products-details-image">
                    <!-- Main Image -->
                    <div class="main-image-container" style="margin-bottom: 20px; text-align: center;">
                        <?php if($product->images->isNotEmpty()): ?>
                            <a href="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" class="glightbox">
                                <img 
                                    src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" 
                                    alt="main image" 
                                    style="width: 100%; max-height: 500px; object-fit: cover; border: 1px solid #ccc;"
                                >
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Thumbnails -->
                    <div class="slick-thumbs" style="margin-top: 20px; display: flex; justify-content: center; gap: 10px;">
                        <ul style="list-style: none; padding: 0; display: flex; gap: 10px;">
                            <?php $__currentLoopData = $product->images->slice(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <!-- Skip the first image -->
                                <li>
                                    <a href="<?php echo e(asset('storage/' . $image->image_path)); ?>" class="glightbox">
                                        <img 
                                            src="<?php echo e(asset('storage/' . $image->image_path)); ?>" 
                                            alt="thumbnail" 
                                            style="width: 70px; height: 70px; object-fit: cover; border: 1px solid #ccc; border-radius: 5px;"
                                        >
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>

                <div class="col-lg-7 col-md-12">
                    <div class="products-details-desc">
                        <h3><?php echo e($product->product_name); ?></h3>

                        <div class="price" style="font-size: 20px">
                            <?php if($sale): ?>
                                <span class="new-price">Rs. <?php echo e(number_format($sale->sale_price, 2)); ?></span>
                                <span class="old-price" style="font-size: 18px">Rs. <?php echo e(number_format($sale->normal_price, 2)); ?></span>
                                <span class="discount"><?php echo e(number_format($sale->sale_rate, 0)); ?>% off</span>
                            <?php elseif($specialOffer): ?>
                                <span class="new-price">Rs. <?php echo e(number_format($specialOffer->offer_price, 2)); ?></span>
                                <span class="old-price" style="font-size: 18px">Rs. <?php echo e(number_format($specialOffer->normal_price, 2)); ?></span>
                                <span class="discount"><?php echo e(number_format($specialOffer->offer_rate, 0)); ?>% off</span>
                            <?php else: ?>
                                <span class="new-price">Rs. <?php echo e(number_format($product->normal_price, 2)); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="products-review">
                            <div class="rating">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <?php if($averageRating >= $i): ?>
                                        <i class='bx bxs-star'></i> <!-- Full star -->
                                    <?php elseif($averageRating >= ($i - 0.5)): ?>
                                        <i class='bx bxs-star-half'></i> <!-- Half star -->
                                    <?php else: ?>
                                        <i class='bx bx-star'></i> <!-- Empty star -->
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>

                            <a href="#" class="rating-count"><?php echo e($totalReviews); ?> Ratings</a>
                        </div>

                        <ul class="products-info">
                            <li><span>Availability:</span> 
                                <?php if($product->quantity > 1): ?>
                                    <span style="color: #4caf50;">In stock</span>
                                <?php else: ?>
                                    <span style="color: red;">Out of stock</span>
                                <?php endif; ?>
                            </li>
                            <li><span>Product Description:</span> <?php echo e(strip_tags($product->product_description)); ?></li>
                        </ul>

                   <!-- Color Options -->
                            <?php if($product->variations->where('type', 'Color')->isNotEmpty()): ?>
                                <div class="products-color-switch">
                                    <span>Color:</span>
                                    <?php $__currentLoopData = $product->variations->where('type', 'Color'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($color->quantity > 0): ?>
                                            <button class="btn btn-outline-secondary btn-sm color-option" 
                                                    style="background-color: <?php echo e($color->hex_value); ?>; border-color: #e8ebec; height: 20px; width: 20px; border-radius:50%" 
                                                    data-color="<?php echo e($color->hex_value); ?>" 
                                                    data-color-name="<?php echo e($color->value); ?>">
                                            </button>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>

                            <!-- Size Options -->
                            <?php if($product->variations->where('type', 'Size')->isNotEmpty()): ?>
                                <div class="products-size-wrapper">
                                    <span>Size:</span>
                                    <ul style="list-style: none; padding: 0; display: flex; gap: 10px;">
                                        <?php $__currentLoopData = $product->variations->where('type', 'Size'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($size->quantity > 0): ?>
                                                <li>
                                                    <a href="#" class="size-option" data-size="<?php echo e($size->value); ?>">
                                                        <?php echo e($size->value); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>


                            <!--<div class="products-info-btn">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#sizeGuideModal"><i class='bx bx-crop'></i> Size guide</a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#productsShippingModal"><i class='bx bxs-truck' ></i> Shipping</a>
                                <a href="contact.html"><i class='bx bx-envelope'></i> Ask about this products</a>
                            </div>-->

                        

                            <div class="products-add-to-cart mt-4">
                                <div class="input-counter">
                                    <span class="minus-btn"><i class="bx bx-minus"></i></span>
                                    <input type="text" id="quantity" value="1" min="1">
                                    <span class="plus-btn"><i class="bx bx-plus"></i></span>
                                </div>

                                <?php if(auth()->guard()->check()): ?>
                                    <button class="default-btn" data-product-id="<?php echo e($product->product_id); ?>" id="addToCartBtn">Add to Cart</button>
                                    <button class="default-btn" id="buyNowBtn" data-product-id="<?php echo e($product->product_id); ?>">Buy Now</button>
                                <?php else: ?>
                                    <button class="default-btn" onclick="alert('Please log in to add to cart.')">Add to Cart</button>
                                    <button class="default-btn" onclick="alert('Please log in to proceed to checkout.')">Buy Now</button>
                                <?php endif; ?> <br>

                                <a href="#" class="wishlist-toggle optional-btn mt-3" data-product-id="<?php echo e($product->product_id); ?>" id="wishlist-<?php echo e($product->product_id); ?>">
                                    <i class="bx bx-heart <?php echo e(in_array($product->product_id, $wishlistProductIds) ? 'filled' : ''); ?>"></i> Add to Wishlist
                                </a>

                            </div>


                        </div>
                    </div>
                </div>


        <div class="tab products-details-tab mb-4">
            <ul class="tabs">
                <li><a href="#">
                    <div class="dot"></div> Description
                </a></li>
                
                <li><a href="#">
                    <div class="dot"></div> Additional Information
                </a></li>

                <li><a href="#">
                    <div class="dot"></div> Why Buy From Us
                </a></li>

                <li><a href="#">
                    <div class="dot"></div> Reviews
                </a></li>
            </ul>

            <div class="tab-content">
                <div class="tabs-item">
                    <div class="products-details-tab-content">
                        <p><?php echo e(strip_tags($product->product_description)); ?></p>

                    
                    </div>
                </div>

                <div class="tabs-item">
                    <div class="products-details-tab-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                        <td>Color:</td>
                                        <td>
                                            <?php $__currentLoopData = $product->variations->where('type', 'Color'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($color->quantity > 0): ?>
                                                    <span style="background-color: <?php echo e($color->hex_value); ?>; width: 20px; height: 20px; display: inline-block; border-radius: 50%;"></span>
                                                
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Size:</td>
                                        <td>
                                            <?php $__currentLoopData = $product->variations->where('type', 'Size'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($size->quantity > 0): ?>
                                                    <?php echo e($size->value); ?> 
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shipping:</td>
                                        <td>LKR 300.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

               

                <div class="tabs-item">
                    <div class="products-details-tab-content">
                        <p>Here are 5 more great reasons to buy from us:</p>

                        <ol>
                            <li>Wide Range of Products – From electronics to fashion, we offer a vast selection of high-quality items for all your needs.</li>
                            <li>Affordable Prices – Enjoy competitive pricing and amazing discounts on top-rated products..</li>
                            <li>Convenient Shopping Experience – Our easy-to-navigate website ensures a seamless shopping experience from browsing to checkout.</li>
                            <li>Secure Payment Options – Shop with confidence using our safe and reliable payment methods.</li>
                            <li>Fast and Reliable Delivery – We guarantee quick delivery, ensuring your orders reach you on time, every time.</li>
                        </ol>
                    </div>
                </div>

                <div class="tabs-item">
                    <div class="products-details-tab-content">
                        <div class="products-review-form">
                            <h3>Customer Reviews</h3>

                            <div class="review-title">
                                <div class="rating">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($averageRating >= $i): ?>
                                            <i class='bx bxs-star'></i> <!-- Full star -->
                                        <?php elseif($averageRating >= ($i - 0.5)): ?>
                                            <i class='bx bxs-star-half'></i> <!-- Half star -->
                                        <?php else: ?>
                                            <i class='bx bx-star'></i> <!-- Empty star -->
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <p>Based on <?php echo e($totalReviews); ?> reviews</p>
                            </div>


                            <div class="review-comments">
                                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="review-item">
                                        <div class="rating">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <?php if($review->rating >= $i): ?>
                                                    <i class='bx bxs-star'></i>
                                                <?php elseif($review->rating >= ($i - 0.5)): ?>
                                                    <i class='bx bxs-star-half'></i>
                                                <?php else: ?>
                                                    <i class='bx bx-star'></i>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                            
                                        </div>
                                        <h3><?php echo e($review->comment_title ?? 'Review'); ?></h3>
                                        <span>
                                            <?php if($review->is_anonymous): ?>
                                                <strong> <?php echo e(ucfirst(substr($review->user->name, 0, 1))); ?>***</strong>
                                            <?php else: ?>
                                                <strong><?php echo e($review->user->name ?? 'User'); ?></strong>
                                            <?php endif; ?>
                                            on <strong><?php echo e($review->created_at->format('M d, Y')); ?></strong>
                                        </span>
                                        <p><?php echo e($review->comment); ?></p>

                                        <?php if($review->media->isNotEmpty()): ?>
                                        <div class="review-media" style="display: flex; gap: 10px; align-items: center;">
                                            <?php $__currentLoopData = $review->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($media->media_type === 'image'): ?>
                                                    <img src="<?php echo e(asset('storage/' . $media->media_path)); ?>" alt="Review Media" class="review-image" style="height: 100px; object-fit: cover;">
                                                <?php elseif($media->media_type === 'video'): ?>
                                                    <video controls style="height: 100px; object-fit: cover;">
                                                        <source src="<?php echo e(asset('storage/' . $media->media_path)); ?>" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>


                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
<!-- End Product Details Area -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $(document).ready(function() {
    // Handle the click event on the heart icon
    $('.wishlist-toggle').on('click', function(e) {
        e.preventDefault(); 

        var productId = $(this).data('product-id'); 
        var heartIcon = $(this).find('i'); 

        $.ajax({
            url: '<?php echo e(route('wishlist.toggle')); ?>',
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
$(document).ready(function() {
    // Handle Color Selection
    if ($('.color-option').length > 0) {
        $('.color-option').on('click', function() {
            // Remove 'selected' class from all color options
            $('.color-option').removeClass('selected');
            // Add 'selected' class to the clicked color
            $(this).addClass('selected');
        });
    }

    // Handle Size Selection
    if ($('.size-option').length > 0) {
        $('.size-option').on('click', function(e) {
            e.preventDefault(); // Prevent default behavior
            const size = $(this).data('size'); // Get the size value

            // Remove 'selected' class from all size options
            $('.size-option').removeClass('selected');
            // Add 'selected' class to the clicked size
            $(this).addClass('selected');
        });

    }

    // Add to Cart Button
    $('#addToCartBtn').on('click', function(e) {
        e.preventDefault();

        const productId = $(this).data('product-id');
        const isAuth = "<?php echo e(Auth::check() ? 'true' : 'false'); ?>";
        const selectedSize = $('.size-option.selected').data('size');
        const selectedColor = $('.color-option.selected').data('color');

        // Check if there are size or color options for this product
        const hasSize = $('.size-option').length > 0;
        const hasColor = $('.color-option').length > 0;

        // Debugging: Log the selected size and color
        console.log("Size selected:", selectedSize);
        console.log("Has Size options:", hasSize);
        console.log("Color selected:", selectedColor);
        console.log("Has Color options:", hasColor);

        // If the product has size options, check if size is selected
        if (hasSize && !selectedSize) {
            toastr.warning('Please select a size before adding this product to the cart.', 'Warning', {
                positionClass: 'toast-top-right',
                timeOut: 3000,
            });
            return;
        }

        // If the product has color options, check if color is selected
        if (hasColor && !selectedColor) {
            toastr.warning('Please select a color before adding this product to the cart.', 'Warning', {
                positionClass: 'toast-top-right',
                timeOut: 3000,
            });
            return;
        }

        // Proceed to add product to cart only once
        if (isAuth === 'true') {
            $.ajax({
                url: "<?php echo e(route('cart.add')); ?>",
                method: 'POST',
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    product_id: productId,
                    size: selectedSize || null,
                    color: selectedColor || null
                },
                success: function(response) {
                    $.get("<?php echo e(route('cart.count')); ?>", function(data) {
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
});

</script>
<script>
$(document).ready(function() {
    // Handle Color Selection
    if ($('.color-option').length > 0) {
        $('.color-option').on('click', function() {
            // Remove 'selected' class from all color options
            $('.color-option').removeClass('selected');
            // Add 'selected' class to the clicked color
            $(this).addClass('selected');
        });
    }

    // Handle Size Selection
    if ($('.size-option').length > 0) {
        $('.size-option').on('click', function(e) {
            e.preventDefault(); // Prevent default behavior
            const size = $(this).data('size'); // Get the size value

            // Remove 'selected' class from all size options
            $('.size-option').removeClass('selected');
            // Add 'selected' class to the clicked size
            $(this).addClass('selected');
        });
    }

    // Buy Now Button
    $('#buyNowBtn').on('click', function(e) {
        e.preventDefault();

        const productId = $(this).data('product-id');
        const isAuth = "<?php echo e(Auth::check() ? 'true' : 'false'); ?>";
        const selectedSize = $('.size-option.selected').data('size');
        const selectedColor = $('.color-option.selected').data('color');
        const quantity = $('#quantity').val() || 1;

        // Log the values for debugging
        console.log("Product ID:", productId);
        console.log("Authenticated:", isAuth);
        console.log("Selected Size:", selectedSize);
        console.log("Selected Color:", selectedColor);
        console.log("Quantity:", quantity);

        // Check if there are size or color options for this product
        const hasSize = $('.size-option').length > 0;
        const hasColor = $('.color-option').length > 0;

        // If the product has size options, check if size is selected
        if (hasSize && !selectedSize) {
            toastr.warning('Please select a size before proceeding.', 'Warning', {
                positionClass: 'toast-top-right',
                timeOut: 3000,
            });
            return;
        }

        // If the product has color options, check if color is selected
        if (hasColor && !selectedColor) {
            toastr.warning('Please select a color before proceeding.', 'Warning', {
                positionClass: 'toast-top-right',
                timeOut: 3000,
            });
            return;
        }

        // Proceed to checkout
        if (isAuth === 'true') {
            $.ajax({
            url: "<?php echo e(route('buynow.checkout')); ?>", // POST request
            method: 'POST',
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                product_id: productId,
                size: selectedSize || null,
                color: selectedColor || null,
                quantity: quantity || 1
            },
            success: function(response) {
                console.log("Response from server:", response);
                window.location.href = response.redirect_url;
            },
            error: function(xhr) {
                console.log("Error response:", xhr.responseText);
                toastr.error('Something went wrong. Please try again.', 'Error', {
                    positionClass: 'toast-top-right',
                    timeOut: 3000,
                });
            }
        });

        } else {
            toastr.warning('Please log in to proceed to checkout.', 'Warning', {
                positionClass: 'toast-top-right',
                timeOut: 3000,
            });
        }
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/frontend/product-description.blade.php ENDPATH**/ ?>