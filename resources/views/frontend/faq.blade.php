@extends ('frontend.master')

@section('content')

         <!-- Start Page Title -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>Frequently Asked Question</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li>FAQ's</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- Start FAQ Area -->
        <section class="faq-area ptb-100">
            <div class="container">
                <div class="tab faq-accordion-tab">
                    <ul class="tabs d-flex flex-wrap justify-content-center">
                        <li><a href="#"><i class='bx bx-flag'></i> <span>Getting Started</span></a></li>
                        
                        <li><a href="#"><i class='bx bxs-badge-dollar'></i> <span>Pricing & Plans</span></a></li>

                        <li><a href="#"><i class='bx bx-shopping-bag'></i> <span>Sales Question</span></a></li>

                        <li><a href="#"><i class='bx bx-book-open'></i> <span>Usage Guides</span></a></li>

                        <li><a href="#"><i class='bx bx-info-circle'></i> <span>General Guide</span></a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tabs-item">
                            <div class="faq-accordion">
                                <ul class="accordion">
                                    <li class="accordion-item">
                                        <a class="accordion-title active" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What shipping methods are available?
                                        </a>
        
                                        <div class="accordion-content show">
                                            <p>Shipping times and costs depend on the shipping method and location. Standard shipping typically takes 5-7 business days, while express shipping takes 2-3 days. For same-day delivery, it's available in select areas for orders placed before 12 PM. Shipping costs are calculated at checkout, with free standard shipping on orders over LKR 5,000. Additional fees apply for express and international shipping.
                                            </p>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What are shipping times and costs?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>We offer several shipping methods to ensure your order arrives as quickly and securely as possible. Our available shipping options include:
                                            Standard Shipping – Delivered within 5-7 business days.
                                            Express Shipping – Delivered within 2-3 business days.
                                            Same-Day Delivery – Available in select areas for orders placed before 12 PM.
                                            International Shipping – We also offer international shipping to select countries, with delivery times varying based on location.
                                            </p>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What payment methods can I use?
                                        </a>
        
                                        <div class="accordion-content">
                                            <ul>
                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                                <li>Comero features a Fast Checkout option, allowing you to securely save your credit card details so that you don't have to re-enter them for future purchases.</li>
                                                <li>PayPal: Shop easily online without having to enter your credit card details on the website. Your account will be charged once the order is completed. To register for a PayPal account, visit the website paypal.com.</li>
                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            Can I use my own domain name?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>Absolutely! Simply point your domain directly to your new Xton. You do not need to use a subdomain or any other temporary domain name placeholder.</p>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What kind of customer service do you offer?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>Our ecommerce consultants are here to answer your questions. In addition to FREE phone support, you can contact our consultants via email or live chat.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tabs-item">
                            <div class="faq-accordion">
                                <ul class="accordion">
                                    <li class="accordion-item">
                                        <a class="accordion-title active" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What shipping methods are available?
                                        </a>
        
                                        <div class="accordion-content show">
                                            <p>Shipping times and costs depend on the shipping method and location. Standard shipping typically takes 5-7 business days, while express shipping takes 2-3 days. For same-day delivery, it's available in select areas for orders placed before 12 PM. Shipping costs are calculated at checkout, with free standard shipping on orders over LKR 5,000. Additional fees apply for express and international shipping.
                                            </p>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What are shipping times and costs?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>We offer several shipping methods to ensure your order arrives as quickly and securely as possible. Our available shipping options include:
                                            Standard Shipping – Delivered within 5-7 business days.
                                            Express Shipping – Delivered within 2-3 business days.
                                            Same-Day Delivery – Available in select areas for orders placed before 12 PM.
                                            International Shipping – We also offer international shipping to select countries, with delivery times varying based on location.
                                            </p>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What payment methods can I use?
                                        </a>
        
                                        <div class="accordion-content">
                                            <ul>
                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                                <li>Comero features a Fast Checkout option, allowing you to securely save your credit card details so that you don't have to re-enter them for future purchases.</li>
                                                <li>PayPal: Shop easily online without having to enter your credit card details on the website. Your account will be charged once the order is completed. To register for a PayPal account, visit the website paypal.com.</li>
                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            Can I use my own domain name?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>Absolutely! Simply point your domain directly to your new Xton. You do not need to use a subdomain or any other temporary domain name placeholder.</p>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What kind of customer service do you offer?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>Our ecommerce consultants are here to answer your questions. In addition to FREE phone support, you can contact our consultants via email or live chat.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tabs-item">
                            <div class="faq-accordion">
                                <ul class="accordion">
                                    <li class="accordion-item">
                                        <a class="accordion-title active" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What shipping methods are available?
                                        </a>
        
                                        <div class="accordion-content show">
                                            <p>Shipping times and costs depend on the shipping method and location. Standard shipping typically takes 5-7 business days, while express shipping takes 2-3 days. For same-day delivery, it's available in select areas for orders placed before 12 PM. Shipping costs are calculated at checkout, with free standard shipping on orders over LKR 5,000. Additional fees apply for express and international shipping.
                                            </p>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What are shipping times and costs?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>We offer several shipping methods to ensure your order arrives as quickly and securely as possible. Our available shipping options include:
                                            Standard Shipping – Delivered within 5-7 business days.
                                            Express Shipping – Delivered within 2-3 business days.
                                            Same-Day Delivery – Available in select areas for orders placed before 12 PM.
                                            International Shipping – We also offer international shipping to select countries, with delivery times varying based on location.
                                            </p>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What payment methods can I use?
                                        </a>
        
                                        <div class="accordion-content">
                                            <ul>
                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                                <li>Comero features a Fast Checkout option, allowing you to securely save your credit card details so that you don't have to re-enter them for future purchases.</li>
                                                <li>PayPal: Shop easily online without having to enter your credit card details on the website. Your account will be charged once the order is completed. To register for a PayPal account, visit the website paypal.com.</li>
                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            Can I use my own domain name?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>Absolutely! Simply point your domain directly to your new Xton. You do not need to use a subdomain or any other temporary domain name placeholder.</p>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What kind of customer service do you offer?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>Our ecommerce consultants are here to answer your questions. In addition to FREE phone support, you can contact our consultants via email or live chat.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tabs-item">
                            <div class="faq-accordion">
                                <ul class="accordion">
                                    <li class="accordion-item">
                                        <a class="accordion-title active" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What shipping methods are available?
                                        </a>
        
                                        <div class="accordion-content show">
                                            <p>Shipping times and costs depend on the shipping method and location. Standard shipping typically takes 5-7 business days, while express shipping takes 2-3 days. For same-day delivery, it's available in select areas for orders placed before 12 PM. Shipping costs are calculated at checkout, with free standard shipping on orders over LKR 5,000. Additional fees apply for express and international shipping.
                                            </p>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What are shipping times and costs?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>We offer several shipping methods to ensure your order arrives as quickly and securely as possible. Our available shipping options include:
                                            Standard Shipping – Delivered within 5-7 business days.
                                            Express Shipping – Delivered within 2-3 business days.
                                            Same-Day Delivery – Available in select areas for orders placed before 12 PM.
                                            International Shipping – We also offer international shipping to select countries, with delivery times varying based on location.
                                            </p>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What payment methods can I use?
                                        </a>
        
                                        <div class="accordion-content">
                                            <ul>
                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                                <li>Comero features a Fast Checkout option, allowing you to securely save your credit card details so that you don't have to re-enter them for future purchases.</li>
                                                <li>PayPal: Shop easily online without having to enter your credit card details on the website. Your account will be charged once the order is completed. To register for a PayPal account, visit the website paypal.com.</li>
                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            Can I use my own domain name?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>Absolutely! Simply point your domain directly to your new Xton. You do not need to use a subdomain or any other temporary domain name placeholder.</p>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What kind of customer service do you offer?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>Our ecommerce consultants are here to answer your questions. In addition to FREE phone support, you can contact our consultants via email or live chat.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tabs-item">
                            <div class="faq-accordion">
                                <ul class="accordion">
                                    <li class="accordion-item">
                                        <a class="accordion-title active" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What shipping methods are available?
                                        </a>
        
                                        <div class="accordion-content show">
                                            <p>Shipping times and costs depend on the shipping method and location. Standard shipping typically takes 5-7 business days, while express shipping takes 2-3 days. For same-day delivery, it's available in select areas for orders placed before 12 PM. Shipping costs are calculated at checkout, with free standard shipping on orders over LKR 5,000. Additional fees apply for express and international shipping.
                                            </p>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What are shipping times and costs?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>We offer several shipping methods to ensure your order arrives as quickly and securely as possible. Our available shipping options include:
                                            Standard Shipping – Delivered within 5-7 business days.
                                            Express Shipping – Delivered within 2-3 business days.
                                            Same-Day Delivery – Available in select areas for orders placed before 12 PM.
                                            International Shipping – We also offer international shipping to select countries, with delivery times varying based on location.
                                            </p>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What payment methods can I use?
                                        </a>
        
                                        <div class="accordion-content">
                                            <ul>
                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                                <li>Comero features a Fast Checkout option, allowing you to securely save your credit card details so that you don't have to re-enter them for future purchases.</li>
                                                <li>PayPal: Shop easily online without having to enter your credit card details on the website. Your account will be charged once the order is completed. To register for a PayPal account, visit the website paypal.com.</li>
                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            Can I use my own domain name?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>Absolutely! Simply point your domain directly to your new OMC. You do not need to use a subdomain or any other temporary domain name placeholder.</p>
                                        </div>
                                    </li>

                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class='bx bx-chevron-down'></i>
                                            What kind of customer service do you offer?
                                        </a>
        
                                        <div class="accordion-content">
                                            <p>Our ecommerce consultants are here to answer your questions. In addition to FREE phone support, you can contact our consultants via email or live chat.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End FAQ Area -->

     
        
@endsection