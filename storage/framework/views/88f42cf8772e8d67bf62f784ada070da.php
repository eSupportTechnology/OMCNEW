  <style>
    .user-initial {
    display: inline-block;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background-color: #007bff; 
    color: #fff; 
    text-align: center;
    line-height: 28px; 
    font-weight: bold;
    font-size: 14px;
    margin-right: 10px; 
}
/* Style for the main dropdown list item */
.dropdown {
    position: relative;
}

/* Hide dropdown menu by default */
.dropdown-menu {
    display: none;
    position: absolute;
    background-color: #fff; /* Background color of dropdown */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    padding: 10px;
    list-style-type: none;
    margin: 0;
    top: 100%;
    left: 0;
    z-index: 10;
}

/* Dropdown items styling */
.dropdown-menu li a {
    padding: 10px;
    text-decoration: none;
    display: block;
    color: #333; /* Text color */
}

.dropdown-menu li a:hover {
    background-color: #f1f1f1; /* Hover effect */
}

/* Show the dropdown menu when hovering over the parent list item */
.dropdown:hover .dropdown-menu {
    display: block;
}


/* Fixed style for the navbar when scrolling */
.navbar-area.fixed {
    position: fixed;
    top: 0;
}

/* Ensure the navbar has a higher z-index when fixed */
.navbar-area {
    position: relative;
    width: 100%;
    z-index: 1010;
    transition: top 0.3s ease, position 0.3s ease;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}


