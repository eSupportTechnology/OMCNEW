@extends('layouts.admin_main.master')

@section('content')
    <style>
        /* Ensure image scales within container */
        .responsive-carousel-image {
            width: 100%;
            height: auto;
            max-width: 750px;
            /* Optional limit for large screens */
            border-radius: 8px;
        }

        /* Margin adjustments for smaller screens */
        @media (max-width: 576px) {
            .responsive-carousel-wrapper {
                margin-top: 1rem;
            }
        }
    </style>

    <main style="margin-top: 58px">
        <div class="container py-4 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="py-2 mb-0 ms-4">Edit Carousels</h4>
            </div>
            <div class="card-container px-4">
                <div class="card py-3 px-5">
                    <div class="card-body">
                        <form action="{{ route('update_carousel', $carousel->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="carouselName" class="form-label text-black">Carousel Title</label>
                                <input type="text" class="form-control" id="carouselName" name="title"
                                    value="{{ old('title', $carousel->title) }}" placeholder="Enter carousel title">
                            </div>

                            <div class="mb-3 responsive-carousel-wrapper">
                                <label for="image" class="form-label text-black">Carousel Image</label>
                                @if ($carousel->image_path)
                                    <div>
                                        <img src="{{ asset('storage/carousel_images/' . $carousel->image_path) }}"
                                            alt="Carousel Image" class="responsive-carousel-image">
                                    </div>
                                    <br>
                                @endif
                                <input type="file" class="form-control" id="image_path" name="image_path">
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
