@extends('layouts.admin_main.master')

@section('content')
    <style>
        /* Ensure image scales within container */
        .responsive-logo-image {
            width: 100%;
            height: auto;
            max-width: 750px;
            /* Optional limit for large screens */
            border-radius: 8px;
        }

        /* Margin adjustments for smaller screens */
        @media (max-width: 576px) {
            .responsive-responsive-logo-image-wrapper {
                margin-top: 1rem;
            }
        }
    </style>

    <main style="margin-top: 58px">
        <div class="container py-4 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="py-2 mb-0 ms-4">Manage Logo</h4>
            </div>
            <div class="card-container px-4">
                <div class="card py-3 px-5">
                    <div class="card-body">
                        <form action="{{ route('insert_or_update_logo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="logoName" class="form-label text-black">Logo Title</label>
                                <input type="text" class="form-control" id="logoName" name="title"
                                    value="{{ old('title', $logo->title) }}" placeholder="Enter logo title">
                            </div>

                            <div class="mb-3 responsive-logo-wrapper">
                                <label for="image" class="form-label text-black">Logo Image <span class="text-info">
                                        (Recommended size: 500x73)</span> <span class="text-danger">*</span></label>
                                @if ($logo->image_path)
                                    <div>
                                        <img src="{{ asset('storage/logo_images/' . $logo->image_path) }}" alt="Logo Image"
                                            class="responsive-logo-image">
                                    </div>
                                    <br>
                                @endif
                                <input type="file" class="form-control" id="image_path" name="image_path">
                            </div>


                            <button type="submit" class="btn btn-success mt-3">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script></script>
@endsection
