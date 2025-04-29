@extends('layouts.app')

@section('content')
<style>

.icon-lg {
    width: 3.5rem;
    height: 3.5rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-size: 1.5rem;
    line-height: 1;
}
.card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}
a {
    text-decoration:none;    
}

.desc{
    color:#fff;    
}

body{margin-top:0px;}
.section_padding_130 {
    padding-top: 110px;
    padding-bottom: 110px;
}
.faq_area {
    position: relative;
    z-index: 1;
    background-color: #f5f5ff;
}

.faq-accordian {
    position: relative;
    z-index: 1;
}
.faq-accordian .card {
    position: relative;
    z-index: 1;
    margin-bottom: 1.5rem;
}
.faq-accordian .card:last-child {
    margin-bottom: 0;
}
.faq-accordian .card .card-header {
    background-color: #ffffff;
    padding: 0;
    border-bottom-color: #ebebeb;
}
.faq-accordian .card .card-header h6 {
    cursor: pointer;
    padding: 1.75rem 2rem;
    color: #3f43fd;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -ms-grid-row-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
}
.faq-accordian .card .card-header h6 span {
    font-size: 1.5rem;
}
.faq-accordian .card .card-header h6.collapsed {
    color: #070a57;
}
.faq-accordian .card .card-header h6.collapsed span {
    -webkit-transform: rotate(-180deg);
    transform: rotate(-180deg);
}
.faq-accordian .card .card-body {
    padding: 1.75rem 2rem;
}
.faq-accordian .card .card-body p:last-child {
    margin-bottom: 0;
}

@media only screen and (max-width: 575px) {
    .support-button p {
        font-size: 14px;
    }
}

.support-button i {
    color: #3f43fd;
    font-size: 1.25rem;
}
@media only screen and (max-width: 575px) {
    .support-button i {
        font-size: 1rem;
    }
}

.support-button a {
    text-transform: capitalize;
    color: #2ecc71;
}
@media only screen and (max-width: 575px) {
    .support-button a {
        font-size: 13px;
    }
}
</style>


