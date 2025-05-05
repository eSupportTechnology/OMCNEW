<?php $__env->startSection('content'); ?>

<style>
    .contact-card {
        width: 300px;
        height: 200px;
        perspective: 1000px;

    }

    .card-inner {
        width: 100%;
        height: 100%;
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.999s;
    }

    .contact-card:hover .card-inner {
        transform: rotateY(180deg);
    }

    .card-front,
    .card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
    }

    .card-front {
        background: linear-gradient(to right, #48629c, #237ccc);
        color: #fff;
        display: flex;
        align-items: center;
        border-radius: 10px;
        justify-content: center;
        font-size: 24px;
        transform: rotateY(0deg);
    }

    .card-back {
        background: linear-gradient(to right, #237ccc, #48629c);
        color: #fff;
        display: flex;
        align-items: center;
        border-radius: 10px;
        justify-content: center;
        font-size: 1.2em;
        transform: rotateY(180deg);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .contact-main {
        text-align: center;
        padding: 50px 0;
        background-image: url('/assets/images/contact1.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
        height: 200px;
    }

    .contact-main h1 {
        font-size: 50px;
        color: white;
        margin-bottom: 10px;
    }

    .contact-section {
        text-align: center;
        padding: 50px 0;
        background-color: #fff;
    }

    .contact-section h2 {
        font-size: 2.5rem;
        margin-bottom: 40px;
        color: #333;
    }

    .contact-container {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 20px;
        flex-wrap: wrap;        
    }

    .contact-item {
        width: 250px;
        text-align: center;
        transition: transform 0.3s ease;
        text-decoration: none;
    }


    .contact-item i {
        font-size: 2.5rem;
        color: #ffffff;
        margin-bottom: 10px;
    }

    .contact-item h3 {
        font-size: 1rem;
        margin-bottom: 5px;
        color: #ffffff;
    }

    .contact-item p {
        font-size: 0.9rem;
        color: #ffffff;
    }

    .row {
        min-height: 100%;
        margin-top: 5vh;
    }

    @media (max-width: 480px) {
        .contact-section h2 {
            font-size: 2rem;
        }

        .contact-item i {
            font-size: 1.5rem;
        }

        .contact-item h3 {
            font-size: 1rem;
        }

        .contact-item p {
            font-size: 0.7rem;
        }
    }


    /* Contact Form Styles */
    .contact-form {
        max-width: 600px;
        margin: 40px auto;
        padding: 30px;
    }

    .contact-form h3 {
        font-size: 1.5rem;
        margin-bottom: 20px;
        color: #333;
    }

    .form-group {
        position: relative;
        width: 100%;
    }

    .contact-form .form-group {
        margin-bottom: 15px;
    }

    input {
        margin-top: 15px;
        width: 100%;
        outline: none;
        height: 45px;
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 1px solid #333;
        background: transparent;
        padding-left: 10px;
    }

    input:focus {
        border-bottom: 1.5px solid #2d79f3;
    }

    .form-group label {
        position: absolute;
        top: 25px;
        left: 15px;
        color: #6f6969;
        transition: all 0.3s ease;
        pointer-events: none;
        z-index: 2;
    }

    .form-group input:focus~label,
    .form-group input:valid~label {
        top: 5px;
        left: 5px;
        font-size: 14px;
        font-weight: 600;
        color: #2d79f3;
        background-color: #ffffff;
        padding-left: 5px;
        padding-right: 5px;
    }
    .contact-form button {
        font-family: inherit;
        font-size: 16px;
        background: royalblue;
        color: white;
        padding: 0.7em 1em;
        padding-left: 0.9em;
        display: flex;
        align-items: center;
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.2s;
        cursor: pointer;
    }

    .contact-form button span {
        display: block;
        margin-left: 0.3em;
        transition: all 0.3s ease-in-out;
    }

    .contact-form button svg {
        display: block;
        transform-origin: center center;
        transition: transform 0.3s ease-in-out;
    }

    .contact-form button:hover .svg-wrapper {
        animation: fly-1 0.6s ease-in-out infinite alternate;
    }

    .contact-form button:hover svg {
        transform: translateX(3.5em) rotate(45deg) scale(1.1);
    }

    .contact-form button:hover span {
        transform: translateX(10em);
    }

    .contact-form button:active {
        transform: scale(0.95);
    }

    @keyframes fly-1 {
        from {
            transform: translateY(0.1em);
        }

        to {
            transform: translateY(-0.1em);
        }
    }
</style>

<!-- Contact-main Section -->
<div class="contact-main">
    <h1>Contact Us</h1>
</div>

<!-- Contact Section Row -->
<div class="container">
    <div class="row align-items-center">
        <!-- Contact Details Section -->
        <div class="col-md-6 contact-section">
            <h2>Let's Get In Touch</h2>
            <div class="contact-container">
                <div class="contact-card">
                    <div class="card-inner">
                        <div class="card-front">
                            <a href="mailto:omarketingcomplex@gmail.com" class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <h3>Email Address</h3>
                                <p>omarketingcomplex@gmail.com</p>
                            </a>
                        </div>
                        <div class="card-back">
                            <a href="mailto:omarketingcomplex@gmail.com" class="contact-item">
                                <p>omarketingcomplex@gmail.com</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="contact-card">
                    <div class="card-inner">
                        <div class="card-front">
                            <a href="tel:+94758337141" class="contact-item">
                                <i class="fas fa-phone-alt"></i>
                                <h3>Phone</h3>
                                <p>075 833 7141</p>
                            </a>
                        </div>
                        <div class="card-back">
                            <a href="tel:+94758337141" class="contact-item">
                                <p>075 833 7141</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vertical Line -->
        <div class="col-md-1 d-none d-md-block">
            <div class="vertical-line"></div>
        </div>

        <!-- Contact Form Section -->
        <div class="col-md-5 contact-form">
            <h3>Send Us a Message</h3>
            <form novalidate=""  id="contactform" action="<?php echo e(route('contactus')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <input type="text" name="author" class="input" required>
                    <label for="author">Name</label>
                </div>
                <div class="form-group">
                    <input type="email" name="email" required>
                    <label for="email">Email</label>
                </div>

                <div class="form-group">
                    <input type="text" name="message" rows="5" required>
                    <label for="name">Message</label>
                </div>
                <button type="submit">
                    <div class="svg-wrapper-1">
                        <div class="svg-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path fill="currentColor"
                                    d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <span>Send Message</span>
                </button>
            </form>
        </div>
    </div>
    <div class="row">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15806.693696915036!2d81.02289743500388!3d7.929136689064929!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3afb45b9b663e885%3A0x401c82be0e935ded!2sOnline%20Marketing%20Complex!5e0!3m2!1sen!2slk!4v1733339414911!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/contac.blade.php ENDPATH**/ ?>