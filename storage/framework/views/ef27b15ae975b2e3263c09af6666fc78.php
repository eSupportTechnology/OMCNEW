<style>
.list-group-item {
    border: none;
    padding: 5px 25px;  
    gap: 15px; 
}

#sidebarMenu {
    max-height: 100vh; 
    overflow-y: auto;  
    padding-bottom: 20px;
    font-size: 16px;
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
            <a href="<?php echo e(route('index')); ?>" class="list-group-item list-group-item-action py-2 <?php echo e(request()->routeIs('index') ? 'active' : ''); ?>" data-mdb-ripple-init aria-current="true" aria-label="Go to Home">
                <span>Dashboard</span>
            </a>

            <a href="<?php echo e(route('ad_center')); ?>" class="list-group-item list-group-item-action py-2 <?php echo e(request()->routeIs('ad_center') ? 'active' : ''); ?>" data-mdb-ripple-init aria-label="Go to Ad Center">
                <span>Ad Center</span>
            </a>
    
            <a href="<?php echo e(route('tracking_id')); ?>" class="list-group-item list-group-item-action py-2 <?php echo e(request()->routeIs('tracking_id') ? 'active' : ''); ?>" data-mdb-ripple-init aria-label="Go to Tools">
                <span>Tracking IDS</span>
            </a>
            
            <a href="<?php echo e(route('affiliate.tool')); ?>" class="list-group-item list-group-item-action py-2 <?php echo e(request()->routeIs('affiliate.tool') ? 'active' : ''); ?>" data-mdb-ripple-init aria-label="Go to Tools">
                <span>Tools</span>
            </a>

            <a href="<?php echo e(route('code_center')); ?>" class="list-group-item list-group-item-action py-2 <?php echo e(request()->routeIs('code_center') ? 'active' : ''); ?>" data-mdb-ripple-init aria-label="Go to Code Center">
                <span>Code Center</span>
            </a>

            
            

            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action py-2" data-bs-toggle="collapse" data-bs-target="#reportsSubmenu" aria-expanded="false" aria-label="Reports">
                    <span>Reports</span>
                    <i class="fas fa-chevron-down float-end mt-2" style="font-size:10px;"></i> 
                </a>
                <div class="collapse ms-3" id="reportsSubmenu">
                    <a href="<?php echo e(route('traffic_report')); ?>" class="list-group-item list-group-item-action py-2 submenu-link" data-mdb-ripple-init>
                        Traffic Report 
                    </a>
                    
                </div>
            </div>

            

            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action py-2" data-bs-toggle="collapse" data-bs-target="#paymentSubmenu" aria-expanded="false" aria-label="Payment">
                    <span>Payment</span>
                    <i class="fas fa-chevron-down float-end mt-2" style="font-size:10px;"></i> 
                </a>
                <div class="collapse ms-3" id="paymentSubmenu">
                    <a href="<?php echo e(route('withdrawals')); ?>" class="list-group-item list-group-item-action py-2 submenu-link" data-mdb-ripple-init>
                      Withdrawals
                    </a>
                    <a href="<?php echo e(route('payment_info')); ?>" class="list-group-item list-group-item-action py-2 submenu-link" data-mdb-ripple-init>
                        Payment Information
                    </a>
                    <!-- <a href="<?php echo e(route('commission_rules')); ?>" class="list-group-item list-group-item-action py-2 submenu-link" data-mdb-ripple-init>
                        Commission Rules
                    </a> -->
                    <a href="<?php echo e(route('show_affiliate_rules')); ?>" class="list-group-item list-group-item-action py-2 submenu-link" data-mdb-ripple-init>
                        Commission Rules
                    </a>
                </div>
            </div>

            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action py-2" data-bs-toggle="collapse" data-bs-target="#accountSubmenu" aria-expanded="false" aria-label="Account">
                    <span>Account</span>
                    <i class="fas fa-chevron-down float-end mt-2" style="font-size:10px;"></i> 
                </a>
                <div class="collapse ms-3" id="accountSubmenu">
                    <a href="<?php echo e(route('mywebsites_page')); ?>" class="list-group-item list-group-item-action py-2 submenu-link" data-mdb-ripple-init>
                      My Websites
                    </a>
                    
                </div>
            </div>
        </div>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\OMCNEW\resources\views/layouts/affiliate_main/sidebar.blade.php ENDPATH**/ ?>