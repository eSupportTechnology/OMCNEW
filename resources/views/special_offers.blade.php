
@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .product-image-wrapper {
        position: relative;
    }

    .btn-cart {
        background-color: white; 
        border: none;
        border-radius: 50%;
        width: 40px; 
        height: 40px; 
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s, color 0.3s; 
    }

    .btn-cart i {
        font-size: 1.5rem; 
        color: black;
    }

    .btn-cart:hover {
        background-color: black; 
    }

    .btn-cart:hover i {
        color: white; 
    }

.col-lg-3-5 {
    width: calc(100% / 4);
    max-width: calc(100% / 4);
}

.product-name {
    line-height: 1.2em; 
}

</style>


<div class="container mt-4 mb-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>        
            <li class="breadcrumb-item active" aria-current="page">Special Offer Products</li>
        </ol>
    </nav>

    <div class="offer mx-auto" style="width: 100%;">
    @if($products->isEmpty())
        <div class="no-products">
            <p>No products found.</p>
        </div>
    @else
        <div class="row mt-3" id="product-list">
            @foreach ($products as $product)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                    <div class="offer-item position-relative">
                        <a href="{{ route('single_product_page', ['product_id' => $product->product_id]) }}" class="d-block text-decoration-none">
                            @if($product->images->isNotEmpty())
                                <div class="offer-image-wrapper position-relative">
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="Product Image" class="img-fluid">
                                    <button type="button" class="btn btn-cart position-absolute bottom-0 end-0 me-2 mb-2" data-bs-toggle="modal" data-bs-target="#cartModal_{{ $product->product_id }}">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </div>
                            @else
                                <img src="{{ asset('storage/default-image.jpg') }}" alt="Default Image" class="img-fluid">
                            @endif
                            <h6 class="product-name">{{ \Illuminate\Support\Str::limit($product->product_name, 25, '...') }}</h6>
                            <div class="price">
                                @if($product->specialOffer && $product->specialOffer->status === 'active')
                                    <span class="offer-price">Rs. {{ number_format($product->specialOffer->offer_price, 2) }}</span><br>
                                    <s style="font-size: 14px; color: #989595; font-weight:500">Rs. {{ number_format($product->normal_price, 2) }}</s>
                                    <span style="color:red; font-size: 14px; margin-left: 5px; font-weight:500">
                                        {{ floor($product->specialOffer->offer_rate) }}% off
                                    </span>
                                @else
                                    Rs. {{ number_format($product->normal_price, 2) }}
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Pagination -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end mb-4" id="pagination">
        @if ($products->currentPage() > 1)
            <li class="page-item" id="prevPage">
                <a class="page-link" href="#" aria-label="Previous" data-page="{{ $products->currentPage() - 1 }}">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @endif
        
        @for ($i = 1; $i <= $products->lastPage(); $i++)
            <li class="page-item @if ($i == $products->currentPage()) active @endif">
                <a class="page-link" href="#" data-page="{{ $i }}">{{ $i }}</a>
            </li>
        @endfor
        
        @if ($products->hasMorePages())
            <li class="page-item" id="nextPage">
                <a class="page-link" href="#" aria-label="Next" data-page="{{ $products->currentPage() + 1 }}">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        @endif
    </ul>
</nav>
</div>


