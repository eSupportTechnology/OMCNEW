@extends('layouts.app')

@section('content')
<!-- Include Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />



<style>
 .card-title {
    text-align: center; 
    color:white;
    font-size: 17px;
 }
.shopping-titles .card{
    border-radius: 15px; 
    overflow: hidden; 
    width:90%;

}
.card-title i {
    margin-right: 7px; 
    font-size: 1.2em;  
}

.rounded-circle{
    width:110px;
    background-color: #f5f5f5;
}

.category-circle a{
    color: black;
    font-weight: 500;
}


.navbar-scrolled {
    background-color: #fff; 
    transition: background-color 0.3s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1); 
}


.navbar-divider {
    height: 35px;
    display: flex;
    align-items: center;
}

.custom-dropdown .dropdown-toggle {
    background-color: transparent;
    color: black;
    border: none;
    border-radius: 8px;
    height: 30px;
    padding: 5px 10px;
    text-align: left;
    display: flex;
    align-items: center;
    width: 100%;
    font-size:16px;
    box-sizing: border-box; 
    cursor: pointer; 
    font-weight:500;
}

.category-icon {
    width: 26px; 
    height: 26px; 
    margin-right: 8px; 
    vertical-align: middle; 
}

/* flash sale page */
.sale-item {
    text-align: center;
    padding: 5px; 
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    box-sizing: border-box;
    margin-bottom: 15px;
    width: 110%; 
}

.sale .row {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
}

.sale-item:hover {
    border: 1px solid #e1e1e1;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
}

.sale-item a {
    text-decoration: none;
    color: black;
}

.sale-item img {
    width: 100%;
    height: auto;
    object-fit: cover;
    margin-bottom: 5px;
}

.sale-image-wrapper {
    width: 100%;
    height: 280px; 
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

.sale-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover; 
}

