
    <div class="footer-container" style="margin-top:200px;">
            <footer class="text-center text-lg-start text-white" style="background: linear-gradient(90deg, #05467c, #0b71d4); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);">
                <div class="container p-4 pb-0">
                    <section class="">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 contact-us-column">
                                <h6 class="text-uppercase mb-4 font-weight-bold">Contact Us</h6>
                                <p><i class="fas fa-home mr-3"></i> No 425/2, Parakum Place, Kaduruwela, Polannaruwa.</p>
                                <p><i class="fas fa-envelope mr-3"></i> 
                                    <a href="mailto:omarketingcomplex@gmail.com" style="color:white; text-decoration:none;">omarketingcomplex@gmail.com</a>
                                </p>
                                <p><i class="fas fa-phone mr-3"></i> 
                                    <a href="tel:+94778337143" style="color:white; text-decoration:none;">075 833 7141</a>
                                </p>
                            </div>
                            
                            <hr class="w-100 clearfix d-md-none" />

                            <div class="info-grid col-md-2 col-lg-2 col-xl-2 mx-auto mt-3 mb-3">
                                <h6 class="text-uppercase mb-4 font-weight-bold">Information</h6>
                                <p><a href="<?php echo e(route('about')); ?>" class="text-white">About Us</a></p>
                                <p><a href="<?php echo e(route('contac')); ?>" class="text-white">Contact Us</a></p>
                                <p><a href="<?php echo e(route('helpcenter')); ?>" class="text-white">Help Center</a></p>

                                <p><a href="<?php echo e(route('customer-inquiry')); ?>" class="text-white">Inquiries</a></p>

                                <p><a href="<?php echo e(route('aff_home')); ?>" target="_blank" class="text-white">Affiliate program</a></p>
                            </div>
                            
                            <hr class="w-100 clearfix d-md-none" />

                            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3 my-acc-column">
                                <h6 class="text-uppercase mb-4 font-weight-bold">My Account</h6>                               
                                <?php if(auth()->guard()->check()): ?>
                                    <p><a href="<?php echo e(route('myorders')); ?>" class="text-white text-decoration-none">Order History</a></p>
                                <?php else: ?>
                                    <p><a href="javascript:void(0);" class="text-white text-decoration-none" onclick="showLoginWarning()">Order History</a></p>
                                <?php endif; ?>
                            </div>


                            <hr class="w-100 clearfix d-md-none" />

                            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3 social-icons">
                                <h6 class="text-uppercase mb-4 font-weight-bold">Social Networks</h6>
                                <p>Follow us on social networks</p>

                                <a class="btn btn-primary btn-floating m-1"style="background-color: #3b5998; border-color: #3b5998"
                                href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

                                <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee; border-color: #55acee"
                                href="#!" role="button"><i class="fab fa-twitter"></i></a>

                                <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39; border-color: #dd4b39"
                                href="#!"role="button"><i class="fab fa-google"></i></a>

                                <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac; border-color: #ac2bac"
                                href="#!" role="button"><i class="fab fa-instagram"></i></a>

                                <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca; border-color: #0082ca"
                                href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>

                            </div>
                            </div>
                    </section>
                </div>

                <div class="text-center p-3" style="background-color: #054070">
                  
                    <a class="text-white" href=""></a>
                </div>
            </footer>
        </div>

<script>
    function showLoginWarning() {
        toastr.warning('Please log in to view your order history.', 'Warning', {
            positionClass: 'toast-top-right',
            timeOut: 3000,
        });
    }
</script><?php /**PATH C:\xampp\htdocs\OMCNEW\resources\views/includes/footer.blade.php ENDPATH**/ ?>