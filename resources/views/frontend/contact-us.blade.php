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
            border-bottom: 1px solid #e0e0e0;
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

        /* Layout Styles */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }

        .col-sm-12,
        .col-xl-4,
        .col-xl-8 {
            padding: 0 15px;
            width: 100%;
        }

        @media (min-width: 1200px) {
            .col-xl-4 {
                width: 33.333333%;
                height: 100%;
                display: flex;
                flex-direction: column;
            }

            .col-xl-8 {
                width: 66.666667%;
            }

            .col-xl-6 {
                width: 50%;
            }

            .contact-wrapper {
                display: flex;
                min-height: 700px;
            }

            .contact-inner {
                display: flex;
                flex-direction: column;
                flex-grow: 1;
            }

            .contact-sections-container {
                flex-grow: 1;
                display: flex;
                flex-direction: column;
            }

            .flex-grow {
                flex-grow: 1;
            }
        }

        /* Heading Styles */
        .contact-us-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 1.5rem 0;
            color: #6a1b9a;
        }

        .mt-3 {
            margin-top: 1.5rem;
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }

        /* Contact Info Box Styles */
        .contact-section {
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .contact-header {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .contact-details {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .contact-details i {
            width: 20px;
            margin-right: 10px;
            color: #6a1b9a;
        }

        .contact-details a {
            color: #555;
            text-decoration: none;
        }

        .divider {
            height: 1px;
            background-color: #eee;
            margin: 15px 0;
        }

        /* Map Styles */
        .map-container {
            border-radius: 4px;
            overflow: hidden;
            position: relative;
            margin-bottom: 20px;
        }

        .google-map {
            width: 100%;
            height: 350px;
            border: none;
        }

        .location-button {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background-color: #6a1b9a;
            color: white;
            display: flex;
            align-items: center;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }

        .location-button img {
            margin-right: 8px;
            height: 16px;
        }

        .location-button .arrow {
            margin-left: 8px;
            height: 14px;
        }

        /* Form Styles */
        .inquiry-form {
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .form-title {
            color: #6a1b9a;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #666;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            height: auto;
        }

        select.form-control {
            height: 42px;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23888' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px;
            padding-right: 30px;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .required::after {
            content: "*";
            color: #6a1b9a;
            margin-left: 2px;
        }

        .recaptcha-container {
            margin-bottom: 15px;
        }

        .submit-button {
            background-color: #6a1b9a;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            width: 100%;
            text-align: center;
        }

        /* Responsive Adjustments */
        @media (max-width: 767px) {
            .contact-us-title {
                font-size: 1.5rem;
            }

            .location-button {
                position: static;
                margin-top: 10px;
                width: 100%;
                justify-content: center;
            }

            .form-control {
                height: 40px;
            }

            .form-title {
                margin-bottom: 15px;
            }

            .inquiry-form {
                padding: 15px;
                box-shadow: none;
                border-radius: 0;
            }

            .recaptcha-container {
                margin: 10px 0 20px;
            }

            textarea.form-control {
                min-height: 100px;
            }

            .submit-button {
                width: 100%;
                padding: 12px 0;
                font-weight: 600;
                border-radius: 4px;
            }

            /* Full width for all columns on mobile */
            .col-xl-6 {
                width: 100%;
            }
        }
    </style>
    <!-- Add Font Awesome for icons -->
    </head>

    <body>
        <div class="nav-ash">
            <div class="site-common-con">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="site-common-con">
            <h1 class="contact-us-title">Contact Us</h1>

            <div class="row contact-wrapper">
                <div class="col-xl-4">
                    <div class="contact-inner">
                        <div class="contact-sections-container">
                            <!-- BuyAbans Hotline -->
                            <div class="contact-section">
                                <h3 class="contact-header">BuyAbans Hotline</h3>
                                <p class="contact-details">
                                    <i class="fa-solid fa-phone"></i>
                                    <span>+94 112 222 888</span>
                                </p>
                            </div>

                            <!-- Abans Duty Free -->
                            <div class="contact-section">
                                <h3 class="contact-header">Abans Duty Free</h3>
                                <p class="contact-details">
                                    <i class="fa-solid fa-phone"></i>
                                    <span>+94 112 252 156</span>
                                </p>
                                <p class="contact-details">
                                    <i class="fa-solid fa-phone" style="opacity: 0;"></i>
                                    <span>+94 112 263 300</span>
                                </p>
                            </div>

                            <!-- Contact Our Headoffice -->
                            <div class="contact-section">
                                <h3 class="contact-header">Contact Our Headoffice</h3>
                                <p class="contact-details">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>No 498 Galle Road, Colombo 03,</span>
                                </p>
                                <p class="contact-details">
                                    <i class="fa-solid fa-location-dot" style="opacity: 0;"></i>
                                    <span>Sri Lanka.</span>
                                </p>
                                <p class="contact-details">
                                    <i class="fa-solid fa-phone"></i>
                                    <span>+94 115 775 000</span>
                                </p>
                                <p class="contact-details">
                                    <i class="fa-solid fa-globe"></i>
                                    <a href="http://www.abansgroup.com">www.abansgroup.com</a>
                                </p>
                            </div>

                            <!-- Service inquiries -->
                            <div class="contact-section flex-grow">
                                <h3 class="contact-header">Service inquiries</h3>
                                <p class="contact-details">
                                    <i class="fa-solid fa-phone"></i>
                                    <span>+94 112 222 888</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <!-- Map -->
                    <div class="map-container">
                        <iframe class="google-map"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.8910420259135!2d79.8494583744827!3d6.9036315186303145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25960aaa01ca3%3A0xe908476a81db02de!2sAbans%20Elite%20-%20Colombo%2003%20(Main%20Showroom)!5e0!3m2!1sen!2slk!4v1703064492054!5m2!1sen!2slk"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                        <a href="#" class="location-button">
                            <img src="themes/buyabans/assets/images/icon/shop.png" alt="Shop icon">
                            Find your store in your location
                            <img class="arrow" src="themes/buyabans/assets/images/icon/arrow5.webp" alt="Arrow">
                        </a>
                    </div>

                    <!-- Inquiry Form -->
                    <div class="inquiry-form">
                        <h3 class="form-title">Service inquiries</h3>
                        <form novalidate="" id="contactform" action="{{ route('contactus') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Inquiry Type<span class="required">*</span></label>
                                <select class="form-control">
                                    <option value="Feedback">Feedback</option>
                                    <option value="Complaint">Complaint</option>
                                    <option value="Question">Question</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Name<span class="required">*</span></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email<span class="required">*</span></label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Message<span class="required">*</span></label>
                                <textarea class="form-control" name="message" required></textarea>
                            </div>

                            {{-- <div class="recaptcha-container">
                                <div class="g-recaptcha-wrapper">
                                    <input type="checkbox" id="robot-check">
                                    <label for="robot-check" style="font-size: 13px; margin-left: 5px;">I'm not a
                                        robot</label>
                                    <img src="https://cdnjs.cloudflare.com/ajax/libs/recaptcha/1.0/recaptcha.min.js"
                                        alt="reCAPTCHA" style="height: 40px; margin-left: 5px;">
                                </div>
                            </div> --}}

                            <button type="submit" class="submit-button">Submit Inquiry</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