.sale-item h6 {
    text-align: left;
    font-size: 15px; 
    margin: 2px 0;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.sale-item .price {
    text-align: left;
    color: orange;
    font-size: 15px; 
    font-weight: bold;
}


/*search bar*/

.search-item {
    padding: 10px;
    border-bottom: 1px solid #ccc;
    cursor: pointer; 
}

.search-item a {
    text-decoration: none;
    color: #000;
}

.search-item:hover {
    background-color: #f1f1f1;
}

</style>


@if (session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success("{{ session('status') }}", 'Success', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
@endif
<nav class="navbar navbar-expand-lg navbar-light fixed-top p-0 m-0">
    <div class="container mb-3"  style="display: flex; flex-direction: column;">
        <div class="row w-100">
            <div class="col-md-4 d-flex justify-content-center justify-content-md-start align-items-center mb-md-0">
                <a href="{{ url('/') }}" class="d-flex align-items-center" style="text-decoration: none">
                    <div class="navbar-brand">
                        <img src="/assets/images/logo2.png" height="70" width="40" alt="Logo"/>
                    </div>
                    <img src="/assets/images/brand_name.png" height="30" width="320" alt="brand"/>
                </a>
            </div>
            <div class="col-md-4 mt-4 d-none d-md-block">
                <form class="d-flex input-group w-auto my-auto mb-md-0">
                    <input autocomplete="off" id="search" type="search" class="form-control rounded" placeholder="Search"  />
                    <span class="input-group-text border-0 d-none d-lg-flex"><i class="fas fa-search"></i></span>
                 </form>
                    <div id="search-results" style="display:none; position:absolute; background:white; width:27%; border:1px solid #ccc;z-index: 1000;"></div>
            </div>


            <div class="col-md-4 p-3 d-flex justify-content-center justify-content-md-end align-items-center">
                <div class="d-flex align-items-center">
                    <div class="dropdown me-3">
                        <a class="text-reset dropdown-toggle1" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('all_items') }}">All Items</a></li>
                            <li><a class="dropdown-item" href="{{ route('helpcenter') }}">Help Center</a></li>
                        </ul>
                    </div>
                    <span class="me-3">|</span>
                    <a class="text-reset me-5" href="{{ route('shopping_cart') }}" style="position: relative;">
                        <span style="font-size: 19px; position: relative;">
                            <i class="fas fa-shopping-cart"></i>
                        </span>
                        <span id="cart-count" class="badge badge-danger">
                            0
                        </span>
                    </a>
                    @guest
                        @if (Route::has('login'))
                            <a class="text-reset me-3" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                                <div style="font-weight:500">LOGIN</div>
                                @if (Route::has('register'))
                                    <a class="signup-btn p-2" href="{{ route('register') }}" style="">SIGN UP</a>
                                @endif
                            </a>
                        @endif
                        @else
                        <div class="dropdown me-3">  
                         <a id="navbarDropdown" class="text-reset dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          <div class="icon-circle">
                          @if(Auth::user()->profile_image)
                            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" style="width: 33px; height: 33px; border-radius: 50%; object-fit: cover;" class="profile_image">
                          @else
                          
                          @endif
                        </div>
                            <span class="ms-2">{{ Auth::user()->name }}</span>
                         </a>
                       <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('dashboard') }}" style="font-size: 15px;">
                          {{ __('My Profile') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-size: 15px;">
                          {{ __('Logout') }}
                        </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                       @csrf
                       </form>
                     </div>
                    </div>

                   @endguest

                </div>
            </div>
        </div>


<!-- Navbar Divider -->
<div class="navbar-divider w-100 p-0 mb-1">
    <div class="container d-flex justify-content-center align-items-center" style="width: 80%;">

        <div class="d-flex align-items-center" style="font-size: 16px;">

            <!-- All Categories Dropdown -->
            <div class="custom-dropdown me-4">
                <div class="dropdown-toggle" id="dropdownMenuButton" aria-expanded="false">
                    <i class="fas fa-bars me-2"></i> All Categories
                </div>
                <div class="dropdown-menu">
                    @foreach ($categories as $category)
                        <div class="dropdown-item dropdown-submenu">
                            <a href="{{ route('user_products', ['category' => $category->parent_category]) }}">
                                <img src="{{ asset('storage/category_images/' . $category->image) }}" alt="{{ $category->parent_category }} icon" class="category-icon">
                                {{ $category->parent_category }}
                            </a>
                            @if ($category->subcategories->isNotEmpty()) 
                                <div class="dropdown-menu multi-column">
                                    @foreach ($category->subcategories as $subcategory)
                                        <div class="dropdown-column">
                                            <a href="{{ route('user_products', ['category' => $category->parent_category, 'subcategory' => $subcategory->subcategory]) }}">
                                                <strong style="font-size:16px;">{{ $subcategory->subcategory }}</strong>
                                            </a>
                                            @if ($subcategory->subSubcategories->isNotEmpty())
                                                @foreach ($subcategory->subSubcategories as $subSubcategory)
                                                    <a href="{{ route('user_products', ['category' => $category->parent_category, 'subcategory' => $subcategory->subcategory, 'subsubcategory' => $subSubcategory->sub_subcategory]) }}">
                                                        {{ $subSubcategory->sub_subcategory }}
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex ms-4 d-none d-md-flex otherlinks">
                <a href="{{ route('all_items') }}" class="mx-3">All Items</a>
                <a href="{{ route('special_offerproducts') }}" class="mx-3">Special Offers</a>
                <a href="{{ route('sale_products') }}" class="mx-3">Flash Sale</a>
                <a href="{{ route('best_sellers') }}" class="mx-3">Bestsellers</a>
            </div>

            <!-- Visible only on screens smaller than 660px -->
            <div class="dropdown d-md-none otherlinks ms-4">
                <a class="dropdown-toggle" href="#" id="otherLinksDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Other
                </a>
                <ul class="dropdown-menu" aria-labelledby="otherLinksDropdown">
                    <li><a class="dropdown-item" href="{{ route('all_items') }}">All Items</a></li>
                    <li><a class="dropdown-item" href="{{ route('special_offerproducts') }}">Special Offers</a></li>
                    <li><a class="dropdown-item" href="{{ route('sale_products') }}">Flash Sale</a></li>
                    <li><a class="dropdown-item" href="{{ route('best_sellers') }}">Bestsellers</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>




</nav>


           

<!-- carousel -->
<div id="introCarousel" class="carousel slide carousel-fade shadow-2-strong" data-mdb-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-mdb-target="#introCarousel" data-mdb-slide-to="0" class="active me-1"></button>
        <button type="button" data-mdb-target="#introCarousel" data-mdb-slide-to="1" class="me-1"></button>
        <button type="button" data-mdb-target="#introCarousel" data-mdb-slide-to="2"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active" style="background-image: url('/assets/images/slider/slider6.png');">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-white">
                    <h1 class="mb-4 mt-2">Elevate Your <br>Lifestyle</h1>
                    <h5 class="mb-4 mt-5">On home & living, leisure & more</h5>
                    <!--<a class="btn btn-outline-light btn-lg m-2" href="#" role="button" rel="nofollow">Add to Cart</a>-->
                </div>
            </div>
        </div>
       
        <div class="carousel-item" style="background-image: url('/assets/images/slider/neww.jpg');">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-white">
                        <h1 class="mb-3">Summer<br>Fashion Sale</h1><br>
                        <h5 class="mb-4">New arrivals Summer Collection</h5>
                        <h4 class="mt-5 text-white">UP TO 50% OFF</h4>
                    </div>
                </div>
        </div>
        <!-- <div class="carousel-item" style="background-image: url('/assets/images/slider/d.jpg');">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-white">
                    <h1 class="mb-4 mt-2">Elevate Your <br>Lifestyle</h1>
                    <h5 class="mb-4 mt-5">On home & living, leisure & more</h5>
                </div>
            </div>
        </div>-->

    </div>

    <a class="carousel-control-prev" href="#introCarousel" role="button" data-mdb-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#introCarousel" role="button" data-mdb-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>






<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}<i class="text-danger">*</i></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }} <i class="text-danger">*</i></label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>
                        @if (Route::has('password.request'))
                            <div>
                                <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary w-100 mt-4 mb-3">{{ __('Login') }}</button>
                    </form>
                    <div class="text-center mt-1">
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <hr class="flex-grow-1">
                            <span class="mx-2 text-secondary">Or continue with</span>
                            <hr class="flex-grow-1">
                        </div>
                        <a class="btn btn-floating" href="#!" role="button">
                            <i class="fa-brands fa-facebook fa-3x" style="color: #2ba2fd;"></i>
                        </a>
                        <a class="btn btn-floating" href="#!" role="button">
                            <i class="fab fa-google fa-3x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Login Modal -->
    @if ($errors->has('email') || $errors->has('password'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
            });
        </script>
    @endif


