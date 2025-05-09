<style>
    .list-group-item {
        border: none;
        padding: 5px 20px;
        display: flex;
        height: 45px;
        align-items: center;
        gap: 15px;
    }

    #sidebarMenu {
        max-height: 100vh;
        overflow-y: auto;
        padding-bottom: 20px;
    }

    .list-group-item i {
        width: 20px;
        text-align: center;
    }

    .list-group-item span {
        flex-grow: 1;
    }

    .list-group-item:not(:last-child) {
        margin-bottom: 5px;
    }

    .list-group-item.active {
        border-left: 4px solid blue;
        background-color: #f8f9fa;
        box-shadow: none;
    }
</style>

<nav id="sidebarMenu" class="collapse navbar-collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
        <div class="list-group list-group-flush mx-2 mt-4">
            <a href="<?php echo e(route('admin.index')); ?>"
                class="list-group-item list-group-item-action py-2 <?php echo e(request()->routeIs('admin.index') ? 'active' : ''); ?>"
                data-mdb-ripple-init aria-current="true">
                <i class="fas fa-tachometer-alt text-muted"></i><span class="text-muted">Dashboard</span>
            </a>
            <a href="<?php echo e(route('customers')); ?>"
                class="list-group-item list-group-item-action py-2 <?php echo e(request()->routeIs('customers') ? 'active' : ''); ?>"
                data-mdb-ripple-init>
                <i class="fas fa-users text-muted"></i><span class="text-muted">Customers</span>
            </a>


            <!-- Affiliate Dropdown -->
            <a class="list-group-item list-group-item-action py-2 d-flex justify-content-between align-items-center <?php echo e(request()->is('Affiliate*') ? 'active' : ''); ?>"
                data-bs-toggle="collapse" href="#AffiliateSubMenu" role="button" aria-expanded="false"
                aria-controls="AffiliateSubMenu">
                <i class="fas fa-users text-muted"></i><span class="text-muted">Affiliate</span>
                <i class="fas fa-chevron-down float-end mt-2" style="font-size:10px;"></i>
            </a>
            <div class="collapse <?php echo e(request()->is('Affiliate*') ? 'show' : ''); ?>" id="AffiliateSubMenu">
                <a href="<?php echo e(route('aff_customers')); ?>" class="list-group-item list-group-item-action ms-4"
                    style="height: 35px; width:180px;">
                    Affiliate Customers
                </a>
                <a href="<?php echo e(route('affiliate_withdrawals')); ?>" class="list-group-item list-group-item-action ms-4"
                    style="height: 35px; width:180px;">
                    Affiliate Withdrawals
                </a>
                <a href="<?php echo e(route('affiliate_rules')); ?>" class="list-group-item list-group-item-action ms-4"
                    style="height: 35px; width:180px;">
                    Affiliate Rules
                </a>
            </div>



            <!-- Products Dropdown -->
            <a class="list-group-item list-group-item-action py-2 d-flex justify-content-between align-items-center <?php echo e(request()->is('products*') ? 'active' : ''); ?>"
                data-bs-toggle="collapse" href="#productsSubMenu" role="button" aria-expanded="false"
                aria-controls="productsSubMenu">
                <i class="fas fa-box text-muted"></i><span class="text-muted">Products</span>
                <i class="fas fa-chevron-down float-end mt-2" style="font-size:10px;"></i>
            </a>
            <div class="collapse <?php echo e(request()->is('products*') ? 'show' : ''); ?>" id="productsSubMenu">
                <a href="<?php echo e(route('products')); ?>" class="list-group-item list-group-item-action ms-4"
                    style="height: 35px; width:180px;">
                    Products
                </a>
                <a href="<?php echo e(route('special_offers')); ?>" class="list-group-item list-group-item-action ms-4"
                    style="height: 35px; width:180px;">
                    Special Offers
                </a>
                <a href="<?php echo e(route('flash_sales')); ?>" class="list-group-item list-group-item-action ms-4"
                    style="height: 35px; width:180px;">
                    Flash Sales
                </a>
            </div>

            <a href="<?php echo e(route('orders')); ?>"
                class="list-group-item list-group-item-action py-2 <?php echo e(request()->routeIs('orders') ? 'active' : ''); ?>"
                data-mdb-ripple-init>
                <i class="fas fa-shopping-cart text-muted"></i><span class="text-muted">Orders</span>
            </a>
            <a href="<?php echo e(route('manage_reviews')); ?>"
                class="list-group-item list-group-item-action py-2 <?php echo e(request()->routeIs('manage_reviews') ? 'active' : ''); ?>"
                data-mdb-ripple-init>
                <i class="fa-solid fa-comments text-muted"></i><span class="text-muted">Manage Reviews</span>
            </a>
            <a href="<?php echo e(route('customer_inquiries')); ?>"
                class="list-group-item list-group-item-action py-2 <?php echo e(request()->routeIs('customer_inquiries') ? 'active' : ''); ?>"
                data-mdb-ripple-init>
                <i class="fas fa-envelope text-muted"></i><span class="text-muted">Customer Inquiries</span>
            </a>
            <a href="<?php echo e(route('category')); ?>"
                class="list-group-item list-group-item-action py-2 <?php echo e(request()->routeIs('category') ? 'active' : ''); ?>"
                data-mdb-ripple-init>
                <i class="fa-solid fa-folder-tree text-muted"></i><span class="text-muted">Product Categories</span>
            </a>
            <a href="<?php echo e(route('show_users')); ?>"
                class="list-group-item list-group-item-action py-2 <?php echo e(request()->routeIs('show_users') ? 'active' : ''); ?>"
                data-mdb-ripple-init>
                <i class="fas fa-user text-muted"></i><span class="text-muted">User Management</span>
            </a>
            <a href="<?php echo e(route('carousel')); ?>"
                class="list-group-item list-group-item-action py-2 <?php echo e(request()->routeIs('carousel') ? 'active' : ''); ?>"
                data-mdb-ripple-init>
                <i class="fas fa-slideshare text-muted"></i><span class="text-muted">Carousel Management</span>
            </a>

            <a href="<?php echo e(route('banner')); ?>"
                class="list-group-item list-group-item-action py-2 <?php echo e(request()->routeIs('banner') ? 'active' : ''); ?>"
                data-mdb-ripple-init>
                <i class="fas fa-ad text-muted"></i><span class="text-muted">Banner Management</span>
            </a>

            <a href="<?php echo e(route('logo')); ?>"
                class="list-group-item list-group-item-action py-2 <?php echo e(request()->routeIs('logo') ? 'active' : ''); ?>"
                data-mdb-ripple-init>
                <i class="fas fa-image text-muted"></i><span class="text-muted">Logo Management</span>
            </a>
        </div>
    </div>
</nav>
<?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/layouts/admin_main/sidebar.blade.php ENDPATH**/ ?>