<?php $__env->startSection('content'); ?>

<style>
/* Hot Deals Product Grid Styles */

/* Container and Layout */
.hot-deals-container {
    margin-top: 2rem;
    margin-bottom: 2rem;
}

.deal-items {
    position: relative;
    padding: 1.25rem;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    background: #ffffff;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.deal-items:hover {
    border-color: #007bff;
    box-shadow: 0 8px 25px rgba(0, 123, 255, 0.15);
    transform: translateY(-2px);
}

/* Checkbox Styling */
.select-item-checkbox {
    position: absolute;
    left: 12px;
    top: 12px;
    width: 18px;
    height: 18px;
    cursor: pointer;
    z-index: 2;
    accent-color: #007bff;
}

/* Product Image */
.deal-items img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 1rem;
    transition: transform 0.3s ease;
}

.deal-items:hover img {
    transform: scale(1.02);
}

/* Product Name */
.deal-items p {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.75rem;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Price Styling */
.price {
    font-size: 1.25rem;
    font-weight: 700;
    color: #28a745;
    margin-bottom: 0.75rem;
}

/* Commission Styling */
.commission {
    font-size: 0.9rem;
    color: #6c757d;
    background-color: #f8f9fa;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    margin-bottom: 1rem;
    border-left: 3px solid #ffc107;
}

/* Color Options */
.products-color-switch {
    margin-bottom: 1rem;
}

.products-color-switch span {
    font-size: 0.9rem;
    font-weight: 600;
    color: #495057;
    display: block;
    margin-bottom: 0.5rem;
}

.color-options-container {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.color-option {
    width: 32px;
    height: 32px;
    border: 2px solid #dee2e6;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.2s ease;
    position: relative;
    padding: 0;
}

.color-option:hover {
    border-color: #007bff;
    transform: scale(1.1);
}

.color-option.selected {
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.color-option::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-weight: bold;
    font-size: 12px;
    opacity: 0;
    transition: opacity 0.2s ease;
}

.color-option.selected::after {
    opacity: 1;
}

/* Size Options */
.products-size-wrapper {
    margin-bottom: 1rem;
}

.products-size-wrapper span {
    font-size: 0.9rem;
    font-weight: 600;
    color: #495057;
    display: block;
    margin-bottom: 0.5rem;
}

.products-size-wrapper .list-inline {
    margin: 0;
    padding: 0;
}

.size-option {
    min-width: 45px;
    height: 35px;
    padding: 0.25rem 0.75rem;
    font-size: 0.85rem;
    font-weight: 500;
    border: 1px solid #ced4da;
    border-radius: 6px;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.size-option:hover {
    border-color: #007bff;
    background-color: #f8f9ff;
    color: #007bff;
    text-decoration: none;
}

.size-option.selected {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}

/* Action Buttons */
.btn_promote,.btn_promote2
.btn_add_to_cart_affiliate {
    padding: 0.75rem 1rem;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
}

.btn_promote,.btn_promote2 {
    background: linear-gradient(135deg, #007bff, #0056b3);
    border: none;
    margin-bottom: 0.75rem;
}

.btn_promote:hover,.btn_promote2:hover {
    background: linear-gradient(135deg, #0056b3, #004085);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
}

.btn_add_to_cart_affiliate {
    background: linear-gradient(135deg, #28a745, #1e7e34);
    border: none;
    margin-top: auto;
}

.btn_add_to_cart_affiliate:hover {
    background: linear-gradient(135deg, #1e7e34, #155724);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

/* Modal Styling */
.modal-content {
    border-radius: 12px;
    border: none;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
}

.modal-header {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-bottom: 1px solid #dee2e6;
    border-radius: 12px 12px 0 0;
    padding: 1.25rem 1.5rem;
}

.modal-title {
    font-weight: 600;
    color: #495057;
}

.modal-body {
    padding: 1.5rem;
}

/* Product Images in Modal */
#productImagesContainer img {
    border-radius: 8px;
    transition: transform 0.2s ease;
    border: 2px solid transparent;
}

#productImagesContainer img:hover {
    transform: scale(1.05);
    border-color: #007bff;
}

.image-wrapper {
    position: relative;
}

.image-checkbox {
    width: 20px;
    height: 20px;
    accent-color: #007bff;
}

/* Form Controls */
.form-control {
    border-radius: 8px;
    border: 1px solid #ced4da;
    padding: 0.75rem 1rem;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Responsive Design */
@media (max-width: 768px) {
    .deal-items {
        margin-bottom: 1.5rem;
    }
    
    .modal-dialog {
        margin: 1rem;
    }
    
    .color-options-container {
        justify-content: center;
    }
    
    .products-size-wrapper .list-inline {
        text-align: center;
    }
    
    .btn_promote,
    .btn_add_to_cart_affiliate {
        font-size: 0.85rem;
        padding: 0.65rem 0.85rem;
    }
}

@media (max-width: 576px) {
    .hot-deals-container {
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
    
    .deal-items {
        padding: 1rem;
    }
    
    .deal-items img {
        height: 180px;
    }
    
    .price {
        font-size: 1.1rem;
    }
    
    .commission {
        font-size: 0.8rem;
        padding: 0.4rem 0.6rem;
    }
}

/* Loading States */
.btn.loading {
    position: relative;
    color: transparent;
}

.btn.loading::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    top: 50%;
    left: 50%;
    margin-left: -8px;
    margin-top: -8px;
    border: 2px solid transparent;
    border-top-color: #ffffff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Utility Classes */
.text-truncate-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.shadow-hover {
    transition: box-shadow 0.3s ease;
}

.shadow-hover:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}
    
</style>
<main style="margin-top: 58px">
    <div class="container pt-4 px-4">
        <h3 class="py-3">AD Center</h3>
        <ul class="nav nav-tabs mb-3" id="myTab0" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab0" data-bs-toggle="tab" data-bs-target="#hot_deals" type="button"
                    role="tab" aria-controls="hot_deals" aria-selected="true">
                    Hot Deals
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="commision-tab0" data-bs-toggle="tab" data-bs-target="#commision" type="button"
                    role="tab" aria-controls="commision" aria-selected="false">
                    Higher Commission
                </button>
            </li>
        </ul>

        <div class="card">
            <div class="card-body">
                <div class="tab-content" id="myTabContent0">
                    <!-- Hot Deals -->
                    <div class="tab-pane fade show active" id="hot_deals" role="tabpanel" aria-labelledby="home-tab0">
                        <form id="hotDealsForm" method="GET" action="<?php echo e(route('ad_center')); ?>">
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <select id="categoriesHotDeals" name="category" class="form-select" style="font-size: 0.8rem;">
                                        <option value="all" <?php echo e(request('category') == 'all' ? 'selected' : ''); ?>>All Categories</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->parent_category); ?>" <?php echo e(request('category') == $category->parent_category ? 'selected' : ''); ?>>
                                                <?php echo e($category->parent_category); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-1 mb-5">
                                    <label id="selectedCountLabel" style="font-size: 0.9rem;">
                                        Selected: <span id="selectedCount">0</span>
                                    </label>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <button type="button" id="toggleSelectAll" class="btn btn-secondary btn-sm" style="font-size: 0.7rem;">
                                        Select All
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="container mt-6 mb-5">
                            <div class="row">
                                <?php $__currentLoopData = $hotDeals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <div class="col-md-3 mb-7">
                                            <div class="deal-items position-relative p-3 border rounded">

                                                <!-- Checkbox -->
                                                <input type="checkbox" class="select-item-checkbox" data-product-id="<?php echo e($product->product_id); ?>" style="position: absolute; left: 12px; top: 12px;">

                                                <!-- Product Image and Info -->
                                                <?php if($product->images->isNotEmpty()): ?>
                                                    <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" alt="<?php echo e($product->product_name); ?>" class="img-fluid mb-2">
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('storage/default-image.png')); ?>" alt="Default Image" class="img-fluid mb-2">
                                                <?php endif; ?>

                                                <p><?php echo e($product->product_name); ?></p>
                                                <div class="price mb-2">Rs.<?php echo e($product->affiliate_price); ?></div>

                                                <?php
                                                    $commissionPrice = $product->total_price - $product->affiliate_price;
                                                ?>
                                                <div class="commission mb-2">
                                                    Est. Commission Rs. <?php echo e($commissionPrice); ?> | <?php echo e($product->commission_percentage); ?>%
                                                </div>

                                                <!-- Color Options -->
                                                <?php if($product->variations->where('type', 'Color')->isNotEmpty()): ?>
                                                    <div class="products-color-switch mb-2">
                                                        <span>Color:</span>
                                                        <div class="color-options-container d-flex gap-1 mt-1">
                                                            <?php $__currentLoopData = $product->variations->where('type', 'Color'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($color->quantity > 0): ?>
                                                                    <button class="color-option btn border rounded-circle"
                                                                        style="width: 24px; height: 24px; background-color: <?php echo e($color->hex_value); ?>;"
                                                                        data-color="<?php echo e($color->hex_value); ?>"
                                                                        data-color-name="<?php echo e($color->value); ?>"
                                                                        data-product-id="<?php echo e($product->product_id); ?>"
                                                                        title="<?php echo e($color->value); ?>">
                                                                    </button>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <!-- Size Options -->
                                                <?php if($product->variations->where('type', 'Size')->isNotEmpty()): ?>
                                                    <div class="products-size-wrapper mb-2">
                                                        <span>Size:</span>
                                                        <ul class="list-inline mt-1">
                                                            <?php $__currentLoopData = $product->variations->where('type', 'Size'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($size->quantity > 0): ?>
                                                                    <li class="list-inline-item me-2">
                                                                        <a href="javascript:void(0)" class="size-option btn btn-outline-secondary btn-sm"
                                                                        data-size="<?php echo e($size->value); ?>"
                                                                        data-product-id="<?php echo e($product->product_id); ?>">
                                                                            <?php echo e($size->value); ?>

                                                                        </a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>

                                                <!-- Hidden inputs for selected values -->
                                                <input type="hidden" class="selected-color" id="color-<?php echo e($product->product_id); ?>">
                                                <input type="hidden" class="selected-size" id="size-<?php echo e($product->product_id); ?>">

                                                <!-- Action Buttons -->
                                                <a href="#" class="btn btn-primary btn_promote w-100 mb-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#promoteModal-<?php echo e($product->product_id); ?>">
                                                    Promote Now
                                                </a>

                                                <button class="btn btn-success btn_add_to_cart_affiliate w-100"
                                                        data-product-id="<?php echo e($product->product_id); ?>">
                                                    Buy Now
                                                </button>
                                            </div>
                                        </div>


                                    <!-- Promote Modal -->
                                    <div class="modal fade" id="promoteModal-<?php echo e($product->product_id); ?>" tabindex="-1" aria-labelledby="promoteModalLabel-<?php echo e($product->product_id); ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="promoteModalLabel-<?php echo e($product->product_id); ?>">Promo Items for <?php echo e($product->product_name); ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Product Images -->
                                                    <?php if($product->images->count() > 0): ?>
                                                        <div class="d-flex mb-3">
                                                            <div class="me-3">
                                                                <p>Pictures:</p>
                                                            </div>
                                                            <div id="productImagesContainer-<?php echo e($product->product_id); ?>" class="d-flex flex-wrap">
                                                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div class="image-wrapper position-relative mb-2 me-2">
                                                                        <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" alt="Product Image" class="img-fluid" width="100px" data-image-id="<?php echo e($image->id); ?>" style="cursor: pointer;">
                                                                        <input type="checkbox" class="position-absolute top-0 start-0 m-2 image-checkbox" style="z-index: 1; display: none;">
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>

                                                        <!-- Download Buttons -->
                                                        <div class="d-flex mb-3">
                                                            <button id="downloadAllBtn" class="btn btn-primary me-2">Download All Images</button>
                                                            <button id="downloadSelectedBtn" class="btn btn-secondary" disabled>Download Selected Images</button>
                                                        </div>
                                                    <?php else: ?>
                                                        <p>No images available for this product.</p>
                                                    <?php endif; ?>

                                                    <!-- Promo Link Section -->
                                                    <div class="mb-3">
                                                        <label for="promoLink-<?php echo e($product->product_id); ?>" class="form-label">Product Link:</label>
                                                        <input type="text" id="promoLink-<?php echo e($product->product_id); ?>" class="form-control" 
                                                            value="<?php echo e(url('product/' . $product->product_id)); ?>" readonly>
                                                        <button type="button" class="btn btn-secondary mt-2" onclick="copyLink('<?php echo e($product->product_id); ?>')">Copy Link</button>
                                                    </div>

                                                    <!-- Promo Materials Section -->
                                                    <div class="mb-3">
                                                        <h5>Promo Materials</h5>
                                                        <p>Copy and share the promo materials below:</p>
                                                        <textarea id="promoMaterial-<?php echo e($product->product_id); ?>" class="form-control" rows="5" readonly>
                                                            Product: <?php echo e($product->product_name); ?>

                                                            Description: <?php echo e($product->product_description); ?>

                                                            Original price: LKR <?php echo e(number_format($product->total_price, 2)); ?>

                                                        </textarea>
                                                        <button type="button" class="btn btn-primary mt-2" onclick="copyPromoMaterial('<?php echo e($product->product_id); ?>')">Copy Promo Material</button>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Higher Commission -->
                    <div class="tab-pane fade" id="commision" role="tabpanel" aria-labelledby="commision-tab0">
                        <form id="highComForm" method="GET" action="<?php echo e(route('ad_center')); ?>#commision">
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <select id="categoriesHighCom" name="category" class="form-select" style="font-size: 0.8rem;">
                                        <option value="all" <?php echo e(request('category') == 'all' ? 'selected' : ''); ?>>All Categories</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->parent_category); ?>" <?php echo e(request('category') == $category->parent_category ? 'selected' : ''); ?>>
                                                <?php echo e($category->parent_category); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-1 mb-3">
                                    <label id="selectedCountLabel" style="font-size: 0.9rem;">
                                        Selected: <span id="selectedCount2">0</span>
                                    </label>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <button type="button" id="toggleSelectAll2" class="btn btn-secondary btn-sm" style="font-size: 0.7rem;">
                                        Select All
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <?php $__currentLoopData = $highCom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-3 mb-7">
                                    <div class="deal-items">
                                        <input type="checkbox" class="select-item-checkbox2" data-product-id="<?php echo e($product->id); ?>" style="position: absolute; left: 12px;">
                                        <a href="#">
                                            <?php if($product->images->isNotEmpty()): ?>
                                                <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" alt="<?php echo e($product->product_name); ?>" class="img-fluid">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('storage/default-image.png')); ?>" alt="Default Image" class="img-fluid">
                                            <?php endif; ?>
                                            <p><?php echo e($product->product_name); ?></p>
                                            <div class="price mb-2">Rs.<?php echo e($product->total_price); ?></div>
                                            <?php
                                                $commissionPrice = $product->total_price - $product->affiliate_price;
                                            ?>
                                            <div class="commission mb-2">
                                                Est. Commission Rs. <?php echo e($commissionPrice); ?> | <?php echo e($product->commission_percentage); ?>%
                                            </div>
                                             <!-- Color Options -->
                                                <?php if($product->variations->where('type', 'Color')->isNotEmpty()): ?>
                                                    <div class="products-color-switch mb-2">
                                                        <span>Color:</span>
                                                        <div class="color-options-container d-flex gap-1 mt-1">
                                                            <?php $__currentLoopData = $product->variations->where('type', 'Color'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($color->quantity > 0): ?>
                                                                    <button class="color-option btn border rounded-circle"
                                                                        style="width: 24px; height: 24px; background-color: <?php echo e($color->hex_value); ?>;"
                                                                        data-color="<?php echo e($color->hex_value); ?>"
                                                                        data-color-name="<?php echo e($color->value); ?>"
                                                                        data-product-id="<?php echo e($product->product_id); ?>"
                                                                        title="<?php echo e($color->value); ?>">
                                                                    </button>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <!-- Size Options -->
                                                <?php if($product->variations->where('type', 'Size')->isNotEmpty()): ?>
                                                    <div class="products-size-wrapper mb-2">
                                                        <span>Size:</span>
                                                        <ul class="list-inline mt-1">
                                                            <?php $__currentLoopData = $product->variations->where('type', 'Size'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($size->quantity > 0): ?>
                                                                    <li class="list-inline-item me-2">
                                                                        <a href="javascript:void(0)" class="size-option btn btn-outline-secondary btn-sm"
                                                                        data-size="<?php echo e($size->value); ?>"
                                                                        data-product-id="<?php echo e($product->product_id); ?>">
                                                                            <?php echo e($size->value); ?>

                                                                        </a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>

                                                <!-- Hidden inputs for selected values -->
                                                <input type="hidden" class="selected-color" id="color-<?php echo e($product->product_id); ?>">
                                                <input type="hidden" class="selected-size" id="size-<?php echo e($product->product_id); ?>">

                                            <a href="#" class="btn btn-primary btn_promote w-100 mb-2" data-bs-toggle="modal" data-bs-target="#promoteModal2-<?php echo e($product->id); ?>">
                                                Promote Now
                                            </a>

                                            <button class="btn btn-success btn_add_to_cart_affiliate w-100"
                                                        data-product-id="<?php echo e($product->product_id); ?>">
                                                    Buy Now
                                                </button>
                                        </a>
                                    </div>
                                </div>

                                <!-- Higher Commission Promote Modal -->
                                <div class="modal fade" id="promoteModal2-<?php echo e($product->id); ?>" tabindex="-1" aria-labelledby="promoteModalLabel2-<?php echo e($product->id); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="promoteModalLabel2-<?php echo e($product->id); ?>">Promo Items for <?php echo e($product->product_name); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Product Images -->
                                                <?php if($product->images->count() > 0): ?>
                                                    <div class="d-flex mb-3">
                                                        <div class="me-3">
                                                            <p>Pictures:</p>
                                                        </div>
                                                        <div id="productImagesContainer-<?php echo e($product->product_id); ?>" class="d-flex flex-wrap">
                                                            <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="image-wrapper position-relative mb-2 me-2">
                                                                    <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" alt="Product Image" class="img-fluid" width="100px" data-image-id="<?php echo e($image->id); ?>" style="cursor: pointer;">
                                                                    <input type="checkbox" class="position-absolute top-0 start-0 m-2 image-checkbox" style="z-index: 1; display: none;">
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>

                                                    <!-- Download Buttons -->
                                                    <div class="d-flex mb-3">
                                                        <button id="downloadAllBtn" class="btn btn-primary me-2">Download All Images</button>
                                                        <button id="downloadSelectedBtn" class="btn btn-secondary" disabled>Download Selected Images</button>
                                                    </div>
                                                <?php else: ?>
                                                    <p>No images available for this product.</p>
                                                <?php endif; ?>

                                                <!-- Promo Link Section -->
                                                <div class="mb-3">
                                                    <label for="promoLink-<?php echo e($product->product_id); ?>" class="form-label">Product Link:</label>
                                                    <input type="text" id="promoLink-<?php echo e($product->product_id); ?>" class="form-control" 
                                                        value="<?php echo e(url('product/' . $product->product_id)); ?>" readonly>
                                                    <button type="button" class="btn btn-secondary mt-2" onclick="copyLink('<?php echo e($product->product_id); ?>')">Copy Link</button>
                                                </div>

                                                <!-- Promo Materials Section -->
                                                <div class="mb-3">
                                                    <h5>Promo Materials</h5>
                                                    <p>Copy and share the promo materials below:</p>
                                                    <textarea id="promoMaterial-<?php echo e($product->product_id); ?>" class="form-control" rows="5" readonly>
                                                        Product: <?php echo e($product->product_name); ?>

                                                        Description: <?php echo e($product->product_description); ?>

                                                        Original price: LKR <?php echo e(number_format($product->total_price, 2)); ?>

                                                    </textarea>
                                                    <button type="button" class="btn btn-primary mt-2" onclick="copyPromoMaterial('<?php echo e($product->product_id); ?>')">Copy Promo Material</button>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    </div>
</main>





<script>
    document.addEventListener('DOMContentLoaded', function() {
        var categorySelectHotDeals = document.getElementById('categoriesHotDeals');
        var categorySelectHighCom = document.getElementById('categoriesHighCom');

        categorySelectHotDeals.addEventListener('change', function() {
            document.getElementById('hotDealsForm').submit();
        });

        categorySelectHighCom.addEventListener('change', function() {
            document.getElementById('highComForm').submit();
        });
    });

    //Hot Deals selection
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.select-item-checkbox');
        const selectedCountLabel = document.getElementById('selectedCount');
        const toggleSelectAllButton = document.getElementById('toggleSelectAll');

        function updateSelectedCount() {
            const selectedCount = document.querySelectorAll('.select-item-checkbox:checked').length;
            selectedCountLabel.textContent = selectedCount;
        }

        toggleSelectAllButton.addEventListener('click', function () {
            const allSelected = [...checkboxes].every(checkbox => checkbox.checked);

            if (allSelected) {
                checkboxes.forEach(checkbox => checkbox.checked = false);
                toggleSelectAllButton.textContent = 'Select All';
            } else {
                checkboxes.forEach(checkbox => checkbox.checked = true);
                toggleSelectAllButton.textContent = 'Deselect All';
            }

            updateSelectedCount();
        });

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', updateSelectedCount);
        });
    });


    //Higher Commission selection
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.select-item-checkbox2');
        const selectedCountLabel = document.getElementById('selectedCount2');
        const toggleSelectAllButton = document.getElementById('toggleSelectAll2');

        function updateSelectedCount() {
            const selectedCount = document.querySelectorAll('.select-item-checkbox2:checked').length;
            selectedCountLabel.textContent = selectedCount;
        }

        toggleSelectAllButton.addEventListener('click', function () {
            const allSelected = [...checkboxes].every(checkbox => checkbox.checked);

            if (allSelected) {
                checkboxes.forEach(checkbox => checkbox.checked = false);
                toggleSelectAllButton.textContent = 'Select All';
            } else {
                checkboxes.forEach(checkbox => checkbox.checked = true);
                toggleSelectAllButton.textContent = 'Deselect All';
            }

            updateSelectedCount();
        });

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', updateSelectedCount);
        });
    });


