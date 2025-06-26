<?php $__env->startSection('content'); ?>
<!-- Bootstrap -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Dashboard CSS -->
<link rel="stylesheet" href="/assets/plugins/userdashboard.css">

<style>
    .dashboard-container {
        margin-top: 2rem;
        padding: 1rem;
    }

    .dashboard-sidebar {
        background-color: #f8f9fa;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #dee2e6;
        height: fit-content;
        transition: all 0.3s ease;
    }

    .dashboard-content {
        background-color: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        padding: 1.5rem;
    }

    .dashboard-nav .nav-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 0.5rem;
        color: #495057;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .dashboard-nav .nav-link:hover {
        background-color: #e9ecef;
    }

    .dashboard-nav .nav-link.active {
        font-weight: bold;
        color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.1);
    }

    .dashboard-nav .nav-link.text-danger {
        color: #dc3545 !important;
    }

    .dashboard-nav .nav-link.text-danger:hover {
        background-color: rgba(220, 53, 69, 0.1);
    }

    .sidebar-toggle {
        display: none;
        margin-bottom: 1rem;
        text-align: center;
    }

    .sidebar-toggle button {
        white-space: nowrap;
        padding: 0.5rem 1rem;

    }

    .page-title-area {
        background-color: #f8f9fa;
        padding: 2rem 0;
        margin-bottom: 1rem;
    }

    .page-title-content h2 {
        margin-bottom: 0.5rem;
        font-size: 1.75rem;
    }

    .page-title-content ul {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .page-title-content ul li {
        margin-right: 0.5rem;
    }

    .page-title-content ul li:not(:last-child)::after {
        content: none;
        margin-left: 0.5rem;
        color: #6c757d;
    }

    @media (max-width: 999px) {
        .sidebar-toggle {
            display: block !important;

        }

        .dashboard-sidebar.collapsed {
            display: none !important;


        }

        .dashboard-sidebar {
            margin-top: 5rem;

        }

    }
    /* Default size for large screens */
.dashboard-nav .nav-link {
    font-size: 1rem; /* ~16px */
    padding: 0.75rem 1rem;
}

/* Medium screens (tablets) */
@media (max-width: 1200px) {
    .dashboard-nav .nav-link {
        font-size: 0.95rem;
        padding: 0.65rem 0.9rem;
    }
}

/* Small screens (phones) */
@media (max-width: 991px) {
    .dashboard-nav .nav-link {
        font-size: 0.9rem;
        padding: 0.6rem 0.85rem;
    }
}

/* Extra small screens (very small phones) */
@media (max-width: 576px) {
    .dashboard-nav .nav-link {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
    }
}



</style>

<!-- Start Page Title -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>My Account</h2>
            <ul>
                <li><a href="/">Home</a></li>
                <li>My Account</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Main dashboard container -->
<div class="container dashboard-container">
    <div class="row">
        <!-- Sidebar toggle for mobile -->
        <div class="col-12 sidebar-toggle">
            <button class="btn btn-primary" id="toggleSidebar">
                ☰ Toggle Menu
            </button>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-3 col-md-4" id="dashboardSidebar">
            <div class="dashboard-sidebar">
                <ul class="nav flex-column dashboard-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('edit-profile') ? 'active' : ''); ?>" href="<?php echo e(route('edit-profile')); ?>">Edit Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('myorders') ? 'active' : ''); ?>" href="<?php echo e(route('myorders')); ?>">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('myreviews') ? 'active' : ''); ?>" href="<?php echo e(route('myreviews')); ?>">My Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('myinquiries') ? 'active' : ''); ?>" href="<?php echo e(route('myinquiries')); ?>">Inquiries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('addresses') ? 'active' : ''); ?>" href="<?php echo e(route('addresses')); ?>">Address Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('change-password') ? 'active' : ''); ?>" href="<?php echo e(route('change-password')); ?>">Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('returns') ? 'active' : ''); ?>" href="<?php echo e(route('returns')); ?>">Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="<?php echo e(route('logout')); ?>"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Log Out
                        </a>
                    </li>
                </ul>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </div>

        <!-- Main content -->
        <div class="col-lg-9 col-md-8">
            <div class="dashboard-content">
                <?php echo $__env->yieldContent('dashboard-content'); ?>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle sidebar visibility on mobile
    document.getElementById('toggleSidebar').addEventListener('click', function () {
        const sidebar = document.getElementById('dashboardSidebar').querySelector('.dashboard-sidebar');
        sidebar.classList.toggle('collapsed');
    });

    function checkScreenSize() {
        const sidebar = document.getElementById('dashboardSidebar').querySelector('.dashboard-sidebar');
        if (window.innerWidth < 1000) {
            sidebar.classList.add('collapsed');
        } else {
            sidebar.classList.remove('collapsed');
        }
    }

    window.addEventListener('load', checkScreenSize);
    window.addEventListener('resize', checkScreenSize);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\OMC2\OMCNEW\resources\views/member_dashboard/user_sidebar.blade.php ENDPATH**/ ?>