<style>
    .footer-white-color-css {
        color: #ffffff;
    }

    .copyright {
        margin: 0;
        padding: 0;
        text-align: center;
    }

    .copyright small {
        display: inline-block;
        margin: 0;
        padding: 0;
        line-height: 1.4;
    }
</style>

<div class="mobile-footer-con">


    <div class="footer ft-destop">
        <div class="row bg-purple m-0">
            <div class="col-6 mobi-purple-div">
                <div class="footer-icon">
                    <a href="#">
                        <img src="{{ asset('frontend/newstyle/assets/images/icon/Page-1.webp') }}">

                    </a>
                </div>
                <div class="footer-details">
                    <p class="footer-white-color-css">Customer Support</p>
                    <!-- <span>8am - 5pm</span> -->
                </div>
            </div>
            <div class="col-6 mobi-purple-div">
                <div class="footer-icon">
                    <a href="#">
                        <img src="{{ asset('frontend/newstyle/assets/images/icon/sri-lanka.webp') }}">

                    </a>
                </div>
                <div class="footer-details">
                    <p class="footer-white-color-css">Island-wide Delivery</p>
                </div>
            </div>

            <div class="col-6 mobi-purple-div">
                <div class="footer-icon">
                    <a href="#">
                        <img src="{{ asset('frontend/newstyle/assets/images/icon/stopwatch.webp') }}">

                    </a>
                </div>
                <div class="footer-details">
                    <p class="footer-white-color-css">Express Delivery</p>
                </div>
            </div>

            <div class="col-6 mobi-purple-div">
                <div class="footer-icon">
                    <a href="#">
                        <img src="{{ asset('frontend/newstyle/assets/images/icon/technical-support.webp') }}">

                    </a>
                </div>
                <div class="footer-details">
                    <p class="footer-white-color-css">100+ Service Centers</p>
                </div>
            </div>
        </div>

        <div class="row footer-mobi-details text-center m-0">
            <div class="col-12 mobi-footer-link">
                <ul>
                    <li><a href="#" target="_blank"><i class="fab fa-facebook" fab fa-facebook
                                style="color:#2B96C5 ; font-size: 22px;"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fab fa-twitter" fab fa-facebook
                                style="color:#2B96C5 ; font-size: 22px;"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fab fa-instagram" fab fa-facebook
                                style="color:#2B96C5 ; font-size: 22px;"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fab fa-linkedin-in" fab fa-facebook
                                style="color:#2B96C5 ; font-size: 22px;"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fab fa-youtube" fab fa-facebook
                                style="color:#2B96C5 ; font-size: 22px;"></i></a></li>
                </ul>

            </div>

            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            About
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul>
                                <li class="footer-nav"><a href="/about">About Us</a></li>
                                <li class="footer-nav"><a href="#">Careers</a></li>
                                <li class="footer-nav"><a href="/contact">Contact Us</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Help
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul>
                                {{-- <li class="footer-nav"><a href="/faq">Frequently Asked Questions</a></li>
                                <li class="footer-nav"><a href="/buy">How To Buy</a></li>
                                <li class="footer-nav"><a href="#">Shipping &amp; Delivery</a></li>
                                <li class="footer-nav"><a href="#">Warranty Information</a></li>
                                <li class="footer-nav"><a href="#">Return Products</a></li> --}}

                                <li class="footer-nav"><a href="{{ route('faq') }}">Frequently Asked Questions</a>
                                </li>
                                <li class="footer-nav"><a href="{{ route('buy') }}">How To Buy</a></li>
                                <li class="footer-nav"><a href="{{ route('shipping-delivery') }}">Shipping &amp;
                                        Delivery</a></li>
                                <li class="footer-nav"><a href="{{ route('warranty') }}">Warranty Information</a></li>
                                <li class="footer-nav"><a href="{{ route('return-product') }}">Return Products</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree" aria-expanded="false"
                            aria-controls="flush-collapseThree">
                            Policies
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul>
                                {{-- <li class="footer-nav"><a href="#">Privacy Policy</a></li>
                                <li class="footer-nav"><a href="#">Return and Refund Policy</a></li>
                                <li class="footer-nav"><a href="#">Terms and Conditions</a></li> --}}

                                <li class="footer-nav"><a href="{{ route('PrivacyPolicy') }} ">Privacy Policy</a>
                                </li>
                                <li class="footer-nav"><a href="{{ route('return-refund') }}">Return and Refund
                                        Policy</a></li>
                                <li class="footer-nav"><a href="{{ route('terms-condition') }}">Terms and
                                        Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>



            </div>

            <div class="d-flex flex-wrap text-center mobi-payment-icon-set">
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/VISA1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/MASTER1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/AMEX1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/COMBANK1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/FRIMI.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/HSBC.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/PB1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/DFCC.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/SAMPATH1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/NDB1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/NTB1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/PAB.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/BOC1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/AMANA1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/CARGILLS1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/CDB1.webp') }}"></div>
                <div class="bank-image"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/KOKO.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/HNB1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/LOLC1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/NSB1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/SC1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/SEY1.webp') }}"></div>
                <div class="bank-image-mobi"><img class="lazy"
                        src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/UB1.webp') }}"></div>

            </div>

            <div class="copyright"><small>Copyright © 2025 ONLINE
                    MARKETING
                    COMPLEX. All Rights
                    Reserved.</small></div>
        </div>

        <!-- <div class="flex-wrap mobi-stickey-footer d-flex">
            <div class="al-m">
                <a href="https://buyabans.com">
                    <img data-cfsrc="frontend/newstyle/assets/images/latest-icon/home.png" src="frontend/newstyle/assets/images/latest-icon/home.png">
                </a>
                <p>Home</p>
            </div>

            <div class="al-m footer-mobile-menu-toggle footer-cat" onclick="if (!window.__cfRLUnblockHandlers) return false; openMenuMobicat()">
                <img data-cfsrc="frontend/newstyle/assets/images/latest-icon/menu-mobi.png" src="frontend/newstyle/assets/images/latest-icon/menu-mobi.png">
                <p>Category</p>
            </div>

            <div class="al-m todays-offer-mobi">
                <a href="javascript:void(0);"><img class="t-offer" data-cfsrc="frontend/newstyle/assets/images/icon/todayOFFERS.png" src="frontend/newstyle/assets/images/icon/todayOFFERS.png"></a>
            </div>

            <div class="al-m footer-mobile-search mobi-brand-new" onclick="if (!window.__cfRLUnblockHandlers) return false; openbrand()">
                <a href="javascript:void(0);"><img data-cfsrc="frontend/newstyle/assets/images/latest-icon/brands-new.png" src="frontend/newstyle/assets/images/latest-icon/brands-new.png"></a>
                <p>Brands</p>
            </div>

            <div class="cart-popup al-m">
                <div class="item-count-foot" id="cart_item_count">0</div>
                <img data-cfsrc="frontend/newstyle/assets/images/new-icon/shopping-cart.png" src="frontend/newstyle/assets/images/new-icon/shopping-cart.png">
                <p>Cart</p>
            </div>
        </div> -->
    </div>
