<?php $__env->startSection('content'); ?>
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

                            <a href="<?php echo e(route('all-items')); ?>" class="delete-selected-filters"><i
                                    class='fa-solid fa-trash'></i> <span>Clear All</span></a>

                        </div>

                        <div class="woocommerce-widget collections-list-widget">
                            <h3 class="woocommerce-widget-title">Categories</h3>

                            <ul class="collections-list-row">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('all-items')); ?>?category=<?php echo e($category->parent_category); ?>"
                                            class="<?php echo e(request('category') === $category->parent_category ? 'active' : ''); ?>">
                                            <?php echo e($category->parent_category); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>

                        <!-- Size Filter -->
                        <div class="woocommerce-widget size-list-widget">
                            <h3 class="woocommerce-widget-title">Size</h3>
                            <ul class="size-list-row">
                                <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('all-items')); ?>?size=<?php echo e($size->value); ?>"
                                            class="<?php echo e(request('size') === $size->value ? 'active' : ''); ?>">
                                            <?php echo e($size->value); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>

                        </div>



                        <!-- Color Filter -->
                        <div class="woocommerce-widget color-list-widget">
                            <h3 class="woocommerce-widget-title">Color</h3>
                            <ul class="color-list-row">
                                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('all-items')); ?>?color=<?php echo e($color->value); ?>"
                                            style="background-color: <?php echo e($color->hex_value); ?>;"
                                            class="<?php echo e(request('color') === $color->value ? 'active' : ''); ?>"
                                            title="<?php echo e($color->value); ?>"></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <p>Showing <?php echo e($products->firstItem()); ?> – <?php echo e($products->lastItem()); ?> of
                                    <?php echo e($products->total()); ?></p>
                            </div>


                        </div>
                    </div>

                    <div id="products-collections-filter" class="row">
                        <?php if($products->isEmpty()): ?>
                            <div class="col-12">
                                <div class="no-products">
                                    <p>No products found.</p>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-4 col-md-4 col-sm-6 products-col-item">
                                    <div class="single-products-box">
                                        <div class="products-image">
                                            <a
                                                href="<?php echo e(route('product-description', ['product_id' => $product->product_id])); ?>">
                                                <?php if($product->images->isNotEmpty()): ?>
                                                    <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>"
                                                        class="main-image" alt="image" style="width: 90%; height:270px">
                                                    <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>"
                                                        class="hover-image" alt="image" style="width: 90%; height:270px">
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('storage/default-image.jpg')); ?>" class="main-image"
                                                        alt="image">
                                                <?php endif; ?>
                                            </a>
                                            <?php if(
                                                ($product->sale && $product->sale->status === 'active') ||
                                                    ($product->specialOffer && $product->specialOffer->status === 'active')): ?>
                                                <div class="sale-tag">
                                                    <?php if($product->sale && $product->sale->status === 'active'): ?>
                                                        <?php
                                                            $saleRate =
                                                                (($product->normal_price - $product->sale->sale_price) /
                                                                    $product->normal_price) *
                                                                100;
                                                        ?>
                                                        - <?php echo e(round($saleRate)); ?>% <span class="off-txt">OFF</span>
                                                    <?php elseif($product->specialOffer && $product->specialOffer->status === 'active'): ?>
                                                        <?php
                                                            $offerRate =
                                                                (($product->normal_price -
                                                                    $product->specialOffer->offer_price) /
                                                                    $product->normal_price) *
                                                                100;
                                                        ?>
                                                        - <?php echo e(round($offerRate)); ?>% <span class="off-txt">OFF</span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>


                                        </div>

                                        <div class="products-content" style="margin-left: 20px;">
                                            <h3><a
                                                    href="<?php echo e(route('product-description', ['product_id' => $product->product_id])); ?>">
                                                    <?php echo e(\Illuminate\Support\Str::limit($product->product_name, 25)); ?></a>
                                            </h3>
                                            <div class="price">
                                                <?php if($product->sale && $product->sale->status === 'active'): ?>
                                                    <span class="old-price">Rs.
                                                        <?php echo e(number_format($product->normal_price, 2)); ?></span>
                                                    <span class="new-price">Rs.
                                                        <?php echo e(number_format($product->sale->sale_price, 2)); ?></span>
                                                <?php elseif($product->specialOffer && $product->specialOffer->status === 'active'): ?>
                                                    <span class="old-price">Rs.
                                                        <?php echo e(number_format($product->normal_price, 2)); ?></span>
                                                    <span class="new-price">Rs.
                                                        <?php echo e(number_format($product->specialOffer->offer_price, 2)); ?></span>
                                                <?php else: ?>
                                                    <span class="new-price">Rs.
                                                        <?php echo e(number_format($product->normal_price, 2)); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="star-rating" style="margin-right: 10px;">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <?php if($i <= floor($product->average_rating)): ?>
                                                        <i class='fa-solid fa-star'></i>
                                                    <?php elseif($i == ceil($product->average_rating) && fmod($product->average_rating, 1) >= 0.5): ?>
                                                        <i class='fa-solid fa-star-half'></i>
                                                    <?php else: ?>
                                                        <i class='fa-solid fa-star'></i>
                                                    <?php endif; ?>
                                                <?php endfor; ?>

                                            </div>

                                            <a href="" class="add-to-cart" data-bs-toggle="modal"
                                                data-bs-target="#cartModal_<?php echo e($product->product_id); ?>">Add to Cart</a>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>


                    <?php
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
                    ?>

                    <div class="pagination-area text-center">
                        <!-- Previous Page Link -->
                        <?php if($products->onFirstPage()): ?>
                            <span class="prev page-numbers disabled"><i class='fa fa-chevron-left'></i></span>
                        <?php else: ?>
                            <a href="<?php echo e($products->previousPageUrl()); ?>" class="prev page-numbers"><i
                                    class='fa fa-chevron-left'></i></a>
                        <?php endif; ?>

                        <!-- Page Numbers (max 8) -->
                        <?php for($page = $start; $page <= $end; $page++): ?>
                            <?php if($page == $products->currentPage()): ?>
                                <span class="page-numbers current" aria-current="page"><?php echo e($page); ?></span>
                            <?php else: ?>
                                <a href="<?php echo e($products->url($page)); ?>" class="page-numbers"><?php echo e($page); ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <!-- Next Page Link -->
                        <?php if($products->hasMorePages()): ?>
                            <a href="<?php echo e($products->nextPageUrl()); ?>" class="next page-numbers"><i
                                    class='fa fa-chevron-right'></i></a>
                        <?php else: ?>
                            <span class="next page-numbers disabled"><i class='fa fa-chevron-right'></i></span>
                        <?php endif; ?>
                    </div>



                </div>
            </div>
        </div>
    </section>
    <!-- End Products Area -->

    <!-- cart modal-->
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade" id="cartModal_<?php echo e($product->product_id); ?>" tabindex="-1" aria-labelledby="cartModalLabel"
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
                                    <?php if($product->images->first()): ?>
                                        <a class="rounded-4 main-image-link"
                                            href="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>">
                                            <img id="mainImage" class="rounded-4 fit" style="width:280px; height:auto"
                                                src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" />
                                        </a>
                                    <?php else: ?>
                                        <a class="rounded-4 main-image-link" href="<?php echo e(asset('images/default.jpg')); ?>">
                                            <img id="mainImage" class="rounded-4 fit"
                                                src="<?php echo e(asset('images/default.jpg')); ?>" />
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="d-flex justify-content-center mb-3">
                                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="mx-1 rounded-2 thumbnail-image"
                                            data-image="<?php echo e(asset('storage/' . $image->image_path)); ?>"
                                            href="javascript:void(0);">
                                            <img class="thumbnail rounded-2"
                                                src="<?php echo e(asset('storage/' . $image->image_path)); ?>"
                                                style="width:70px; height:auto" />
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </aside>

                            <main class="col-lg-7">
                                <h4><?php echo e($product->product_name); ?></h4>
                                <p class="description">
                                    <?php echo e(str_replace('&nbsp;', ' ', strip_tags($product->product_description))); ?>

                                </p>
                                <div class="d-flex flex-row my-3">
                                    <div class="text-warning mb-1 me-2">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= floor($product->average_rating)): ?>
                                                <i class='fa fa-star'></i>
                                            <?php elseif($i == ceil($product->average_rating) && fmod($product->average_rating, 1) >= 0.5): ?>
                                                <i class='fa fa-star-half'></i>
                                            <?php else: ?>
                                                <i class='fa fa-star'></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <span class="ms-1"><?php echo e(number_format($product->average_rating, 1)); ?></span>
                                    </div>
                                    <span class="text-primary"><?php echo e($product->rating_count); ?> Ratings </span>

                                </div>
                                <hr />

                                <div class="product-availability mt-3 mb-1">
                                    <span>Availability :</span>
                                    <?php if($product->quantity > 1): ?>
                                        <span class="ms-1" style="color:#4caf50;">In stock</span>
                                    <?php else: ?>
                                        <span class="ms-1" style="color:red;">Out of stock</span>
                                    <?php endif; ?>
                                </div>

                                <div class="product-container">
                                    <!-- Size Options -->
                                    <?php if($product->variations->where('type', 'Size')->isNotEmpty()): ?>
                                        <div class="mb-2">
                                            <span>Size: </span>
                                            <?php $__currentLoopData = $product->variations->where('type', 'Size'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($size->quantity > 0): ?>
                                                    <button class="btn btn-outline-secondary btn-sm me-1 size-option"
                                                        style="height:28px;" data-size="<?php echo e($size->value); ?>">
                                                        <?php echo e($size->value); ?>

                                                    </button>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- Color Options -->
                                    <?php if($product->variations->where('type', 'Color')->isNotEmpty()): ?>
                                        <div class="mb-2">
                                            <span>Color: </span>
                                            <?php $__currentLoopData = $product->variations->where('type', 'Color'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($color->quantity > 0): ?>
                                                    <button class="btn btn-outline-secondary btn-sm color-option"
                                                        style="background-color: <?php echo e($color->hex_value); ?>; border-color: #e8ebec; height: 17px; width: 15px;"
                                                        data-color="<?php echo e($color->hex_value); ?>"
                                                        data-color-name="<?php echo e($color->value); ?>">
                                                    </button>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="product-price mb-3 mt-3 d-flex align-items-center">
                                        <span class="h4" style="color:#f55b29; margin-right: 10px;">
                                            <?php if($product->sale && $product->sale->status === 'active'): ?>
                                                <span class="sale-price">Rs.
                                                    <?php echo e(number_format($product->sale->sale_price, 2)); ?></span>
                                            <?php elseif($product->specialOffer && $product->specialOffer->status === 'active'): ?>
                                                <span class="offer-price">Rs.
                                                    <?php echo e(number_format($product->specialOffer->offer_price, 2)); ?></span>
                                            <?php else: ?>
                                                Rs. <?php echo e(number_format($product->normal_price, 2)); ?>

                                            <?php endif; ?>
                                        </span>
                                    </div>

                                    <?php if(auth()->guard()->check()): ?>
                                        <a href="#"
                                            class="btn btn-custom-cart mb-3 add-to-cart-modal shadow-0 <?php echo e($product->quantity <= 1 ? 'btn-disabled' : ''); ?>"
                                            data-product-id="<?php echo e($product->product_id); ?>" data-auth="true"
                                            style="width: 40%; background-color: #007bff; color: white;">
                                            <i class="me-1 fa fa-shopping-basket"></i>Add to cart
                                        </a>
                                    <?php else: ?>
                                        <a href="#"
                                            class="btn btn-custom-cart mb-3 add-to-cart-modal shadow-0 <?php echo e($product->quantity <= 1 ? 'btn-disabled' : ''); ?>"
                                            data-product-id="<?php echo e($product->product_id); ?>" data-auth="false"
                                            style="width: 40%; background-color: #007bff; color: white;">
                                            <i class="me-1 fa fa-shopping-basket"></i>Add to cart
                                        </a>
                                    <?php endif; ?>

                                </div>

                                <a href="<?php echo e(route('product-description', $product->product_id)); ?>"
                                    style="text-decoration: none; font-size:14px; color: #297aa5">
                                    View Full Details<i class="fa-solid fa-circle-right ms-1"></i></a>
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

                            <a href="<?php echo e(route('all-items')); ?>" class="delete-selected-filters"><i
                                    class='fa fa-trash'></i> <span>Clear All</span></a>

                        </div>

                        <div class="woocommerce-widget collections-list-widget">
                            <h3 class="woocommerce-widget-title">Categories</h3>

                            <ul class="collections-list-row">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('all-items')); ?>?category=<?php echo e($category->parent_category); ?>"
                                            class="<?php echo e(request('category') === $category->parent_category ? 'active' : ''); ?>">
                                            <?php echo e($category->parent_category); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>

                        <!-- Size Filter -->
                        <div class="woocommerce-widget size-list-widget">
                            <h3 class="woocommerce-widget-title">Size</h3>
                            <ul class="size-list-row">
                                <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('all-items')); ?>?size=<?php echo e($size->value); ?>"
                                            class="<?php echo e(request('size') === $size->value ? 'active' : ''); ?>">
                                            <?php echo e($size->value); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>

                        </div>



                        <!-- Color Filter -->
                        <div class="woocommerce-widget color-list-widget">
                            <h3 class="woocommerce-widget-title">Color</h3>
                            <ul class="color-list-row">
                                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('all-items')); ?>?color=<?php echo e($color->value); ?>"
                                            style="background-color: <?php echo e($color->hex_value); ?>;"
                                            class="<?php echo e(request('color') === $color->value ? 'active' : ''); ?>"
                                            title="<?php echo e($color->value); ?>">
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        url: "<?php echo e(route('cart.add')); ?>",
                        method: 'POST',
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            product_id: productId,
                            size: selectedSize,
                            color: selectedColor
                        },
                        success: function(response) {
                            // Update cart count
                            $.get("<?php echo e(route('cart.count')); ?>", function(data) {
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
                            window.location.href = "<?php echo e(route('login')); ?>";
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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\OMC\OMCNEW\resources\views/frontend/all_items.blade.php ENDPATH**/ ?>