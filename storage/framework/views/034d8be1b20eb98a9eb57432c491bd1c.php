<?php $__env->startSection('content'); ?>
    <style>
        /* body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #fff;
                    color: #333;
                    line-height: 1.5;
                } */

        /* .header {
                    background-color: #fff;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                    padding: 10px;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                } */

        .logo {
            color: #e91e63;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .logo img {
            height: 30px;
        }

        .currency-selector {
            font-size: 14px;
            color: #666;
        }

        .nav-ash {
            background-color: #f1f1f1;
            padding: 3px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .site-common-con {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .breadcrumb {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item {
            font-size: 14px;
        }

        .breadcrumb-item a {
            color: #6a1b9a;
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: #777;
        }

        .breadcrumb-item+.breadcrumb-item:before {
            content: "/";
            padding: 0 8px;
            color: #777;
        }

        .container {
            max-width: 100%;
            padding: 0;
        }

        .sidebar {
            width: 100%;
            margin-right: 0;
            margin-bottom: 20px;
        }

        .sidebar-header {
            background-color: #6b5b7b;
            color: white;
            padding: 15px;
            margin: 0;
            text-align: center;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            border-bottom: 1px solid #eee;
            border-left: 1px solid #eee;
            border-right: 1px solid #eee;
        }

        .sidebar-menu li a {
            display: block;
            padding: 15px;
            text-decoration: none;
            color: #333;
        }

        .sidebar-menu li.active a {
            color: #4a0082;
            font-weight: bold;
        }

        .sidebar-menu li a:hover:not(.active) {
            background-color: #f9f9f9;
        }

        .content {
            padding: 15px;
        }

        h1 {
            color: #4a0082;
            font-size: 1.5rem;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .phone {
            color: #4a0082;
            font-weight: bold;
        }

        .highlight {
            font-weight: bold;
            color: #4a0082;
        }

        a {
            color: #4a0082;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Mobile responsive styles */
        @media (min-width: 768px) {
            .container {
                display: flex;
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }

            .sidebar {
                width: 250px;
                margin-right: 30px;
                margin-bottom: 0;
            }

            .content {
                flex: 1;
                padding: 0;
            }

            h1 {
                font-size: 1.8rem;
            }
        }

        /* Steps specific styles */
        .steps {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .steps li {
            margin-bottom: 15px;
            padding-left: 20px;
            position: relative;
        }

        .steps li:before {
            content: attr(data-step) ".";
            position: absolute;
            left: 0;
            font-weight: bold;
        }
    </style>
    <div class="nav-ash">
        <div class="site-common-con">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">How To Buy</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <h3 class="sidebar-header">FAQ</h3>
            <ul class="sidebar-menu">
                <li class="active"><a href="<?php echo e(route('buy')); ?>">How To Buy</a></li>
                <li><a href="shipping-delivery.html">Shipping & Delivery</a></li>
                <li><a href="warranty-information.html">Warranty Information</a></li>
                <li><a href="return-products.html">Return Products</a></li>
            </ul>
        </div>

        <div class="content">
            <h1>How To Buy</h1>
            <ol class="steps">
                <li data-step="1">You can browse by category, brand, or simply type what you're looking for into the search
                    bar.</li>
                <li data-step="2">Select Buy Now to purchase an item immediately or Add to Cart and continue shopping.</li>
                <li data-step="3">When you're ready to check out, click View Cart, edit your order, apply Promo Codes, and
                    choose your preferred delivery method. Select Home Delivery to have your order delivered to your home
                    address by our professional courier service or select Click & Collect to pick it up from an Abans Elite
                    showroom of your choice.</li>
                <li data-step="4">Login to automatically fill in your saved personal & delivery information or Continue as
                    Guest and add your details manually.</li>
                <li data-step="5">Choose your preferred Payment Method, fill in the requested payment details and make your
                    payment using our secure payment gateway.</li>
                <li data-step="6">After the payment is made, you will receive an order confirmation via SMS and/or Email.
                </li>
                <li data-step="7">After the order is confirmed, you can check the Order Status from Track Your Order. You
                    will also be notified when your order is ready for Delivery or Pickup for Click & Collect orders.</li>
            </ol>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/frontend/how-to-buy.blade.php ENDPATH**/ ?>