</div>







<!--
============================================================================================================================ -->


<!-- footer for mobile begin-->
<!-- Begin of cart popup-->
<div class="mini-cart d-none">
    <div class="mini-cart-overlay"></div>
    <div class="cart-white">
        <div class="close-minicart"><i class="fa-solid fa-xmark"></i></div>
        <div class="cart-logo">
            {{-- <img src="{{ asset('frontend/newstyle/assets/images/logo.png') }}"> --}}
            @if ($siteLogo && $siteLogo->image_path)
                <img src="{{ asset('storage/logo_images/' . $siteLogo->image_path) }}" alt="Site Logo"
                    style="width: 180px;">
            @else
                <img src="{{ asset('frontend/newstyle/assets/images/buyabans-logo.png') }}" style="width: 180px;">
            @endif
        </div>
        <h4>My Cart</h4>
        <div id="mini-cart-data">
            <div>
                <div class="subtotal">
                    <div class="toatal-div-main">
                        <div class="sub-total-label">Cart Subtotal</div>
                        <div class="pro-amount">
                            <span id= "cart-count-4">0</span> Items Added
                        </div>
                    </div>
                    <div class="sub-total" id="cart-subtotal-1">Rs. 0</div>
                </div>

                <div class="cart-added">
                    <p class="cart-include">Cart Include</p>

                    {{-- mini cart here --}}
                    @include('frontend.partials.mini-cart')
                    {{-- mini cart here end --}}


                    <div>
                        <a href="{{ route('cart') }}" class="btn btn-site-default w-100 mt-4">View Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- footer for mobile end -->


