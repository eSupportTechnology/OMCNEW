@extends ('frontend.master')

@section('content')
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }

        .site-common-con {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Navigation Styles */
        .nav-ash {
            background-color: #f1f1f1;
            padding: 10px 0;
        }

        .breadcrumb {
            display: flex;
            list-style: none;
            padding: 0;
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

        /* Content Styles */
        .mt-5 {
            margin-top: 3rem;
        }

        .mt-3 {
            margin-top: 2rem;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }

        .col-12,
        .col-xl-6,
        .col-xl-12,
        .col-sm-12 {
            padding: 0 15px;
            width: 100%;
        }

        @media (min-width: 1200px) {
            .col-xl-6 {
                width: 50%;
            }
        }

        .page-title-wrap {
            color: #6a1b9a;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .text-center {
            text-align: center;
        }

        .about-sub-head {
            color: #6a1b9a;
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            line-height: 1.4;
        }

        .common-p {
            font-size: 1rem;
            margin-bottom: 1.5rem;
            color: #555;
        }

        .about-img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Fact Check Section */
        .about-img-set {
            display: flex;
            justify-content: center;
            margin: 2rem 0;
            flex-wrap: wrap;
        }

        .about-box {
            flex: 1;
            padding: 20px;
            min-width: 240px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .about-box:hover {
            transform: translateY(-10px);
        }

        .about-box img {
            max-width: 100%;
            height: auto;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        /* Responsive Adjustments */
        @media (max-width: 991px) {
            .about-img-set {
                flex-direction: column;
                align-items: center;
            }

            .about-box {
                margin-bottom: 20px;
            }
        }
    </style>

    <div class="nav-ash">
        <div class="site-common-con">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="site-common-con mt-5">
        <div class="row">
            <div class="col-12 col-xl-6">
                <h1 class="page-title-wrap">About Us</h1>
                <h3 class="about-sub-head">We, at Buyabans.com, offer you the convenience of browsing, purchasing, and
                    reserving products & services from across the Abans Group of Companies.</h3>
                <p class="common-p">Our virtual store boasts an endless array of globally recognizable brands and includes
                    only authentic products. We guarantee that our discounts are genuine, and your payments are secured. Our
                    delivery teams cover the entirety of Sri Lanka, and our friendly staff are always ready to provide you
                    after-sales support through extensive network of over a hundred Abans service centers.</p>
                <p class="common-p">Established in March 2007, Buyabans.com operates from Abans headquarters in Colombo, Sri
                    Lanka, and also serves customers purchasing from UK, Australia, USA, Italy, etc., for their loved ones
                    in Sri Lanka. Echoing our parent company Abans PLC's values of reliability, value-for-money, and honesty
                    in service, with the best online shopping experience with access to the best products at the best prices
                    to suit all your needs.</p>
            </div>
            <div class="col-12 col-xl-6">
                <img class="about-img" src="https://buyabans.com/themes/buyabans/assets/images/about-page.webp"
                    alt="Abans Building">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-xl-12">
                <h2 class="page-title-wrap text-center">Abans Fact Check</h2>
            </div>
        </div>

        <div class="about-img-set">
            <div class="about-box">
                <img class="img-fluid" src="https://buyabans.com/themes/buyabans/assets/images/diverse-sectors.webp"
                    alt="5 Diverse Sectors">
            </div>
            <div class="about-box">
                <img class="img-fluid" src="https://buyabans.com/themes/buyabans/assets/images/31.webp"
                    alt="40+ Renowned Brands">
            </div>
            <div class="about-box">
                <img class="img-fluid" src="https://buyabans.com/themes/buyabans/assets/images/32.webp" alt="400+ Showrooms"
                    style="width:80%;">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <p class="common-p text-center">We continuously strive to innovate, improving the range of products and
                    services
                    available online for our customers and we ensure that product information is as up-to-date and accurate
                    as possible. We continue to drive our efforts towards the goal of becoming the leading online platform
                    in Sri Lanka for customers to purchase products and services from anywhere in the world.</p>
            </div>

        </div>
        <br>
    </div>

    </section>
    <!-- End About Area -->
@endsection