<div class="container" style="width: 80%;">
    <section class="section mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7 text-center desc">
                    <h2 class="h1 mb-3 text-black">Hi! How can we help?</h2>
                    <form class="d-flex flex-column mt-4">
                        <div class="input-group">
                            <input autocomplete="off" type="search" class="form-control rounded" placeholder="Search" style="height: 50px;"/>
                            <span class="input-group-text border-0" style="background-color: #05467c; height: 100%; width: 50px; padding:15px;">
                                <i class="fas fa-search" style="font-size: 1.2rem; color:white;"></i>
                            </span>
                        </div>
                    </form> 

                </div>
            </div>
        </div>
    </section>
    <section class="section pt-4">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card h-100 d-flex">
                        <div class="card-body d-flex">
                            <div class="icon-lg bg-primary rounded-3 text-white"><i class="fa fa-question-circle"></i></div>
                            <div class="ps-3 col">
                                <h5 class="h6 mb-2"><a class="stretched-link text-reset" href="#">Buying and Item Support</a></h5>
                                <p class="m-0">To purchase products from OMC (Online Marketing Complex), you must first submit an application to create a user account. After setting up an account, you will be able to take advantage of various benefits when purchasing products.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card h-100 d-flex">
                        <div class="card-body d-flex">
                            <div class="icon-lg bg-primary rounded-3 text-white"><i class="fa fa-id-badge"></i></div>
                            <div class="ps-3 col">
                                <h5 class="h6 mb-2"><a class="stretched-link text-reset" href="#">Licensing</a></h5>
                                <p class="m-0">When purchasing products from OMC, you will be provided with valuable resources under specific licensing agreements. This ensures adequate legal protection regarding the products, allowing you to have specific and defined usage rights.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card h-100 d-flex">
                        <div class="card-body d-flex">
                            <div class="icon-lg bg-primary rounded-3 text-white"><i class="fa fa-user"></i></div>
                            <div class="ps-3 col">
                                <h5 class="h6 mb-2"><a class="stretched-link text-reset" href="#">Your Account</a></h5>
                                <p class="m-0">To confirm that you have an OMC (Online Marketing Complex) account, simply log in using your username and password credentials. This account allows you to efficiently purchase products and avail yourself of various specific benefits and exclusive offers.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card h-100 d-flex">
                        <div class="card-body d-flex">
                            <div class="icon-lg bg-primary rounded-3 text-white"><i class="fa fa-trophy"></i></div>
                            <div class="ps-3 col">
                                <h5 class="h6 mb-2"><a class="stretched-link text-reset" href="#">Copyright and Trademarks</a></h5>
                                <p class="m-0">The products provided by OMC come with legal protections to safeguard associated intellectual property rights and information. You can securely protect your rights related to the products and services. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card h-100 d-flex">
                        <div class="card-body d-flex">
                            <div class="icon-lg bg-primary rounded-3 text-white"><i class="fa fa-book"></i></div>
                            <div class="ps-3 col">
                                <h5 class="h6 mb-2"><a class="stretched-link text-reset" href="#">Tax &amp; Compliance</a></h5>
                                <p class="m-0"> When purchasing products from Online Marketing Complex, you must ensure that you make the correct tax payments in accordance with the laws and regulations of your state. OMC is also ready to provide support regarding tax-related matters.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card h-100 d-flex">
                        <div class="card-body d-flex">
                            <div class="icon-lg bg-primary rounded-3 text-white"><i class="fa fa-credit-card"></i></div>
                            <div class="ps-3 col">
                                <h5 class="h6 mb-2"><a class="stretched-link text-reset" href="#">Payment methods</a></h5>
                                <p class="m-0">You can conveniently use one of the various payment plans available through Visa and MasterCard to purchase products from OMC (Online Marketing Complex). Additionally, you have the option to easily make payments after receiving the product in your hands.</P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--FAQ-->
        <div class="faq_area section_padding_130 mt-5" id="faq">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-lg-6">
                    <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <h3><span>Frequently </span> Asked Questions</h3>
                        <p><p>Here you'll find answers to frequently asked questions about our products, order process, shipping, and returns. Our customer support team is here to help.</p>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-lg-8">
                    <div class="accordion faq-accordian" id="faqAccordion">
                        <div class="card border-0 wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            <div class="card-header" id="headingOne">               
                                <h6 class="mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    When will I receive my order?<span class="lni-chevron-up"></span></h6>
                            </div>
                            <div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>After seller send out your package, you will receive the goods in the promised delivery time. There is the estimated delivery time and shipping information shown on the logistics page (by clicking 'Track Order' button on the order list page).</p>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 wow fadeInUp" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                            <div class="card-header" id="headingTwo">
                                <h6 class="mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                How to check my refund?<span class="lni-chevron-up"></span></h6>
                            </div>
                            <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="card-body">                            
                                    <p>Generally, the refund will be received in 3-20 business days. Please click the right Payment/Refund method for detail information about the refund..</p>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="card-header" id="headingThree">
                                <h6 class="mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How to purchase products?<span class="lni-chevron-up"></span>
                                </h6>
                            </div>
                            <div class="collapse" id="collapseThree" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>You can buy products by creating and registering a user account within OMC. By registering, you can obtain many benefits.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card border-0 wow fadeInUp" data-wow-delay="0.5s">
                            <div class="card-header" id="headingFour">
                                <h6 class="mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    How to earn additional income?<span class="lni-chevron-up"></span>
                                </h6>
                            </div>
                            <div class="collapse" id="collapseFour" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Through OMC, you can earn additional income by registering for our affiliate program. Full details can be found on our affiliate page.</p>
                                </div>
                            </div>
                        </div>
                         
                      <div class="card border-0 wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                            <div class="card-header" id="headingLast">
                                <h6 class="mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#collapseLast" aria-expanded="true" aria-controls="collapseLast">
                                    How do I track my package?<span class="lni-chevron-up"></span></h6>
                            </div>
                            <div class="collapse" id="collapseLast" aria-labelledby="headingLast" data-bs-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Visit "My Orders"-Find the order-Click “Track Order” /"Click here to view more".
                                    You can also visit Cainiao and 17track for more tracking information.
                                    </p>
                                </div>
                            </div>
                        </div>
                   </div>

                    <div class="support-button text-center d-flex align-items-center justify-content-center mt-4 wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <i class="lni-emoji-sad"></i>
                        <p class="mb-0 px-2">Can't find your answers?</p>
                        <a href="{{ route('contac') }}"> Contact us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
