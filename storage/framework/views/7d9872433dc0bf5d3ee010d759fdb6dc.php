<?php $__env->startSection('content'); ?>

<style>
   .btn-create {
        font-size: 0.8rem;
    }

</style>



<main style="margin-top: 20px">
    <div class="container p-5">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="py-2 mb-0 ms-4">Edit Offers</h4>
        </div>

        <div class="card-container px-4">
            <div class="card py-2 px-4">
                <div class="card-body">
                    <form action="<?php echo e(route('edit_offers', $offer->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <input type="hidden" name="id" value="<?php echo e($offer->id); ?>">
                        
                        <div class="form-group">
                            <label for="product_name">Product</label> 
                            <input type="text" name="product_name" id="product_name" class="form-control" value="<?php echo e($offer->product->product_name); ?>" required readonly>
                        </div>

                        <div class="form-group mt-3">
                            <label for="month">Month</label>
                            <input type="month" class="form-control" id="month" name="month" placeholder="Select Month" value="<?php echo e($offer->month); ?>" required>
                        </div>
                        <?php $__errorArgs = ['month'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-danger"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <div class="form-group mt-3">
                            <label for="normal_price">Normal Price</label>
                            <input type="text" name="normal_price" id="normal_price" class="form-control" value="<?php echo e($offer->normal_price); ?>" required readonly>
                        </div>

                        <div class="form-group mt-3">
                            <label for="offer_rate">Offer Rate (%)</label>
                            <input type="text" name="offer_rate" id="offer_rate" class="form-control" value="<?php echo e($offer->offer_rate); ?>" required>
                        </div>
                        <?php $__errorArgs = ['offer_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-danger"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <div class="form-group mt-3">
                            <label for="offer_price">Offer Price</label>
                            <input type="text" name="offer_price" id="offer_price" class="form-control" value="<?php echo e($offer->offer_price); ?>" required readonly>
                        </div>

                        <div class="form-group mt-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="Active" <?php echo e($offer->status == 'Active' ? 'selected' : ''); ?>>Active</option>
                                <option value="Inactive" <?php echo e($offer->status == 'Inactive' ? 'selected' : ''); ?>>Inactive</option>
                            </select>    
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Offer</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</main>





<script>
   document.addEventListener('DOMContentLoaded', function() {
    const normalPriceInput = document.getElementById('normal_price');
    const offerRateInput = document.getElementById('offer_rate');
    const offerPriceInput = document.getElementById('offer_price');

    offerRateInput.addEventListener('input', function() {
        const normalPrice = parseFloat(normalPriceInput.value) || 0;
        const offerRate = parseFloat(offerRateInput.value) || 0;
        const offerPrice = normalPrice - (normalPrice * (offerRate / 100));
        
        if (!isNaN(offerPrice)) {
            offerPriceInput.value = offerPrice.toFixed(2);
        }
    });
});
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/admin_dashboard/edit_offers.blade.php ENDPATH**/ ?>