<!-- categories view -->
<div class="container shopping-titles mt-4 mb-3" style="width: 80%;">
    <div class="row mt-5 row-cols-2 row-cols-md-3 row-cols-lg-6 g-2">
        @foreach ($categories as $category)
            <div class="col text-center category-circle">
            <a href="{{ route('user_products', ['category' => $category->parent_category]) }}">
                <img src="{{ asset('storage/category_images/' . $category->image) }}" alt="{{ $category->parent_category }}" class="rounded-circle">
                <p class="mt-2">{{ $category->parent_category }}</p>
            </a>
            </div>
        @endforeach
    </div>
</div>






<!-- Special Offers -->
<div class="container mt-5 mb-4 special-offers" style="width:76%;">
    <a href="{{ route('special_offerproducts') }}" style="text-decoration: none; color:black;"><h4>Special Offers</h4></a>
    <div class="row justify-content-between">
        @foreach ($specialOffers as $offer)
            <div class="col-md-2 col-sm-5 col-6 mb-2">
                <div class="special-offer-item mb-2">
                    <a href="{{ route('single_product_page', ['product_id' => $offer->product_id]) }}">
                        @if ($offer->product->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $offer->product->images->first()->image_path) }}" class="card-img-top" alt="{{ $offer->product->product_name }}"/>
                        @else
                            <img src="" class="card-img-top" alt="Default Image"/>
                        @endif
                        <div class="card-body">
                            <h5>{{ $offer->product->product_name }}</h5>
                            <div class="price">Rs.{{ number_format($offer->offer_price, 2) }} <s style="font-size:12px; color: #989595; font-weight:500">Rs.{{ number_format($offer->normal_price, 2) }}</s></div>
                            <div class="discount">{{ $offer->offer_rate }}% off</div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>



