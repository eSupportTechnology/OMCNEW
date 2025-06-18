<?php $__env->startSection('content'); ?>
<style>
    .table thead{
        background-color: #f9f9f9; 
    }
</style>  

<main style="margin-top: 58px">
    <div class="container pt-4 px-4"> 

        <h3 class="py-3">Withdrawals</h3>

        <div class="row">
            <!-- Display Total Available Balance -->
            <div class="col-md-6 col-12 mb-4"> 
                <div class="card">
                    <div class="card-body">
                        <p class="mb-3">Total Available Balance</p>
                        <h3 class="mb-6">LKR <?php echo e(number_format($totalBalance, 2)); ?></h3> 
                    </div>
                </div>
            </div>

            <!-- Withdrawal Box -->
            <div class="col-md-6 col-12 mb-4"> 
                <div class="card">
                    <div class="card-body">
                        <p class="mb-3">Request Withdrawal</p>
                        <p class="mb-2 " style="color:red;">Check your balance; it must be more than 1000 before requesting a withdrawal.</p>
                        <form method="POST" action="<?php echo e(route('paymentrequest')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <input type="number" name="withdraw_amount" id="withdraw_amount" class="form-control" placeholder="Enter Amount" required>
                            </div>
                            <!-- Use raw numeric totalBalance value -->
                            <input type="hidden" name="total" value="<?php echo e($totalBalance); ?>">
                            <button type="submit" class="btn btn-primary">Withdraw</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Requests Table -->
        <div class="card">
            <div class="card-body">
                <div class="tab-pane fade show active" role="tabpanel">
                    <div class="row align-items-center mb-3">
                        <div class="col-md-4 mb-2 d-flex align-items-center">
                            <input type="date" id="date" class="form-control" style="font-size: 0.8rem;">
                        </div>
                    </div>

                    <div class="container mt-4 mb-4">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Time</th>
                                        <th scope="col">Transfer Channel</th>
                                        <th scope="col">Account Number</th>
                                        <th scope="col">Requested Withdrawal Amount</th>
                                        <th scope="col">Processing Fee</th>
                                        <th scope="col">Paid Amount</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $paymentRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($request->requested_at); ?></td>
                                            <td><?php echo e($request->bank_name); ?> - <?php echo e($request->branch); ?></td>
                                            <td><?php echo e($request->account_number); ?></td>
                                            <td>LKR <?php echo e(number_format($request->withdraw_amount, 2)); ?></td>
                                            <td>LKR <?php echo e(number_format($request->processing_fee, 2)); ?></td>
                                            <td>LKR <?php echo e(number_format($request->paid_amount, 2)); ?></td>
                                            <td><?php echo e($request->status); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No withdrawal requests found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="card-footer d-flex justify-content-between align-items-center">
                <span>Total: <?php echo e($paymentRequests->count()); ?></span>
                <div class="d-flex align-items-center">
                    <label for="items-per-page" class="form-label me-2 mb-0">Items per page:</label>
                    <select id="items-per-page" class="form-select items-per-page" style="font-size: 0.8rem; width: auto;">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                </div>
                <!-- Pagination controls -->
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#"><i class="fa-solid fa-arrow-left"></i></a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-arrow-right"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.affiliate_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\OMCNEW\resources\views/affiliate_dashboard/withdrawals.blade.php ENDPATH**/ ?>