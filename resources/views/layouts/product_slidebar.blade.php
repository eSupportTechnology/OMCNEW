@extends ('frontend.master')

@section('content')
  <!-- Start Products Area -->

  <section class="products-area pt-100 pb-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-12">
                <div class="woocommerce-widget-area">
                    <div class="woocommerce-widget filter-list-widget">
                        <h3 class="woocommerce-widget-title">Current Selection</h3>

                        <div class="selected-filters-wrap-list">
                            <ul>
                                <li><a href="#"><i class='bx bx-x'></i> 44</a></li>
                                <li><a href="#"><i class='bx bx-x'></i> XI</a></li>
                                <li><a href="#"><i class='bx bx-x'></i> Clothing</a></li>
                                <li><a href="#"><i class='bx bx-x'></i> Shoes</a></li>
                            </ul>

                            <a href="#" class="delete-selected-filters"><i class='bx bx-trash'></i> <span>Clear All</span></a>
                        </div>
                    </div>

                    <div class="woocommerce-widget collections-list-widget">
                        <h3 class="woocommerce-widget-title">Collections</h3>

                        <ul class="collections-list-row">
                            <li><a href="#">Men's</a></li>
                            <li class="active"><a href="#" class="active">Women’s</a></li>
                            <li><a href="#">Clothing</a></li>
                            <li><a href="#">Shoes</a></li>
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Uncategorized</a></li>
                        </ul>
                    </div>

                    <div class="woocommerce-widget price-list-widget">
                        <h3 class="woocommerce-widget-title">Price</h3>

                        <div class="collection-filter-by-price">
                            <input class="js-range-of-price" type="text" data-min="0" data-max="1055" name="filter_by_price" data-step="10">
                        </div>
                    </div>

                    <div class="woocommerce-widget size-list-widget">
                        <h3 class="woocommerce-widget-title">Size</h3>

                        <ul class="size-list-row">
                            <li><a href="#">20</a></li>
                            <li><a href="#">24</a></li>
                            <li class="active"><a href="#">36</a></li>
                            <li><a href="#">30</a></li>
                            <li><a href="#">XS</a></li>
                            <li><a href="#">S</a></li>
                            <li><a href="#">M</a></li>
                            <li><a href="#">L</a></li>
                            <li><a href="#">L</a></li>
                            <li><a href="#">XL</a></li>
                        </ul>
                    </div>

                    <div class="woocommerce-widget color-list-widget">
                        <h3 class="woocommerce-widget-title">Color</h3>

                        <ul class="color-list-row">
                            <li class="active"><a href="#" title="Black" class="color-black"></a></li>
                            <li><a href="#" title="Red" class="color-red"></a></li>
                            <li><a href="#" title="Yellow" class="color-yellow"></a></li>
                            <li><a href="#" title="White" class="color-white"></a></li>
                            <li><a href="#" title="Blue" class="color-blue"></a></li>
                            <li><a href="#" title="Green" class="color-green"></a></li>
                            <li><a href="#" title="Yellow Green" class="color-yellowgreen"></a></li>
                            <li><a href="#" title="Pink" class="color-pink"></a></li>
                            <li><a href="#" title="Violet" class="color-violet"></a></li>
                            <li><a href="#" title="Blue Violet" class="color-blueviolet"></a></li>
                            <li><a href="#" title="Lime" class="color-lime"></a></li>
                            <li><a href="#" title="Plum" class="color-plum"></a></li>
                            <li><a href="#" title="Teal" class="color-teal"></a></li>
                        </ul>
                    </div>

                    <div class="woocommerce-widget brands-list-widget">
                        <h3 class="woocommerce-widget-title">Brands</h3>

                        <ul class="brands-list-row">
                            <li><a href="#">Gucci</a></li>
                            <li><a href="#">Virgil Abloh</a></li>
                            <li><a href="#">Balenciaga</a></li>
                            <li class="active"><a href="#">Moncler</a></li>
                            <li><a href="#">Fendi</a></li>
                            <li><a href="#">Versace</a></li>
                        </ul>
                    </div>

                    <div class="woocommerce-widget aside-trending-widget">
                        <div class="aside-trending-products">
                            <img src="frontend/assets/img/offer-bg.jpg" alt="image">

                            <div class="category">
                                <h3>Top Trending</h3>
                                <span>Spring/Summer 2024 Collection</span>
                            </div>
                            <a href="products-right-sidebar.html" class="link-btn"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-12">
                <div class="products-filter-options">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-4">
                            <div class="d-lg-flex d-md-flex align-items-center">
                                <span class="sub-title d-lg-none"><a href="#" data-bs-toggle="modal" data-bs-target="#productsFilterModal"><i class='bx bx-filter-alt'></i> Filter</a></span>
                                
                                <span class="sub-title d-none d-lg-block d-md-block">View:</span>

                                <div class="view-list-row d-none d-lg-block d-md-block">
                                    <div class="view-column">
                                        <a href="#" class="icon-view-one">
                                            <span></span>
                                        </a>

                                        <a href="#" class="icon-view-two active">
                                            <span></span>
                                            <span></span>
                                        </a>

                                        <a href="#" class="icon-view-three">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </a>

                                        <a href="#" class="view-grid-switch">
                                            <span></span>
                                            <span></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <p>Showing 1 – 18 of 100</p>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="products-ordering-list">
                                <select>
                                    <option>Sort by Price: Low to High</option>
                                    <option>Default Sorting</option>
                                    <option>Sort by Popularity</option>
                                    <option>Sort by Average Rating</option>
                                    <option>Sort by Latest</option>
                                    <option>Sort by Price: High to Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Facility Area -->
        <section class="facility-area pb-70">
            <div class="container">
                <div class="facility-slides owl-carousel owl-theme">
                    <div class="single-facility-box">
                        <div class="icon">
                            <i class='flaticon-tracking'></i>
                        </div>
                        <h3>Free Shipping Worldwide</h3>
                    </div>

                    <div class="single-facility-box">
                        <div class="icon">
                            <i class='flaticon-return'></i>
                        </div>
                        <h3>Easy Return Policy</h3>
                    </div>

                    <div class="single-facility-box">
                        <div class="icon">
                            <i class='flaticon-shuffle'></i>
                        </div>
                        <h3>7 Day Exchange Policy</h3>
                    </div>

                    <div class="single-facility-box">
                        <div class="icon">
                            <i class='flaticon-sale'></i>
                        </div>
                        <h3>Weekend Discount Coupon</h3>
                    </div>

                    <div class="single-facility-box">
                        <div class="icon">
                            <i class='flaticon-credit-card'></i>
                        </div>
                        <h3>Secure Payment Methods</h3>
                    </div>

                    <div class="single-facility-box">
                        <div class="icon">
                            <i class='flaticon-location'></i>
                        </div>
                        <h3>Track Your Package</h3>
                    </div>

                    <div class="single-facility-box">
                        <div class="icon">
                            <i class='flaticon-customer-service'></i>
                        </div>
                        <h3>24/7 Customer Support</h3>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Facility Area -->

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
                                    <li><i class='bx bx-map'></i> <a href="#" target="_blank">o 425/2, Parakum Place, Kaduruwela, Polannaruwa.</a></li>
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
                                    <a href="products-one-row-2.html"><img src="frontend/assets/img/products/img1.jpg" alt="image"></a>
                                </li>

                                <li>
                                    <a href="products-one-row-2.html"><img src="frontend/assets/img/products/img2.jpg" alt="image"></a>
                                </li>

                                <li>
                                    <a href="products-one-row-2.html"><img src="frontend/assets/img/products/img3.jpg" alt="image"></a>
                                </li>

                                <li>
                                    <a href="products-one-row-2.html"><img src="frontend/assets/img/products/img4.jpg" alt="image"></a>
                                </li>
                            </ul>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <a href="products-left-sidebar-with-categories-3.html" class="shop-now-btn">Shop Now</a>
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
                                    <span class="old-price">$210.00</span>
                                    <span class="new-price">$200.00</span>
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
                                    <a href="#"><img src="assets/img/products/img1.jpg" alt="image"></a>
                                </div>

                                <div class="products-content">
                                    <h3><a href="#">Long Sleeve Leopard T-Shirt</a></h3>
                                    <span>Blue / XS</span>
                                    <div class="products-price">
                                        <span>1</span>
                                        <span>x</span>
                                        <span class="price">$250.00</span>
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
                                        <span class="price">$200.00</span>
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
                                        <span class="price">$200.00</span>
                                    </div>
                                    <a href="#" class="remove-btn"><i class='bx bx-trash'></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="products-cart-subtotal">
                            <span>Subtotal</span>

                            <span class="subtotal">$524.00</span>
                        </div>

                        <div class="products-cart-btn">
                            <a href="#" class="default-btn">Proceed to Checkout</a>
                            <a href="#" class="optional-btn">View Shopping Cart</a>
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
                        <h3>My Wish List (3)</h3>

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
                                        <span class="price">$250.00</span>
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
                                        <span class="price">$200.00</span>
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
                                        <span class="price">$200.00</span>
                                    </div>
                                    <a href="#" class="remove-btn"><i class='bx bx-trash'></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="products-cart-btn">
                            <a href="#" class="optional-btn">View Shopping Cart</a>
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

        <!-- Start Products Filter Modal Area -->
        <div class="modal left fade productsFilterModal" id="productsFilterModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class='bx bx-x'></i> Close</span>
                    </button>

                    <div class="modal-body">
                        <div class="woocommerce-widget-area">
                            <div class="woocommerce-widget filter-list-widget">
                                <h3 class="woocommerce-widget-title">Current Selection</h3>

                                <div class="selected-filters-wrap-list">
                                    <ul>
                                        <li><a href="#"><i class='bx bx-x'></i> 44</a></li>
                                        <li><a href="#"><i class='bx bx-x'></i> XI</a></li>
                                        <li><a href="#"><i class='bx bx-x'></i> Clothing</a></li>
                                        <li><a href="#"><i class='bx bx-x'></i> Shoes</a></li>
                                    </ul>

                                    <a href="#" class="delete-selected-filters"><i class='bx bx-trash'></i> <span>Clear All</span></a>
                                </div>
                            </div>

                            <div class="woocommerce-widget collections-list-widget">
                                <h3 class="woocommerce-widget-title">Collections</h3>

                                <ul class="collections-list-row">
                                    <li><a href="#">Men's</a></li>
                                    <li class="active"><a href="#" class="active">Women’s</a></li>
                                    <li><a href="#">Clothing</a></li>
                                    <li><a href="#">Shoes</a></li>
                                    <li><a href="#">Accessories</a></li>
                                    <li><a href="#">Uncategorized</a></li>
                                </ul>
                            </div>

                            <div class="woocommerce-widget price-list-widget">
                                <h3 class="woocommerce-widget-title">Price</h3>

                                <div class="collection-filter-by-price">
                                    <input class="js-range-of-price" type="text" data-min="0" data-max="1055" name="filter_by_price" data-step="10">
                                </div>
                            </div>

                            <div class="woocommerce-widget size-list-widget">
                                <h3 class="woocommerce-widget-title">Size</h3>

                                <ul class="size-list-row">
                                    <li><a href="#">20</a></li>
                                    <li><a href="#">24</a></li>
                                    <li class="active"><a href="#">36</a></li>
                                    <li><a href="#">30</a></li>
                                    <li><a href="#">XS</a></li>
                                    <li><a href="#">S</a></li>
                                    <li><a href="#">M</a></li>
                                    <li><a href="#">L</a></li>
                                    <li><a href="#">L</a></li>
                                    <li><a href="#">XL</a></li>
                                </ul>
                            </div>

                            <div class="woocommerce-widget color-list-widget">
                                <h3 class="woocommerce-widget-title">Color</h3>

                                <ul class="color-list-row">
                                    <li class="active"><a href="#" title="Black" class="color-black"></a></li>
                                    <li><a href="#" title="Red" class="color-red"></a></li>
                                    <li><a href="#" title="Yellow" class="color-yellow"></a></li>
                                    <li><a href="#" title="White" class="color-white"></a></li>
                                    <li><a href="#" title="Blue" class="color-blue"></a></li>
                                    <li><a href="#" title="Green" class="color-green"></a></li>
                                    <li><a href="#" title="Yellow Green" class="color-yellowgreen"></a></li>
                                    <li><a href="#" title="Pink" class="color-pink"></a></li>
                                    <li><a href="#" title="Violet" class="color-violet"></a></li>
                                    <li><a href="#" title="Blue Violet" class="color-blueviolet"></a></li>
                                    <li><a href="#" title="Lime" class="color-lime"></a></li>
                                    <li><a href="#" title="Plum" class="color-plum"></a></li>
                                    <li><a href="#" title="Teal" class="color-teal"></a></li>
                                </ul>
                            </div>

                            <div class="woocommerce-widget brands-list-widget">
                                <h3 class="woocommerce-widget-title">Brands</h3>

                                <ul class="brands-list-row">
                                    <li><a href="#">Gucci</a></li>
                                    <li><a href="#">Virgil Abloh</a></li>
                                    <li><a href="#">Balenciaga</a></li>
                                    <li class="active"><a href="#">Moncler</a></li>
                                    <li><a href="#">Fendi</a></li>
                                    <li><a href="#">Versace</a></li>
                                </ul>
                            </div>

                            <div class="woocommerce-widget aside-trending-widget">
                                <div class="aside-trending-products">
                                    <img src="frontend/assets/img/offer-bg.jpg" alt="image">

                                    <div class="category">
                                        <h3>Top Trending</h3>
                                        <span>Spring/Summer 2024 Collection</span>
                                    </div>
                                   <a href="products-right-sidebar.html" class="link-btn"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Products Filter Modal Area -->
 @endsection
        