<!--Flash Sale Section-->
<div class="container mt-5 flash-sale" style="width:76%; background: linear-gradient(to top, #f0f0f0, #ffffff);">
    <h4><i class="fas fa-bolt" style="color: #FFD43B;"></i> Flash Sale</h4>
    <div class="row mt-3" id="product-list">
            @foreach ($flashSales as $sale)
                    <div class="col-6 col-sm-4 col-md-2 col-lg- mb-3">
                        <div class="sale-item position-relative">
                            <a href="{{ route('single_product_page', ['product_id' => $sale->product->product_id]) }}" class="d-block text-decoration-none">
                                <div class="sale-image-wrapper position-relative">
                                    @if ($sale->product->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $sale->product->images->first()->image_path) }}" alt="Product Image" class="img-fluid">
                                    @else
                                        <img src="{{ asset('storage/default-image.jpg') }}" alt="Default Image" class="img-fluid">
                                    @endif

                                    <!-- Flash Sale Icon -->
                                    <div class="flash-sale-icon position-absolute top-0 start-0 m-0 my-1">
                                        <span style="background-color: #FFD43B; color: black; padding: 5px; border-radius:none">
                                            <i class="fas fa-bolt"></i> {{ floor($sale->sale_rate) }}% 
                                        </span>
                                    </div>
                                </div>
                                <h6 class="product-name">{{ \Illuminate\Support\Str::limit($sale->product->product_name, 20, '...') }}</h6>
                                <div class="price">
                                    <span class="offer-price">Rs. {{ number_format($sale->sale_price, 2) }}</span><br>
                                    <s style="font-size: 14px; color: #989595; font-weight:500">Rs. {{ number_format($sale->normal_price, 2) }}</s>
                                </div>
                            </a>
                        </div>
                    </div>

            @endforeach
        </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
 <script type="text/javascript" src="/assets/carousel/js/mdb.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var dropdownToggle = document.getElementById('dropdownMenuButton');
            var dropdownMenu = dropdownToggle.nextElementSibling;

            dropdownToggle.addEventListener('click', function () {
                dropdownMenu.classList.toggle('show');
            });

            document.addEventListener('click', function (event) {
                if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.navbar');
        const scrollThreshold = 50; 

        function handleScroll() {
            if (window.scrollY > scrollThreshold) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        }

        window.addEventListener('scroll', handleScroll);

        handleScroll();
    });


    document.addEventListener('DOMContentLoaded', function () {
    const carousel = new mdb.Carousel(document.getElementById('introCarousel'), {
        interval: 2000,
        ride: 'carousel'
    });
    });

</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Include Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#search').on('keyup', function(event) {
            var query = $(this).val();
            // Check if the query length is more than 2 characters
            if (query.length > 2) {
                $.ajax({
                    url: "{{ route('searchProducts') }}", // Route to handle search
                    type: "GET",
                    data: { search: query },
                    success: function(data) {
                        $('#search-results').empty().show(); // Clear previous results and show dropdown
                        if (data.length > 0) {
                            $.each(data, function(index, product) {
                                $('#search-results').append(
                                    '<div class="search-item" data-href="/product/' + product.product_id + '">' +
                                        product.product_name +
                                    '</div>'
                                );
                            });
                        } else {
                            $('#search-results').append('<div class="search-item">No products found</div>');
                        }
                    },
                    error: function() {
                        $('#search-results').empty().show();
                        $('#search-results').append('<div class="search-item">Error searching products</div>');
                    }
                });
            } else {
                $('#search-results').hide(); // Hide dropdown if query is too short
            }

            // Handle search submission on Enter key
            if (event.key === 'Enter') {
                window.location.href = "/search-results?query=" + encodeURIComponent(query);
            }
        });

        // Handle click event on the search icon
        $('#search-icon').on('click', function() {
            var query = $('#search').val();
            if (query.length > 2) {
                window.location.href = "/search-results?query=" + encodeURIComponent(query);
            }
        });

        // Hide results when clicking outside of the search input
        $(document).click(function(e) {
            if (!$(e.target).closest('#search, #search-results').length) {
                $('#search-results').hide();
            }
        });

        // Make entire search item clickable
        $('#search-results').on('click', '.search-item', function() {
            var href = $(this).data('href'); // Get the URL from the data attribute
            window.location.href = href; // Redirect to the product page
        });
    });
</script>




@endsection
