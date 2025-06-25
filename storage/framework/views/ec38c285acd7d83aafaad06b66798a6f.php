
<header>
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top p-1">
        <!-- Container wrapper -->
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="d-flex mb-md-0 px-3">
                <a href="" class="d-flex align-items-center" style="text-decoration: none">
                    <div class="navbar-brand me-0 p-0">
                        <img src="/assets/images/logo.png" height="52" width="35" alt="Logo" />
                    </div>
                    <img src="/assets/images/brand_name.png" height="25" width="280" alt="brand" class="" />
                </a>
            </div>

            <ul class="navbar-nav ms-auto d-flex align-items-center flex-row">
                

               

                <li class="nav-item dropdown me-2 d-flex align-items-center">
                    <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                        id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="icon-circle">
                            <i class="fas fa-user-alt"></i>
                        </div>
                        <span class="ms-2 text-muted"><?php echo e($affiliateName); ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        
                        <li><a class="dropdown-item" href="<?php echo e(route('mywebsites_page')); ?>">Account Settings</a></li>

                        <li>
                            <form id="logout-form" action="<?php echo e(route('aff_logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- Container wrapper -->
    </nav>
</header>
<?php /**PATH C:\xampp\htdocs\OMCNEW\resources\views/layouts/affiliate_main/navbar.blade.php ENDPATH**/ ?>