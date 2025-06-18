<!-- resources/views/about.blade.php -->

@extends('layouts.app')

@section('content')

<style>
    .about-section {
        background: #f9f9f9;
        padding: 50px;
        font-family: Arial, sans-serif;
    }

    .about-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .about-header h1 {
        font-size: 48px;
        color: #333;
    }

    .about-header p {
        font-size: 18px;
        color: hsl(271, 90%, 24%);
    }


    .about-content {
        display: flex;
        gap: 30px;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .about-images {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        flex: 1;
    }

    .about-images img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 8px;
    }

    .about-text {
        max-width: 50%;
        flex: 1;
    }

    .about-text h2 {
        font-size: 32px;
        color: #333;
        margin-bottom: 20px;
    }

    .about-text p {
        font-size: 16px;
        color: #555;
        line-height: 1.6;
        margin-bottom: 15px;
        text-align: justify;
        text-justify: inter-word;
        /* Ensure equal word spacing */
        word-break: break-word;
        /* Break long words to avoid big gaps */
        word-spacing: normal;
        /* Reset any extra word spacing */
        letter-spacing: normal;
        /* Set normal letter spacing */
        hyphens: auto;
        /* Allow automatic hyphenation */

    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .about-content {
            flex-direction: column;
        }

        .about-text {
            max-width: 100%;
        }

        .about-images {
            grid-template-columns: 1fr;
        }

        .about-images img {
            width: 100%;
            height: 250px;
        }

        .about-text p {
            font-size: 14px;
            word-spacing: normal;
            letter-spacing: normal;
            text-align: justify;
        }

    }

    @media (max-width: 480px) {
        .about-header h1 {
            font-size: 36px;
        }

        .about-header p {
            font-size: 16px;
        }

        .about-text h2 {
            font-size: 28px;
        }

        .about-text p {
            font-size: 14px;
            text-align: justify;
            word-spacing: normal;
            letter-spacing: normal;
        }
    }

    /* < !-- services --> */
    .services-section {
        text-align: center;
        padding: 50px;
        background-color: #f9f9f9;

    }

    .services-section h2 {
        font-size: 36px;
        color: #333;
        margin-bottom: 10px;
        text-align: center;
    }

    .services-section p {
        font-size: 16px;
        color: #777;
        margin-bottom: 40px;
        text-align: center;
    }

    .services-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        max-width: 1000px;
        margin: 0 auto;
    }

    .service-box {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .service-box:hover {
        transform: translateY(-10px);
        background-color: #f5b942;
        color: #fff;
    }


    .service-box h3 {
        font-size: 20px;
        margin-bottom: 15px;
        color: #333;
    }

    .service-box p {
        font-size: 14px;
        color: #777;
        margin-bottom: 20px;
    }

    .service-box.active h3,
    .service-box.active p {
        color: #fff;
    }



    /* Responsive */
    @media (max-width: 768px) {
        .services-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .services-container {
            grid-template-columns: 1fr;
        }
    }

    .missions {
        background: #f9f9f9;
        padding: 50px;
        font-family: Arial, sans-serif;
    }

    .mission-1 {
        display: flex;
        align-items: center;
        gap: 30px;
        justify-content: space-between;
    }

    .mission-1 img {
        width: 35%;
        height: auto;
        border-radius: 8px;
    }

    .mission {
        max-width: 50%;
    }

    .mission h2 {
        font-size: 32px;
        color: #333;
        margin-bottom: 20px;
    }

    .mission p {
        font-size: 16px;
        color: #555;
        line-height: 1.6;
        margin-bottom: 15px;
        text-align: justify;
        word-spacing: 1px;
        letter-spacing: 0.5px;
        text-justify: inter-word;
        /* Space evenly between words */
        hyphens: auto;
        /* Automatically break words to fit lines */
    }

    @media (max-width: 768px) {
        .mission-1 {
            flex-direction: column;
        }

        .mission-1 img {
            width: 100%;
        }

        .mission {
            max-width: 100%;
        }

        .mission p {
            font-size: 14px;
            word-spacing: 0.5px;
            letter-spacing: 0.4px;
            hyphens: auto;
            text-justify: inter-word;

        }

    }
</style>
<div class="about-section">
    <div class="about-header">
        <h1>About Us</h1>
        <p>A Full Service Online marketing complex</p>
        <br>

    </div>

    <div class="about-content">
        <div class="about-images">
            <img src="https://media.istockphoto.com/id/1729402032/photo/an-unrecognizable-beautiful-woman-holding-her-shopping-bags.jpg?s=612x612&w=0&k=20&c=lld45QpIxSQUrhVsZLPuSC3X08jJYU6rsHT8U4l7MS0=" alt="OMC Image 1">
            <img src="https://media.istockphoto.com/id/2161735131/photo/women-modern-fashion-clothes-and-accessories-flat-lay-female-casual-style-look-with-warm.jpg?s=612x612&w=0&k=20&c=q_XPGiEkS5zGn0sl_gz0G4PC4WM8sHhK4YFR7sy3C2A=" alt="OMC Image 2">
            <img src="https://media.istockphoto.com/id/1487766953/photo/brown-haired-young-model-wearing-autumn-spring-concept-clothes.jpg?s=612x612&w=0&k=20&c=YRqhCjrL_kCMCW-vicISP6vnrxs7Q83nMzj4R1Gpnd0=" alt="OMC Image 3">
            <img src="https://media.istockphoto.com/id/172691691/photo/shoes-and-rattle.jpg?s=612x612&w=0&k=20&c=BDFCFm_EO43aaS8nhK5qzubVdf4hwUlc0mVMN-Vs_Kg=" alt="OMC Image 4">
        </div>
        <div class="about-text">
            <h2>Discover OMC – Your Ultimate Online Shopping Destination</h2>

            <p>
                Shop effortlessly at the Online Marketing Complex (OMC)! Explore a wide selection of high-quality products, including fashion, accessories, home goods, electronics, and more. We’re committed to delivering a secure, seamless, and enjoyable shopping experience with fast shipping, personalized recommendations, and exceptional customer service.
            </p>
            <p>
                From trending styles to everyday essentials, OMC is your go-to platform for convenient online shopping, trusted by customers worldwide.
            </p>
        </div>
    </div>
</div>

<!--services -->
<br>
<div class="services-section">
    <h2>Services</h2>
    <p>The Online Marketing Complex offers a comprehensive range of services</p>

    <div class="services-container">
        <div class="service-box">
            <h3>Social Media Management</h3>
            <p> Comprehensive management of social media accounts, including content creation, scheduling, and analytics to enhance brand presence and engagement.</p>

        </div>

        <div class="service-box">
            <h3>Search Engine Optimization (SEO)</h3>
            <p>Strategies to improve website visibility and ranking on search engines, including keyword research, on-page optimization, and link-building services.</p>

        </div>

        <div class="service-box">
            <h3>Content Creation</h3>
            <p> Professional writing and multimedia services, including blog posts, articles, infographics, and videos, tailored to attract and engage target audiences.</p>

        </div>

        <div class="service-box">
            <h3>Email Marketing Campaigns</h3>
            <p>Design and execution of targeted email campaigns to nurture leads, increase customer retention, and promote products or services effectively.</p>

        </div>

        <div class="service-box">
            <h3>Branding and Identity Development</h3>
            <p>Services focused on creating and enhancing brand identity, including logo design, brand guidelines, and messaging strategies to ensure a cohesive brand image.</p>

        </div>

        <div class="service-box">
            <h3>Digital Advertising</h3>
            <p> Management of online advertising campaigns across various platforms, such as Google Ads and social media, aimed at driving traffic and conversions through targeted ads.</p>

        </div>
    </div>
</div>
<!-- mission -->
<div class="missions">
    <div class="mission-1">
        <img src="https://media.istockphoto.com/id/1283030328/photo/silhouette-of-businessman-holding-target-board-on-the-top-of-mountain-with-over-blue-sky-and.jpg?s=612x612&w=0&k=20&c=2ZifINbmOZq9dWW8iviW1k275x2zDy8w5_TBuLB5Sso=" alt="OMC Mission Image" class="image">
        <div class="mission">
            <h2>Our Mission</h2>
            <p> "At the Online Marketing Complex (OMC),our mission is to empower businesses and individuals by providing comprehensive marketing solutions that drive success in the digital world.
                We are dedicated to offering top-tier services in branding, digital media, content creation, and strategic marketing, enabling our clients to achieve their full potential.
                With a focus on innovation, creativity, and customer satisfaction, OMC strives to make online marketing accessible and effective for all, transforming ideas into impactful realities."</p>
        </div>
    </div>
</div>

@endsection
