<?php $__env->startSection('content'); ?>



<style>
    .table thead {
        background-color: #f9f9f9; 
    }

    .btn-create {
        font-size: 0.8rem;
    }

    .action-buttons a {
        margin-right: 5px;
    }

    .btn-approve {
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 3px;
    }

    .btn-reject {
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 3px;
    }

    .status-approved {
        color: blue;
        font-weight: bold;
    }

    .status-rejected {
        color: red;
        font-weight: bold;
    }
</style> 


<main style="margin-top: 58px">
    <div class="container pt-4 px-4">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="py-3 mb-0">Affiliate Customers</h3>
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
                                    <th scope="col">NIC</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Contact No</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" style="width:5%">Status</th>
                                    <th scope="col" style="width: 5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $aff_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($customer->name); ?></td>
                                    <td><?php echo e($customer->NIC); ?></td>
                                    <td><?php echo e($customer->address); ?></td>
                                    <td><?php echo e($customer->contactno); ?></td>
                                    <td><?php echo e($customer->email); ?></td>
                                    <td class="status1">
                                        <?php if($customer->status == 'pending'): ?>
                                            <form action="<?php echo e(route('aff_customers.updateStatus', $customer->id)); ?>" method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <button type="submit" name="status" value="approved" class="btn-approve btn btn-success mb-1">Approve</button>
                                                <button type="submit" name="status" value="rejected" class="btn-reject btn btn-danger">Reject</button>
                                            </form>
                                        <?php elseif($customer->status == 'approved'): ?>
                                            <span class="status-approved">Approved</span>
                                        <?php elseif($customer->status == 'rejected'): ?>
                                            <span class="status-rejected">Rejected</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="action-buttons">
                                        <a href="<?php echo e(route('aff_customer-details', $customer->id)); ?>" class="btn btn-info btn-sm view-btn" 
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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/admin_dashboard/aff_customers.blade.php ENDPATH**/ ?>