
<style>
.dropdown-header {
    font-weight: bold;
    padding: 5px 16px;
}

.dropdown-item {
    padding: 10px 16px;
}

.dropdown-menu {
    max-height: 400px; 
    overflow-y: auto; 
}

.notification-item {
    position: relative;
    display: flex;
    align-items: center;
    cursor: pointer;
}

.notification-item:hover .close-icon {
    display: inline;
}

.close-icon {
    position: absolute;
    right: 20px;
    cursor: pointer;
    font-size: 18px;
    display: none; 
}

.three-dots {
    cursor: pointer;
    margin-left: 8px;
}

.three-dots-menu {
    display: none; 
    position: absolute;
    top: 100%; 
    left: 0; 
    z-index: 1000;
}

.dropdown-header {
    position: relative; 
}


</style>




<header>
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top p-1">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="col-md-4 d-flex mb-md-0 px-3">
                <a href="" class="d-flex align-items-center" style="text-decoration: none">
                    <div class="navbar-brand me-0 p-0">
                        <img src="/assets/images/logo.png" height="52" width="35" alt="Logo" />
                    </div>
                    <img src="/assets/images/brand_name.png" height="25" width="280" alt="brand" />
                </a>
            </div>

            <ul class="navbar-nav ms-auto d-flex align-items-center flex-row">
            <li class="nav-item dropdown me-4">
                    <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="notificationsDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <?php if($notifications['totalNotifications'] > 0): ?>
                            <span class="badge rounded-pill badge-notification bg-danger"><?php echo e($notifications['totalNotifications']); ?></span>
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown" style="width: 400px;">
                        <li>
                            <div class="dropdown-header d-flex justify-content-between align-items-center">
                                <h6 class="mt-3">Notifications</h6>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>

                        
                        <?php $__currentLoopData = $notifications['sortedNotifications']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($notification instanceof App\Models\CustomerOrder): ?> 
                                <li class="notification-item d-flex justify-content-between align-items-center" data-order-id="<?php echo e($notification->id); ?>">
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fas fa-shopping-cart me-4" style="font-size: 18px;"></i>
                                        <div>
                                            <strong>New Order</strong><br>
                                            <small>Order #<?php echo e($notification->order_code); ?> placed on <?php echo e($notification->created_at->format('Y-m-d')); ?></small>
                                        </div>
                                    </a>
                                    <i class="fas fa-times close-icon" data-order-id="<?php echo e($notification->id); ?>" style="color: red;"></i>
                                </li>
                            <?php elseif($notification instanceof App\Models\User): ?> 
                                <li class="notification-item d-flex justify-content-between align-items-center" data-user-id="<?php echo e($notification->id); ?>">
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fas fa-user-plus me-4" style="font-size: 18px;"></i>
                                        <div>
                                            <strong>New Customer Registration</strong><br>
                                            <small><?php echo e($notification->name); ?> registered on <?php echo e($notification->created_at->format('Y-m-d')); ?></small>
                                        </div>
                                    </a>
                                    <i class="fas fa-times close-icon" data-user-id="<?php echo e($notification->id); ?>" style="color: red;"></i>
                                </li>
                            <?php elseif($notification instanceof App\Models\Review): ?>  <!-- Handle new review notifications -->
                                <li class="notification-item d-flex justify-content-between align-items-center" data-review-id="<?php echo e($notification->id); ?>">
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fas fa-star me-4" style="font-size: 18px;"></i>
                                        <div>
                                            <strong>New Review</strong><br>
                                            <small><?php echo e($notification->is_anonymous ? 'Anonymous' : $notification->user->name); ?> reviewed on a product <?php echo e($notification->created_at->format('Y-m-d')); ?></small>
                                        </div>
                                    </a>
                                    <i class="fas fa-times close-icon" data-review-id="<?php echo e($notification->id); ?>" style="color: red;"></i>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>


                <span class="me-2">|</span>
                <li class="nav-item dropdown me-2 d-flex align-items-center">
                    <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                        id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="icon-circle">
                          <?php if(session('image_path')): ?>
                          <img src="<?php echo e(asset('storage/user_images/' . session('image_path'))); ?>" alt="Admin Image" class="rounded-circle" height="35" width="35">
                          <?php else: ?>
                              <i class="fas fa-user-alt"></i>
                          <?php endif; ?>
                        </div>
                        <span class="ms-2"><?php echo e(session('name', 'Admin')); ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="<?php echo e(route('admin.profile')); ?>">My profile</a></li>
                        <li>
                            <form action="<?php echo e(route('admin.logout')); ?>" method="POST" class="m-0">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notificationsDropdown = document.getElementById('notificationsDropdown');
        const notificationCountBadge = notificationsDropdown.querySelector('.badge-notification');

        // Load closed notification IDs from local storage
        const closedNotifications = JSON.parse(localStorage.getItem('closedNotifications')) || [];

        // Remove closed notifications from the DOM
        closedNotifications.forEach(id => {
            const notificationItem = document.querySelector(`li.notification-item[data-order-id="${id}"], li.notification-item[data-user-id="${id}"]`);
            if (notificationItem) {
                notificationItem.remove();
            }
        });

        // Update notification count
        let currentCount = parseInt(notificationCountBadge.innerText) || 0;
        currentCount -= closedNotifications.length; // Decrease count by the number of closed notifications
        notificationCountBadge.innerText = currentCount > 0 ? currentCount : 0;

        // Handle close icon clicks
        const closeIcons = document.querySelectorAll('.close-icon');
        closeIcons.forEach(icon => {
            icon.addEventListener('click', function (event) {
                event.stopPropagation(); // Prevent the click from propagating to parent elements
                
                // Remove the notification item from the dropdown
                const notificationItem = event.target.closest('li.notification-item');
                if (notificationItem) {
                    notificationItem.remove();
                    
                    // Get the ID of the notification to close
                    const notificationId = event.target.dataset.orderId || event.target.dataset.userId;
                    if (notificationId) {
                        // Store the closed notification ID in local storage
                        closedNotifications.push(notificationId);
                        localStorage.setItem('closedNotifications', JSON.stringify(closedNotifications));
                    }

                    // Update the notification count
                    let currentCount = parseInt(notificationCountBadge.innerText) || 0;
                    notificationCountBadge.innerText = currentCount > 0 ? currentCount - 1 : 0;
                    
                    // Hide the badge if count is zero
                    if (currentCount - 1 === 0) {
                        notificationCountBadge.style.display = 'none'; 
                    }
                }
            });
        });
    });
</script>

<?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/layouts/admin_main/navbar.blade.php ENDPATH**/ ?>