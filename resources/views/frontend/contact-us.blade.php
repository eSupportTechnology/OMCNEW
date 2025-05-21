@extends ('frontend.master')

@section('content')
    <main class="content-container">




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
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="title color-purple mt-3 mb-3">Contact Us</h3>
                </div>
            </div>

            <!-- left contact data for mobile begin-->
            <div class="accordion accordion-flush acc-contact acc-contact-res-mobi" id="accordion-contact">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#BuyAbansHotline" aria-expanded="false" aria-controls="BuyAbansHotline">
                            OMC Hotline
                        </button>
                    </h2>
                    <div id="BuyAbansHotline" class="accordion-collapse collapse show" aria-labelledby="BuyAbansHotline"
                        data-bs-parent="#accordion-contact">
                        <div class="accordion-body">
                            <p class="contact-txt"><i class="fa-solid fa-phone"></i>+94 75 833 7141</p>
                            <p class="contact-txt"><i class="fa-solid fa-envelope"></i><a
                                    href="cdn-cgi/l/email-protection.html" class="__cf_email__"
                                    data-cfemail="b0d9ded6dff0d2c5c9d1d2d1dec39ed3dfdd">[email&#160;protected]</a></p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#AbansDutyFree" aria-expanded="false" aria-controls="AbansDutyFree">
                            OMC Duty Free
                        </button>
                    </h2>
                    <div id="AbansDutyFree" class="accordion-collapse collapse" aria-labelledby="AbansDutyFree"
                        data-bs-parent="#accordion-contact">
                        <div class="accordion-body">
                            <p class="contact-txt"><i class="fa-solid fa-phone"></i>+94 75 833 7141</p>
                            <p class="contact-txt"><i class="fa-solid fa-phone transparent"></i>+94 75 833 7141</p>
                        </div>
                    </div>
                </div>


                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#Headoffice" aria-expanded="false" aria-controls="Headoffice">
                            Contact Our Headoffice
                        </button>
                    </h2>
                    <div id="Headoffice" class="accordion-collapse collapse" aria-labelledby="Headoffice"
                        data-bs-parent="#accordion-contact">
                        <div class="accordion-body">
                            <p class="contact-txt"><i class="fa-solid fa-phone"></i>+94 75 833 7141</p>
                            <p class="contact-txt"><i class="fa-solid fa-phone transparent"></i>+94 75 833 7141</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#Serviceinquiries" aria-expanded="false" aria-controls="Serviceinquiries">
                            Service inquiries
                        </button>
                    </h2>
                    <div id="Serviceinquiries" class="accordion-collapse collapse" aria-labelledby="Serviceinquiries"
                        data-bs-parent="#accordion-contact">
                        <div class="accordion-body">
                            <p class="contact-txt"><i class="fa-solid fa-phone"></i>+94 75 833 7141</p>
                            <p class="contact-txt"><i class="fa-solid fa-phone transparent"></i>+94 75 833 7141</p>
                        </div>
                    </div>
                </div>


            </div>
            <!-- left contact data for mobile end-->

            <!-- left contact data for destop begin-->
            <div class="row">
                <div class="col-xl-4 acc-contact-res-des">
                    <div class="white-box-contact-info">
                        <div class="contact-info">
                            <div class="main-contact-info">
                                <p class="contact-title">OMC Hotline</p>
                                <p class="contact-txt"><i class="fa-solid fa-phone"></i>+94 112 222 888</p>

                            </div>
                        </div>

                        <div class="contact-info">
                            <div class="main-contact-info">
                                <p class="contact-title">Abans Duty Free</p>
                                <p class="contact-txt"><i class="fa-solid fa-phone"></i>+94 75 833 7141</p>
                                <p class="contact-txt"><i class="fa-solid fa-phone transparent"></i>+94 75 833 7141</p>
                            </div>
                        </div>

                        <div class="contact-info">
                            <div class="main-contact-info">
                                <p class="contact-title">Contact Our Headoffice</p>
                                <p class="contact-txt mb-0"><i class="fa-solid fa-location-dot"></i>No 425/2, Parakum Place, Kaduruwela, Polannaruwa.</p>
                                <p class="contact-txt"><i class="fa-solid fa-location-dot transparent"></i>Sri Lanka.</p>
                                <p class="contact-txt"><i class="fa-solid fa-phone"></i>+94 115 775 000</p>
                                <p class="contact-txt"><i class="fa-solid fa-envelope"></i>www.myomc.lk</p>

                            </div>
                        </div>

                        <div class="contact-info">
                            <div class="main-contact-info">
                                <p class="contact-title">Service inquiries</p>
                                <p class="contact-txt"><i class="fa-solid fa-phone"></i> +94 112 222 888</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-8">

                    <div class="contact-map">


                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31613.237266021137!2d81.045318!3d7.93109!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3afb45b9b663e885%3A0x401c82be0e935ded!2sOnline%20Marketing%20Complex!5e0!3m2!1sen!2slk!4v1747806887113!5m2!1sen!2slk"
                            width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>

                        {{-- <a class="find-loc-link" id="redirectButton"><img
                                class="icon "src="themes/buyabans/assets/images/icon/shop_icon.svg">Find your
                            store in your location <img class="arrow"
                                src="themes/buyabans/assets/images/icon/arrow5.webp"></a> --}}
                    </div>

                    <!-- Inquiry Form -->
                    <div class="contact-form">
                        <h3 class="form-title">Service inquiries</h3>
                        <form novalidate="" id="contactform" action="{{ route('contactus') }}" method="POST">
                            @csrf
                            {{-- <div class="form-group">
                                <label class="form-label">Inquiry Type<span class="required">*</span></label>
                                <select class="form-control">
                                    <option value="Feedback">Feedback</option>
                                    <option value="Complaint">Complaint</option>
                                    <option value="Question">Question</option>
                                </select>
                            </div> --}}

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

                            <button type="submit" class="submit-button btn btn-site-default btn-inq">Submit
                                Inquiry</button>
                        </form>
                    </div>

                </div>
            </div>
            <!-- left contact data for mobile end-->
        </div>



    </main>

    <br>
@endsection
