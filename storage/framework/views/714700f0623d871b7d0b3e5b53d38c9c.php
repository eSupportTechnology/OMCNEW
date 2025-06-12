<?php $__env->startSection('content'); ?>

<style> 


</style>  

<main style="margin-top: 58px">
    <div class="container pt-4 px-4"> 
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="py-3 mb-0">Special offers</h3>
            <a href="<?php echo e(route('add_offers')); ?>" class="btn btn-primary btn-create">Add Offer</a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="container  mb-4">
                    <div class="table-responsive p-0">
                        <table id="example" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Offer month</th>
                                    <th scope="col">Normal Price</th>
                                    <th scope="col">Offer Rate%</th>
                                    <th scope="col">Offer Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($offer->product_id); ?></td>
                                    <td><?php echo e($offer->product ? $offer->product->product_name : 'No Product Available'); ?></td>

                                    <td>
                                    <img src="<?php echo e($offer->product && $offer->product->images->first() ? asset('storage/' . $offer->product->images->first()->image_path) : asset('path/to/default-image.jpg')); ?>" 
                                        alt="<?php echo e($offer->product ? $offer->product->product_name : 'No Product Available'); ?>" 
                                        style="width: 50px; height: auto;">
                                    </td> 
                                    <td><?php echo e($offer->month); ?></td>
                                    <td><?php echo e($offer->normal_price); ?></td>
                                    <td><?php echo e($offer->offer_rate); ?></td>
                                    <td><?php echo e($offer->offer_price); ?></td>
                                    <td><?php echo e($offer->status); ?></td>
                                    <td class="action-buttons">
                                        <a href="<?php echo e(route('edit_offers', $offer->id)); ?>" class="btn btn-warning btn-sm mb-1" style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form id="delete-form-<?php echo e($offer->id); ?>" action="<?php echo e(route('delete_offer', $offer->id)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" class="btn btn-danger btn-sm mb-1" onclick="confirmDelete('delete-form-<?php echo e($offer->id); ?>', 'You want to delete this Offer?')"
                                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\OMC\OMCNEW\resources\views/admin_dashboard/special_offers.blade.php ENDPATH**/ ?>