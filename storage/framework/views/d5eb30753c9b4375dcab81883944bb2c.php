<?php $__env->startSection('content'); ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
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
            margin: 0 auto;
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        h1 {
            color: #663399;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 10px;
            gap: 20px;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input[type="tel"] {
            width: 100%;
            max-width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .recaptcha-container {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .recaptcha {
            display: inline-flex;
            align-items: center;
            border: 1px solid #d3d3d3;
            border-radius: 3px;
            padding: 10px;
            background-color: #f9f9f9;
            max-width: 300px;
            flex-wrap: wrap;
        }

        .recaptcha input {
            margin-right: 10px;
        }

        .recaptcha-logo {
            border-left: 1px solid #d3d3d3;
            padding-left: 10px;
            margin-left: 10px;
            height: 38px;
            display: flex;
            align-items: center;
        }

        .recaptcha-logo img {
            height: 100%;
        }

        .subscribe-btn {
            background-color: #663399;
            color: white;
            border: none;
            border-radius: 3px;
            padding: 12px 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .subscribe-btn:hover {
            background-color: #5a2d87;
        }

        /* Mobile responsive styles */
        @media screen and (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 22px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .form-group {
                width: 100%;
                margin-bottom: 15px;
            }

            input[type="tel"] {
                width: 100%;
            }

            .recaptcha {
                width: 100%;
                max-width: none;
                box-sizing: border-box;
            }

            .recaptcha-logo {
                margin-top: 10px;
                margin-left: 0;
                padding-left: 0;
                border-left: none;
                border-top: 1px solid #d3d3d3;
                padding-top: 10px;
                height: auto;
                width: 100%;
                justify-content: center;
            }

            .subscribe-btn {
                width: 100%;
                padding: 12px;
            }
        }

        @media screen and (max-width: 480px) {
            h1 {
                font-size: 20px;
            }

            .breadcrumb-item {
                font-size: 12px;
            }
        }
    </style>
    <div class="nav-ash">
        <div class="site-common-con">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Newsletter Subscription</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <h1>Newsletter Subscription</h1>

        <form>
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                </div>
            </div>

            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="tel" id="mobile" name="mobile">
            </div>

            <div class="recaptcha-container">
                <div class="recaptcha">
                    <input type="checkbox" id="recaptcha" name="recaptcha">
                    <label for="recaptcha">I'm not a robot</label>
                    <div class="recaptcha-logo">
                        <img src="/api/placeholder/60/38" alt="reCAPTCHA logo">
                    </div>
                </div>
            </div>

            <button type="submit" class="subscribe-btn">Subscribe</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/frontend/Subscribe-Newsletter.blade.php ENDPATH**/ ?>