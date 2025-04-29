@extends ('frontend.master')

@section('content')
<style>
    .feature-description {
        display: none;
        text-align: justify;
        /* Hide descriptions by default */
        color: #6c757d;
        /* Bootstrap's muted text color */
    }

    .feature-title:hover {
        font-weight: 600;
    }

    .feature-item:hover .feature-description {
        display: block;
        /* font-weight: 600; */
        /* Show description on hover */
    }
</style>
<!-- Start Page Title -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>About Us</h2>
            <ul>
                <li><a href="{{route('home')}}">Home</a></li>
                <li>About Us</li>
            </ul>
        </div>

    </div>
</div>
<!-- End Page Title -->

<!-- Start About Area -->
<section class="about-area ptb-100">
    <div class="container">
        <div class="row align-items-center justify-content-center" style="margin-bottom: 4vh;">
            <div class="col-lg-6 col-md-12">
                <div class="about-image">
                    <img src="frontend/assets/img/about-img.png" class="shadow" alt="image">
                    <img src="frontend/assets/img/about-img-2.png" class="shadow" alt="image">

                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="about-content">
                    <span class="sub-title">About Us</span>
                    <h2>Discover OMC – Your Ultimate Online Shopping Destination</h2>
                    <h6>Shop smarter. Shop OMC.</h6>
                    <p>Shop effortlessly at the Online Marketing Complex (OMC)! Explore a wide selection of high-quality products, including fashion, accessories, home goods, electronics, and more. We’re committed to delivering a secure, seamless, and enjoyable shopping experience with fast shipping, personalized recommendations, and exceptional customer service.
                    </p>

                    <div class="features-text">
                        <p>From trending styles to everyday essentials, OMC is your go-to platform for convenient online shopping, trusted by customers worldwide.</p>
                    </div>
                </div>
            </div>
        </div>

       

        <div class="about-inner-area">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="about-text">
                        <h3>Our Services</h3>
                        <p>OMC offers a comprehensive range of services</p>

                        <ul class="features-list list-unstyled">
                            <li class="feature-item">
                                <div class="d-flex align-items-start">
                                    <i class="bx bx-check me-2"></i>
                                    <span class="feature-title">Social Media Management</span>
                                </div>
                                <p class="feature-description mt-2">Comprehensive management of social media accounts, including content creation, scheduling, and analytics to enhance brand presence and engagement.</p>
                            </li>
                            <li class="feature-item">
                                <div class="d-flex align-items-start">
                                    <i class="bx bx-check me-2"></i>
                                    <span class="feature-title">SEO Optimization</span>
                                </div>
                                <p class="feature-description mt-2">Strategies to improve website visibility and ranking on search engines, including keyword research, on-page optimization, and link-building services.</p>
                            </li>
                            <li class="feature-item">
                                <div class="d-flex align-items-start">
                                    <i class="bx bx-check me-2"></i>
                                    <span class="feature-title">Content Creation</span>
                                </div>
                                <p class="feature-description mt-2">Professional writing and multimedia services, including blog posts, articles, infographics, and videos, tailored to attract and engage target audiences.</p>
                            </li>
                            <li class="feature-item">
                                <div class="d-flex align-items-start">
                                    <i class="bx bx-check me-2"></i>
                                    <span class="feature-title">Email Marketing Campaigns</span>
                                </div>
                                <p class="feature-description mt-2">Design and execution of targeted email campaigns to nurture leads, increase customer retention, and promote products or services effectively.</p>
                            </li>
                            <li class="feature-item">
                                <div class="d-flex align-items-start">
                                    <i class="bx bx-check me-2"></i>
                                    <span class="feature-title">Branding and Identity Development</span>
                                </div>
                                <p class="feature-description mt-2">Services focused on creating and enhancing brand identity, including logo design, brand guidelines, and messaging strategies to ensure a cohesive brand image.</p>
                            </li>
                            <li class="feature-item">
                                <div class="d-flex align-items-start">
                                    <i class="bx bx-check me-2"></i>
                                    <span class="feature-title">Digital Advertising</span>
                                </div>
                                <p class="feature-description mt-2">Management of online advertising campaigns across various platforms, such as Google Ads and social media, aimed at driving traffic and conversions through targeted ads.</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="about-text">
                        <h3>Our Values</h3>
                        <p>The best of both worlds. Store and web.</p>

                        <ul class="features-list">
                            <li><i class='bx bx-check'></i> Always in style!</li>
                            <li><i class='bx bx-check'></i> Discover your favorite shopping</li>
                            <li><i class='bx bx-check'></i> Find yourself</li>
                            <li><i class='bx bx-check'></i> Feel-good shopping</li>
                        </ul>
                    </div>
                </div> -->

                <div class="col-lg-4 col-md-6 col-sm-6   ">
                    <div class="about-text">
                        <h3>Our Vision & Mission</h3>

                        <ul class="features-list list-unstyled">
                            <li class="feature-item">
                                <div class="d-flex align-items-start">
                                    <i class="bx bx-check me-2"></i>
                                    <span class="feature-title">Vision</span>
                                </div>
                                <p class="feature-description mt-2">"To be the global leader in innovative marketing solutions, empowering businesses and individuals to thrive in the digital age. We envision a future where online marketing is accessible, impactful, and transformative, enabling our clients to turn their ambitions into lasting success through creativity, strategy, and innovation."</p>
                            </li>
                            <li class="feature-item">
                                <div class="d-flex align-items-start">
                                    <i class="bx bx-check me-2"></i>
                                    <span class="feature-title">Mission</span>
                                </div>
                                <p class="feature-description mt-2">"At the Online Marketing Complex (OMC),our mission is to empower businesses and individuals by providing comprehensive marketing solutions that drive success in the digital world. We are dedicated to offering top-tier services in branding, digital media, content creation, and strategic marketing, enabling our clients to achieve their full potential. With a focus on innovation, creativity, and customer satisfaction, OMC strives to make online marketing accessible and effective for all, transforming ideas into impactful realities."</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End About Area -->
@endsection