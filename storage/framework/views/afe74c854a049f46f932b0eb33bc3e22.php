<?php $__env->startSection('dashboard-content'); ?>
<style>
.list-group-item {
    border: 1px solid #e0e0e0;
    border-radius: 5px; 
}

.list-group-item h6 {
    color: #007bff; 
}

.list-group-item p {
    margin-bottom: 0.5rem; 
}

.list-group-item small {
    font-style: italic; 
}


</style>



<div class="d-flex justify-content-between align-items-center py-2 px-2">
    <h4>Customer Inquiries</h4>
    <a href="<?php echo e(route('inquiry.create')); ?>" class="btn default-btn">Write an Inquiry</a>
</div>

<div class="container p-4">
    <div class="list-group">
        <?php $__empty_1 = true; $__currentLoopData = $inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="list-group-item mb-3 position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 p-3" style="font-size:12px;" aria-label="Close"></button>
                <h6 style="color: black;" class="mb-1"><?php echo e($inquiry->subject); ?></h6>
                <p class="mb-1"><strong>Message:</strong> <?php echo e($inquiry->message); ?></p>
                <small class="text-muted">Date: <?php echo e($inquiry->created_at->format('Y-m-d')); ?></small>
                <hr>
                <h6 class="mt-2">Admin Response:</h6>
                <p><?php echo e($inquiry->reply ?? 'No response yet.'); ?></p>
                <small class="text-muted">Date of Response: <?php echo e($inquiry->updated_at->format('Y-m-d')); ?></small>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="list-group-item mb-3">
                <p class="text-center">No inquiries available.</p>
            </div>
        <?php endif; ?>
    </div>
</div>





<script>
    document.querySelectorAll('.btn-close').forEach(button => {
    button.addEventListener('click', function() {
        this.closest('.list-group-item').remove(); 
    });
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('member_dashboard.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/member_dashboard/myinquiries.blade.php ENDPATH**/ ?>