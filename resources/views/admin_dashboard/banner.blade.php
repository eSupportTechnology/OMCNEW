@extends('layouts.admin_main.master')

@section('content')
    <style>
        .arrow-toggle {
            margin-right: 5px;
        }
    </style>

    <main style="margin-top: 58px">
        <div class="container py-4 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="py-3 mb-0">Manage Banners</h3>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add New
                    Banner</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table category-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Position</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th style="width:20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $banner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $banner->title }}</td>
                                        <td>{{ $banner->position }}</td>

                                        <td>
                                            @if ($banner->image_path)
                                                <img src="{{ asset('storage/banner_images/' . basename($banner->image_path)) }}"
                                                    alt="Banner Image" style="max-width: 70px;">
                                            @else
                                                No Image
                                            @endif
                                        </td>

                                        @if ($banner->is_active)
                                            <td><span class="badge bg-success">Active</span></td>
                                        @else
                                            <td><span class="badge bg-danger">Inactive</span></td>
                                        @endif

                                        <td>
                                            <div class="category-actions">
                                                <a href="{{ route('edit_banner', $banner->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-sm btn-danger delete-category"
                                                    data-id="{{ $banner->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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
    </main>







    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-2">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bannerForm" method="POST" action="{{ route('banner_add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label text-black">Banner Title <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Enter banner name" required>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label text-black">Position <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" id="position" name="position" required
                                onchange="updateRecommendedSize()">
                                <option value="bottom">Bottom</option>
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image_path" class="form-label text-black">
                                Banner Image <span id="recommended-size" class="text-info">(Recommended size:
                                    1920x450)</span> <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control" id="image_path" name="image_path" required>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Add Banner</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateRecommendedSize() {
            const position = document.getElementById('position').value;
            const label = document.getElementById('recommended-size');

            let sizeText = '';

            switch (position) {
                case 'bottom':
                    sizeText = '(Recommended size: 1920x450)';
                    break;
                case 'left':
                    sizeText = '(Recommended size: 721x219)';
                    break;
                case 'right':
                    sizeText = '(Recommended size: 720x218)';
                    break;
                default:
                    sizeText = '(Recommended size: 1920x500)';
            }

            label.textContent = sizeText;
        }

        // Trigger update on page load in case value is pre-selected (e.g., in edit mode)
        document.addEventListener('DOMContentLoaded', updateRecommendedSize);
    </script>

    <script>
        //delete the categories
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-category').forEach(function(button) {
                button.addEventListener('click', function() {
                    const bannerId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        customClass: {
                            container: 'delete-confirm-modal'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/admin/banner/${bannerId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute(
                                            'content'),
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok.');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.status) {
                                        Swal.fire(
                                            'Deleted!',
                                            'Banner has been deleted.',
                                            'success'
                                        ).then(() => {
                                            this.closest('tr').remove();
                                        });
                                    } else {
                                        console.error(
                                            'Server response does not indicate success:',
                                            data);
                                        Swal.fire(
                                            'Failed!',
                                            data.message ||
                                            'Failed to delete the category.',
                                            'error'
                                        );
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire(
                                        'Error!',
                                        'An error occurred while deleting the category.',
                                        'error'
                                    );
                                });
                        }
                    });
                });
            });
        });
    </script>



    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
@endsection