/* Style for the xton-responsive-nav */
.xton-responsive-nav {
    background-color:white;
}


  </style>  


  <!-- Start Top Header Area -->
  <div class="top-header">
      <div class="container">
          <div class="row align-items-center justify-content-center">
              <div class="col-lg-6 col-md-12">
                  <ul class="header-contact-info">
                      <li>Welcome to Omc</li>
                      <li>Call: <a href="tel:075 833 7141">075 833 7141</a></li>
                  </ul>
              </div>

              <div class="col-lg-6 col-md-12">
                  <ul class="header-top-menu">
                      <li><a href="#" data-bs-toggle="modal" data-bs-target="#shoppingWishlistModal"><i class='bx bx-heart'></i> Wishlist</a></li>
                       
                      <?php if(auth()->guard()->check()): ?>
                        <li class="dropdown">
                            <a href="#">
                                <span class="user-initial">
                                    <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                                </span>
                                My Account
                            </a>
                            <ul class="dropdown-menu" style="z-index:1020">
                                <li><a href="<?php echo e(route('user.dashboard')); ?>">Dashboard</a></li>
                                <li>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </li>
                            </ul>

                        </li>
                        <?php else: ?>
                            <li><a href="/login"><i class='bx bx-log-in'></i> Login</a></li>
                        <?php endif; ?>


                      <ul class="header-top-others-option">
                          <div class="option-item">
                              <div class="search-btn-box">
                                  <i class="search-btn bx bx-search-alt"></i>
                              </div>
                          </div>

                         <!-- Cart in the Top Header -->
                        <div class="option-item">
                            <div class="cart-btn">
                                <a href="/cart">
                                    <i class='bx bx-shopping-bag'></i>
                                    <span id="cart-count-header">0</span>
                                </a>
                            </div>
                        </div>
                      </ul>
              </div>
          </div>
      </div>
  </div>
  <!-- End Top Header Area -->

  <!-- Start Navbar Area -->
  <div class="navbar-area" >
      <div class="xton-responsive-nav">
          <div class="container">
              <div class="xton-responsive-menu">
                  <div class="logo" >
                      <a href="/">
                      <img src="<?php echo e(asset('frontend/assets/img/logo.png')); ?>" height="50" width="35" class="main-logo" alt="logo">
                        <span>
                            <img src="<?php echo e(asset('frontend/assets/img/brand_name.png')); ?>" style="height:30px" width="285" alt="brand" />
                        </span>
                        <img src="<?php echo e(asset('frontend/assets/img/white-logo.png')); ?>" class="white-logo" alt="logo">
                      </a>
                  </div>
              </div>
          </div>
      </div>

      <div class="xton-nav">
          <div class="container">
              <nav class="navbar navbar-expand-md navbar-light"  style="width:110%">
                  <a class="navbar-brand" href="/">
                  <img src="<?php echo e(asset('frontend/assets/img/logo.png')); ?>" style="height:50px; width:30px" class="main-logo" alt="logo">
                    <span>
                        <img src="<?php echo e(asset('frontend/assets/img/brand_name.png')); ?>" style="height:25px; width:250px"  alt="brand" />
                    </span>
                    <img src="<?php echo e(asset('frontend/assets/img/white-logo.png')); ?>" class="white-logo" alt="logo">

                  </a>

                  <div class="collapse navbar-collapse mean-menu" style="margin-right:80px">
                      <ul class="navbar-nav">
                          <li class="nav-item"><a href="/" class="nav-link ">Home </a>
                          </li>

                          <li class="nav-item"><a href="#" class="nav-link">Categories </a>
                                <ul class="dropdown-menu">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="nav-item">
                                            <a href="/all-items?category=<?php echo e(urlencode($category->parent_category)); ?>" 
                                            class="nav-link"><?php echo e($category->parent_category); ?> <i class="bx bx-chevron-right"></i></a>
                                            <ul class="dropdown-menu" style="position: absolute; top: 0; left: 100%; margin-top: 0;">
                                                <?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="nav-item">
                                                        <a href="/all-items?subcategory=<?php echo e(urlencode($subcategory->subcategory)); ?>" 
                                                        class="nav-link" data-toggle="dropdown"><?php echo e($subcategory->subcategory); ?> 
                                                        <i class="bx bx-chevron-right"></i>
                                                        </a>
                                                        <ul class="dropdown-menu" style="position: absolute; top: 0; left: 100%; margin-top: 0;">
                                                            <?php $__currentLoopData = $subcategory->subSubcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li class="nav-item">
                                                                    <a href="/all-items?subsubcategory=<?php echo e(urlencode($subSubcategory->sub_subcategory)); ?>" 
                                                                    class="nav-link"><?php echo e($subSubcategory->sub_subcategory); ?></a>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>

                          <li class="nav-item"><a href="/About-us" class="nav-link ">About us </a>
                          </li>

                          <li class="nav-item"><a href="/all-items" class="nav-link">All items </a>
                          </li>

                          <li class="nav-item "><a href="/special-offers" class="nav-link">Special offers </a>
                          </li>

                          <li class="nav-item "><a href="/best-seller" class="nav-link">Best sellers </a>

                          </li>

                          <li class="nav-item"><a href="/contact" class="nav-link">Contact</a>
                          </li>
                          
                      </ul>

                      <div class="others-option">
                          <div class="option-item">
                              <div class="search-btn-box">
                                  <i class="search-btn bx bx-search-alt"></i>
                              </div>
                          </div>

                        <!-- Cart in the Navbar -->
                        <div class="option-item">
                            <div class="cart-btn">
                                <a href="/cart">
                                    <i class='bx bx-shopping-bag'></i>
                                    <span id="cart-count-navbar">0</span>
                                </a>
                            </div>
                        </div>

                          <div class="option-item">
                              <div class="burger-menu" data-bs-toggle="modal" data-bs-target="#sidebarModal">
                                  <span class="top-bar"></span>
                                  <span class="middle-bar"></span>
                                  <span class="bottom-bar"></span>
                              </div>
                          </div>
                      </div>
                  </div>
              </nav>
          </div>
      </div>
  </div>
  <!-- End Navbar Area -->


            <!-- Start Search Overlay -->
            <div class="search-overlay">
                <div class="d-table">
                    <div class="d-table-cell">
                        <div class="search-overlay-layer"></div>
                        <div class="search-overlay-layer"></div>
                        <div class="search-overlay-layer"></div>

                        <div class="search-overlay-close">
                            <span class="search-overlay-close-line"></span>
                            <span class="search-overlay-close-line"></span>
                        </div>

                        <div class="search-overlay-form">
                <form action="<?php echo e(route('searchResults')); ?>" method="GET">
                    <input 
                        type="text" 
                        class="input-search" 
                        name="query" 
                        placeholder="Search here..." 
                        value="<?php echo e(request('query')); ?>"> <!-- Preserve input on search results -->
                    <button type="submit"><i class='bx bx-search-alt'></i></button>
                </form>
            </div>

          </div>
      </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const navbar = document.querySelector(".navbar-area");
        const topHeader = document.querySelector(".top-header");
        const topHeaderHeight = topHeader.offsetHeight;

        window.addEventListener("scroll", function () {
            if (window.scrollY > topHeaderHeight) {
                navbar.classList.add("fixed");
            } else {
                navbar.classList.remove("fixed");
            }
        });
    });
</script>

  <!-- End Search Overlay --><?php /**PATH C:\Users\chint\OneDrive\Documents\GitHub\online-marketing\resources\views/frontend/navbar-new.blade.php ENDPATH**/ ?>