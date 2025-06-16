<?php $__env->startSection('dashboard-content'); ?>
<style>
    .review-images {
        display: flex;
        gap: 10px;
    }

    .review-images img {
        width: 10%;
        height: auto;
        object-fit: cover;
    }
   

</style>
<?php if(session('status')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success("<?php echo e(session('status')); ?>", 'Success', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
<?php endif; ?>

<h4 class="py-2 px-2">My Reviews</h4>
<div class="d-flex justify-content-between align-items-center mt-4">
    <div class="button-tabs">
        <button class="tab-button mb-1 active" data-target="to-be-reviewed">To be Reviewed (<?php echo e($toBeReviewedItems->count()); ?>)</button>
        <button class="tab-button mb-1" data-target="history">History (<?php echo e($reviewedItems->count()); ?>)</button>
    </div>
</div>

<!-- To be reviewed Tab -->
<div id="to-be-reviewed" class="tab-content active">
    <div class="order-items mt-3">
        <div class="order-items-list px-3">
                <?php $__currentLoopData = $toBeReviewedItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="order-item d-flex align-items-center justify-content-between" style="padding: 10px; border-bottom: 1px solid #eaeaea;">
                    <div style="display: flex; align-items: center;">
                        <div style="margin-right: 15px;">
                            <?php if($item->product->images->isNotEmpty()): ?>
                                <a href="#"><img src="<?php echo e(asset('storage/' . $item->product->images->first()->image_path)); ?>" alt="Product Image" width="70" height="auto"></a>
                            <?php endif; ?>
                        </div>
                        <div style="line-height: 1.5;">
                            <span style="font-weight: 600; font-size: 15px;"><?php echo e($item->product->product_name); ?></span><br>
                                <div class="d-flex align-items-center">
                                    <?php if($item->color): ?>
                                        <span class="d-flex align-items-center me-2">
                                            <strong>Color:</strong> 
                                            <span style="display: inline-block; background-color: <?php echo e($item->color); ?>; border: 1px solid #e8ebec; height: 15px; width: 15px; border-radius: 50%;" 
                                                title="<?php echo e($item->color); ?>"></span>
                                        </span>
                                        |
                                    <?php endif; ?>
                                    <?php if($item->size): ?>
                                        <span class="me-2 ms-2">Size: <span style="font-weight: 600;"><?php echo e($item->size ? $item->size : '-'); ?></span></span>
                                        |
                                    <?php endif; ?> 
                                    <?php if($item->quantity): ?>
                                    <span class="ms-2">Qty: <span style="font-weight: 600;"><?php echo e($item->quantity); ?></span></span>
                                    <?php endif; ?>
                                </div>
                            <h6 class="mt-2" style="font-weight: bold;">Rs <?php echo e($item->cost); ?></h6>  
                        </div>
                    </div>
                    <div class="ml-auto" style="text-align: right;">
                        <a href="<?php echo e(route('write.reviews', ['product_id' => $item->product_id, 'color' => $item->color, 
                        'size' => $item->size, 'quantity' => $item->quantity, 'cost' => $item->cost, 'order_code' => $item->order->order_code])); ?>" class="btn-review">Review</a>
                    </div>
                </div>
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</div>

<!-- History Tab -->
<div id="history" class="tab-content">
    <div class="order-items mt-3">
        <div class="order-items-list px-3">
            <?php $__currentLoopData = $reviewedItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="order-item row mb-5" style="padding: 10px; border-bottom: 1px solid #eaeaea;">
                    <div class="col-md-1 d-flex flex-column align-items-start">
                        <div style="margin-right: 15px;">
                            <?php if($review->product->images->isNotEmpty()): ?>
                                <a href="#"><img src="<?php echo e(asset('storage/' . $review->product->images->first()->image_path)); ?>" alt="Product Image" width="70" height="auto"></a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex flex-column align-items-start border-end" style="border-right: 1px solid #eaeaea; font-size: 13px;">
                        <span style="font-weight: 600;"><?php echo e($review->product->product_name); ?></span>
                        <div class="d-flex align-items-center">
                        <?php if($review->orderItem): ?>
                            <?php if($review->orderItem->color): ?>
                                <span class="d-flex align-items-center me-2">
                                    Color: 
                                    <span style="display: inline-block; background-color: <?php echo e($review->orderItem->color); ?>; border: 1px solid #e8ebec; height: 15px; width: 15px; border-radius: 50%; margin-left: 0.5rem;" 
                                        title="<?php echo e($review->orderItem->color); ?>"></span>
                                </span>
                            <?php endif; ?>

                            <?php if($review->orderItem->size): ?>
                                <span class="me-2">Size: <span style="font-weight: 600;"><?php echo e($review->orderItem->size); ?></span></span>
                            <?php endif; ?>

                            <?php if($review->orderItem->quantity): ?>
                                <span class="ms-2">Qty: <span style="font-weight: 600;"><?php echo e($review->orderItem->quantity); ?></span></span>
                            <?php endif; ?>

                            <?php if(!$review->orderItem->color && !$review->orderItem->size && !$review->orderItem->quantity): ?>
                                <span class="me-2">Details not available</span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="me-2">Color: <span style="font-weight: 600;"></span></span> | 
                            <span class="me-2">Size: <span style="font-weight: 600;"></span></span> |
                            <span class="ms-2">Qty: <span style="font-weight: 600;"></span></span>
                        <?php endif; ?>

                        </div>
                        <?php if($review->orderItem): ?>
                            <h6 class="mt-2" style="font-size: 13px; font-weight: bold;">Rs <?php echo e($review->orderItem->cost); ?></h6>
                        <?php else: ?>
                            <h6 class="mt-2" style="font-size: 13px; font-weight: bold;"></h6>
                        <?php endif; ?>

                    </div>

                    <div class="col-md-6 d-flex flex-column align-items-start border-end" style="border-right: 1px solid #eaeaea;">
                        <p class="m-0" style="font-weight: 500;">Feedback I left:</p>
                        <div class="rating text-warning mb-1" style="font-size: 20px;">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                    <?php if($review->rating >= $i): ?>
                                        <i class='bx bxs-star'></i> <!-- Full star -->
                                    <?php elseif($review->rating >= ($i - 0.5)): ?>
                                        <i class='bx bxs-star-half'></i> <!-- Half star -->
                                    <?php else: ?>
                                        <i class='bx bx-star'></i> <!-- Empty star -->
                                    <?php endif; ?>
                                <?php endfor; ?>
                        </div>
                        <div class="review-description text-start">
                            <p style="font-size: 13px;"><?php echo e($review->comment); ?></p>
                        </div>
                        <div class="review-images">
                            <?php $__currentLoopData = $review->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($media->media_type === 'image'): ?>
                                    <img src="<?php echo e(asset('storage/' . $media->media_path)); ?>" alt="Review Image" style="">
                                <?php elseif($media->media_type === 'video'): ?>
                                    <video width="100" controls>
                                        <source src="<?php echo e(asset('storage/' . $media->media_path)); ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-start justify-content-start">
                        <span class=""><?php echo e($review->status === 'pending' ? 'Feedback is not published' : 'Feedback is published'); ?></span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>





<script>
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            this.classList.add('active');
            document.getElementById(this.getAttribute('data-target')).classList.add('active');
        });
    });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('member_dashboard.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/member_dashboard/myreviews.blade.php ENDPATH**/ ?>