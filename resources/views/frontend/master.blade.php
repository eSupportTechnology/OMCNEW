<!DOCTYPE html>
<html lang="zxx">
    <head>
        
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/boxicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/nice-select.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/meanmenu.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/rangeSlider.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
        <!-- <link rel="stylesheet" href="{{ asset('frontend/assets/css/dark.css') }}">-->
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>OMC - Online Marketing Complex</title>

        <link rel="icon" type="image/png" href="assets/images/logo1.png" style="">
       
    </head>
    <body>
        
       
        @include('frontend.navbar-new')
       

        @yield('content')
        @include('frontend.footer-new')

       
          <!-- Start Sidebar Modal -->
          <div class="modal right fade sidebarModal" id="sidebarModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class='bx bx-x'></i></span>
                    </button>

                    <div class="modal-body">
                        <div class="sidebar-about-content">
                            <h3>About The Store</h3>

                            <div class="about-the-store">
                                <p>One of the most popular on the web is shopping. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                
                                <ul class="sidebar-contact-info">
                                    <li><i class='bx bx-map'></i> <a href="#" target="_blank"> No 425/2, Parakum Place, Kaduruwela, Polannaruwa.</a></li>
                                    <li><i class='bx bx-phone-call'></i> <a href="tel:075 833 7141">075 833 7141</a></li>
                                    <li><i class='bx bx-envelope'></i> <a href="mailto:omarketingcomplex@gmail.com">omarketingcomplex@gmail.com</a></li>
                                </ul>
                            </div>

                            <ul class="social-link">
                                <li><a href="https://www.facebook.com/" class="d-block" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                                <li><a href="https://twitter.com/login" class="d-block" target="_blank"><i class='bx bxl-twitter'></i></a></li>
                                <li><a href="https://www.instagram.com/" class="d-block" target="_blank"><i class='bx bxl-instagram'></i></a></li>
                                <li><a href="https://www.linkedin.com/login" class="d-block" target="_blank"><i class='bx bxl-linkedin'></i></a></li>
                                <li><a href="https://www.pinterest.com/" class="d-block" target="_blank"><i class='bx bxl-pinterest-alt'></i></a></li>
                            </ul>
                        </div>

                        <div class="sidebar-new-in-store">
                            <h3>New In Store</h3>

                            <ul class="products-list">
                                <li>
                                    <a href="#"><img src="frontend/assets/img/products/img1.jpg" alt="image"></a>
                                </li>

                                <li>
                                    <a href="#"><img src="frontend/assets/img/products/img2.jpg" alt="image"></a>
                                </li>

                                <li>
                                    <a href="#"><img src="frontend/assets/img/products/img3.jpg" alt="image"></a>
                                </li>

                                <li>
                                    <a href="#"><img src="frontend/assets/img/products/img4.jpg" alt="image"></a>
                                </li>
                            </ul>

                            <p></p>
                            <a href="/all-items" class="shop-now-btn">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Sidebar Modal -->

        <!-- Start QuickView Modal Area -->
        <div class="modal fade productsQuickView" id="productsQuickView" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class='bx bx-x'></i></span>
                    </button>

                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="products-image">
                                <img src="frontend/assets/img/quick-view-img.jpg" alt="image">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="products-content">
                                <h3><a href="#">Long Sleeve Leopard T-Shirt</a></h3>

                                <div class="price">
                                    <span class="old-price">RS 2500</span>
                                    <span class="new-price">RS 1500</span>
                                </div>

                                <div class="products-review">
                                    <div class="rating">
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                    </div>
                                    <a href="#" class="rating-count">3 reviews</a>
                                </div>

                                <ul class="products-info">
                                    <li><span>Vendor:</span> <a href="#">Lereve</a></li>
                                    <li><span>Availability:</span> <a href="#">In stock (7 items)</a></li>
                                    <li><span>Products Type:</span> <a href="#">T-Shirt</a></li>
                                    <li><span>Products Description:</span> <a href="#">This is new meterial</a></li>
                                </ul>

                                <div class="products-color-switch">
                                    <h4>Color:</h4>

                                    <ul>
                                        <li><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Black" class="color-black"></a></li>
                                        <li><a href="#" data-bs-toggle="tooltip" data-placement="top" title="White" class="color-white"></a></li>
                                        <li><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Green" class="color-green"></a></li>
                                        <li><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Yellow Green" class="color-yellowgreen"></a></li>
                                        <li><a href="#" data-bs-toggle="tooltip" data-placement="top" title="Teal" class="color-teal"></a></li>
                                    </ul>
                                </div>

                                <div class="products-size-wrapper">
                                    <h4>Size:</h4>

                                    <ul>
                                        <li><a href="#">XS</a></li>
                                        <li class="active"><a href="#">S</a></li>
                                        <li><a href="#">M</a></li>
                                        <li><a href="#">XL</a></li>
                                        <li><a href="#">XXL</a></li>
                                    </ul>
                                </div>

                                <div class="products-add-to-cart">
                                    <div class="input-counter">
                                        <span class="minus-btn"><i class='bx bx-minus'></i></span>
                                        <input type="text" value="1">
                                        <span class="plus-btn"><i class='bx bx-plus'></i></span>
                                    </div>

                                    <button type="submit" class="default-btn">Add to Cart</button>
                                </div>

                                <a href="#" class="view-full-info">View Full Info</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End QuickView Modal Area -->

        <!-- Start Shopping Cart Modal -->
        <div class="modal right fade shoppingCartModal" id="shoppingCartModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class='bx bx-x'></i></span>
                    </button>

                    <div class="modal-body">
                        <h3>My Cart (3)</h3>

                        <div class="products-cart-content">
                            <div class="products-cart">
                                <div class="products-image">
                                    <a href="#"><img src="frontend/assets/img/products/img1.jpg" alt="image"></a>
                                </div>

                                <div class="products-content">
                                    <h3><a href="#">Long Sleeve Leopard T-Shirt</a></h3>
                                    <span>Blue / XS</span>
                                    <div class="products-price">
                                        <span>1</span>
                                        <span>x</span>
                                        <span class="price">RS 3500</span>
                                    </div>
                                    <a href="#" class="remove-btn"><i class='bx bx-trash'></i></a>
                                </div>
                            </div>

                            <div class="products-cart">
                                <div class="products-image">
                                    <a href="#"><img src="frontend/assets/img/products/img2.jpg" alt="image"></a>
                                </div>

                                <div class="products-content">
                                    <h3><a href="#">Causal V-Neck Soft Raglan</a></h3>
                                    <span>Blue / XS</span>
                                    <div class="products-price">
                                        <span>1</span>
                                        <span>x</span>
                                        <span class="price">RS 2000</span>
                                    </div>
                                    <a href="#" class="remove-btn"><i class='bx bx-trash'></i></a>
                                </div>
                            </div>

                            <div class="products-cart">
                                <div class="products-image">
                                    <a href="#"><img src="frontend/assets/img/products/img3.jpg" alt="image"></a>
                                </div>

                                <div class="products-content">
                                    <h3><a href="#">Hanes Men's Pullover</a></h3>
                                    <span>Blue / XS</span>
                                    <div class="products-price">
                                        <span>1</span>
                                        <span>x</span>
                                        <span class="price">RS 3000</span>
                                    </div>
                                    <a href="#" class="remove-btn"><i class='bx bx-trash'></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="products-cart-subtotal">
                            <span>Subtotal</span>

                            <span class="subtotal">RS 8500</span>
                        </div>

                        <div class="products-cart-btn">
                            <a href="/checkout" class="default-btn">Proceed to Checkout</a>
                            <a href="/cart" class="optional-btn">View Shopping Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Shopping Cart Modal -->

        <!-- Start Wishlist Modal -->
        <div class="modal right fade shoppingWishlistModal" id="shoppingWishlistModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class='bx bx-x'></i></span>
                    </button>

                    <div class="modal-body">
                        <h3>My Wish List ({{ $wishlistCount }})</h3>

                        @if(auth()->check()) 
                        @forelse($wishlistItems as $item)
                        <div class="products-cart-content">
                            <div class="products-cart">
                                <div class="products-image">
                                    <a href="{{ route('product-description', ['product_id' => $item->product_id]) }}">
                                        <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" alt="image" style="width:50px">
                                    </a>
                                </div>

                                <div class="products-content">
                                    <h3><a href="{{ route('product-description', ['product_id' => $item->product_id]) }}">
                                    {{ $item->product->product_name }}</a></h3>
                                    <div class="products-price">
                                        <span class="price">Rs {{ number_format($item->product->sale->sale_price ?? $item->product->specialOffer->offer_price ?? $item->product->normal_price, 2) }}
                                        </span>
                                    </div>
                                    <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" style="display: inline; border:none">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="remove-btn" style="border:none">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>

                                </div>
                            </div>
                            @empty
                                <p>Your wishlist is empty.</p>
                            @endforelse
                        @else
                            <p>Please <a href="{{ route('login') }}">login</a> to view your wishlist.</p>
                        @endif
                        

                        <div class="products-cart-btn">
                            <a href="/cart" class="optional-btn">View Shopping Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Wishlist Modal -->

        <!-- Start Size Guide Modal Area -->
        <div class="modal fade sizeGuideModal" id="sizeGuideModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="bx bx-x"></i></span>
                    </button>

                    <div class="modal-sizeguide">
                        <h3>Size Guide</h3>
                        <p>This is an approximate conversion table to help you find your size.</p>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Italian</th>
                                        <th>Spanish</th>
                                        <th>German</th>
                                        <th>UK</th>
                                        <th>US</th>
                                        <th>Japanese</th>
                                        <th>Chinese</th>
                                        <th>Russian</th>
                                        <th>Korean</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>34</td>
                                        <td>30</td>
                                        <td>28</td>
                                        <td>4</td>
                                        <td>00</td>
                                        <td>3</td>
                                        <td>155/75A</td>
                                        <td>36</td>
                                        <td>44</td>
                                    </tr>
                                    <tr>
                                        <td>36</td>
                                        <td>32</td>
                                        <td>30</td>
                                        <td>6</td>
                                        <td>0</td>
                                        <td>5</td>
                                        <td>155/80A</td>
                                        <td>38</td>
                                        <td>44</td>
                                    </tr>
                                    <tr>
                                        <td>38</td>
                                        <td>34</td>
                                        <td>32</td>
                                        <td>8</td>
                                        <td>2</td>
                                        <td>7</td>
                                        <td>160/84A</td>
                                        <td>40</td>
                                        <td>55</td>
                                    </tr>
                                    <tr>
                                        <td>40</td>
                                        <td>36</td>
                                        <td>34</td>
                                        <td>10</td>
                                        <td>4</td>
                                        <td>9</td>
                                        <td>165/88A</td>
                                        <td>42</td>
                                        <td>55</td>
                                    </tr>
                                    <tr>
                                        <td>42</td>
                                        <td>38</td>
                                        <td>36</td>
                                        <td>12</td>
                                        <td>6</td>
                                        <td>11</td>
                                        <td>170/92A</td>
                                        <td>44</td>
                                        <td>66</td>
                                    </tr>
                                    <tr>
                                        <td>44</td>
                                        <td>40</td>
                                        <td>38</td>
                                        <td>14</td>
                                        <td>8</td>
                                        <td>13</td>
                                        <td>175/96A</td>
                                        <td>46</td>
                                        <td>66</td>
                                    </tr>
                                    <tr>
                                        <td>46</td>
                                        <td>42</td>
                                        <td>40</td>
                                        <td>16</td>
                                        <td>10</td>
                                        <td>15</td>
                                        <td>170/98A</td>
                                        <td>48</td>
                                        <td>77</td>
                                    </tr>
                                    <tr>
                                        <td>48</td>
                                        <td>44</td>
                                        <td>42</td>
                                        <td>18</td>
                                        <td>12</td>
                                        <td>17</td>
                                        <td>170/100B</td>
                                        <td>50</td>
                                        <td>77</td>
                                    </tr>
                                    <tr>
                                        <td>50</td>
                                        <td>46</td>
                                        <td>44</td>
                                        <td>20</td>
                                        <td>14</td>
                                        <td>19</td>
                                        <td>175/100B</td>
                                        <td>52</td>
                                        <td>88</td>
                                    </tr>
                                    <tr>
                                        <td>52</td>
                                        <td>48</td>
                                        <td>46</td>
                                        <td>22</td>
                                        <td>16</td>
                                        <td>21</td>
                                        <td>180/104B</td>
                                        <td>54</td>
                                        <td>88</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Size Guide Modal Area -->

        <!-- Start Shipping Modal Area -->
        <div class="modal fade productsShippingModal" id="productsShippingModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class='bx bx-x'></i></span>
                    </button>

                    <div class="shipping-content">
                        <h3>Shipping</h3>
                        <ul>
                            <li>Complimentary ground shipping within 1 to 7 business days</li>
                            <li>In-store collection available within 1 to 7 business days</li>
                            <li>Next-day and Express delivery options also available</li>
                            <li>Purchases are delivered in an orange box tied with a Bolduc ribbon, with the exception of certain items</li>
                            <li>See the delivery FAQs for details on shipping methods, costs and delivery times</li>
                        </ul>

                        <h3>Returns and Exchanges</h3>
                        <ul>
                            <li>Easy and complimentary, within 14 days</li>
                            <li>See conditions and procedure in our return FAQs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Shipping Modal Area -->

        
        
        

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
        <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/magnific-popup.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/parallax.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/rangeSlider.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/nice-select.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/meanmenu.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/slick.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/sticky-sidebar.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/form-validator.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/contact-form-script.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/ajaxchimp.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/main.js') }}"></script>



<!-- Include Toastr.js after jQuery -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

       <script>
        $(document).ready(function() {
            console.log("Fetching cart count from: {{ route('cart.count') }}");
            
            $.get("{{ route('cart.count') }}", function(data) {
                // Update both cart count elements
                $('#cart-count-header').text(data.cart_count);
                $('#cart-count-navbar').text(data.cart_count);
            });

            $(document).ready(function() {
                console.log("jQuery is working!");
            });
        });
    </script>

  </body>
</html>