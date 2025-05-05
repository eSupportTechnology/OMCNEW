<?php $__env->startSection('content'); ?>



<style>

</style>

<main style="margin-top: 50px">
    <div class="container py-5 px-4">
        <h3>Customer Inquiries</h3>
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="table-responsive">
                        <div class="d-flex mb-4 col-md-3" style="font-size:15px;">
                            <label for="dateFilter" class="form-label col-md-4 mt-2">Select Date:</label>
                            <input type="date" id="dateFilter" class="form-control col-md-3" placeholder="Select date" style="font-size:15px;">
                        </div>

                        <table id="example" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td> 
                                        <td><?php echo e($inquiry->user->name ?? 'N/A'); ?></td> 
                                        <td><?php echo e($inquiry->order_id); ?></td> 
                                        <td><?php echo e($inquiry->created_at->format('Y-m-d')); ?></td> 
                                        <td><?php echo e($inquiry->subject); ?></td> 
                                        <td><?php echo e($inquiry->status); ?></td> 
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#inquiryDetailsModal<?php echo e($inquiry->id); ?>"> 
                                                <i class="fas fa-file"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal for Inquiry Details -->
                                    <div class="modal fade" id="inquiryDetailsModal<?php echo e($inquiry->id); ?>" tabindex="-1" aria-labelledby="inquiryDetailsModalLabel<?php echo e($inquiry->id); ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content p-2">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="inquiryDetailsModalLabel<?php echo e($inquiry->id); ?>">Inquiry Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Customer:</strong> <?php echo e($inquiry->user->name ?? 'N/A'); ?></p>
                                                    <p><strong>Order ID:</strong> <?php echo e($inquiry->order_id); ?></p>
                                                    <p><strong>Subject:</strong> <?php echo e($inquiry->subject); ?></p>
                                                    <p><strong>Message:</strong> <?php echo e($inquiry->message); ?></p>
                                                    <form action="<?php echo e(route('inquiries.response', $inquiry->id)); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="mb-3">
                                                            <label for="responseMessage" class="form-label">Response</label>
                                                            <textarea class="form-control" id="responseMessage" name="response" rows="4"><?php echo e($inquiry->reply); ?></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit Response</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No inquiries available.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateFilter = document.getElementById('dateFilter');
    const table = document.getElementById('example').getElementsByTagName('tbody')[0];
    
    dateFilter.addEventListener('change', function() {
        const selectedDate = dateFilter.value;
        
        if (selectedDate) {
            for (let row of table.rows) {
                const dateCell = row.cells[3].innerText; 
                if (dateCell === selectedDate) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        } else {
            for (let row of table.rows) {
                row.style.display = '';
            }
        }
    });
});
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/admin_dashboard/customer_inquiries.blade.php ENDPATH**/ ?>