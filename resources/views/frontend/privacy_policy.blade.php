@extends ('frontend.master')

@section('content')

<style>
    .customer-service-content h3,
    .customer-service-content p {
        padding: 10px 0; 
        margin: 0; 
        line-height: 1.6; 
    }

    .email-link:hover {
        text-decoration: underline;
    }

    .email-link {
        color: #007BFF; 
        text-decoration: none;
        font-weight: bold;
}

</style>
       
       <!-- Start Page Title -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>Privacy Policy</h2>
                    <ul>
                        <li><a href="/home">Home</a></li>
                        <li>Privacy Policy</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- Start Privacy Policy Area -->
        <section class="customer-service-area ptb-100">
            <div class="container">
                <div class="customer-service-content">
                    <p>At OMC, your privacy is of utmost importance to us. This Privacy Policy outlines how we collect, use, and protect your personal information. </p>

                    <h3>1. Information We Collect</h3>
                        <p>We may collect the following information:</p>
                            <ul>
                                <li>Your name, email address, and phone number when you register or make a purchase.</li>
                                <li>Payment information for order processing.</li>
                                <li>Delivery address for shipping purposes.</li>
                                <li>Technical data such as IP address and browser type for analytics and security.</li>
                            </ul>

                    <h3>2. How We Use Your Information</h3>
                        <p>We use your personal data to: </p>
                            <ul>
                                <li>Process and deliver your orders.</li>
                                <li>Provide customer support.</li>
                                <li>Send promotional offers, if you have opted in.</li>
                                <li>Improve our website and services.</li>
                            </ul>

                    <h3>3. Information Sharing</h3>
                        <p> We do not sell, trade, or rent your personal information to third parties. However, we may share information with trusted partners to facilitate order fulfillment and payment processing.</p>
        
                    <h3>4. Data Security</h2>
                        <p> We implement various security measures to ensure the safety of your personal data. However, no online transmission or storage system is 100% secure.</p>
        
                    <h3>5. Cookies</h2>
                        <p>Our website may use cookies to enhance user experience. You can disable cookies through your browser settings, but this may affect functionality.</p>
       
                    <h3>6. Changes to This Policy</h2>
                        <p> We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated revision date. </p>
      
                    <h3>7. Contact Us</h2>
                        <p> If you have any questions about this Privacy Policy, please contact us at <a href="mailto:omarketingcomplex@gmail.com" class="email-link">omarketingcomplex@gmail.com</a>. </p>

                </div>
            </div>
        </section>
        <!-- End Privacy Policy Area -->





       

       

       

@endsection        