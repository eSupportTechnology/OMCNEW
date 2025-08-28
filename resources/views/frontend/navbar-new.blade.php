<style>
    .search-container {
        position: relative;
    }

    .suggestions-box {
        position: absolute;
        top: 100%;
        /* Pushes it just below the input */
        left: 0;
        width: 100%;
        z-index: 999;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

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




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <div id="app">

        <div class="main-container-wrapper">



            <div id="notification_banner"></div>







            <!-- mobile hearder begin -->
            <!-- top banner mobile-->
            <div class="mobi-main-header fixed-header">
                <div id="topupbar_banner_mobile"></div>
                <header class="header mobile-header">
                    <div class="container mobile-header-container">
                        <div class="mobi-full-row d-flex align-items-center justify-content-between">
                            <!-- Left Section: Menu + Logo -->
                            <div class="header-left-section d-flex align-items-center">
                                <div class="header-left me-2">
                                    <a href="#" class="mobile-menu-toggle new-mobile-toggle"
                                        onclick="if (!window.__cfRLUnblockHandlers) return false; openMenuMobi()"
                                        data-cf-modified-a071cb3ff60724c4b8f55cf9-="">
                                        {{--  <img class="mobi-menu-icon"
                                         src="{{ asset('frontend/newstyle/assets/images/menuLOGO-mbo.png') }}">  --}}
                                        <i class="ph ph-list mobile-menu-icon mobi-menu-icon"
                                            style="color: #2b96c5; font-size: 24px;"></i>
                                    </a>
                                </div>

                                <div class="mobi-logo">
                                    @if ($siteLogo && $siteLogo->image_path)
                                        <a href="{{ url('/') }}">
                                            <img src="{{ asset('storage/logo_images/' . $siteLogo->image_path) }}"
                                                alt="Site Logo" class="img-fluid" style="max-height: 60px;">
                                        </a>
                                    @else
                                        <a href="/">
                                            <img src="{{ asset('frontend/newstyle/assets/images/buyabanslogo-new.png') }}"
                                                alt="logo" />
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Right Section: Account, Cart, Search Icons -->
                            <div class="header-right-section d-flex align-items-center">
                                <div class="mobile-icons-container d-flex align-items-center">

                                    <!-- Account Icon -->
                                    <div class="mobile-icon-item">
                                        @auth
                                            <div class="loged-user">
                                                <div class="log-user-img">
                                                    <a href="{{ route('dashboard') }}">
                                                        <img src="https://buyabans.com/themes/buyabans/assets/images/icon/dummy-user.png"
                                                            alt="User" class="mobile-account-icon">
                                                    </a>
                                                </div>
                                            </div>
                                        @else
                                            <a href="{{ route('login') }}" class="mobile-account-link">
                                                <img src="{{ asset('frontend/newstyle/assets/images/account-icon.png') }}"
                                                    alt="Account" class="mobile-account-icon">
                                            </a>
                                        @endauth
                                    </div>

                                    <!-- Cart Icon -->
                                    <div class="mobile-icon-item des-cart cart-popup">
                                        <a href="javascript:void(0)" class="mobile-cart-link">
                                            <div class="mobile-cart-wrapper">
                                                <i class="ph ph-shopping-cart-simple mobile-cart-icon"
                                                    style="color:#2b96c5"></i>
                                                <span class="mobile-cart-count"
                                                    id="cart-count-1">{{ $cartCount ?? 0 }}</span>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- Search Icon -->
                                    <div class="mobile-icon-item">
                                        <button class="mobile-search-btn ">
                                            {{--  <img src="{{ asset('frontend/newstyle/assets/images/icon/mobi-search.png') }}"
                                             alt="Search" class="mobile-search-icon"  >  --}}
                                            <i class="ph ph-magnifying-glass mobile-search-icon"
                                                style="color: #2b96c5; font-size: 24px;"></i>

                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search Container -->
                    <div class="search-con search-con-mobile" style="marging-left:100px ">
                        <div class="search-title col-sm-12" style="display: none;">
                            <p>Search</p>
                            <button class="close-search"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                        <div class="top-search clear-both">
                            <form action="{{ route('searchResults') }}" method="GET"
                                class="d-flex w-100 align-items-center">
                                <input type="text" class="form-control main-search top-search-suggestion-mobi"
                                    placeholder="Search for products, categories and more">
                                <button type="button" class="btn btn-primary submit-search" style=" marging-top:100px">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                            <div id="" class="suggestions-box suggestions-box-display-mobi"
                                style="display: none;">
                                <div class="left-suggestion-no-products" hidden>
                                    <p>No results found.</p>
                                </div>
                                <div class="left-suggestion-main-con"></div>
                                <div class="right-suggestion-main-con">
                                    <div>
                                        <h4 class="headding search-category-title" hidden>Categories</h4>
                                        <ul></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
            </div>

            <!-- Add this CSS for proper mobile header styling -->
            <style>
                .mobi-main-header {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    z-index: 1000;
                    background: #fff;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }

                .mobile-header-container {
                    padding: 10px 15px;
                }

                .mobi-full-row {
                    width: 100%;
                }

                .header-left-section {
                    flex: 1;
                }

                .header-right-section {
                    flex-shrink: 0;
                }

                .mobile-icons-container {
                    gap: 20px;
                    /* Equal spacing between all icons */
                }

                .mobile-icon-item {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 40px;
                    height: 40px;
                }

                /* Account Icon Styling */
                .mobile-account-icon {
                    width: 24px;
                    height: 24px;
                    object-fit: contain;
                }

                .mobile-account-link {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 100%;
                    height: 100%;
                }

                /* Cart Icon Styling */
                .mobile-cart-wrapper {
                    position: relative;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .mobile-cart-icon {
                    font-size: 24px;
                    color: #333;
                }

                .mobile-cart-count {
                    position: absolute;
                    top: -8px;
                    right: -8px;
                    background: #ff4444;
                    color: white;
                    border-radius: 50%;
                    width: 18px;
                    height: 18px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 11px;
                    font-weight: bold;
                    min-width: 18px;
                }

                .mobile-cart-link {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 100%;
                    height: 100%;
                    text-decoration: none;
                }

                /* Search Icon Styling */
                .mobile-search-btn {
                    background: none;
                    border: none;
                    padding: 0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 100%;
                    height: 100%;
                    cursor: pointer;
                }

                .mobile-search-icon {
                    width: 24px;
                    height: 24px;
                    object-fit: contain;

                }

                /* Logo styling */
                .mobi-logo img {
                    max-height: 50px;
                    width: auto;
                }

                /* Menu icon styling */
                .mobi-menu-icon {
                    width: 24px;
                    height: 24px;
                }

                /* Responsive adjustments */
                @media (max-width: 480px) {
                    .mobile-icons-container {
                        gap: 4px;
                    }

                    .mobile-icon-item {
                        width: 36px;
                        height: 36px;

                    }

                    .mobile-account-icon,
                    .mobile-search-icon {
                        width: 20px;
                        height: 20px;
                    }

                    .mobile-cart-icon {
                        font-size: 20px;
                    }

                    .mobile-cart-count {
                        width: 16px;
                        height: 16px;
                        font-size: 10px;
                        top: -6px;
                        right: -6px;
                    }
                }

                @media (min-width: 480px) {
                    .mobile-icons-container {
                        gap: 4px;
                    }
                }

                /* Hover effects */
                .mobile-icon-item:hover {
                    opacity: 0.7;
                    transition: opacity 0.2s ease;
                }

                /* Ensure proper alignment */
                .d-flex {
                    display: flex;
                }

                .align-items-center {
                    align-items: center;
                }

                .justify-content-between {
                    justify-content: space-between;
                }
            </style>


            <!-- destop header begin -->

            <div class="desmain-header">
                <div class="page-loader" hidden>
                    <img src="{{ asset('frontend/newstyle/assets/images/loader.gif') }}" style="display:block">

                </div>

                <div class="destop-affix">
                    <div class="destop-header">
                        <div id="topupbar_banner_desktop"></div>

                        <!-- top banner mobile-->
                        <div class="site-common-con header-search">
                            <div class="destop-main-header">
                                <div class="des-logo">
                                    @if ($siteLogo && $siteLogo->image_path)
                                        <a href="{{ url('/') }}">
                                            <img src="{{ asset('storage/logo_images/' . $siteLogo->image_path) }}"
                                                alt="Site Logo" class="img-fluid">
                                        </a>
                                    @else
                                        <a href="/"><img
                                                src="{{ asset('frontend/newstyle/assets/images/buyabanslogo-new.png') }}">
                                        </a>
                                    @endif

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
                                    <div class="top-search search-container">
                                        <form action="{{ route('searchResults') }}" method="GET"
                                            class="d-flex w-100 align-items-center">
                                            <input type="text" name="query"
                                                class="form-control main-search top-search-suggestion-desk"
                                                placeholder="Search for products, categories and more">
                                            <button type="submit" class="btn btn-primary submit-search">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </form>

                                        <div id="" class="suggestions-box suggestions-box-display"
                                            style="display: none;">
                                            <div class="left-suggestion-no-products" hidden>
                                                <p>No results found.</p>
                                            </div>

                                            <div class="left-suggestion-main-con">
                                                <!-- JS will inject products here -->
                                            </div>

                                            <div class="right-suggestion-main-con">
                                                <div>
                                                    <h4 class="headding search-category-title">Categories</h4>
                                                    <ul class="category-list">
                                                        <!-- JS will inject categories here -->
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

                                                {{--  <cart-item-count></cart-item-count>  --}}
                                                <div class="dt-icon-div">
                                                    <span id="cart-count-3"
                                                        class="w-16 h-16 text-xs text-white flex-center rounded-circle bg-main-two-600 position-absolute top-n6 ">
                                                        {{ $cartCount ?? 0 }}

                                                    </span>
                                                    <img src=" {{ asset('frontend/newstyle/assets/images/cart-new.png') }}"
                                                        class="cart-img">
                                                </div>
                                                <span class="span-cart">Cart</span>
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
                                                @auth

                                                    <div class="auth-container">
                                                        <div class="loged-user d-inline-flex">
                                                            <div class="log-user-img"><img
                                                                    src="https://buyabans.com/themes/buyabans/assets/images/icon/dummy-user.png">
                                                            </div>
                                                            <div class="log-user-data dropdown">
                                                                <div class="user-name">Hi!
                                                                    {{ auth()->user()->name }}
                                                                </div>
                                                                <div class="dropdown-box">

                                                                    <ul class="log-popup-links">
                                                                        <li>
                                                                            <a href="{{ route('dashboard') }}">
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
                                                                                    action="{{ route('logout') }}">


                                                                                    @csrf
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
                                                @else
                                                    <!-- Default Profile Icon and Links for Guests -->
                                                    <div class="sign-up d-inline-flex">
                                                        <div>
                                                            <a href="{{ route('login') }}" class="d-flex">
                                                                <div class="dt-icon-div"><img
                                                                        src=" {{ asset('frontend/newstyle/assets/images/account-icon.png') }} ">
                                                                </div>
                                                                <div>Login</div>
                                                            </a>
                                                        </div>

                                                        <div class="boder-right"></div>

                                                        <div>
                                                            <a class="sign-up-link"
                                                                href="{{ route('signup') }}"><span>Sign
                                                                    Up</span></a>
                                                        </div>
                                                    </div>

                                                </div>


                                            @endauth
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

        <style>




            .category-list {
                display: flex;
                align-items: center;
                gap: 0;
                margin: 0;
                padding: 0;
                list-style: none;
                overflow-x: auto;
                scrollbar-width: none;
                -ms-overflow-style: none;

            }

            .category-list::-webkit-scrollbar {
                display: none;
            }

            .category-item {
                flex-shrink: 0;

            }

            .category-link {
                display: block;
                padding: 15px 20px;
                color: #2b96c5;
                text-decoration: none;
                font-weight: 500;
                font-size: 14px;
                transition: all 0.3s ease;
                white-space: nowrap;
                position: relative;

            }

            .category-link:hover {
                background: #fff;
                color: #2b96c5;
            }

            .category-link.active {
                background: #fff;
                color: #2b96c5;
                border-bottom: 3px solid #2b96c5;
            }

            .category-scroll-container {
                position: relative;
            }

            .scroll-indicator {
                position: absolute;
                top: 0;

                bottom: 0;
                width: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(90deg, rgba(248, 249, 250, 0) 0%, rgba(248, 249, 250, 1) 100%);
                cursor: pointer;
                z-index: 10;
                opacity: 0;
                transition: opacity 0.3s ease;

            }

            .scroll-indicator.left {
                left: 0px;
                padding-right: 5px;
                background: linear-gradient(270deg, rgba(248, 249, 250, 0) 0%, rgba(248, 249, 250, 1) 100%);

            }

            .scroll-indicator.right {
                right: 0px;
                padding-left: 5px;

            }

            .scroll-indicator.visible {
                opacity: 1;
            }

            .scroll-indicator i {
                font-size: 18px;
                color: #666;
            }

            .category-sidebar {
                position: fixed;
                left: 0;
                top: 60px;
                bottom: 0;
                width: 250px;
                background: #fff;
                border-right: 1px solid #e0e0e0;
                overflow-y: auto;
                z-index: 900;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .category-sidebar.open {
                transform: translateX(0);
            }

            .category-sidebar-toggle {
                position: fixed;
                left: 10px;
                top: 70px;
                background: #2b96c5;
                color: white;
                border: none;
                padding: 10px 15px;
                border-radius: 0 5px 5px 0;
                cursor: pointer;
                z-index: 901;
                display: none;
            }

            .category-sidebar-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .category-sidebar-item {
                border-bottom: 1px solid #f0f0f0;
            }

            .category-sidebar-link {
                display: flex;
                align-items: center;
                padding: 15px 20px;
                color: #333;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .category-sidebar-link:hover {
                background: #f8f9fa;
                color: #2b96c5;
                padding-left: 25px;
            }

            .category-sidebar-link i {
                margin-right: 12px;
                font-size: 18px;
                width: 24px;
                text-align: center;
            }


            @media (max-width: 768px) {


                .category-link {
                    padding: 12px 15px;
                    font-size: 13px;
                }

                .scroll-indicator {
                    width: 30px;
                }
            }



            .category-link i {
                margin-right: 8px;
                font-size: 16px;
            }

            .category-badge {
                background: #2b96c5;
                color: white;
                font-size: 10px;
                padding: 2px 6px;
                border-radius: 10px;
                margin-left: 8px;
                font-weight: 600;
            }
        </style>

        {{-- <div class="category-bar">

            <div class="category-bar-container">
                <div class="category-scroll-container">
                    <div class="scroll-indicator left" onclick="scrollCategories('left')">
                        <i class="fa fa-chevron-left"></i>
                    </div>
                    <div class="scroll-indicator right" onclick="scrollCategories('right')">
                        <i class="fa fa-chevron-right"></i>
                    </div>

                    <ul class="category-list" id="categoryList">
                        @foreach ($categories as $category)
                            <li class="category-item">
                                <a href="/all-items?category={{ urlencode($category->parent_category) }}"
                                    class="category-link {{ request('category') == $category->parent_category ? 'active' : '' }}">
                                    @if ($category->parent_category == 'Electronics')
                                    @elseif($category->parent_category == 'Fashion')

                                    @elseif($category->parent_category == 'Home & Garden')

                                    @elseif($category->parent_category == 'Sports')
                                    @endif
                                    {{ $category->parent_category }}

                                    @if ($category->is_featured)
                                        <span class="category-badge">HOT</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div> --}}

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const categoryList = document.getElementById('categoryList');
                const leftIndicator = document.querySelector('.scroll-indicator.left');
                const rightIndicator = document.querySelector('.scroll-indicator.right');

                function checkScroll() {
                    const scrollLeft = categoryList.scrollLeft;
                    const scrollWidth = categoryList.scrollWidth;
                    const clientWidth = categoryList.clientWidth;

                    if (scrollLeft > 0) {
                        leftIndicator.classList.add('visible');
                    } else {
                        leftIndicator.classList.remove('visible');
                    }

                    if (scrollLeft < scrollWidth - clientWidth - 1) {
                        rightIndicator.classList.add('visible');
                    } else {
                        rightIndicator.classList.remove('visible');
                    }
                }

                checkScroll();

                categoryList.addEventListener('scroll', checkScroll);

                window.addEventListener('resize', checkScroll);
            });

            function scrollCategories(direction) {
                const categoryList = document.getElementById('categoryList');
                const scrollAmount = 200;

                if (direction === 'left') {
                    categoryList.scrollBy({
                        left: -scrollAmount,
                        behavior: 'smooth'
                    });
                } else {
                    categoryList.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                }
            }


            document.addEventListener('DOMContentLoaded', function() {
                const currentPath = window.location.pathname;
                const currentParams = new URLSearchParams(window.location.search);
                const currentCategory = currentParams.get('category');

                if (currentCategory) {
                    document.querySelectorAll('.category-link').forEach(link => {
                        const linkParams = new URLSearchParams(link.search);
                        if (linkParams.get('category') === currentCategory) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        </script>

        <button class="category-sidebar-toggle" onclick="toggleSidebar()">
            <i class="fa fa-bars"></i> Categories
        </button>

        <div class="category-sidebar" id="categorySidebar">
            <div style="padding: 20px; background: #f8f9fa; border-bottom: 1px solid #e0e0e0;">
                <h4 style="margin: 0; font-size: 18px;">Shop Categories</h4>
            </div>
            <ul class="category-sidebar-list">
                @foreach ($categories as $category)
                    <li class="category-sidebar-item">
                        <a href="/all-items?category={{ urlencode($category->parent_category) }}"
                            class="category-sidebar-link">
                            <i class="fa fa-angle-right"></i>
                            {{ $category->parent_category }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('categorySidebar');
                sidebar.classList.toggle('open');
            }
            document.addEventListener('click', function(e) {
                const sidebar = document.getElementById('categorySidebar');
                const toggle = document.querySelector('.category-sidebar-toggle');

                if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
                    sidebar.classList.remove('open');
                }
            });
        </script>
    </div>
    </div>





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
                        <strong>+94 75 833 7141
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
                        <li class="column-1"><a href="#" title="">Brands</a></li>


                        {{-- <li class="column-1"><a href="/shop" title="">Shop</a></li> --}}

                        <li><a href="{{ route('about') }}" title=""> About Us </a></li>

                        <li><a href="{{ route('contac') }}" title="">Contact Us </a></li>

                        {{-- <li><a href="{{ route('frontend.vendor') }}" title="">Vendors </a></li> --}}


                    </ul>







                    </ul>


                </div>

                <div class="tab-pane cat-pane" id="categories">
                    <ul class=" list-unstyled">

                        @foreach ($categories as $category)
                            <li class="position-relative">

                                <!-- Main Category and Toggle -->
                                <div class="d-flex justify-content-between align-items-center ">
                                    <a href="/all-items?category={{ urlencode($category->parent_category) }}"
                                        class="text-dark text-decoration-none fw-semibold" style="line-height: 1.6;">
                                        {{ $category->parent_category }}
                                    </a>

                                    @if ($category->subcategories->isNotEmpty())
                                        <span class="toggle-btn" onclick="toggleDropdown(this)"
                                            style="cursor: pointer;">
                                            <i class="fa fa-chevron-down text-muted"></i>
                                        </span>
                                    @endif
                                </div>

                                <!-- Subcategory List -->
                                @if ($category->subcategories->isNotEmpty())
                                    <ul
                                        class="dropdown subcategory-dropdown bg-light border mt-1 rounded shadow-sm d-none">
                                        @foreach ($category->subcategories as $subcategory)
                                            <li>
                                                <a href="/all-items?subcategory={{ urlencode($subcategory->subcategory) }}"
                                                    class="d-block px-4 py-2 text-dark text-decoration-none"
                                                    style="line-height: 1.6;">
                                                    {{ $subcategory->subcategory }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                            </li>
                        @endforeach

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
                        url: "{{ route('searchProducts') }}",
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
            fetch("{{ route('cart.count') }}")
                .then(response => response.json())
                .then(data => {
                    const countIds = ['cart-count-1', 'cart-count-2', 'cart-count-3', 'cart-count-4'];
                    countIds.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.textContent = data.cart_count;
                    });
                })
                .catch(error => {
                    console.error('Error fetching cart count:', error);
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const brandsMenuItem = document.querySelector('li > a[title="Brands"]')?.parentElement;
            const submenu = document.getElementById('brand-submenu');

            let brandsLoaded = false;
            let brandsFetching = false;
            let hoverTimeout = null;

            if (!brandsMenuItem || !submenu) return;

            // Show submenu on hover
            brandsMenuItem.addEventListener('mouseenter', () => {
                // Clear any existing timeout to avoid flickering
                if (hoverTimeout) clearTimeout(hoverTimeout);

                submenu.style.display = 'block';

                // Only fetch data if it hasn't been loaded or isn't currently fetching
                if (!brandsLoaded && !brandsFetching) {
                    brandsFetching = true; // Lock to prevent multiple requests

                    console.log('Fetching brands data');

                    fetch('/brands-data')
                        .then(res => {
                            if (!res.ok) throw new Error('Network response was not ok');
                            return res.json();
                        })
                        .then(data => {
                            const topContainer = document.getElementById('top-brands');
                            const allContainer = document.getElementById('all-brands');

                            // Clear containers first to prevent duplicate content
                            topContainer.innerHTML = '';
                            allContainer.innerHTML = '';

                            const allList = [
                                [],
                                [],
                                [],
                                []
                            ];
                            let col = 0;

                            data.forEach(brand => {
                                const imageUrl = brand.image ? brand.image :
                                    'default-image.png';

                                const brandLink = `<a title="${brand.name}" href="/brand/${brand.slug}">
                        <img src="/storage/${imageUrl}" alt="${brand.name}" style="height: 50px;">
                    </a>`;

                                if (brand.is_top_brand) {
                                    topContainer.insertAdjacentHTML('beforeend',
                                        `<div class="brand-img col-sm-3">${brandLink}</div>`
                                    );
                                }

                                allList[col].push(
                                    `<li><a href="/brand/${brand.slug}">${brand.name}</a></li>`
                                );
                                col = (col + 1) % 4;
                            });

                            allList.forEach(column => {
                                allContainer.insertAdjacentHTML('beforeend',
                                    `<ul class="col-sm-3">${column.join('')}</ul>`);
                            });

                            brandsLoaded = true;
                            console.log('Brands loaded successfully');
                        })
                        .catch(err => {
                            console.error('Brand fetch failed:', err);
                        })
                        .finally(() => {
                            brandsFetching = false;
                        });
                }
            });

            // Add event listeners to both menu item and submenu to prevent flickering
            submenu.addEventListener('mouseenter', () => {
                if (hoverTimeout) clearTimeout(hoverTimeout);
                submenu.style.display = 'block';
            });

            // Hide submenu on mouse leave with slight delay to prevent flickering
            const handleMouseLeave = () => {
                hoverTimeout = setTimeout(() => {
                    submenu.style.display = 'none';
                }, 200); // Small delay to prevent flickering when moving between menu and submenu
            };

            brandsMenuItem.addEventListener('mouseleave', handleMouseLeave);
            submenu.addEventListener('mouseleave', handleMouseLeave);
        });
    </script>

    <script>
        // Mobile Search Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Get the search button and search container elements
            const searchButton = document.querySelector('.mobile-search-btn');
            const searchContainer = document.querySelector('.search-con-mobile');
            const closeButton = document.querySelector('.close-search');
            const searchTitle = document.querySelector('.search-title');

            // Function to show search container
            function showSearch() {
                if (searchContainer) {
                    searchContainer.style.display = 'block';
                    // Show the search title as well
                    if (searchTitle) {
                        searchTitle.style.display = 'block';
                    }
                    // Focus on the search input for better UX
                    const searchInput = searchContainer.querySelector('.main-search');
                    if (searchInput) {
                        setTimeout(() => searchInput.focus(), 100);
                    }
                }
            }

            // Function to hide search container
            function hideSearch() {
                if (searchContainer) {
                    searchContainer.style.display = 'none';
                    // Hide the search title as well
                    if (searchTitle) {
                        searchTitle.style.display = 'none';
                    }
                }
            }

            // Add click event listener to search button
            if (searchButton) {
                searchButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    showSearch();
                });
            }

            // Add click event listener to close button
            if (closeButton) {
                closeButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    hideSearch();
                });
            }

            // Optional: Close search when clicking outside
            document.addEventListener('click', function(e) {
                if (searchContainer &&
                    searchContainer.style.display === 'block' &&
                    !searchContainer.contains(e.target) &&
                    !searchButton.contains(e.target)) {
                    hideSearch();
                }
            });

            // Optional: Close search with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && searchContainer && searchContainer.style.display === 'block') {
                    hideSearch();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.top-search-suggestion-mobi');
            const suggestionBox = document.getElementById('suggestions-box-display-mobi');
            const productCon = suggestionBox.querySelector('.left-suggestion-main-con');
            const categoryCon = suggestionBox.querySelector('.right-suggestion-main-con ul');
            const noResults = suggestionBox.querySelector('.left-suggestion-no-products');
            const searchCloseBtn = document.querySelector('.close-search');

            // Search functionality
            searchInput.addEventListener('keyup', function() {
                const query = this.value.trim();

                if (query.length < 2) {
                    suggestionBox.style.display = 'none';
                    return;
                }

                fetch(`/search-suggestions?q=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(data => {
                        productCon.innerHTML = '';
                        categoryCon.innerHTML = '';

                        if (data.products.length === 0 && data.categories.length === 0) {
                            noResults.hidden = false;
                            suggestionBox.style.display = 'block';
                            return;
                        }

                        noResults.hidden = true;

                        // Products
                        data.products.forEach(product => {
                            productCon.innerHTML += `
                            <a class="search-product-element" href="${product.url}">
                                <div class="suggestion-box">
                                    <div class="suggestion-product-img">
                                        <img class="img-fluid" alt="" src="${product.image ?? ''}">
                                    </div>
                                    <div class="suggestion-box-details">
                                        <div class="product-line product-name">${product.name}</div>
                                    </div>
                                </div>
                            </a>`;
                        });

                        // Categories
                        data.categories.forEach(category => {
                            categoryCon.innerHTML += `
                            <li><a class="search-category-name" href="${category.url}">${category.name}</a></li>`;
                        });

                        suggestionBox.style.display = 'block';
                    })
                    .catch(err => {
                        console.error('Mobile search error:', err);
                    });
            });

            // Close search suggestions
            if (searchCloseBtn) {
                searchCloseBtn.addEventListener('click', () => {
                    suggestionBox.style.display = 'none';
                    searchInput.value = '';
                });
            }
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInputDesktop = document.querySelector(
            '.top-search-suggestion-desk'); // give desktop input a unique class
            const suggestionBox = document.getElementById('suggestions-box-display');
            const productCon = suggestionBox?.querySelector('.left-suggestion-main-con');
            const categoryCon = suggestionBox?.querySelector('.right-suggestion-main-con ul');
            const noResults = suggestionBox?.querySelector('.left-suggestion-no-products');

            if (!searchInputDesktop) return;

            searchInputDesktop.addEventListener('keyup', function() {
                const query = this.value.trim();

                if (query.length < 2) {
                    if (suggestionBox) suggestionBox.style.display = 'none';
                    return;
                }

                fetch(`/search-suggestions?q=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(data => {
                        if (!suggestionBox) return;

                        productCon.innerHTML = '';
                        categoryCon.innerHTML = '';

                        if (data.products.length === 0 && data.categories.length === 0) {
                            noResults.hidden = false;
                            suggestionBox.style.display = 'block';
                            return;
                        }

                        noResults.hidden = true;

                        // Products
                        data.products.forEach(product => {
                            productCon.innerHTML += `
                            <a class="search-product-element" href="${product.url}">
                                <div class="suggestion-box">
                                    <div class="suggestion-product-img">
                                        <img class="img-fluid" alt="" src="${product.image ?? ''}">
                                    </div>
                                    <div class="suggestion-box-details">
                                        <div class="product-line product-name">${product.name}</div>
                                    </div>
                                </div>
                            </a>`;
                        });

                        // Categories
                        data.categories.forEach(category => {
                            categoryCon.innerHTML += `
                            <li><a class="search-category-name" href="${category.url}">${category.name}</a></li>`;
                        });

                        suggestionBox.style.display = 'block';
                    })
                    .catch(err => {
                        console.error('Desktop search error:', err);
                    });
            });
        });
    </script>


    </header>
