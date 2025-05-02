<?php $__env->startSection('content'); ?>

<main style="margin-top: 58px">
    <div class="container pt-4 px-4">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="py-3 mb-0">Affiliate Withdrawals</h3>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active fw-bold" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="true">Completed Payments</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">
                    Pending Payments (<?php echo e($pendingRequests->count()); ?>)
                </a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- Completed Tab -->
            <div class="tab-pane fade show active" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Withdraw Amount</th>
                                        <th>Bank Name</th>
                                        <th>Branch</th>
                                        <th>Account Name</th>
                                        <th>Account No.</th>
                                        <th>Requested Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $completedRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($request->affiliateUser->name); ?></td>
                                            <td><?php echo e($request->withdraw_amount); ?></td>
                                            <td><?php echo e($request->bank_name); ?></td>
                                            <td><?php echo e($request->branch); ?></td>
                                            <td><?php echo e($request->account_name); ?></td>
                                            <td><?php echo e($request->account_number); ?></td>
                                            <td><?php echo e($request->requested_at->format('Y-m-d')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Tab -->
            <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Withdraw Amount</th>
                                        <th>Bank Name</th>
                                        <th>Branch</th>
                                        <th>Account Name</th>
                                        <th>Account No.</th>
                                        <th>Requested Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $pendingRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($request->affiliateUser->name); ?></td>
                                            <td><?php echo e($request->withdraw_amount); ?></td>
                                            <td><?php echo e($request->bank_name); ?></td>
                                            <td><?php echo e($request->branch); ?></td>
                                            <td><?php echo e($request->account_name); ?></td>
                                            <td><?php echo e($request->account_number); ?></td>
                                            <td><?php echo e($request->requested_at->format('Y-m-d')); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm d-flex align-items-center justify-content-center" 
                                                        style="width: 25px; height: 25px;" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#updatePaymentModal<?php echo e($request->id); ?>" 
                                                        title="Mark as Completed">
                                                    <i class="fas fa-check-circle"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="updatePaymentModal<?php echo e($request->id); ?>" tabindex="-1" aria-labelledby="updatePaymentModalLabel<?php echo e($request->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updatePaymentModalLabel<?php echo e($request->id); ?>">Update Payment Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?php echo e(route('affiliate.updatePaymentStatus', $request->id)); ?>" method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <div class="mb-3">
                                                                <label for="processing_fee_<?php echo e($request->id); ?>" class="form-label">Processing Fee</label>
                                                                <input type="text" name="processing_fee" id="processing_fee_<?php echo e($request->id); ?>" class="form-control" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="paid_amount_<?php echo e($request->id); ?>" class="form-label">Paid Amount</label>
                                                                <input type="text" name="paid_amount" id="paid_amount_<?php echo e($request->id); ?>" class="form-control" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/admin_dashboard/affiliate_withdrawals.blade.php ENDPATH**/ ?>