//download images
document.addEventListener('DOMContentLoaded', function() {
    const imageWrappers = document.querySelectorAll('.image-wrapper');
    const downloadAllBtn = document.getElementById('downloadAllBtn');
    const downloadSelectedBtn = document.getElementById('downloadSelectedBtn');

    imageWrappers.forEach(wrapper => {
        const img = wrapper.querySelector('img');
        const checkbox = wrapper.querySelector('.image-checkbox');

        img.addEventListener('click', () => {
            checkbox.checked = !checkbox.checked;
            checkbox.style.display = checkbox.checked ? 'block' : 'none';
            updateDownloadSelectedBtn();
        });

        checkbox.addEventListener('change', () => {
            updateDownloadSelectedBtn();
        });
    });

    downloadAllBtn.addEventListener('click', () => {
        const allImageIds = Array.from(document.querySelectorAll('.image-wrapper img')).map(img => img.getAttribute('data-image-id'));
        downloadImages(allImageIds);
    });

    downloadSelectedBtn.addEventListener('click', () => {
        const selectedImageIds = Array.from(document.querySelectorAll('.image-checkbox:checked')).map(cb => cb.previousElementSibling.getAttribute('data-image-id'));
        if (selectedImageIds.length > 0) {
            downloadImages(selectedImageIds);
        }
    });

    function updateDownloadSelectedBtn() {
        const anyImageChecked = document.querySelector('.image-checkbox:checked') !== null;
        downloadSelectedBtn.disabled = !anyImageChecked;
    }

    function downloadImages(imageIds) {
        if (imageIds.length > 0) {
            window.location.href = `/affiliate/dashboard/ad_center/download-images?ids=${imageIds.join(',')}`;
        }
    }
});


