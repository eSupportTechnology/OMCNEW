@extends('layouts.app')

@section('content')

<style>
        
</style>



<!--cosmetics-->
<div class="container mt-4 mb-5">
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cosmetics</li>
        </ol>
    </nav>

        <div class="products">
            <div class="row mt-3">
                <div class="col-md-3">
                    <div class="products-item">
                        <a href="{{ route('single_product_page') }}">
                            <img src="/assets/images/cosmetics1.jpg" alt="Product 1">
                            <h6>Shop online with BRAND COSMETICS now! Visit BRAND COSMETICS</h6>
                            <div class="price">Rs.1350</div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-item">
                        <img src="/assets/images/cosmetics2.jpg" alt="Product 1">
                        <h6>Shop online with BRAND COSMETICS now! Visit BRAND COSMETICS</h6>
                        <div class="price">Rs.1350</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-item">
                        <img src="/assets/images/cosmetics3.png" alt="Product 1">
                        <h6>Shop online with BRAND COSMETICS now! Visit BRAND COSMETICS</h6>
                        <div class="price">Rs.1350</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-item">
                        <img src="/assets/images/cosmetics4.jpg" alt="Product 1">
                        <h6>Shop online with BRAND COSMETICS now! Visit BRAND COSMETICS</h6>
                        <div class="price">Rs.1350</div>
                    </div>
                </div>
            </div>
        </div>



    <div class="row-divider"></div>
   

    <div class="products">
            <div class="row mt-3">
                <div class="col-md-3">
                    <div class="products-item">
                        <img src="/assets/images/cosmetics1.jpg" alt="Product 1">
                        <h6>Shop online with BRAND COSMETICS now! Visit BRAND COSMETICS</h6>
                        <div class="price">Rs.1350</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-item">
                        <img src="/assets/images/cosmetics2.jpg" alt="Product 1">
                        <h6>Shop online with BRAND COSMETICS now! Visit BRAND COSMETICS</h6>
                        <div class="price">Rs.1350</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-item">
                        <img src="/assets/images/cosmetics3.png" alt="Product 1">
                        <h6>Shop online with BRAND COSMETICS now! Visit BRAND COSMETICS</h6>
                        <div class="price">Rs.1350</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-item">
                        <img src="/assets/images/cosmetics4.jpg" alt="Product 1">
                        <h6>Shop online with BRAND COSMETICS now! Visit BRAND COSMETICS</h6>
                        <div class="price">Rs.1350</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row-divider"></div>

        <div class="products">
            <div class="row mt-3">
                <div class="col-md-3">
                    <div class="products-item">
                        <img src="/assets/images/cosmetics1.jpg" alt="Product 1">
                        <h6>Shop online with BRAND COSMETICS now! Visit BRAND COSMETICS</h6>
                        <div class="price">Rs.1350</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-item">
                        <img src="/assets/images/cosmetics2.jpg" alt="Product 1">
                        <h6>Shop online with BRAND COSMETICS now! Visit BRAND COSMETICS</h6>
                        <div class="price">Rs.1350</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-item">
                        <img src="/assets/images/cosmetics3.png" alt="Product 1">
                        <h6>Shop online with BRAND COSMETICS now! Visit BRAND COSMETICS</h6>
                        <div class="price">Rs.1350</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-item">
                        <img src="/assets/images/cosmetics4.jpg" alt="Product 1">
                        <h6>Shop online with BRAND COSMETICS now! Visit BRAND COSMETICS</h6>
                        <div class="price">Rs.1350</div>
                    </div>
                </div>
            </div>
        </div>
    
</div>



@endsection