<!-- footer for destop begin -->
<style>
    /* Footer styling */
    .destop-footer-con {
        font-family: 'Roboto', sans-serif;
    }

    .footer {
        margin-bottom: 0;
    }

    /* Top blue service bar */
    .purple-div {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        padding: 20px 0;
        margin-bottom: 0;
        background-color: #2B96C5; /* Keeping the original blue color */
    }

    .footer-box {
        display: flex;
        align-items: center;
        margin: 10px 15px;
    }

    .footer-icon {
        margin-right: 10px;
    }

    .footer-icon img {
        width: 32px;
        height: auto;
    }

    .footer-details p {
        margin: 0;
        font-weight: 500;
    }

    .footer-white-color-css {
        color: white;
        font-size: 14px;
    }

    /* Main footer content area */
    .footer-padding {
        padding: 40px 0 0;  /* Remove bottom padding */
        margin-bottom: 0;   /* Ensure no margin at bottom */
    }

    /* Company info section - FIXED */
    .address-info {
        display: block; /* Changed from flex to block to fix alignment */
    }

    /* Direct logo styling fix */
    .address-info img {
        max-width: 300px;
        height: auto;
        display: block;
        margin-bottom: 20px;
    }

    .hotline {
        margin-top: 20px;
    }

    .hotline p {
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .tel-no {
        color: #2B96C5;
        font-size: 18px;
        font-weight: bold;
        text-decoration: none;
    }

    /* Social media section */
    .social-media {
        margin-top: 20px;
        margin-bottom: auto;
    }

    .social-media ul {
        display: flex;
        padding: 0;
        list-style: none;
    }

    .social-media ul li {
        margin-right: 15px;
    }

    /* Footer links styling */
    .footer-title {
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        font-size: 16px;
    }

    .footer-links-set ul {
        list-style: none;
        padding: 0;
    }

    .footer-link {
        margin-bottom: 10px;
    }

    .footer-link a {
        color: #555;
        text-decoration: none;
        transition: color 0.3s;
        font-size: 14px;
    }

    .footer-link a:hover {
        color: #2B96C5;
    }

    /* Payment methods section */
    .payment-methods-container {
        padding: 20px 0;
        border-top: 1px solid #eee;
    }

    .footer-payment-methods {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 20px;
    }

    .bank-image {
        margin: 5px;
    }

    .bank-image img {
        height: 25px;
        width: auto;
    }

    /* Copyright section */
    .copyright {
        text-align: center;
        padding: 15px 0;
        margin-top: 10px;
    }

    .copyright small {
        font-size: 13px;
        color: #555;
        letter-spacing: 0.5px;
    }
</style>

<div class="destop-footer-con">
    <!-- Top service bar with blue background -->
    <div class="purple-div">
        <div class="footer-box">
            <div class="footer-icon">
                <img src="{{ asset('frontend/newstyle/assets/images/icon/Page-1.webp') }}">
            </div>
            <div class="footer-details">
                <p class="footer-white-color-css">Customer Support</p>
            </div>
        </div>
        <div class="footer-box">
            <div class="footer-icon">
                <img src="{{ asset('frontend/newstyle/assets/images/icon/sri-lanka.webp') }}">
            </div>
            <div class="footer-details">
                <p class="footer-white-color-css">Island-wide Delivery</p>
            </div>
        </div>
        <div class="footer-box">
            <div class="footer-icon">
                <img src="{{ asset('frontend/newstyle/assets/images/icon/stopwatch.webp') }}">
            </div>
            <div class="footer-details">
                <p class="footer-white-color-css">Express Delivery</p>
            </div>
        </div>
        <div class="footer-box">
            <div class="footer-icon">
                <img src="{{ asset('frontend/newstyle/assets/images/icon/technical-support.webp') }}">
            </div>
            <div class="footer-details">
                <p class="footer-white-color-css">100+ Service Centers</p>
            </div>
        </div>
    </div>

    <!-- Main footer content -->
    <div class="container footer-padding">
        <div class="row">
            <!-- Company info and social media -->
            <div class="col-md-4">
                <div class="address-info">
                    <!-- Simplified logo structure -->
                    @if ($siteLogo && $siteLogo->image_path)
                        <img src="{{ asset('storage/logo_images/' . $siteLogo->image_path) }}" alt="Site Logo">
                    @else
                        <img src="{{ asset('frontend/newstyle/assets/images/buyabans-logo.webp') }}" alt="Site Logo">
                    @endif

                    <div class="hotline">
                        <p>HOTLINE</p>
                        <a class="tel-no" href="#">+94 112 251 202</a>
                    </div>
                    <div class="social-media">
                        <ul>
                            <li><a href="#" target="_blank"><i class="fab fa-facebook" style="color:#2B96C5; font-size: 22px;"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter" style="color:#2B96C5; font-size: 22px;"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram" style="color:#2B96C5; font-size: 22px;"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin-in" style="color:#2B96C5; font-size: 22px;"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-youtube" style="color:#2B96C5; font-size: 22px;"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Footer navigation links - no changes needed here -->
            <div class="col-md-8">
                <div class="row">
                    <!-- About section -->
                    <div class="col-md-3">
                        <div class="footer-links-set">
                            <p class="footer-title">About</p>
                            <ul>
                                <li class="footer-link"><a href="{{ route('about') }}">About Us</a></li>
                                <li class="footer-link"><a href="#">Careers</a></li>
                                <li class="footer-link"><a href="{{ route('contac') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Help section -->
                    <div class="col-md-3">
                        <div class="footer-links-set">
                            <p class="footer-title">Help</p>
                            <ul>
                                <li class="footer-link"><a href="{{ route('faq') }}">F&Q</a></li>
                                <li class="footer-link"><a href="{{ route('buy') }}">How To Buy</a></li>
                                <li class="footer-link"><a href="{{ route('shipping-delivery') }}">Shipping &amp; Delivery</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Policies section -->
                    <div class="col-md-3">
                        <div class="footer-links-set">
                            <p class="footer-title">Policies</p>
                            <ul>
                                <li class="footer-link"><a href="{{ route('PrivacyPolicy') }}">Privacy Policy</a></li>
                                <li class="footer-link"><a href="{{ route('return-refund') }}">Return and Refund Policy</a></li>
                                <li class="footer-link"><a href="{{ route('terms-condition') }}">Terms and Conditions</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Quick Links section -->
                    <div class="col-md-3">
                        <div class="footer-links-set">
                            <p class="footer-title">Quick Links</p>
                            <ul>
                                <li class="footer-link"><a href="#">Brands</a></li>
                                <li class="footer-link"><a href="#">Warranty Information</a></li>
                                <li class="footer-link"><a href="#">Return Products</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment methods and copyright -->
    <div class="payment-methods-container">
        <div class="container">
            <div class="footer-payment-methods">
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/VISA1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/MASTER1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/AMEX1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/COMBANK1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/FRIMI.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/HSBC.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/PB1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/DFCC.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/SAMPATH1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/NDB1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/NTB1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/PAB.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/BOC1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/AMANA1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/CARGILLS1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/CDB1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/KOKO.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/HNB1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/LOLC1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/NSB1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/SC1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/SEY1.webp') }}"></div>
                <div class="bank-image"><img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/UB1.webp') }}"></div>
            </div>
            <div class="copyright">
                <small>Copyright © 2025 ONLINE MARKETING COMPLEX. All Rights Reserved.</small>
            </div>
        </div>
    </div>
</div>
<!-- footer for destop end -->



<overlay-loader :is-open="show_loader"></overlay-loader>


</div>



<script>
    function updateSubTotal() {
        fetch("{{ route('cart.subtotal') }}")
            .then(response => response.json())
            .then(data => {
                document.getElementById('cart-subtotal-1').textContent = "Rs. " + data.subtotal;
            })
            .catch(error => {
                console.error('Error fetching cart subtotal:', error);
            });
    }

    // Call on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateSubTotal();
    });