<!-- cart modal-->
@foreach ($products as $product)
    <div class="modal fade" id="cartModal_{{ $product->product_id }}" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content" style="border-radius: 0;">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gx-5">
                        <aside class="col-lg-5">
                            <div class="rounded-4 mb-3 d-flex justify-content-center">
                                <a class="rounded-4 main-image-link" href="{{ asset('storage/' . $product->images->first()->image_path) }}">
                                    <img id="mainImage" class="rounded-4 fit" src="{{ asset('storage/' . $product->images->first()->image_path) }}" />
                                </a>
                            </div>
                            <div class="d-flex justify-content-center mb-3">
                                @foreach($product->images as $image)
                                <a class="mx-1 rounded-2 thumbnail-image" data-image="{{ asset('storage/' . $image->image_path) }}" href="javascript:void(0);">
                                    <img class="thumbnail rounded-2" src="{{ asset('storage/' . $image->image_path) }}" />
                                </a>
                                @endforeach
                            </div>
                        </aside>

                        <main class="col-lg-7">
                            <h4>{{ $product->product_name }}</h4>
                            <p class="description">
                                {{ (str_replace('&nbsp;', ' ', strip_tags($product->product_description))) }}
                            </p>
                            <div class="d-flex flex-row my-3">
                                <div class="text-warning mb-1 me-2">
                                    @for($i = 0; $i < floor($product->average_rating); $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                    @if($product->average_rating - floor($product->average_rating) >= 0.5)
                                        <i class="fas fa-star-half-alt"></i>
                                    @endif
                                    @for($i = 0; $i < (5 - ceil($product->average_rating)); $i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                    <span class="ms-1">{{ number_format($product->average_rating, 1) }}</span>
                                </div>
                                <span class="text-primary">{{ $product->rating_count }} Ratings  </span>
                            </div>
                            <hr />
                            
                            <div class="product-availability mt-3 mb-1">
                                <span>Availability :</span>
                                @if($product->quantity > 1)
                                    <span class="ms-1" style="color:#4caf50;">In stock</span>
                                @else
                                    <span class="ms-1" style="color:red;">Out of stock</span>
                                @endif
                            </div>

                            <div class="product-container">
                            <!-- Size Options -->
                            @if($product->variations->where('type', 'Size')->isNotEmpty())
                                <div class="mb-2">
                                    <span>Size: </span>
                                    @foreach($product->variations->where('type', 'Size') as $size)
                                        @if($size->quantity > 0)  
                                            <button class="btn btn-outline-secondary btn-sm me-1 size-option" style="height:28px;" data-size="{{ $size->value }}">
                                                {{ $size->value }}
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            <!-- Color Options -->
                            @if($product->variations->where('type', 'Color')->isNotEmpty())
                                <div class="mb-2">
                                    <span>Color: </span>
                                    @foreach($product->variations->where('type', 'Color') as $color)
                                        @if($color->quantity > 0)  
                                            <button class="btn btn-outline-secondary btn-sm color-option" 
                                                style="background-color: {{ $color->hex_value }}; border-color: #e8ebec; height: 17px; width: 15px;" 
                                                data-color="{{ $color->hex_value }}">
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            <div class="product-price mb-3 mt-3 d-flex align-items-center">
                                <span class="h4" style="color:#f55b29; margin-right: 10px;">
                                    @if($product->specialOffer && $product->specialOffer->status === 'active') 
                                        Rs. {{ number_format($product->specialOffer->offer_price, 2) }} 
                                        <s style="font-size: 14px; color: #989595; font-weight: 500; margin-left: 5px;">
                                            Rs. {{ number_format($product->specialOffer->normal_price, 2) }}
                                        </s>
                                        <span class="discount" style="color:red; font-size: 18px; margin-left: 10px;">
                                            {{ floor($product->specialOffer->offer_rate) }}% off 
                                        </span>
                                    @else
                                        Rs. {{ number_format($product->normal_price, 2) }}
                                    @endif
                                </span>
                            </div>

                            @auth
                                <a href="#" class="btn btn-custom-cart mb-3 add-to-cart-modal shadow-0 {{ $product->quantity <= 1 ? 'btn-disabled' : '' }}"
                                    data-product-id="{{ $product->product_id }}" data-auth="true" style="width: 40%;">
                                    <i class="me-1 fa fa-shopping-basket"></i>Add to cart
                                </a>
                            @else
                                <a href="#" class="btn btn-custom-cart mb-3 add-to-cart-modal shadow-0 {{ $product->quantity <= 1 ? 'btn-disabled' : '' }}" 
                                    data-product-id="{{ $product->product_id }}" data-auth="false" style="width: 40%;">
                                    <i class="me-1 fa fa-shopping-basket"></i>Add to cart
                                </a>
                            @endauth

                            <a href="{{ route('single_product_page', $product->product_id ) }}" style="text-decoration: none; font-size:14px; color: #297aa5">
                            View Full Details<i class="fa-solid fa-circle-right ms-1"></i></a>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>


   


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-cart').forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation();
                event.preventDefault();
            });
        });
    });

     //pagination
    document.addEventListener('DOMContentLoaded', function () {
    const productList = document.getElementById('product-list');
    const paginationButtons = document.getElementById('pagination');

    paginationButtons.addEventListener('click', function (event) {
        if (event.target.closest('.page-link')) {
            event.preventDefault(); // Prevent default link behavior
            const page = event.target.closest('.page-link').getAttribute('data-page');
            fetchProducts(page);
        }
    });

    function fetchProducts(page) {
        fetch(`/home/special_offer_products?page=${page}`)
            .then(response => response.text())
            .then(data => {
                productList.innerHTML = new DOMParser().parseFromString(data, 'text/html').getElementById('product-list').innerHTML;

                const newPagination = new DOMParser().parseFromString(data, 'text/html').getElementById('pagination');
                paginationButtons.innerHTML = newPagination.innerHTML;

                paginationButtons.addEventListener('click', function (event) {
                    if (event.target.closest('.page-link')) {
                        event.preventDefault(); 
                        const page = event.target.closest('.page-link').getAttribute('data-page');
                        fetchProducts(page);
                    }
                });
            })
            .catch(error => console.error('Error fetching products:', error));
    }
});


