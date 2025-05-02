<?php $__env->startSection('content'); ?>

<main style="margin-top: 58px">
    <div class="container px-5 py-5">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mb-1 mx-5">Product Details</h3>
        </div>

        <div class="card p-5 mx-5">
            <div class="row">
                <div class="col-md-7"> 
                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Product ID:</strong><?php echo e($product->product_id); ?></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Name:</strong><?php echo e($product->product_name); ?></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Images:</strong>
                            <div class="d-flex flex-wrap">
                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" alt="Product Image" class="img-thumbnail" width="100" style="margin-right: 5px;">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12">
                            <strong class="me-2">Description:</strong>
                            <?php echo $product->product_description; ?>

                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Category:</strong><?php echo e($product->product_category); ?></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">In Stock Quantity:</strong><?php echo e($product->quantity); ?></div>
                    </div>
                </div>

                <div class="col-md-5"> 
                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Normal Price:</strong> Rs <?php echo e($product->normal_price); ?></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Affiliate:</strong> <?php echo e($product->is_affiliate ? 'Yes' : 'No'); ?></div>
                    </div>

                    <?php if($product->is_affiliate): ?>
                        <div class="affiliate-fields">
                            <div class="row mb-2">
                                <div class="col-12"><strong class="me-2">Affiliate Price:</strong> Rs <?php echo e($product->affiliate_price); ?></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12"><strong class="me-2">Commission:</strong> <?php echo e($product->commission_percentage); ?>%</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12"><strong class="me-2">Total Price:</strong> Rs <?php echo e($product->total_price); ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($product->variations->where('type', 'Size')->isNotEmpty()): ?>
                        <div class="row mb-2">
                            <div class="col-12 d-flex">
                                <strong class="me-2">Sizes:</strong>
                                <?php
                                    $sizes = $product->variations->where('type', 'Size');
                                ?>
                                <ul style="list-style-type: none; padding-left: 0; margin: 0;">
                                    <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="d-inline-block me-3"><?php echo e($size['value']); ?> - <?php echo e($size['quantity']); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($product->variations->where('type', 'Color')->isNotEmpty()): ?>
                        <div class="row mb-2">
                            <div class="col-12 d-flex">
                                <strong class="me-2">Colors:</strong>
                                <ul style="list-style-type: none; padding-left: 0; margin: 0;">
                                    <?php $__currentLoopData = $product->variations->where('type', 'Color'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="d-inline-block me-3" style="vertical-align: middle;">
                                            <span style="display: inline-block; background-color: <?php echo e($color->hex_value); ?>; border: 1px solid #e8ebec; height: 20px; width: 20px;" 
                                            title="<?php echo e($color->hex_value); ?>"></span> 
                                            <span style="position: relative; top: -2px;" class="ms-1"> - <?php echo e($color['quantity']); ?></span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($product->variations->where('type', 'Material')->isNotEmpty()): ?>
                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Material:</strong>
                            <?php
                                $materials = $product->variations->where('type', 'Material'); 
                            ?>
                            <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span><?php echo e($material['value']); ?> </span>
                                <?php if(!$loop->last): ?>
                                    <span>, </span>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row mb-2">
                        <div class="col-12"><strong class="me-2">Tags :</strong><?php echo e($product->tags); ?></div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/color-name-list@4.11.0/dist/colornames.min.js"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/admin_dashboard/product-details.blade.php ENDPATH**/ ?>