@extends('layouts.admin_main.master')

@section('content')
    <style>
        /* Ensure image scales within container */
        .responsive-banner-image {
            width: 100%;
            height: auto;
            max-width: 1920px;
            /* Optional limit for large screens */
            border-radius: 8px;
        }

        /* Margin adjustments for smaller screens */
        @media (max-width: 576px) {
            .responsive-banner-wrapper {
                margin-top: 1rem;
            }
        }
    </style>

    <main style="margin-top: 58px">
        <div class="container py-4 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="py-2 mb-0 ms-4">Edit Banners</h4>
            </div>
            <div class="card-container px-4">
                <div class="card py-3 px-5">
                    <div class="card-body">
                        <form action="{{ route('update_banner', $banner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="bannerName" class="form-label text-black">Banner Title</label>
                                <input type="text" class="form-control" id="bannerName" name="title"
                                    value="{{ old('title', $banner->title) }}" placeholder="Enter banner title">
                            </div>

                            <div class="mb-3">
                                <label for="position" class="form-label text-black">Position</label>
                                <select class="form-select" id="position" name="position">
                                    <option value="bottom" {{ $banner->position == 'bottom' ? 'selected' : '' }}>Bottom
                                    </option>
                                    <option value="left" {{ $banner->position == 'left' ? 'selected' : '' }}>Left</option>
                                    <option value="right" {{ $banner->position == 'right' ? 'selected' : '' }}>Right
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3 responsive-banner-wrapper">
                                <label for="image" class="form-label text-black">Banner Image</label>
                                @if ($banner->image_path)
                                    <div>
                                        <img src="{{ asset('storage/banner_images/' . $banner->image_path) }}"
                                            alt="Banner Image" class="responsive-banner-image">
                                    </div>
                                    <br>
                                @endif
                                <input type="file" class="form-control" id="image_path" name="image_path">
                            </div>


                            <div class="mb-3">
                                <label for="bannerIsActive" class="form-label text-black">Status</label>
                                <select class="form-select" id="bannerIsActive" name="is_active">
                                    <option value="1" {{ $banner->is_active == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $banner->is_active == 0 ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>


                            <button type="submit" class="btn btn-success mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script></script>
@endsection
