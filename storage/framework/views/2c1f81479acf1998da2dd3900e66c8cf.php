<?php $__env->startSection('content'); ?>
<main class="content-container">

    <div class="nav-ash">
        <div class="site-common-con">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="site-common-con mt-5">
        <div class="row">
            <div class="col-12 col-xl-6">
                <h1 class="page-title-wrap">About Us</h1>
                <h3 class="about-sub-head">We are a Sri Lankan company providing construction, consultancy, and renovation services with unmatched quality and reliability.</h3>
                <p class="common-p">OMC is a multidisciplinary company that undertakes Building Construction, Consultancy, and Renovation Projects island-wide. We specialize in both government and private sector projects. With a dedicated team of engineers and professionals, we ensure every project is handled with precision and quality.</p>
                <p class="common-p">Our services include Architectural Designing, Quantity Surveying, Structural Engineering, Interior Designing, and MEP Services. We have a proven track record of successfully completed residential and commercial projects and have earned a reputation for quality, integrity, and timely delivery.</p>
            </div>
            <div class="col-12 col-xl-6">
                <img class="about-img" src="<?php echo e(asset('themes/buyabans/assets/images/about-img.png')); ?>" alt="About OMC">
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-xl-12">
                <h2 class="page-title-wrap text-center">Why Choose OMC?</h2>
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-center about-img-set gap-3">
                <div class="about-box text-right" style="width: 382px; height: 383px;">
                    <img class="img-fluid w-100 h-100 object-fit-cover" src="<?php echo e(asset('themes/buyabans/assets/images/diverse-sectors.webp')); ?>" alt="Expertise">
                </div>
                <div class="about-box text-center" style="width: 382px; height: 383px;">
                    <img class="img-fluid w-100 h-100 object-fit-cover" src="<?php echo e(asset('themes/buyabans/assets/images/31.webp')); ?>" alt="Projects">
                </div>
                <div class="about-box text-left" style="width: 382px; height: 383px;">
                    <img class="img-fluid w-100 h-100 object-fit-cover" src="<?php echo e(asset('themes/buyabans/assets/images/32.webp')); ?>" alt="Services">
                </div>
            </div>


            <div class="col-sm-12 mt-4">
                <p class="common-p">We focus on delivering value to our clients with transparency, accountability, and innovative approaches. By combining our technical knowledge and experience, we bring our clients' visions to life while ensuring safety, sustainability, and compliance at every stage.</p>
                <p class="common-p">Choose OMC for your next project and experience excellence in engineering and construction.</p>
            </div>
        </div>
    </div>

</main>
</br>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/frontend/About-us.blade.php ENDPATH**/ ?>