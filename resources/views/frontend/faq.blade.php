@extends ('frontend.master')

@section('content')
    <style>
        .nav-ash {
            background-color: #f1f1f1;
            padding: 3px 0;
            border-bottom: 1px solid #e0e0e0;
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

        .content {
            padding: 15px;
        }

        h1 {
            color: #4a0082;
            font-size: 1.5rem;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .faq-item {
            margin-bottom: 20px;
        }

        .question {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .answer {
            margin-left: 20px;
            color: #444;
            position: relative;
            font-size: 0.95rem;
        }

        .answer p {
            margin: 5px 0 15px 15px;
        }

        .answer:before {
            content: "»";
            position: absolute;
            left: 0;
            color: #666;
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

            .question {
                font-size: 1.1rem;
            }

            .hamburger-menu {
                display: none;
            }
        }

        /* Navigation specific for mobile */
        .hamburger-menu {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        /* Styling for list prefixes */
        .faq-item .question {
            display: flex;
            align-items: flex-start;
        }

        .faq-item .question-number {
            margin-right: 8px;
        }

        .faq-item .question-text {
            flex: 1;
        }

        /* Answer list styles */
        .answer-list {
            list-style-type: lower-alpha;
            margin-top: 5px;
            margin-bottom: 10px;
            padding-left: 35px;
        }

        .answer-list li {
            margin-bottom: 5px;
        }

        .nav-ash {
            background-color: #f1f1f1;
            padding: 10px 0;
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
        }

        .breadcrumb-item {
            font-size: 14px;
        }

        .breadcrumb-item a {
            color: #4a0082;
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
    </style>

    <div class="nav-ash">
        <div class="site-common-con">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <h3 class="sidebar-header">FAQ</h3>
            <ul class="sidebar-menu">
                <li><a href="{{ route('buy') }}">How To Buy</a></li>
                <li><a href="#">Shipping & Delivery</a></li>
                <li><a href="#">Warranty Information</a></li>
                <li><a href="#">Return Products</a></li>
            </ul>
        </div>

        <div class="content">
            <h1>Frequently Asked Questions</h1>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">1.</span>
                    <span class="question-text">Do I need to create a user account to buy products on
                        BuyAbans.com?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>No. You can browse and purchase what you want as a guest. However, by registering as a user,
                            you
                            can make your online shopping experience even better by earning & spending customer Loyalty
                            points for special discounts, saving items to your Wish List to buy later, keeping track of
                            past
                            & current orders, and more.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">2.</span>
                    <span class="question-text">Are my online transactions safe?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>Yes. We utilize the latest in digital encryption & web technology to ensure that your
                            transactions are secure and your personal details are safe when you shop at BuyAbans.com.
                            You
                            can read our <a href="#">Privacy Policy here</a> for more details on how we keep your
                            personal details safe.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">3.</span>
                    <span class="question-text">What payment methods can I use?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>We accept Visa/MasterCard/AMEX credit & debit cards, Frimi & Dialog genie digital wallets,
                            bank
                            transfers and cash on delivery payments.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">4.</span>
                    <span class="question-text">Can I pay in installments?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>Yes. We offer Easy Payment Plans for up to 60 Months with Interest-Free Payments Plans
                            available
                            up to 48 Months for credit cardholders. You can view the available payment plans on the
                            product
                            page and select your preference during Check Out.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">5.</span>
                    <span class="question-text">How do I track/check the status of my order?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>Simply log in to your user account, go to My Orders and select the order to check the
                            status.
                        </li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">6.</span>
                    <span class="question-text">How long will it take to deliver my order?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>We can deliver your order within 4 to 5 working days anywhere in Sri Lanka.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">7.</span>
                    <span class="question-text">What is Pickup?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>If you don't want to wait for your order to be delivered to your home, you can now pick it
                            up
                            yourself from one of our Abans Elite Showrooms. Simply select Pick up at checkout and choose
                            your preferred store. When your order is ready to collect, we'll let you know.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">8.</span>
                    <span class="question-text">There is something wrong with my order. What do I do?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>You can contact our customer care hotline at +94 112 222 888, WhatsApp us at +94 772 222
                            888.
                        </li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">9.</span>
                    <span class="question-text">I received my order but there is something missing/product is
                        damaged/wrong
                        product. What should I do?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>You can contact our customer care hotline at +94 112 222 888, WhatsApp us at +94 772 222
                            888.
                        </li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">10.</span>
                    <span class="question-text">How do I get my Air-Conditioner installed?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>Our team will complete the installation within 03 working days after delivery. Installation
                            up
                            to 5 meters of piping is free. Additional charges will be informed after site inspection.
                        </li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">11.</span>
                    <span class="question-text">I need help setting up my TV/Washing Machine/Refrigerator. Who do I
                        call?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>Contact our customer care hotline at +94 112 222 888 or WhatsApp at +94 772 222 888. We will
                            send a team within 03–04 working days to help set up your device.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">12.</span>
                    <span class="question-text">My device stopped working/is faulty (within 48 hours of delivery). Who
                        do I
                        call?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>Try restarting the device. If the issue persists, contact our customer care hotline or
                            WhatsApp
                            and follow their instructions. Turn off the device while we assist you.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">13.</span>
                    <span class="question-text">The product I bought last week/month/year stopped working/is faulty. Who
                        do
                        I call?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>Contact our service center at +94 115 555 888 and follow their instructions.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">14.</span>
                    <span class="question-text">How do I get a replacement/refund?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>Log in to your user account, go to Return Requests and submit your request with issue
                            details
                            and photos. You can also call our hotline or WhatsApp.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">15.</span>
                    <span class="question-text">What is the BuyAbans.com return/refund policy?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>You can read our <a href="#">Return and Refund Policy here</a>.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">16.</span>
                    <span class="question-text">What is the Warranty I can get for a product?</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>You can check the warranty period and details on the product page.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <span class="question-number">17.</span>
                    <span class="question-text">Further Questions</span>
                </div>
                <div class="answer">
                    <ul class="answer-list">
                        <li>If you have any other questions, contact us at +94 112 222 888 or WhatsApp us at +94 772 222
                            888.</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection
