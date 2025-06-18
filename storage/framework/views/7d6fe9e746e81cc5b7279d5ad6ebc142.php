<?php $__env->startSection('content'); ?>

<main style="margin-top: 58px">
    <div class="container pt-4 px-4"> 
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="py-3 mb-0">Affiliate Rules</h3>
            <button type="button" class="btn btn-primary btn-create" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fa-solid fa-plus"></i> Add
            </button>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="container mt-4 mb-4">
                    <div class="table-responsive">
                        <table id="example" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 10%">#</th>
                                    <th>Rule</th>
                                    <th style="width: 15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $rules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($rule->rule); ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editRuleModal" data-id="<?php echo e($rule->id); ?>" data-rule="<?php echo e($rule->rule); ?>" style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="<?php echo e(route('affiliate_rules.destroy', $rule->id)); ?>" method="POST" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger btn-sm" style="font-size: 0.75rem; padding: 0.25rem 0.5rem;"> 
                                                    <i class="fas fa-trash"></i></button>
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

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New Rule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="addUserForm" action="<?php echo e(route('admin_rules.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <textarea name="rule" rows="3" class="form-control w-100" required></textarea>
                    <button type="submit" class="btn btn-success btn-create mt-2">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Rule Modal -->
<div class="modal fade" id="editRuleModal" tabindex="-1" aria-labelledby="editRuleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRuleModalLabel">Edit Rule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="editRuleForm" action="<?php echo e(route('admin_users.update', ':id')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="mb-3">
                        <label for="edit_rule" class="form-label">Rule</label>
                        <textarea id="edit_rule" name="rule" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-create">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const ruleId = this.getAttribute('data-id');
                const ruleText = this.getAttribute('data-rule');

                const form = document.getElementById('editRuleForm');
                form.action = form.action.replace(':id', ruleId);

                document.getElementById('edit_rule').value = ruleText;
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\OMCNEW\resources\views/admin_dashboard/affiliate_rules.blade.php ENDPATH**/ ?>