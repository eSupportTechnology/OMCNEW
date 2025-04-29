<!DOCTYPE html>
<html lang="zxx">

    <style>
        /* Custom styles */
        .carousel-item {
            background-size: cover;
            background-position: center;
            height: 650px;
            /* Adjust height as needed */
            width: 100%;
            position: relative;
        }

        /* Mobile (up to 576px) */
        @media (max-width: 576px) {
            .carousel-item {
                height: 200px;
                /* Adjust height for mobile */
            }

            .carousel {
                margin-top: 65px;
            }
        }

        /* Tablet (576px to 768px) */
        @media (min-width: 577px) and (max-width: 768px) {
            .carousel-item {
                height: 500px;
                /* Adjust height for tablets */
            }
        }



        /* Each carousel item with a different image */
        .carousel-item:nth-child(1) {
            background-image: url('frontend/newstyle/assets/images/public.jpg');
            /* Replace with your image path */
        }

        .carousel-item:nth-child(2) {
            background-image: url('frontend/newstyle/assets/images/public.jpg');
            /* Replace with your image path */
        }

        .carousel-item:nth-child(3) {
            background-image: url('frontend/newstyle/assets/images/public.jpg');
            /* Replace with your image path */
        }

        .carousel-item-next,
        .carousel-item-prev,
        .carousel-item.active {
            transition: transform 0.5s ease;
        }

        /* Optional: Ensure the carousel controls are visible */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black;
            /* For better visibility */
        }

        /* Hide the carousel control buttons */
        .carousel-control-prev,
        .carousel-control-next {
            display: none;
        }

        /* Style the dots (indicators) */
        .carousel-indicators li {
            background-color: transparent;
            width: 20px;
            height: 20px;
            border-radius: 0;
            border: 2px solid white;
            margin: 0 5px;
            /* Adds some space between dots */
        }

        .carousel-indicators .active {
            background-color: white;
            transform: scale(1.2);
        }


        .owl-carousel .owl-nav button.owl-next,
        .owl-carousel .owl-nav button.owl-prev,
        .owl-carousel button.owl-dot {
            background: 0 0;
            color: inherit;
            border: none;
            padding: 0 !important;
            font: inherit;
            font-size: 37px !important;
        }


        .product-image {
            width: 100% !important;
            height: auto !important;
            object-fit: cover !important;
        }
    </style>

    <?php echo $__env->make('frontend.navbar-new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('frontend.footer-new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </body>
<?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/frontend/master.blade.php ENDPATH**/ ?>