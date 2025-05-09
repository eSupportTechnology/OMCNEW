<?php $__env->startSection('content'); ?>
<!-- Include Bootstrap CSS in your <head> section -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">



<style>
    .action-buttons {
        padding: 5px;
        width: 35px;
    }

    .tab-content .table {
        margin-top: 20px;
    }

    .review-images {
        display: flex;
        gap: 10px;
    }

    .review-images img {
        width: 15%;
        height: auto;
        object-fit: cover;
    }

    .dropdown-menu {
        min-width: 100px;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-profile img {
        width: 40px;
        height: auto;
        object-fit: cover;
    }

    .reviewer-profile {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .reviewer-profile img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .star-rating {
        color: gold;
    }

    .action-icons i {
        font-size: 16px;
        margin-right: 10px;
        cursor: pointer;
    }

    .action-icons i.edit-icon {
        color: #007bff;
    }

    .action-icons i.delete-icon {
        color: #dc3545;
    }
</style>

<main style="margin-top: 58px">
    <div class="container pt-4 px-4">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="py-3 mb-0">Manage Reviews</h3>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active fw-bold" id="published-tab" data-bs-toggle="tab" href="#published" role="tab" aria-controls="published" aria-selected="true">Published</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">
                    Pending <span class="badge bg-danger"><?php echo e($pendingReviews->count()); ?></span>
                </a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- Published Tab -->
            <div class="tab-pane fade show active" id="published" role="tabpanel" aria-labelledby="published-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Reviewer</th>
                                        <th style="width: 30%">Review</th>
                                        <th style="width: 15%">Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $publishedReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td>
                                                <div class="user-profile">
                                                    <img src="<?php echo e(asset('storage/' . $review->product->images->first()->image_path)); ?>" alt="Product Image" style="max-width: 50px;">
                                                    <?php echo e($review->product->product_name); ?>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="reviewer-profile">
                                                    <?php
                                                        $profileImage = $review->user->profile_image ? asset('storage/' . $review->user->profile_image) : asset('assets/images/default-user.png');
                                                    ?>
                                                    <img src="<?php echo e($profileImage); ?>" alt="Profile Image" class="rounded-circle" width="100" height="100" style="object-fit: cover;">
                                                    <span><?php echo e($review->user->name); ?></span>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo e($review->comment); ?>

                                                <div class="star-rating">
                                                    <?php for($i = 0; $i < 5; $i++): ?>
                                                        <?php if($i < $review->rating): ?>
                                                            <i class="fas fa-star"></i>
                                                        <?php else: ?>
                                                            <i class="far fa-star"></i>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                </div>
                                            </td>
                                            <td><?php echo e($review->created_at->format('Y-m-d')); ?></td>
                                            <td><span class="badge bg-success"><?php echo e(ucfirst($review->status)); ?></span></td>
                                            <td>

                                                <form id="delete-form-<?php echo e($review->id); ?>" action="<?php echo e(route('reviews.destroy', $review->id)); ?>" method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button" class="btn btn-danger btn-sm" style="font-size: 0.75rem; padding: 0.25rem 0.5rem;" onclick="confirmDelete('delete-form-<?php echo e($review->id); ?>', 'Are you sure you want to delete this Review?')">

        
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

            <!-- Pending Tab -->
            <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Reviewer</th>
                                        <th style="width: 30%">Review</th>
                                        <th style="width: 15%">Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $pendingReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td>
                                                <div class="user-profile">
                                                    <img src="<?php echo e(asset('storage/' . $review->product->images->first()->image_path)); ?>" alt="Product Image" style="max-width: 50px;">
                                                    <?php echo e($review->product->product_name); ?>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="reviewer-profile">
                                                    <?php
                                                        $profileImage = $review->user->profile_image ? asset('storage/' . $review->user->profile_image) : asset('assets/images/default-user.png');
                                                    ?>
                                                    <img src="<?php echo e($profileImage); ?>" alt="Profile Image" class="rounded-circle" width="100" height="100" style="object-fit: cover;">
                                                    <span><?php echo e($review->user->name); ?></span>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo e($review->comment); ?>

                                                <div class="star-rating">
                                                    <?php for($i = 0; $i < 5; $i++): ?>
                                                        <?php if($i < $review->rating): ?>
                                                            <i class="fas fa-star"></i>
                                                        <?php else: ?>
                                                            <i class="far fa-star"></i>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                </div>
                                            </td>
                                            <td><?php echo e($review->created_at->format('Y-m-d')); ?></td>
                                            <td><span class="badge bg-warning"><?php echo e(ucfirst($review->status)); ?></span></td>
                                            <td>

                                                <div class="dropdown"> 

                                                    <button class="btn btn-sm btn-light" type="button" id="dropdownMenuButton<?php echo e($review->id); ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo e($review->id); ?>">
                                                        <li><a class="dropdown-item" href="#" onclick="approveReview(<?php echo e($review->id); ?>)">Publish</a></li>
                                                        <li>

                                                            <form id="delete-form-<?php echo e($review->id); ?>" action="<?php echo e(route('reviews.destroy', $review->id)); ?>" method="POST" style="display:inline;">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                                <a class="dropdown-item" style="cursor: pointer;" onclick="confirmDelete('delete-form-<?php echo e($review->id); ?>', 'Are you sure you want to delete this Review?')">Delete</a>

                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
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

    </div>
</main>




<!-- Approve Review Confirmation Modal -->
<div class="modal fade" id="approveReviewModal" tabindex="-1" aria-labelledby="approveReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveReviewModalLabel">Confirm Approval</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to approve this review?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmApproveBtn">Confirm</button>
            </div>
        </div>
    </div>
</div>


<script>
    let csrfToken = '<?php echo e(csrf_token()); ?>'; 
    let currentReviewId = null;

    function approveReview(reviewId) {
    currentReviewId = reviewId; 
    // Show the modal
    $('#approveReviewModal').modal('show');

    // Set up the event listener for the confirm button
    document.getElementById('confirmApproveBtn').onclick = function() {
        fetch(`/admin/manage_reviews/${currentReviewId}/approve`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                status: 'published'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); 
            } else {
                alert('Error approving review: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    };
}



</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/admin_dashboard/manage_reviews.blade.php ENDPATH**/ ?>