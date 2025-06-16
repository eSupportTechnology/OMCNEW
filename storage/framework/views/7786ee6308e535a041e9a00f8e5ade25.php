<?php $__env->startSection('content'); ?>
<main class="content-container">
    <div class="nav-ash">
        <div class="site-common-con">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="site-common-con">
        <div class="row">
            <div class="col-md-3 terms-nav">
                <div class="nav flex-column nav-pills" id="v-pills-tab" aria-orientation="vertical">
                    <a class="nav-link" id="v-pills-one-tab" href="/faq">FAQ</a>
                    <a class="nav-link" id="v-pills-two-tab" href="/buy">How To Buy</a>
                    <a class="nav-link active" id="v-pills-three-tab" href="/shipping-delivery">Shipping & Delivery</a>
                    <a class="nav-link" id="v-pills-three-tab" href="/warranty">Warranty Information</a>
                    <a href="/return-product" class="nav-link" id="v-pills-four-tab">Return Products</a>
                </div>
            </div>

            <div class="col-md-9">
                <div class="tab-content terms-tab" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-three" role="tabpanel" aria-labelledby="v-pills-three-tab">
                        <h3 class="title-terms mb-4">Shipping &amp; Delivery</h3>

                        <ul>
                            <li class="monial-graph">Complimentary ground shipping within 1 to 7 business days</li>
                            <li class="monial-graph">In-store collection available within 1 to 7 business days</li>
                            <li class="monial-graph">Next-day and Express delivery options also available</li>
                            <li class="monial-graph">Purchases are delivered in an orange box tied with a Bolduc ribbon, with the exception of certain items</li>
                            <li class="monial-graph">See the delivery FAQs for details on shipping methods, costs and delivery times</li>
                        </ul>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><strong>Order Amount (Rs.)</strong></td>
                                        <td><strong>Delivery Charge</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Up to 10,000</td>
                                        <td>Rs. 490</td>
                                    </tr>
                                    <tr>
                                        <td>10,001 – 20,000</td>
                                        <td>Rs. 590</td>
                                    </tr>
                                    <tr>
                                        <td>20,001 - 50,000</td>
                                        <td>Rs. 790</td>
                                    </tr>
                                    <tr>
                                        <td>50,001 - 100,000</td>
                                        <td>Rs. 1090</td>
                                    </tr>
                                    <tr>
                                        <td>100,001 - 200,000</td>
                                        <td>Rs. 1590</td>
                                    </tr>
                                    <tr>
                                        <td>200,001 &amp; above</td>
                                        <td>Rs. 2090</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\omcnew project\OMCNEW\resources\views/frontend/ShippingDelivery.blade.php ENDPATH**/ ?>