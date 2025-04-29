@extends('layouts.admin_main.master')

@section('content')
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
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="py-3 mb-0">Manage Reviews</h3>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active fw-bold" id="published-tab" data-bs-toggle="tab" href="#published" role="tab" aria-controls="published" aria-selected="true">Published</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">
                    Pending <span class="badge bg-danger">{{ $pendingReviews->count() }}</span>
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
                                    @foreach ($publishedReviews as $review)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="user-profile">
                                                    <img src="{{ asset('storage/' . $review->product->images->first()->image_path) }}" alt="Product Image" style="max-width: 50px;">
                                                    {{ $review->product->product_name }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="reviewer-profile">
                                                    @php
                                                        $profileImage = $review->user->profile_image ? asset('storage/' . $review->user->profile_image) : asset('assets/images/default-user.png');
                                                    @endphp
                                                    <img src="{{ $profileImage }}" alt="Profile Image" class="rounded-circle" width="100" height="100" style="object-fit: cover;">
                                                    <span>{{ $review->user->name }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $review->comment }}
                                                <div class="star-rating">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $review->rating)
                                                            <i class="fas fa-star"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>{{ $review->created_at->format('Y-m-d') }}</td>
                                            <td><span class="badge bg-success">{{ ucfirst($review->status) }}</span></td>
                                            <td>

                                                <form id="delete-form-{{ $review->id }}" action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" style="font-size: 0.75rem; padding: 0.25rem 0.5rem;" onclick="confirmDelete('delete-form-{{ $review->id }}', 'Are you sure you want to delete this Review?')">

        
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
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
                                    @foreach ($pendingReviews as $review)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="user-profile">
                                                    <img src="{{ asset('storage/' . $review->product->images->first()->image_path) }}" alt="Product Image" style="max-width: 50px;">
                                                    {{ $review->product->product_name }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="reviewer-profile">
                                                    @php
                                                        $profileImage = $review->user->profile_image ? asset('storage/' . $review->user->profile_image) : asset('assets/images/default-user.png');
                                                    @endphp
                                                    <img src="{{ $profileImage }}" alt="Profile Image" class="rounded-circle" width="100" height="100" style="object-fit: cover;">
                                                    <span>{{ $review->user->name }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $review->comment }}
                                                <div class="star-rating">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $review->rating)
                                                            <i class="fas fa-star"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>{{ $review->created_at->format('Y-m-d') }}</td>
                                            <td><span class="badge bg-warning">{{ ucfirst($review->status) }}</span></td>
                                            <td>

                                                <div class="dropdown"> 

                                                    <button class="btn btn-sm btn-light" type="button" id="dropdownMenuButton{{ $review->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $review->id }}">
                                                        <li><a class="dropdown-item" href="#" onclick="approveReview({{ $review->id }})">Publish</a></li>
                                                        <li>

                                                            <form id="delete-form-{{ $review->id }}" action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a class="dropdown-item" style="cursor: pointer;" onclick="confirmDelete('delete-form-{{ $review->id }}', 'Are you sure you want to delete this Review?')">Delete</a>

                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
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
    let csrfToken = '{{ csrf_token() }}'; 
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
                'X-CSRF-TOKEN': '{{ csrf_token() }}', 
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

@endsection
