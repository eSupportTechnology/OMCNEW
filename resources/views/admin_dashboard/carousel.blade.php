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
                <h3 class="py-3 mb-0">Manage Carousels</h3>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add New
                    Carousel</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table category-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th style="width:20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carousels as $carousel)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $carousel->title }}</td>

                                        <td>
                                            @if ($carousel->image_path)
                                                <img src="{{ asset('storage/carousel_images/' . basename($carousel->image_path)) }}"
                                                    alt="Carousel Image" style="max-width: 70px;">
                                            @else
                                                No Image
                                            @endif
                                        </td>

                                        @if ($carousel->is_active)
                                            <td><span class="badge bg-success">Active</span></td>
                                        @else
                                            <td><span class="badge bg-danger">Inactive</span></td>
                                        @endif

                                        <td>
                                            <div class="category-actions">
                                                <a href="{{ route('edit_carousel', $carousel->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-sm btn-danger delete-category"
                                                    data-id="{{ $carousel->id }}">
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
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Carousel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="carouselForm" method="POST" action="{{ route('carousel_add') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label text-black">Carousel Title <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Enter carousel name" required>
                        </div>
                        <div class="mb-3">
                            <label for="image_path" class="form-label text-black">Carousel Image <span
                                    class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="image_path" name="image_path" required>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Add Carousel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        //delete the categories
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-category').forEach(function(button) {
                button.addEventListener('click', function() {
                    const carouselId = this.getAttribute('data-id');

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
                            fetch(`/admin/carousel/${carouselId}`, {
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
                                            'Carousel has been deleted.',
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