</script>


<script>
$(document).ready(function() {
    // Add to Cart click event
    $('.add-to-cart-modal').on('click', function(e) {
        e.preventDefault();

        const productId = $(this).data('product-id');
        const isAuth = $(this).data('auth');  

        // Get the closest product container
        const productContainer = $(this).closest('.product-container');

        // Check for the existence of size and color options scoped to the specific product
        const sizeOptions = productContainer.find('button.size-option');
        const colorOptions = productContainer.find('button.color-option');

        const hasSizeOptions = sizeOptions.length > 0;
        const hasColorOptions = colorOptions.length > 0;

        // Get selected size and color only if their options are available
        const selectedSize = hasSizeOptions ? sizeOptions.filter('.active').data('size') : null;  
        const selectedColor = hasColorOptions ? colorOptions.filter('.active').data('color') : null;



        // Check if size options are present and if a size was selected
        if (hasSizeOptions && !selectedSize) {
            toastr.warning('Please select a size option before adding this product to the cart.', 'Warning', {
                positionClass: 'toast-top-right',
                timeOut: 3000,
            });
            return;
        }

        // Check if color options are present and if a color was selected
        if (hasColorOptions && !selectedColor) {
            toastr.warning('Please select a color option before adding this product to the cart.', 'Warning', {
                positionClass: 'toast-top-right',
                timeOut: 3000,
            });
            return;
        }

        // Proceed to add to cart
        if (isAuth === true || isAuth === "true") { 
            $.ajax({
                url: "{{ route('cart.add') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    size: selectedSize,  // Include size if it was selected or null
                    color: selectedColor   // Include color if it was selected or null
                },
                success: function(response) {
                    $.get("{{ route('cart.count') }}", function(data) {
                        $('#cart-count').text(data.cart_count);
                    });

                    toastr.success('Item added to cart!', 'Success', {
                        positionClass: 'toast-top-right',
                        timeOut: 3000,
                    });

                    // Reset active states after adding to cart
                    productContainer.find('button.size-option.active').removeClass('active');
                    productContainer.find('button.color-option.active').removeClass('active');
                },
                error: function(xhr) {
                    toastr.error('Something went wrong. Please try again.', 'Error', {
                        positionClass: 'toast-top-right',
                        timeOut: 3000,
                    });
                }
            });
        } else {
            toastr.warning('Please log in to add items to your cart.', 'Warning', {
                positionClass: 'toast-top-right',
                timeOut: 3000,
            });
        }
    });

    $('.size-option').on('click', function() {
        $('.size-option').removeClass('active');
        $(this).addClass('active');
    });

    $('.color-option').on('click', function() {
        $('.color-option').removeClass('active');
        $(this).addClass('active');
    });

    $('.color-option').on('click', function() {
        $('.color-option').removeClass('selected-color');
        $(this).addClass('selected-color');
    });  
});

document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.thumbnail-image').forEach(function(thumbnail) {
            thumbnail.addEventListener('click', function() {
                const newImage = this.getAttribute('data-image');
                document.getElementById('mainImage').setAttribute('src', newImage);
                document.querySelector('.main-image-link').setAttribute('href', newImage);
            });
        });
    });

</script>


@endsection