//refreshing the tabs
    document.addEventListener('DOMContentLoaded', function() {
        var hash = window.location.hash;

        document.querySelectorAll('.nav-link').forEach(function(navLink) {
            navLink.classList.remove('active');
            navLink.setAttribute('aria-selected', 'false');
        });
        document.querySelectorAll('.tab-pane').forEach(function(tabPane) {
            tabPane.classList.remove('show', 'active');
        });

        if (hash) {
            var tabLink = document.querySelector('.nav-link[data-bs-target="' + hash + '"]');
            var tabPane = document.querySelector(hash);
            if (tabLink && tabPane) {
                tabLink.classList.add('active');
                tabLink.setAttribute('aria-selected', 'true');
                tabPane.classList.add('show', 'active');
            }
        } else {
            var defaultTab = document.querySelector('.nav-link[data-bs-target="#hot_deals"]');
            var defaultPane = document.querySelector('#hot_deals');
            if (defaultTab && defaultPane) {
                defaultTab.classList.add('active');
                defaultTab.setAttribute('aria-selected', 'true');
                defaultPane.classList.add('show', 'active');
            }
        }
    });
</script>

<script>
    function copyPromoMaterial(productId) {
        // Get the promo material textarea
        var promoMaterialTextarea = document.getElementById('promoMaterial-' + productId);

        // Select the text inside the textarea
        promoMaterialTextarea.select();
        promoMaterialTextarea.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text to the clipboard
        document.execCommand('copy');

        // Optionally, show an alert or notification
        alert('Promo material copied to clipboard!');
    }