</script>















</body>


<script>
    function closeMenuMobi() {
        //alert(2);
        document.body.classList.remove("mmenu-active");
        document.querySelector(".mobile-menu-wrapper").style.visibility = "hidden";
    }

    function openMenuMobi() {
        //alert(1);
        document.body.classList.add("mmenu-active");
        document.querySelector(".mobile-menu-wrapper").style.visibility = "visible";
    }


    function openSubmenus(clickedSpan) {
        let $dropdown = $(clickedSpan).next(".dropdown");
        // Toggle the visibility of the clicked dropdown instantly (no animation)
        $dropdown.toggle();
        $(clickedSpan).toggleClass("rotate"); // Rotate the toggle button for effect
    }

    $(document).ready(function() {

        $(".toggle-btn-dest").on("click", function() {
            let $widget = $(this).closest(".widget"); // Get the parent widget
            let $title = $widget.find(".widget-title"); // Get the widget title
            let $body = $widget.find(".widget-body"); // Get the widget body

            // Toggle collapsed class on widget title
            $title.toggleClass("collapsed");

            // Use CSS instead of slideToggle() for instant effect
            $body.toggleClass("hidden");
        });

        $(".toggle-btn-mobi").on("click", function() {
            let $widget = $(this).closest(".widget"); // Get the parent widget
            let $title = $widget.find(".widget-title"); // Get the widget title
            let $body = $widget.find(".widget-body"); // Get the widget body

            // Toggle collapsed class on widget title
            $title.toggleClass("collapsed");

            // Use CSS instead of slideToggle() for instant effect
            $body.toggleClass("hidden");
        });

    });


    $(".cart-popup").click(function() {
        $('.mini-cart').removeClass('d-none');
        $('.mini-cart').addClass('d-block');
    });
    $(".close-minicart, .mini-cart-overlay").click(function() {
        $('.mini-cart').addClass('d-none');
        $('.mini-cart').removeClass('d-block');
    });
</script>



<script src="{{ asset('/frontend/newstyle/rocket-loader.min.js') }}" data-cf-settings="a071cb3ff60724c4b8f55cf9-|49"
    defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
    integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"
    integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
    integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"
    integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>






</html>
