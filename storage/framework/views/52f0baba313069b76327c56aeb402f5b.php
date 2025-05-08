<?php $__env->startSection('content'); ?>
    <style>
        .sidebar {
            width: 225px;
            padding-top: 50px;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            border: 1px solid #ddd;
        }

        .sidebar-nav li {
            border-bottom: 1px solid #ddd;
        }

        .sidebar-nav li:last-child {
            border-bottom: none;
        }

        .sidebar-nav li a {
            display: block;
            padding: 12px 15px;
            text-decoration: none;
            color: #333;
            background-color: #fff;
        }

        .sidebar-nav li.active {
            background-color: #736382;
        }

        .sidebar-nav li.active a {
            color: #fff;
            background-color: #736382;
        }

        .content {
            flex-grow: 1;
            padding: 20px 30px;
        }

        .title-terms {
            color: #5a2382;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .order-title {
            font-size: 16px;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 8px;
            margin-top: 25px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .row {
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .col-sm-6 {
            width: 48%;
            float: left;
            margin-right: 2%;
        }

        .col-sm-12 {
            width: 100%;
            clear: both;
            padding-top: 10px;
        }

        .fs-14 {
            font-size: 14px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        .req {
            color: #dc3545;
        }

        .req::after {
            content: "*";
            color: #dc3545;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type="checkbox"] {
            margin-right: 8px;
            vertical-align: middle;
        }

        .checkbox-inline {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-inline label {
            margin: 0;
        }

        a {
            color: #5a2382;
            text-decoration: none;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #5a2382;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        .btn-site-default {
            background-color: #5a2382;
        }

        .btn-inq {
            min-width: 120px;
        }

        .row::after {
            content: "";
            display: table;
            clear: both;
        }

        @media (max-width: 768px) {
            .col-sm-6 {
                width: 100%;
                margin-right: 0;
            }

            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .content {
                padding: 20px 15px;
            }
        }
    </style>

    <div class="container" style="display: flex; gap: 30px; margin-top: 20px;">

        <div class="sidebar">
            <ul class="sidebar-nav">
                <li><a href="#">FAQ</a></li>
                <li><a href="#">How To Buy</a></li>
                <li><a href="#">Shipping & Delivery</a></li>
                <li><a href="#">Warranty Information</a></li>
                <li class="active"><a href="#">Return Products</a></li>
            </ul>
        </div>

        <div class="content">
            <h3 class="title-terms">Return Products Request</h3>
            <p class="order-title">Order Information</p>

            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="fs-14">Order ID <span class="req"></span></label>
                    <input type="text" name="orderid" id="orderid" required="required" class="form-control" />
                </div>
                <div class="form-group col-sm-6">
                    <label class="fs-14">Billing Last Name <span class="req"></span></label>
                    <input type="text" name="lastname" id="lastname" required="required" class="form-control" />
                </div>
                <div class="form-group col-sm-6">
                    <label class="fs-14">Find Order By <span class="req"></span></label>
                    <input type="text" name="orderby" id="orderby" required="required" class="form-control" />
                </div>
                <div class="form-group col-sm-6">
                    <label class="fs-14">Email <span class="req"></span></label>
                    <input type="email" name="email" id="email" required="required" class="form-control" />
                </div>
                <div class="form-group col-sm-12">
                    <div class="checkbox-inline">
                        <input id="t_and_c_agree" type="checkbox" name="t_and_c_agree" required />
                        <label for="t_and_c_agree" class="fs-14">
                            I agree to <a href="#" target="_blank">Terms & Conditions</a>
                        </label>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <button class="btn btn-site-default btn-inq">Submit Inquiry</button>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/frontend/ReturnProduct.blade.php ENDPATH**/ ?>