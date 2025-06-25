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
            <h3 class="py-3 mb-0">Customers</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="container mt-4 mb-4">
                    <div class="table-responsive">
                        <table id="example" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Registered Date</th>
                                    <th scope="col">Total Orders</th>
                                    <th scope="col" style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($customer->name); ?></td>
                                    <td><?php echo e($customer->email); ?></td>
                                    <td><?php echo e($customer->phone_num); ?></td>
                                    <td><?php echo e($customer->created_at?->format('Y-m-d') ?? 'N/A'); ?></td>
                                    <td><?php echo e($customer->customer_orders_count); ?></td>

                                    <td class="action-buttons">
                                        <a href="<?php echo e(route('customer-details', $customer->id)); ?>" class="btn btn-info btn-sm view-btn"
                                            style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                            <i class="fas fa-eye"></i>
                                        </a>
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






<script>


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\OMC\OMCNEW\resources\views/admin_dashboard/customers.blade.php ENDPATH**/ ?>