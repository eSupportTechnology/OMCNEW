<?php $__env->startSection('content'); ?>

<style>
    .card {
        margin-bottom: 20px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .order-cards-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }


    .icon-container {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 55px; 
    height: 55px; 
    border-radius: 50%; 
    background-color: white; 
    margin: auto; 
}
.icon {
    width: 20px; 
    text-align: center; 
    display: inline-block;
}
.promotion-methods {
    list-style-type: none; 
    padding: 0; 
    margin: 0; 
    display: flex; 
    flex-wrap: wrap;
}

.promotion-methods li {
    margin-right: 15px; 
    padding: 5px;
    background-color: #f1f1f1; 
    border-radius: 4px; 
}

.social-button {
    display: inline-flex;           
    justify-content: center;      
    align-items: center;          
    width: 40px;                  
    height: 40px;                  
    border-radius: 50%;           
    margin: 0 5px;               
    color: white;                  
    font-size: 18px;              
    text-decoration: none;        
    transition: background-color 0.3s; 
}

.instagram-icon {
    background-color: #E1306C; 
}

.facebook-icon {
    background-color: #4267B2; 
}

.tiktok-icon {
    background-color: black;
}

.youtube-icon {
    background-color: #FF0000;
}

.website-icon {
    background-color: #007bff;
}

.whatsapp-icon {
    background-color: #25D366;
}


.social-button:hover {
    opacity: 0.8; 
}



</style>  

<main style="margin-top: 58px">
    <div class="container px-5 py-5">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mb-1">Affiliate Customer Details</h3>
        </div>

        <div class="order-cards-row mt-2 d-flex">
            <div class="card" style="width: 35%; margin-right: 2%;">
                <div class="card-title">Profile</div>
                <div class="card-body p-2">
                    <div class="text-center">
                        <div class="profile-image mb-3">
                            <img src="<?php echo e(asset('assets/images/default-user.png')); ?>" 
                                alt="Profile Image" class="rounded-circle" width="100" height="100" style="object-fit: cover;">
                        </div>
                        <p class="mb-1 text-muted">USER ID: #<?php echo e(str_pad($aff_customer->id, 4, '0', STR_PAD_LEFT)); ?></p>
                        <h5 class="mb-2"><?php echo e($aff_customer->name); ?></h5>
                    </div>

                    <div class="text-start ps-3 mt-4">
                        <p class="mb-1"><i class="fa fa-envelope me-3"></i><?php echo e($aff_customer->email); ?></p>
                        <p class="mb-1"><i class="fa-solid fa-phone me-3"></i><?php echo e($aff_customer->contactno); ?></p>
                        <p class="mb-1"><i class="fa fa-birthday-cake me-3"></i><?php echo e($aff_customer->DOB->format('Y-m-d')); ?></p>
                        <p class="mb-1"><i class="fa-solid fa-address-book me-3"></i><?php echo e($aff_customer->address); ?></p>
                    </div>
                </div>
            </div>

            <!-- Increased width of the Other Details card -->
            <div class="d-flex flex-wrap" style="width: 62%; height: auto;">
                <div class="card item-details-card" style="width: 100%;">
                    <div class="card-body">
                        <h5>Other Details</h5>
                        <div class="ps-3 mt-4">
                            <p class="mb-1">
                                <i class="fa fa-bank icon me-3"></i>
                                <span>Bank Name: <?php echo e($aff_customer->bank_name); ?></span>
                            </p>
                            <p class="mb-1">
                                <i class="fa fa-building icon me-3"></i>
                                <span>Branch: <?php echo e($aff_customer->branch); ?></span>
                            </p>
                            <p class="mb-1">
                                <i class="fa fa-user icon me-3"></i>
                                <span>Account Name: <?php echo e($aff_customer->account_name); ?></span>
                            </p>
                            <p class="mb-1">
                                <i class="fa fa-credit-card icon me-3"></i>
                                <span>Account Number: <?php echo e($aff_customer->account_number); ?></span>
                            </p>
                        </div>

                        <div class="text-start ps-3 mt-4">
                            <h6>Promotion Methods</h6>
                            <?php if(!empty($aff_customer->promotion_method) && is_array($aff_customer->promotion_method)): ?>
                                <ul class="promotion-methods">
                                    <?php $__currentLoopData = $aff_customer->promotion_method; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="mt-1"><?php echo e($method); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php else: ?>
                                <p>No promotion methods available.</p>
                            <?php endif; ?>
                        </div>

                        <div class="text-start ps-3 mt-4">
                            <h6>Social Media Links</h6>
                            <?php
                                $linksAvailable = false; 
                            ?>

                            <?php if(!empty($aff_customer->instagram_url)): ?>
                                <a href="<?php echo e($aff_customer->instagram_url); ?>" target="_blank" class="social-button instagram-icon">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <?php $linksAvailable = true; ?>
                            <?php endif; ?>

                            <?php if(!empty($aff_customer->facebook_url)): ?>
                                <a href="<?php echo e($aff_customer->facebook_url); ?>" target="_blank" class="social-button facebook-icon">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <?php $linksAvailable = true; ?>
                            <?php endif; ?>

                            <?php if(!empty($aff_customer->tiktok_url)): ?>
                                <a href="<?php echo e($aff_customer->tiktok_url); ?>" target="_blank" class="social-button tiktok-icon">
                                    <i class="fab fa-tiktok"></i>
                                </a>
                                <?php $linksAvailable = true; ?>
                            <?php endif; ?>

                            <?php if(!empty($aff_customer->youtube_url)): ?>
                                <a href="<?php echo e($aff_customer->youtube_url); ?>" target="_blank" class="social-button youtube-icon">
                                    <i class="fab fa-youtube"></i>
                                </a>
                                <?php $linksAvailable = true; ?>
                            <?php endif; ?>

                            <?php if(!empty($aff_customer->content_website_url)): ?>
                                <a href="<?php echo e($aff_customer->content_website_url); ?>" target="_blank" class="social-button website-icon">
                                    <i class="fa fa-globe"></i>
                                </a>
                                <?php $linksAvailable = true; ?>
                            <?php endif; ?>

                            <?php if(!empty($aff_customer->content_whatsapp_url)): ?>
                                <a href="<?php echo e($aff_customer->content_whatsapp_url); ?>" target="_blank" class="social-button whatsapp-icon">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <?php $linksAvailable = true; ?>
                            <?php endif; ?>

                            <?php if(!$linksAvailable): ?>
                                <p>No social media links available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_main.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\OMCNEW\resources\views/admin_dashboard/aff_customer-details.blade.php ENDPATH**/ ?>