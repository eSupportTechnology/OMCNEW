@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<style>
    .fit {
        max-width: 100%;
        max-height: 100vh;
        margin: auto;
    }
    .product-price span {
        display: inline-block;
        margin-right: 10px;
    }
</style>

<div class="container mt-4 mb-5">
    <section class="py-5">
        <div class="container">
            <div class="row gx-5">
                <aside class="col-lg-5">
                    <div class="border rounded-4 mb-3 d-flex justify-content-center">
                        <a class="rounded-4 glightbox" data-type="image" href="/assets/images/aff4.png">
                            <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="/assets/images/aff4.png" />
                        </a>
                    </div>
                </aside>

                <main class="col-lg-7">
                    <div class="ps-lg-3">
                        <div class="product-price mb-3">
                            <span class="h3" style="font-weight: bold;">Rs. 1500&nbsp;</span>
                            <span class="h5 text-danger">33% off</span>
                        </div>
                        <h4 class="title text-dark">
                            Pink Cherry Blossom Pen Rose Flower Pen Metal Ballpoint Pen Cute Rotary Ball Pens Business 
                            Signature Pens Office School Writing Supplies<br />
                        </h4>
                        <div class="d-flex flex-row my-3">
                            <div class="text-warning mb-1 me-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="ms-1">4.5</span>
                            </div>
                            <span class="text-primary">18 Ratings | </span>
                            <span class="text-primary">&nbsp; 25 Questions Answered</span>
                        </div>
                        <div style="margin-top: -15px;">
                            <span class="text-muted">Brand: </span>
                            <span class="text-primary"> No Brand | More Wearable technology from No Brand</span>
                        </div>

                        <hr />

                        <span class="">Availability :</span>
                        <span class="ms-1" style="color:#4caf50;">In stock</span>

                        <div class="d-flex justify-content-start mb-3">
                            <a class="glightbox border mx-1 rounded-2" data-type="image" href="/assets/images/aff4.png" class="item-thumb">
                                <img width="60" height="60" class="rounded-2" src="/assets/images/aff4.png" />
                            </a>
                            <a class="glightbox border mx-1 rounded-2" data-type="image" href="/assets/images/aff5.png" class="item-thumb">
                                <img width="60" height="60" class="rounded-2" src="/assets/images/aff5.png" />
                            </a>
                            <a class="glightbox border mx-1 rounded-2" data-type="image" href="/assets/images/aff6.png" class="item-thumb">
                                <img width="60" height="60" class="rounded-2" src="/assets/images/aff6.png" />
                            </a>
                            <a class="glightbox border mx-1 rounded-2" data-type="image" href="/assets/images/aff7.png" class="item-thumb">
                                <img width="60" height="60" class="rounded-2" src="/assets/images/aff7.png" />
                            </a>
                            <a class="glightbox border mx-1 rounded-2" data-type="image" href="/assets/images/aff8.png" class="item-thumb">
                                <img width="60" height="60" class="rounded-2" src="/assets/images/aff8.png" />
                            </a>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4 col-6 mb-3">
                                <label class="mb-2 d-block">Quantity</label>
                                <div class="col-lg-7 d-flex align-items-center justify-content-end">
                                    <div class="input-group mb-3 quantity-input">
                                        <button class="btn btn-white" type="button" id="button-minus">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="text" class="form-control text-center" id="quantity" value="1" aria-label="Quantity" />
                                        <button class="btn btn-white" type="button" id="button-plus">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <a href="#" class="btn btn-custom-buy shadow-0 me-2">Buy now</a>
                            <a href="{{ route('shopping_cart') }}" class="btn btn-custom-cart shadow-0">
                                <i class="me-1 fa fa-shopping-basket"></i>Add to cart
                            </a>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>

    const lightbox = GLightbox({
        touchNavigation: true,
        loop: true,
        zoomable: true,
        draggable: true,
        autoplayVideos: true
    });


    document.getElementById('button-plus').addEventListener('click', function() {
        var quantityInput = document.getElementById('quantity');
        var currentValue = parseInt(quantityInput.value);
        if (!isNaN(currentValue)) {
            quantityInput.value = currentValue + 1;
        } else {
            quantityInput.value = 0;
        }
    });

    document.getElementById('button-minus').addEventListener('click', function() {
        var quantityInput = document.getElementById('quantity');
        var currentValue = parseInt(quantityInput.value);
        if (!isNaN(currentValue) && currentValue > 0) {
            quantityInput.value = currentValue - 1;
        } else {
            quantityInput.value = 0;
        }
    });
</script>

@endsection
