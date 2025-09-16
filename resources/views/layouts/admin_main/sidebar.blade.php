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

    .back-btn-fixed {
        position: fixed;
        top: 70px;
        left: 15px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        cursor: pointer;
        box-shadow: none;
        transition: background-color 0.3s, transform 0.2s, box-shadow 0.3s;
        z-index: 1100;
    }

    .back-btn-fixed i {
        color: #000;
    }

    .back-btn-fixed:hover {
        background-color: #e0e0e0;
        transform: scale(1.1);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }
</style>
<div class="back-btn-fixed" onclick="history.back()" title="Go Back">
    <i class="fas fa-arrow-left"></i>
</div>
<nav id="sidebarMenu" class="collapse navbar-collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
        <div class="list-group list-group-flush mx-2 mt-4">
            <a href="{{ route('admin.index') }}"
                class="list-group-item list-group-item-action py-2 {{ request()->routeIs('admin.index') ? 'active' : '' }}"
                data-mdb-ripple-init aria-current="true">
                <i class="fas fa-tachometer-alt text-muted"></i><span class="text-muted">Dashboard</span>
            </a>
            <a href="{{ route('customers') }}"
                class="list-group-item list-group-item-action py-2 {{ request()->routeIs('customers') ? 'active' : '' }}"
                data-mdb-ripple-init>
                <i class="fas fa-users text-muted"></i><span class="text-muted">Customers</span>
            </a>


            <!-- Affiliate Dropdown -->
            <a class="list-group-item list-group-item-action py-2 d-flex justify-content-between align-items-center {{ request()->is('Affiliate*') ? 'active' : '' }}"
                data-bs-toggle="collapse" href="#AffiliateSubMenu" role="button" aria-expanded="false"
                aria-controls="AffiliateSubMenu">
                <i class="fas fa-users text-muted"></i><span class="text-muted">Affiliate</span>
                <i class="fas fa-chevron-down float-end mt-2" style="font-size:10px;"></i>
            </a>
            <div class="collapse {{ request()->is('Affiliate*') ? 'show' : '' }}" id="AffiliateSubMenu">
                <a href="{{ route('aff_customers') }}" class="list-group-item list-group-item-action ms-4"
                    style="height: 35px; width:180px;">
                    Affiliate Customers
                </a>
                <a href="{{ route('affiliate_withdrawals') }}" class="list-group-item list-group-item-action ms-4"
                    style="height: 35px; width:180px;">
                    Affiliate Withdrawals
                </a>
                <a href="{{ route('affiliate_rules') }}" class="list-group-item list-group-item-action ms-4"
                    style="height: 35px; width:180px;">
                    Affiliate Rules
                </a>
            </div>



            <!-- Products Dropdown -->
            <a class="list-group-item list-group-item-action py-2 d-flex justify-content-between align-items-center {{ request()->is('products*') ? 'active' : '' }}"
                data-bs-toggle="collapse" href="#productsSubMenu" role="button" aria-expanded="false"
                aria-controls="productsSubMenu">
                <i class="fas fa-box text-muted"></i><span class="text-muted">Products</span>
                <i class="fas fa-chevron-down float-end mt-2" style="font-size:10px;"></i>
            </a>
            <div class="collapse {{ request()->is('products*') ? 'show' : '' }}" id="productsSubMenu">
                <a href="{{ route('products') }}" class="list-group-item list-group-item-action ms-4"
                    style="height: 35px; width:180px;">
                    Products
                </a>
                <a href="{{ route('special_offers') }}" class="list-group-item list-group-item-action ms-4"
                    style="height: 35px; width:180px;">
                    Special Offers
                </a>
                <a href="{{ route('flash_sales') }}" class="list-group-item list-group-item-action ms-4"
                    style="height: 35px; width:180px;">
                    Flash Sales
                </a>
            </div>

            <a href="{{ route('orders') }}"
                class="list-group-item list-group-item-action py-2 {{ request()->routeIs('orders') ? 'active' : '' }}"
                data-mdb-ripple-init>
                <i class="fas fa-shopping-cart text-muted"></i><span class="text-muted">Orders</span>
            </a>
            <a href="{{ route('manage_reviews') }}"
                class="list-group-item list-group-item-action py-2 {{ request()->routeIs('manage_reviews') ? 'active' : '' }}"
                data-mdb-ripple-init>
                <i class="fa-solid fa-comments text-muted"></i><span class="text-muted">Manage Reviews</span>
            </a>
            <a href="{{ route('customer_inquiries') }}"
                class="list-group-item list-group-item-action py-2 {{ request()->routeIs('customer_inquiries') ? 'active' : '' }}"
                data-mdb-ripple-init>
                <i class="fas fa-envelope text-muted"></i><span class="text-muted">Customer Inquiries</span>
            </a>
            <a href="{{ route('category') }}"
                class="list-group-item list-group-item-action py-2 {{ request()->routeIs('category') ? 'active' : '' }}"
                data-mdb-ripple-init>
                <i class="fa-solid fa-folder-tree text-muted"></i><span class="text-muted">Product Categories</span>
            </a>
            <a href="{{ route('brand_list') }}"
                class="list-group-item list-group-item-action py-2 {{ request()->routeIs('brand_list') ? 'active' : '' }}"
                data-mdb-ripple-init>
                <i class="fa-solid fa-folder-open text-muted"></i><span class="text-muted">Product Brands</span>
            </a>
            <a href="{{ route('show_users') }}"
                class="list-group-item list-group-item-action py-2 {{ request()->routeIs('show_users') ? 'active' : '' }}"
                data-mdb-ripple-init>
                <i class="fas fa-user text-muted"></i><span class="text-muted">User Management</span>
            </a>
            <a href="{{ route('carousel') }}"
                class="list-group-item list-group-item-action py-2 {{ request()->routeIs('carousel') ? 'active' : '' }}"
                data-mdb-ripple-init>
                <i class="fas fa-slideshare text-muted"></i><span class="text-muted">Carousel Management</span>
            </a>

            <a href="{{ route('banner') }}"
                class="list-group-item list-group-item-action py-2 {{ request()->routeIs('banner') ? 'active' : '' }}"
                data-mdb-ripple-init>
                <i class="fas fa-ad text-muted"></i><span class="text-muted">Banner Management</span>
            </a>

            <a href="{{ route('logo') }}"
                class="list-group-item list-group-item-action py-2 {{ request()->routeIs('logo') ? 'active' : '' }}"
                data-mdb-ripple-init>
                <i class="fas fa-image text-muted"></i><span class="text-muted">Logo Management</span>
            </a>

            <a href="{{ route('shipping-charges.index') }}"
                class="list-group-item list-group-item-action py-2 {{ request()->routeIs('shipping-charges.index') ? 'active' : '' }}"
                data-mdb-ripple-init>
                <i class="fas fa-image text-muted"></i><span class="text-muted">Shipping Management</span>
            </a>

        </div>
    </div>
</nav>