</script>

<script>
    function copyPromoMaterial(productId) {
        // Get the promo material textarea
        var promoMaterialTextarea = document.getElementById('promoMaterial-' + productId);

        // Select the text inside the textarea
        promoMaterialTextarea.select();
        promoMaterialTextarea.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text to the clipboard
        document.execCommand('copy');

        // Optionally, show an alert or notification
        alert('Promo material copied to clipboard!');
    }
</script>

<script>
    function copyLink(productId) {
        const promoLink = document.getElementById(`promoLink-${productId}`);
        promoLink.select();
        document.execCommand("copy");
        alert("Product link copied to clipboard!");
    }

    function copyPromoMaterial(productId) {
        const promoMaterial = document.getElementById(`promoMaterial-${productId}`);
        promoMaterial.select();
        document.execCommand("copy");
        alert("Promo material copied to clipboard!");
    }
</script>





<script>
document.addEventListener('DOMContentLoaded', function () {
    // ✅ Handle color selection
    document.querySelectorAll(".color-option").forEach(btn => {
        btn.addEventListener("click", function () {
            const productId = this.dataset.productId;
            const colorValue = this.dataset.colorName;
            document.getElementById(`color-${productId}`).value = colorValue;

            // Highlight selected color
            document.querySelectorAll(`.color-option[data-product-id="${productId}"]`).forEach(b => b.classList.remove("border-3", "border-dark"));
            this.classList.add("border-3", "border-dark");
        });
    });

    // ✅ Handle size selection
    document.querySelectorAll(".size-option").forEach(btn => {
        btn.addEventListener("click", function () {
            const productId = this.dataset.productId;
            const sizeValue = this.dataset.size;
            document.getElementById(`size-${productId}`).value = sizeValue;

            // Highlight selected size
            document.querySelectorAll(`.size-option[data-product-id="${productId}"]`).forEach(b => b.classList.remove("active"));
            this.classList.add("active");
        });
    });

  // Handle "Buy Now" button
document.querySelectorAll('.btn_add_to_cart_affiliate').forEach(button => {
    button.addEventListener('click', function (e) {
        e.preventDefault();

        const productId = this.dataset.productId;

        // Get color and size; default to 'no' if empty
        const selectedColor = document.getElementById(`color-${productId}`).value || 'no';
        const selectedSize = document.getElementById(`size-${productId}`).value || 'no';

        const url = new URL('/affiliate/checkout', window.location.origin);
        url.searchParams.set('product_id', productId);
        url.searchParams.set('color', selectedColor);
        url.searchParams.set('size', selectedSize);

        window.location.href = url.toString();
    });
});

});
</script>










<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.affiliate_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\OMCNEW\resources\views/affiliate_dashboard/ad_center.blade.php ENDPATH**/ ?>