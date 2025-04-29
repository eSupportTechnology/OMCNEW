<?php $__env->startSection('content'); ?>

        <!-- Start Page Title -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>Contact Us</h2>
                    <ul>
                        <li><a href="/home">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

       
        <!-- Start Contact Area -->
        <section class="contact-area ptb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-12">
                        <div class="contact-info">
                            <h3>Here to Help</h3>
                            <p>Have a question? You may find an answer in our <a href="/faq">FAQs</a>. But you can also contact us.</p>

                            <ul class="contact-list">
                                <li><i class='bx bx-map'></i> Location: <a href="#">No 425/2, Parakum Place, Kaduruwela, Polannaruwa.</a></li>
                                <li><i class='bx bx-phone-call'></i> Call Us: <a href="tel:075 833 7141">075 833 7141</a></li>
                                <li><i class='bx bx-envelope'></i> Email Us: <a href="mailto:omarketingcomplex@gmail.com">omarketingcomplex@gmail.com</a></li>
                            </ul>

                           <!-- <h3>Opening Hours:</h3>
                            <ul class="opening-hours">
                                <li><span>Monday:</span> 8AM - 6AM</li>
                                <li><span>Tuesday:</span> 8AM - 6AM</li>
                                <li><span>Wednesday:</span> 8AM - 6AM</li>
                                <li><span>Thursday - Friday:</span> 8AM - 6AM</li>
                                <li><span>Sunday:</span> Closed</li>
                            </ul>-->

                            <h3>Follow Us:</h3>
                            <ul class="social">
                                <li><a href="#" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                                <li><a href="#" target="_blank"><i class='bx bxl-twitter'></i></a></li>
                                <li><a href="#" target="_blank"><i class='bx bxl-instagram'></i></a></li>
                                <li><a href="#" target="_blank"><i class='bx bxl-linkedin'></i></a></li>
                                <li><a href="#" target="_blank"><i class='bx bxl-skype'></i></a></li>
                                <li><a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a></li>
                                <li><a href="#" target="_blank"><i class='bx bxl-youtube'></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-7 col-md-12">
                        <div class="contact-form">
                            <h3>Send Us a Message</h3>
                            <p>We're happy to answer any questions you have or provide you with an estimate. Just send us a message in the form below with any questions you may have.</p>

                            <form novalidate=""  id="contactform" action="<?php echo e(route('contactus')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="row justify-content-center">
                                    <div class="col-lg-12 col-md-6">
                                        <div class="form-group">
                                            <label>Name <span>*</span></label>
                                            <input type="text" name="name" class="form-control" required placeholder="Your name">
                                        </div>
                                    </div>
                            
                                    <div class="col-lg-12 col-md-6">
                                        <div class="form-group">
                                            <label>Email <span>*</span></label>
                                            <input type="email" name="email" class="form-control" required placeholder="Your email address">
                                        </div>
                                    </div>
                            
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Your Message <span>*</span></label>
                                            <textarea name="message" cols="30" rows="5" required class="form-control" placeholder="Write your message..."></textarea>
                                        </div>
                                    </div>
                            
                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Area -->

        <!-- Map -->
        <div id="map" class="mb-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15806.693696915036!2d81.02289743500388!3d7.929136689064929!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3afb45b9b663e885%3A0x401c82be0e935ded!2sOnline%20Marketing%20Complex!5e0!3m2!1sen!2slk!4v1733339414911!5m2!1sen!2slk"></iframe>
        </div>
        <!-- End Map -->

       
<?php $__env->stopSection(); ?>
 
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\e support project\resources\views/frontend/contact.blade.php ENDPATH**/ ?>