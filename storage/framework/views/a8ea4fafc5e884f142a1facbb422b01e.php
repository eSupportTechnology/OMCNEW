<style>
    /* Hide elements with the class .mobhide on screens smaller than or equal to 768px */
    @media (max-width: 768px) {
        .mobhide {
            display: none !important;
            /* Add !important if you want to override other styles */
        }
    }

    @media (min-width: 768px) {
        .mobshow {
            display: none !important;
            /* Hides .mobshow on screens 768px or wider */
        }
    }
</style>

<body>








    <div id="app">

        <div class="main-container-wrapper">



            <div id="notification_banner"></div>







            <!-- mobile hearder begin -->
            <!-- top banner mobile-->
            <div class="mobi-main-header fixed-header">
                <div id="topupbar_banner_mobile"></div>
                <header class="header mobile-header ">
                    <div class="container mobile-header-container">
                        <div class="mobi-full-row">
                            <div class="col-5-5">
                                <div class="d-flex">
                                    <div class="header-left me-2">
                                        <a href="#" class="mobile-menu-toggle new-mobile-toggle"
                                            onclick="if (!window.__cfRLUnblockHandlers) return false;  openMenuMobi()"
                                            data-cf-modified-a071cb3ff60724c4b8f55cf9-="">
                                            <img class="mobi-menu-icon"
                                                src="<?php echo e(asset('frontend/newstyle/assets/images/menuLOGO-mbo.png')); ?>">



                                        </a>
                                    </div>

                                    <div class="mobi-logo">
                                        <?php if($siteLogo && $siteLogo->image_path): ?>
                                            <a href="<?php echo e(url('/')); ?>">
                                                <img src="<?php echo e(asset('storage/logo_images/' . $siteLogo->image_path)); ?>"
                                                    alt="Site Logo" class="img-fluid" style="max-height: 60px;">
                                            </a>
                                        <?php else: ?>
                                            <a href="/"><img
                                                    src="<?php echo e(asset('frontend/newstyle/assets/images/buyabanslogo-new.png')); ?>"
                                                    alt="logo" />
                                            </a>
                                        <?php endif; ?>

                                    </div>

                                </div>
                            </div>

                            <!-- <div class="col-2-5">
                        <div class="mobi-header-btn mobi-search-btn">
                            <img class="cart-icon"
                                src="frontend/newstyle/assets/images/icon/mobi-search.png">
                        </div>
                    </div> -->


                            <!-- Header Middle Right start -->
                            <div class="header-right flex-align d-lg-block d-none">
                                <div class="flex-wrap gap-32 header-two-activities flex-align">
                                    <button type="button"
                                        class="gap-4 flex-align search-icon d-lg-none d-flex item-hover-two">
                                        <span class="text-2xl text-white d-flex position-relative item-hover__text">
                                            <i class="ph ph-magnifying-glass"></i>
                                        </span>
                                    </button>





                                    <a href="javascript:void(0)"
                                        class="gap-8 ml-10 flex-align flex-column item-hover-two"
                                        style="margin-right:30px;">
                                        <span
                                            class="mt-6 text-2xl text-white d-flex position-relative me-6 item-hover__text">
                                            <i class="ph ph-shopping-cart-simple"></i>
                                            <!-- Display the cart count dynamically -->
                                            <span id="cart-count-1"
                                                class="w-16 h-16 text-xs text-white flex-center rounded-circle bg-main-two-600 position-absolute top-n6 end-n4">
                                                <?php echo e($cartCount ?? 0); ?>


                                            </span>
                                        </span>
                                        <span class="text-white text-md item-hover__text d-none d-lg-flex">Cart</span>
                                    </a>


                                </div>
                            </div>














                            <div class="col-2-5">
                                <div class="header-right-con">
                                    <div
                                        class="top-right-nav d-flex align-items-center justify-content-end gap-3 flex-wrap">

                                        <!-- Profile Dropdown -->
                                        <div class="profile-dropdown">
                                            <?php if(auth()->guard()->check()): ?>
                                                <div class="auth-container d-flex align-items-center">
                                                    <div class="loged-user d-inline-flex align-items-center gap-2">
                                                        <div class="log-user-img">
                                                            <img
                                                                src="https://buyabans.com/themes/buyabans/assets/images/icon/dummy-user.png">
                                                        </div>
                                                        <div class="log-user-data dropdown">
                                                            <div class="dropdown-box">
                                                                <ul class="log-popup-links">
                                                                    <li>
                                                                        <a href="<?php echo e(route('dashboard')); ?>">
                                                                            <img
                                                                                src="https://buyabans.com/themes/buyabans/assets/images/icon/mini-profile/user.png">
                                                                            My Account
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a>
                                                                            <img
                                                                                src="https://buyabans.com/themes/buyabans/assets/images/icon/mini-profile/turn-off.png">
                                                                            <form method="POST"
                                                                                action="<?php echo e(route('logout')); ?>">
                                                                                <?php echo csrf_field(); ?>
                                                                                <button type="submit"
                                                                                    class="dropdown-item w-100">Logout</button>
                                                                            </form>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <!-- Guest Login/Register -->
                                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                                    <div class="sign-up d-inline-flex">
                                                        <div class="mobhide">
                                                            <a href="<?php echo e(route('login')); ?>"
                                                                class="d-flex align-items-center">
                                                                <div class="dt-icon-div">
                                                                    <img
                                                                        src="<?php echo e(asset('frontend/newstyle/assets/images/account-icon.png')); ?>">
                                                                </div>
                                                                <div>Login</div>
                                                            </a>
                                                        </div>

                                                        <div class="boder-right"></div>

                                                        <div class="mobhide">
                                                            <a class="sign-up-link" href="<?php echo e(route('signup')); ?>">
                                                                <span>Sign Up</span>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="mobshow">
                                                        <a href="<?php echo e(route('login')); ?>" class="d-flex align-items-center">
                                                            <div class="dt-icon-div">
                                                                <img src="<?php echo e(asset('frontend/newstyle/assets/images/account-icon.png')); ?>"
                                                                    style="padding-bottom: 17px;">
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Cart -->
                                        <div class="des-cart pos-relative cart-popup">
                                            <a href="javascript:void(0)"
                                                class="d-flex align-items-center gap-2 item-hover-two">
                                                <span class="text-2xl text-white2 position-relative">
                                                    <i class="ph ph-shopping-cart-simple"></i>
                                                    <span id="cart-count-2"
                                                        class="w-16 h-16 text-xs text-white flex-center rounded-circle bg-main-two-600 position-absolute top-n6 end-n4">
                                                        <?php echo e($cartCount ?? 0); ?>

                                                    </span>
                                                </span>
                                                <span class="text-white2 text-md d-none d-lg-flex">Cart</span>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>


                </header>

            </div>


            <!-- destop header begin -->

            <div class="desmain-header">
                <div class="page-loader" hidden>
                    <img src="<?php echo e(asset('frontend/newstyle/assets/images/loader.gif')); ?>" style="display:block">

                </div>

                <div class="destop-affix">
                    <div class="destop-header">
                        <div id="topupbar_banner_desktop"></div>

                        <!-- top banner mobile-->
                        <div class="site-common-con header-search">
                            <div class="destop-main-header">
                                <div class="des-logo">
                                    <?php if($siteLogo && $siteLogo->image_path): ?>
                                        <a href="<?php echo e(url('/')); ?>">
                                            <img src="<?php echo e(asset('storage/logo_images/' . $siteLogo->image_path)); ?>"
                                                alt="Site Logo" class="img-fluid">
                                        </a>
                                    <?php else: ?>
                                        <a href="/"><img
                                                src="<?php echo e(asset('frontend/newstyle/assets/images/buyabanslogo-new.png')); ?>">
                                        </a>
                                    <?php endif; ?>

                                </div>
                                <style>
                                    .top-search {
                                        display: flex;
                                        align-items: center;
                                        gap: 5px;
                                        /* optional spacing between input and button */
                                    }

                                    .top-search .form-control.main-search {
                                        margin: 0;
                                        height: 40px;
                                        /* Adjust this to match the button height */
                                        padding: 6px 12px;
                                        box-sizing: border-box;
                                    }

                                    .top-search .submit-search {
                                        height: 40px;
                                        /* Match input height */
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                    }
                                </style>


                                <div class="search-con">
                                    <div class="top-search ">
                                        <input type="text" class="form-control main-search top-search-suggestion"
                                            placeholder="Search for products, categories and more">
                                        <button type="button" class="btn btn-primary submit-search"><i
                                                class="fa-solid fa-magnifying-glass"></i></button>
                                        <div id="suggestions-box-display"
                                            class="suggestions-box suggestions-box-display" style="display: none;">
                                            <div class="left-suggestion-no-products" hidden>
                                                <p>No results found.</p>
                                            </div>
                                            <div class="left-suggestion-main-con">
                                            </div>

                                            <div class="right-suggestion-main-con">
                                                <div>
                                                    <h4 class="headding search-category-title" hidden>Categories</h4>
                                                    <ul>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>












                                </div>
                                <div class="header-right-con">
                                    <div class="top-right-nav">
                                        <div class="des-cart pos-relative cart-popup ">

                                            <a href="javascript:void(0)" class="d-flex">

                                                <cart-item-count></cart-item-count>
                                                <div class="dt-icon-div"><span id="cart-count-3"
                                                        class="w-16 h-16 text-xs text-white flex-center rounded-circle bg-main-two-600 position-absolute top-n6 ">
                                                        <?php echo e($cartCount ?? 0); ?>


                                                    </span> <img
                                                        src=" <?php echo e(asset('frontend/newstyle/assets/images/cart-new.png')); ?>"
                                                        class="cart-img"></div><span>Cart</span>
                                            </a>
                                        </div>



                                        <script>
                                            $(".cart-popup").click(function() {
                                                $('.mini-cart').removeClass('d-none');
                                                $('.mini-cart').addClass('d-block');
                                            });
                                            $(".close-minicart, .mini-cart-overlay").click(function() {
                                                $('.mini-cart').addClass('d-none');
                                                $('.mini-cart').removeClass('d-block');
                                            });
                                        </script>


                                        <div class="auth-container">



                                            <!-- Profile Dropdown -->
                                            <div class="profile-dropdown">
                                                <?php if(auth()->guard()->check()): ?>

                                                    <div class="auth-container">
                                                        <div class="loged-user d-inline-flex">
                                                            <div class="log-user-img"><img
                                                                    src="https://buyabans.com/themes/buyabans/assets/images/icon/dummy-user.png">
                                                            </div>
                                                            <div class="log-user-data dropdown">
                                                                <div class="user-name">Hi!
                                                                    <?php echo e(auth()->user()->name); ?>

                                                                </div>
                                                                <div class="dropdown-box">

                                                                    <ul class="log-popup-links">
                                                                        <li>
                                                                            <a href="<?php echo e(route('dashboard')); ?>">
                                                                                <img
                                                                                    src="https://buyabans.com/themes/buyabans/assets/images/icon/mini-profile/user.png">My
                                                                                Account
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a>
                                                                                <img
                                                                                    src="https://buyabans.com/themes/buyabans/assets/images/icon/mini-profile/turn-off.png">
                                                                                <form method="POST"
                                                                                    action="<?php echo e(route('logout')); ?>">


                                                                                    <?php echo csrf_field(); ?>
                                                                                    <button type="submit"
                                                                                        class="dropdown-item w-100">Logout</button>
                                                                                </form>
                                                                            </a>
                                                                        </li>



                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <!-- Default Profile Icon and Links for Guests -->
                                                    <div class="sign-up d-inline-flex">
                                                        <div>
                                                            <a href="<?php echo e(route('login')); ?>" class="d-flex">
                                                                <div class="dt-icon-div"><img
                                                                        src=" <?php echo e(asset('frontend/newstyle/assets/images/account-icon.png')); ?> ">
                                                                </div>
                                                                <div>Login</div>
                                                            </a>
                                                        </div>

                                                        <div class="boder-right"></div>

                                                        <div>
                                                            <a class="sign-up-link"
                                                                href="<?php echo e(route('signup')); ?>"><span>Sign
                                                                    Up</span></a>
                                                        </div>
                                                    </div>

                                                </div>


                                            <?php endif; ?>
                                        </div>

                                    </div>



                                    <!-- <div class="site-converters">
                                    <div> <img class="flag"
                                            src="frontend/newstyle/assets/images/latest-icon/currency-new.png">
                                    </div>
                                    <div class="dropdown">
                                        <div class="txt-lan">
                                            EN/
                                        </div>
                                        <div class="txt-currency">LKR
                                            <i class="fa-solid fa-chevron-down"></i>
                                        </div>
                                        <div class="dropdown-box">
                                            <div class="form-group">
                                                <label>Language</label>
                                                <select name="username" id="username" required="required" onchange="if (!window.__cfRLUnblockHandlers) return false; window.location.href = this.value" class="form-select" data-cf-modified-a071cb3ff60724c4b8f55cf9-=""> -->
                                    <!-- <option>EN (English)</option>
                                                <option>SN (Sinhala)</option>
                                                <option>TM (Tamil)</option> -->

                                    <!-- <option value="?locale=en"
                                                            selected>
                                                            English</option>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Currency</label>
                                                <select name="username" class="currency form-select"
                                                    required="required" > -->


                                    <!-- <option>LKR</option>
                                                 <option>USD</option> -->

                                    <!-- <option value="?currency=USD"
                                                                >
                                                                USD</option>
                                                                                                                                                                                                                                <option value="?currency=LKR"
                                                                selected>
                                                                LKR</option>
                                                                                                                                                            </select>
                                            </div> -->
                                    <!-- <button class="btn btn-site-default w-100">Select</button> -->
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--    category begin -->
        <div class="header-bottom destop-categories">
            <div class="site-common-con">
                <div class="d-flex">
                    <div class="cat-main-set ">
                        <div id="mega-menu">
                            <div class="btn-mega">
                                <div class="all-cat-txt">
                                    <div class="cat-icon">

                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <span class="nav-vcenter">
                                        All Categories
                                        <span class="fa-solid fa-chevron-down cat-arrow"></span>
                                    </span>
                                </div>
                            </div>
                            <style>




                            </style>
                            <div class="wrap-menu">
                                <div class="wrap-inner">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="fly main-link">
                                            <a href="/all-items?category=<?php echo e(urlencode($category->parent_category)); ?>">

                                                <?php echo e($category->parent_category); ?>

                                            </a>


                                            <div class="inner">
                                                <div class="scroll-height"></div>
                                                <div class="scroll-cat-set">


                                                    <!-- Check if the category has subcategories -->
                                                    <?php if($category->subcategories->isNotEmpty()): ?>
                                                        <?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="one-third">
                                                                <div class="cat-title">
                                                                    <a
                                                                        href="/all-items?subcategory=<?php echo e(urlencode($subcategory->subcategory)); ?>">
                                                                        <?php echo e($subcategory->subcategory); ?>

                                                                    </a>
                                                                </div>
                                                                <ul>
                                                                    <?php if($category->subcategories->isNotEmpty()): ?>
                                                                        <?php $__currentLoopData = $subcategory->subSubcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <li class="fly main-link">
                                                                                <a
                                                                                    href="/all-items?subsubcategory=<?php echo e(urlencode($subSubcategory->sub_subcategory)); ?>">
                                                                                    <?php echo e($subSubcategory->sub_subcategory); ?>

                                                                                </a>


                                                                            </li>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>

                                                                </ul>

                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>



                        </div>



                    </div><!-- /.col-md-3 col-2 -->


                    <!-- right sub menu end -->


                    <div class="cat-sub-set">
                        <div class="nav-wrap">
                            <div id="mainnav" class="mainnav">
                                <ul class="menu">



                                    <li class="column-1"> <a href="/" title="">Home</a> </li>
                                    <!-- /.column-1 -->


                                    <!-- /.column-1 -->
                                    <li class="column-1"><a href="/shop" title="">Shop</a></li>
                                    <!-- /.column-1 -->


                                    </li><!-- /.column-1 -->









                                    <li class="column-1">
                                        <a href="/about" title="">

                                            About Us </a>

                                    </li>


                                    <li class="column-1">
                                        <a href="/contact" title="">

                                            Contact Us </a>

                                    </li>

                                    




                                    <!-- /.column-1 -->
                                </ul><!-- /.menu -->



                                <div class="destop-hotline d-flex">

                                    <div class="top-track">

                                        <!-- <a href="#"><i
                                                        class="fa-solid fa-location-dot me-2"></i>Track your order</a> -->

                                    </div>
                                    <div><a href="#" title="">
                                            <i class="fa-solid fa-phone me-2"></i>
                                            +94 112 251 202

                                        </a>
                                    </div>
                                </div>

                            </div><!-- /.mainnav -->
                        </div><!-- /.nav-wrap -->

                        <div class="btn-menu">
                            <span></span>
                        </div><!-- //mobile menu button -->
                    </div><!-- /.col-md-9 -->
                </div><!-- /.row -->




            </div><!-- /.container -->
        </div>
        <!-- destop category end -->
    </div>
    </div>
    <!-- destop header end -->





    <!-- mobile header end -->
















    <!-- onestop showroom login -->
    <!-- Modal -->
    <!-- usd convert modal begin -->
    <div class="modal fade" id="modal-usd" tabindex="-1" aria-labelledby="modal-usd" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row w-100">
                        <div class="col-sm-12">
                            <h5 class="modal-title" id="popupModalLabel">Notice</h5>
                            <p>The payment mode is about to switch to USD (US Dollars)<br>
                                Please read our terms & conditions and proceed accordingly</p>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                    </div>
                </div>

                <div class="modal-body">
                    <p class="usd-term-title">Terms & Conditions</p>
                    <ul>
                        <li>Locally issued cards will not be accepted as a valid payment mode.</li>
                        <li>International cards are not eligible for any easy payment schemes.</li>
                        <li>The pickup option is not available for payments made in USD.</li>
                    </ul>

                    <div class="d-flex justify-content-center btn-set-usd">
                        <button class="btn btn-site-default" data-currency-type="USD" id="currency-change">Proceed
                            with
                            currency change</button>
                        <button id="back-to-product" data-previous-currency-type="LKR" class="btn usd-back-btn">Back
                            to
                            product</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- usd convert modal end -->



    </div>


    <!-- Start of Mobile Menu -->
    <div class="mobile-menu-wrapper" style="z-index: 10000;">
        <div class="mobile-menu-overlay ss" onclick="if (!window.__cfRLUnblockHandlers) return false; closeMenuMobi()"
            data-cf-modified-a071cb3ff60724c4b8f55cf9-=""></div>
        <!-- End of .mobile-menu-overlay -->
        <!-- End of .mobile-menu-close -->
        <div class="mobile-menu-container scrollable">

            <a href="#" class="mobile-menu-close"
                onclick="if (!window.__cfRLUnblockHandlers) return false; closeMenuMobi()"
                data-cf-modified-a071cb3ff60724c4b8f55cf9-=""><i class="close-icon"></i></a>
            <!-- End of Search Form -->

            <div class="hot-line-mob">
                <div class="d-flex mobi-hot-main">
                    <div class="mobi-hot-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <div>HOT LINE</div>
                        <strong>+94 112 251 202
                        </strong>
                    </div>
                </div>
            </div>

            <div class="tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#main-menu" class="nav-link mobimain-menu active"
                            onclick="if (!window.__cfRLUnblockHandlers) return false; opensideMainMobi()"
                            data-cf-modified-a071cb3ff60724c4b8f55cf9-="">Main Menu</a>
                    </li>
                    <li class="nav-item">
                        <a href="#categories" class="nav-link menu-cat "
                            onclick="if (!window.__cfRLUnblockHandlers) return false; opencategoryMobi()"
                            data-cf-modified-a071cb3ff60724c4b8f55cf9-="">Categories</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content">

                <!-- Main Menu Tab Pane -->
                <div class="tab-pane menu-pane active" id="main-menu">
                    <ul class="mobi-icon-menu">


                        <li> <a href="/" title="">Home</a> </li>


                        <li class="column-1"><a href="/shop" title="">Shop</a></li>

                        <li><a href="/about" title=""> About Us </a></li>

                        <li><a href="/contact" title="">Contact Us </a></li>

                        


                    </ul>







                    </ul>


                </div>

                <div class="tab-pane cat-pane" id="categories">
                    <ul class=" list-unstyled">

                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="position-relative">

                                <!-- Main Category and Toggle -->
                                <div class="d-flex justify-content-between align-items-center ">
                                    <a href="<?php echo e(url('/shop?category_id=' . $category->id)); ?>"
                                        class="text-dark text-decoration-none fw-semibold" style="line-height: 1.6;">
                                        <?php echo e($category->name); ?>

                                    </a>

                                    <?php if($category->subcategories->isNotEmpty()): ?>
                                        <span class="toggle-btn" onclick="toggleDropdown(this)"
                                            style="cursor: pointer;">
                                            <i class="fa fa-chevron-down text-muted"></i>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- Subcategory List -->
                                <?php if($category->subcategories->isNotEmpty()): ?>
                                    <ul
                                        class="dropdown subcategory-dropdown bg-light border mt-1 rounded shadow-sm d-none">
                                        <?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="<?php echo e(url('/shop?subcategory_id=' . $subcategory->id)); ?>"
                                                    class="d-block px-4 py-2 text-dark text-decoration-none"
                                                    style="line-height: 1.6;">
                                                    <?php echo e($subcategory->name); ?>

                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>

                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </div>


                <script>
                    function toggleDropdown(toggleBtn) {
                        const dropdown = toggleBtn.closest('li').querySelector('.subcategory-dropdown');
                        if (dropdown) {
                            dropdown.classList.toggle('d-none');
                            toggleBtn.querySelector('i').classList.toggle('fa-chevron-down');
                            toggleBtn.querySelector('i').classList.toggle('fa-chevron-up');
                        }
                    }
                </script>



                <style>
                    .subcategory-dropdown {
                        list-style: none;
                        padding-left: 0;
                    }

                    .category-link:hover {
                        background-color: #f8f9fa;
                    }
                </style>

            </div>































        </div>
    </div>
    <!-- End of Mobile Menu -->
    </div>


    <script>
        document.querySelectorAll('.nav-link').forEach((tab) => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
                this.classList.add('active');

                document.querySelectorAll('.tab-pane').forEach(el => el.classList.remove('show', 'active'));
                const target = this.getAttribute('href');
                document.querySelector(target).classList.add('show', 'active');
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('#product-search').on('keyup', function() {
                let query = $(this).val();
                $('#search-results').empty();

                if (query.length > 0) {
                    $.ajax({
                        url: "<?php echo e(route('searchProducts')); ?>",
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(response) {
                            if (response.products && response.products.length > 0) {
                                $('#search-results').show();
                                response.products.forEach(function(product) {
                                    $('#search-results').append(
                                        `<div class="p-2 border-bottom">${product.product_name}</div>`
                                    );
                                });
                            } else {
                                $('#search-results').show().html(
                                    '<div class="p-2">No products found</div>');
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#search-results').hide();
                }
            });
        });
    </script>

    <script>
        function updateCartCount() {
            fetch("<?php echo e(route('cart.count')); ?>")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('cart-count-1').textContent = data.cart_count;
                    document.getElementById('cart-count-2').textContent = data.cart_count;
                    document.getElementById('cart-count-3').textContent = data.cart_count;
                    document.getElementById('cart-count-4').textContent = data.cart_count;
                })
                .catch(error => {
                    console.error('Error fetching cart count:', error);
                });
        }

        // Call on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
        });
    </script>



    </header>
<?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/frontend/navbar-new.blade.php ENDPATH**/ ?>