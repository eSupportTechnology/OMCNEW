<?php $__env->startSection('dashboard-content'); ?>
<style>
    h4.py-2.px-2 {
        margin-bottom: 20px; /* Adjust the value to increase or decrease the space */
    }

    .dashboard-header {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #e0e0e0;
    }

    .profile-info {
        margin-left: 20px;
    }

    .profile-info h4 {
        margin: 0;
        font-size: 18px;
        font-weight: bold;
    }

    .profile-info p {
        margin: 0;
        font-size: 14px;
        color: #888;
    }

    .orders-section {
        margin-top: 30px;
        padding: 20px;
        border-bottom: 1px solid #e0e0e0;
        margin-bottom: 20px;
    }

    .orders-row {
        display: flex;
        justify-content: space-around; /* Adjusts space evenly between items */
        padding: 10px 0;
    }

    .orders-box {
        display: flex;
        flex-direction: column; /* Stack image and text vertically */
        align-items: center; /* Center align items */
        justify-content: center;
        text-align: center;
        width: 100px;
        padding: 10px;
    }

    .orders-box img {
        width: 40px;
        height: 40px;
        margin-bottom: 5px; /* Space between image and text */
    }

    .orders-box p {
        margin: 0; /* Reset margin for better alignment */
        font-size: 12px;
        white-space: nowrap;
    }

    .faq-section {
    width: 80%;
    max-width: 800px;
    margin: 0 auto;
}


.faq-item {
    margin-bottom: 10px;
}

.faq-question {
    width: 100%;
    padding: 15px;
    font-size: 16px;
    text-align: left;
    background-color:white;
    border: none;
    outline: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.faq-question:hover {
    background-color: #ddd;
}

.faq-answer {
    display: none;
    padding: 15px;
    border: 1px solid #ddd;
    border-top: none;
    background-color: #f9f9f9;
}

.faq-answer p {
    margin: 0;
}
</style>




<div class="dashboard-header" style="display: flex; align-items: center; background-color: #f8f9fa; padding: 20px; border-radius: 10px;">
    <?php if(isset($user)): ?>
        <img src="<?php echo e($user->profile_image_url); ?>" alt="Profile Picture" style="width: 70px; height: auto; border-radius: 50%; object-fit: cover; margin-right: 20px;">
        <span style="font-size: 20px; font-weight: bold; color: #343a40;"><?php echo e($user->name); ?></span>
    <?php else: ?>
        <p style="color: #dc3545;">No user details available.</p>
    <?php endif; ?>
</div>

<!-- My Orders Section -->
<div class="orders-section" style="margin-top: 20px; padding: 20px; background-color: #ffffff; border-radius: 10px;">
    <h5 style="color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 10px;">My Orders</h5>
    <div class="orders-row">
        <div class="orders-box">
            <img src="https://icons.veryicon.com/png/128/miscellaneous/document-format/reviewed-5.png" alt="Confirmed">
            <p>Confirmed</p>
        </div>
        <div class="orders-box">
            <img src="https://icons.veryicon.com/png/128/miscellaneous/cb/to-be-shipped-25.png" alt="To be shipped">
            <p>To be shipped</p>
        </div>
        <div class="orders-box">
            <img src="https://icons.veryicon.com/png/128/miscellaneous/bigmk_app_icon/in-transit.png" alt="Shipped">
            <p>Shipped</p>
        </div>
        <div class="orders-box">
            <a href="<?php echo e(route('myreviews')); ?>" class="text-decoration-none text-black">
                <img src="https://icons.veryicon.com/png/o/application/collaborative-software-foundation-icon/comment-235.png" alt="To be reviewed">
                <p>To be reviewed</p>
            </a>
        </div>
    </div>
</div>



<div class="dashboard-container" style="display: flex; justify-content: space-between; margin-top: 15px;">
    <!-- Recent Activity Section -->
    <div class="activity-section" style="flex: 1; margin-right: 10px; padding: 20px; background-color: #ffffff; border-radius: 10px;">
        <h5 style="color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 10px;">Recent Activities</h5>
        <ul>
            <?php if(!empty($activities)): ?>
                <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo $activity; ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <li style="color: #dc3545;">No recent activities.</li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Notifications Section -->
    <div class="notifications-section" style="flex: 1; margin-left: 10px; padding: 20px; background-color: #ffffff; border-radius: 10px;">
        <h5 style="color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 10px;">Notifications</h5>
        <ul>
            <?php if(!empty($notifications)): ?>
                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo $notification; ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <li style="color: #dc3545;">No new notifications.</li>
            <?php endif; ?>
        </ul>
    </div>
</div>





<script>
    document.addEventListener('DOMContentLoaded', function () {
    var faqQuestions = document.querySelectorAll('.faq-question');

    faqQuestions.forEach(function (question) {
        question.addEventListener('click', function () {
            var answer = this.nextElementSibling;

            // Hide all other answers
            var allAnswers = document.querySelectorAll('.faq-answer');
            allAnswers.forEach(function (item) {
                if (item !== answer) {
                    item.style.display = 'none';
                }
            });

            // Toggle the answer of the clicked question
            if (answer.style.display === 'block') {
                answer.style.display = 'none';
            } else {
                answer.style.display = 'block';
            }
        });
    });
});

</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('member_dashboard.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\chint\OneDrive\Documents\GitHub\online-marketing\resources\views/member_dashboard/dashboard.blade.php ENDPATH**/ ?>