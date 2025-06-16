<?php $__env->startSection('content'); ?>

<style>
    .card {
        border-radius: 0;
        width: 90%;
    }

    .thank-you-section {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<!-- Start Page Title -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Payment Failed</h2>
            <ul>
                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li>Payment Failed</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title -->

<div class="container mt-4">
    <section class="thank-you-section mb-4">
        <!-- Payment -->
        <div class="col-md-12 mb-4 card-container">
            <div class="card shadow-0 border" style="background-color:#f5f5f5">
                <?php echo csrf_field(); ?>
                <div class="p-4 text-center">
                    <h4 style="color: red;">Payment Failed</h4>
                    <h6 class="mt-4">We were unable to process your payment.</h6>
                    <p class="mt-4">Please try again or contact customer support for assistance.</p>
                    <a href="<?php echo e(url('/')); ?>" class="btn btn-primary mt-3">Back to Home</a>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/frontend/payment-fail.blade.php ENDPATH**/ ?>