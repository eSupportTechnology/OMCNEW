@extends ('frontend.master')

@section('content')
    <main class="content-container">




        <div class="nav-ash">
            <div class="site-common-con">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            FAQ
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="site-common-con">
            <div class="row">
                <div class="col-md-3 terms-nav">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" aria-orientation="vertical">
                        <a class="nav-link  active " id="v-pills-one-tab" href="faq.html">FAQ</a>

                        <a class="nav-link " id="v-pills-two-tab" href="/buy">How To Buy</a>

                        <a class="nav-link " id="v-pills-three-tab" href="/shipping-delivery">Shipping & Delivery</a>

                        <a class="nav-link " id="v-pills-three-tab" href="/warranty">Warranty Information</a>

                        <a href="return-product" class="nav-link " id="v-pills-four-tab" href="/return-product">Return
                            Products</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content terms-tab" id="v-pills-tabContent">
                        <div class="tab-pane fade  show active " id="v-pills-one" role="tabpanel"
                            aria-labelledby="v-pills-one-tab">
                            <div id="accordion" role="tablist">

                                <div class="content-section">
                                    <h3 class="title-terms">Frequently Asked Questions</h3>

                                    <ol>
                                        <li class="title-other">What shipping methods are available?
                                            <ol style="list-style-type: square">
                                                <li>Shipping times and costs depend on the shipping method and location. Standard shipping typically takes 5-7 business days, while express shipping takes 2-3 days. For same-day delivery, it's available in select areas for orders placed before 12 PM. Shipping costs are calculated at checkout, with free standard shipping on orders over LKR 5,000. Additional fees apply for express and international shipping.</li>
                                            </ol>
                                        </li>
                                        <li class="title-other">What are shipping times and costs?
                                            <ol style="list-style-type: square">
                                                <li>We offer several shipping methods to ensure your order arrives as quickly and securely as possible. Our available shipping options include: Standard Shipping – Delivered within 5-7 business days. Express Shipping – Delivered within 2-3 business days. Same-Day Delivery – Available in select areas for orders placed before 12 PM. International Shipping – We also offer international shipping to select countries, with delivery times varying based on location.</li>
                                            </ol>
                                        </li>
                                        <li class="title-other">What payment methods can I use?
                                            <ol style="list-style-type: square">
                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.
                                                </li>
                                            </ol>
                                            <ol style="list-style-type: square; ">
                                                <li>Comero features a Fast Checkout option, allowing you to securely save your credit card details so that you don't have to re-enter them for future purchases.
                                                </li>
                                            </ol>
                                            <ol style="list-style-type: square">
                                                <li>PayPal: Shop easily online without having to enter your credit card details on the website. Your account will be charged once the order is completed. To register for a PayPal account, visit the website paypal.com.
                                                </li>
                                            </ol>
                                            <ol style="list-style-type: square">
                                                <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.
                                                </li>
                                            </ol>
                                        </li>
                                        <li class="title-other">Can I use my own domain name?
                                            <ol style="list-style-type: square">
                                                <li>Absolutely! Simply point your domain directly to your new Xton. You do not need to use a subdomain or any other temporary domain name placeholder.</li>
                                            </ol>
                                        </li>
                                        <li class="title-other">What kind of customer service do you offer?
                                            <ol style="list-style-type: square">
                                                <li>Our ecommerce consultants are here to answer your questions. In addition to FREE phone support, you can contact our consultants via email or live chat.</li>
                                            </ol>
                                        </li>

                                    </ol>
                                </div>





                            </div>
                        </div>

                        <div class="tab-pane fade " id="v-pills-two" role="tabpanel" aria-labelledby="v-pills-two-tab">

                            <h3 class="title-terms mb-4" style="padding-top: 0px;">How To Buy</h3>
                            <ol>
                                <li class="monial-graph">You can browse by category, brand, or simply type what you’re
                                    looking
                                    for into the search bar.</li>
                                <li class="monial-graph">Select Buy Now to purchase an item immediately or Add to Cart and
                                    continue shopping.</li>
                                <li class="monial-graph">When you’re ready to check out, click View Cart, edit your order,
                                    apply
                                    Promo Codes, and choose your preferred delivery method. Select Home Delivery to have
                                    your
                                    order delivered to your home address by our professional courier service or select Click
                                    &amp; Collect to pick it up from an Abans Elite showroom of your choice.</li>
                                <li class="monial-graph">Login to automatically fill in your saved personal &amp; delivery
                                    information or Continue as Guest and add your details manually.</li>
                                <li class="monial-graph">Choose your preferred Payment Method, fill in the requested payment
                                    details and make your payment using our secure payment gateway.</li>
                                <li class="monial-graph">After the payment is made, you will receive an order confirmation
                                    via
                                    SMS and/or Email.</li>
                                <li class="monial-graph">After the order is confirmed, you can check the Order Status from
                                    Track Your Order. You will also be notified when your order is ready for Delivery or
                                    Pickup
                                    for Click &amp; Collect orders.</li>
                            </ol>
                        </div>

                        <div class="tab-pane fade " id="v-pills-three" role="tabpanel"
                            aria-labelledby="v-pills-three-tab">

                            <h3 class="title-terms mb-4">Shipping &amp; Delivery</h3>

                            <ol>
                                <li class="monial-graph">Items ordered online on BuyAbans.com will be delivered in within 3
                                    to 5 working days anywhere in Sri Lanka.</li>
                                <li class="monial-graph">Estimated delivery time may vary based on the availability of
                                    items
                                    ordered and the delivery
                                    address.</li>
                                <li class="monial-graph">The following delivery charges will apply based on the total value
                                    of
                                    your order.</li>
                            </ol>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr style="height: 18px;">
                                            <td style="width: 50%; height: 18px;"><strong>Order Amount (Rs.)</strong></td>
                                            <td style="width: 50%; height: 18px;"><strong>Delivery Charge</strong></td>
                                        </tr>
                                        <tr style="height: 18px;">
                                            <td style="width: 50%; height: 18px;">Up to 10,000&nbsp;</td>
                                            <td style="width: 50%; height: 18px;">Rs. 490</td>
                                        </tr>
                                        <tr style="height: 18px;">
                                            <td style="width: 50%; height: 18px;">10,001 – 20,000</td>
                                            <td style="width: 50%; height: 18px;">Rs. 590</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;">20,001 - 50,000</td>
                                            <td style="width: 50%;">Rs. 790</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;">50,001 - 100,000</td>
                                            <td style="width: 50%;">Rs. 1090</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;">100,001 - 200,000</td>
                                            <td style="width: 50%;">Rs. 1590</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;">200,001 &amp; above</td>
                                            <td style="width: 50%;">Rs. 2090</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>




                        <div class="tab-pane fade " id="v-pills-four" role="tabpanel"
                            aria-labelledby="v-pills-four-tab">

                            <h3 class="title-terms mb-4">Warranty</h3>
                            <p class="monial-graph">The warranty provided through the BuyAbans.com website is the same as
                                the
                                common warranty provided to all Abans PLC showrooms. For any warranty-related issues, please
                                contact the Service Centre via the contact details on the warranty card.</p>
                            <p class="monial-graph">We guarantee that all products sold by Abans PLC are in good quality
                                and
                                working order and tested for quality and handed over to the customer for normal and standard
                                usage, subject to the following terms and conditions. Abans PLC agrees to repair the
                                manufacturing defects in products on free of charge basis only <strong
                                    class="warrenty-first-strong">within the 01-year standard warranty period except for
                                    products covered under different warranty periods.</strong></p>
                            <p class="monial-graph">Extended warranty will be provided subject to payments, for extended
                                warranty terms and conditions refer the extended warranty card.</p>
                            <p class="monial-graph">The warranty will not be effective for <strong
                                    class="warrenty-second-strong">repairs/installations/services done by any 03rd party
                                    other
                                    than Abans Electricals PLC/Abans PLC or its authorized service agents, damage caused by
                                    ancillary equipment and non-recommended accessories, normal wear, tear and corrosion,
                                    corrosion of copper tanks, promotional Items given free of charge with the main product,
                                    damages due to split and liquid, drop damages, seepage, secretion from insects, rodents
                                    or
                                    domestic pets, accident, fire, theft, act of god, power surges, electrical leakage,
                                    voltage
                                    fluctuations, negligence, misuse, abuse, incorrect installations, modifications,
                                    improper
                                    testing operation, maintenance installation, charging of batteries other than standard
                                    charges, defaced, obliterated or removed, substance damage to coil cards and connectors
                                    due
                                    to misuse, damage due to shock or external force, lightning, being operated in alkaline
                                    or
                                    unsuitable atmosphere, use of products outside specification, use for purpose not
                                    recommended, use beyond the guidelines, directions and user capacity of product,
                                    alterations, defaced or suspected warranty cards and serial number alteration, unclear
                                    rubber stamp of showroom managers and dealers, any damage or loss to any 03rd party or
                                    property, batteries, chargers, carrying cases, laptop bags, power adaptors, power
                                    cables,
                                    internet connection cables, printer cables, cartridges, toner, knobs, locks, bulbs,
                                    filters,
                                    racks, shelves, gas charging, switches, remote controllers, AV cables, antenna cables,
                                    inter
                                    connection cables, brushers, drive belts, pulleys, pads, plug tops, burner caps, trivet,
                                    tube, ignition plugs, telephone shower, plastic jug, blades, handles, lids, pouches,
                                    speaker
                                    cables, speakers, speaker boxes, water tap and any other consumable parts.</strong></p>
                            <p class="monial-graph">Failure to install software, video, audio and file formats are not
                                considered as manufacturing defects. No warranty is provided for the quality of the software
                                and
                                hardware used by the customer, hardware and software defects and corruption, virus attacks,
                                spywares, firmware upgrades, defects due to use of third-party application and unauthorized
                                and
                                illegal software and company will not be responsible for any data losses at point of repair.
                            </p>
                            <p class="monial-graph">If the product delivered by the company contains any damage during
                                transit
                                or handling, customer shall be informed at the same time on date of delivery. If the product
                                is
                                delivered by the customer, company shall not be liable for any damage arising while
                                transporting. Customer is advised to check before moving out product from showroom
                                premises/Duty
                                Free showrooms.</p>
                            <p class="monial-graph">Services shall not be provided if Hire Purchase Instalments are due.
                            </p>
                            <p class="monial-graph">If the product is beyond economical repair, product replacement with
                                similar working condition and warranty shall be effective for remaining period.</p>
                            <p class="monial-graph">It is recommended to use the product with power guard and stabilizers.
                            </p>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td style="width: 30%;"><strong>Refrigerators Bottle Coolers Freezers</strong>
                                            </td>
                                            <td style="width:70%;">05 years for compressor only. Customer shall bear any
                                                charges for labour or
                                                accessories in relation to the replacement of compressor. 10-Year warranty
                                                shall apply only on compressors of selected refrigerator models. Humidity on
                                                the surface shall not be considered as defect.</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Televisions LCD/LED</strong></td>
                                            <td>If it is a manufacturing fault within the warranty period, Abans PLC will
                                                repair it free of charge.<br><br>1-year warranty for panel and 3-year
                                                warranty for other parts including Main and Power PCB.<br><br>Colour dots up
                                                to 7 numbers on LCD/LED TV screens shall be considered as a normal
                                                industrial cause as a result of pixel burnt and shall not replace the said
                                                products on that effect.<br><br>No warranty for Main/Power PCB damages due
                                                to signal wire connections/careless plugging/unplugging and usage of multi
                                                plugs.<br><br>No replacements allowed for back light replacements.<br>No
                                                warranty for TV and AV accessories / remotes / speakers / mics / wires /
                                                HDMI ports / Cables.<br>Televisions fixed on mobile vehicles shall not be
                                                covered under this warranty.</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Audio</strong></td>
                                            <td>No warranty for Speaker body corrosion, colour fading and fungus.<br>No
                                                warranty for Remote / Audio Speakers / Mics / Wires / Jacks.<br><br>If
                                                similar model is not available and customer request for refund, the refund
                                                value depends on the usage period.<br>Usage Period 00-06 months: Refund 85%
                                                from the invoiced value.<br>Usage Period 06-12 months: Refund 75% from the
                                                invoiced value.<br><br><strong>When customer request
                                                    upgrade</strong><br>Usage Period 00-06 months: Get balance amount +
                                                Remaining warranty. <br>Usage Period 06-12 months: Get balance amount +
                                                Remaining warranty.</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Washing Machine</strong></td>
                                            <td>05/10-year warranty on Stainless Steel Drum against rusting / Direct Drive
                                                or Smart Inverter Motor for selected models only.<br>05-year warranty on
                                                selected washing machines.</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Water Purifier</strong></td>
                                            <td>Refer warranty instruction sheet for more details.</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Solar System</strong></td>
                                            <td>Refer warranty instruction sheet for more details.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table2 " style="margin-top:30px;">
                                <p class="title-terms mb-4">SPECIAL WARRANTY TERMS</p>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td style="width: 30%"><strong>Product</strong></td>
                                                <td style="width: 70%"><strong>Special Warranty Terms for Products / Parts
                                                        / Accessories</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Air Conditioners</strong></td>
                                                <td>Within the standard one-year warranty period, 3 services will be
                                                    provided
                                                    free of charge.<br><br>10-year warranty for the compressor of the LG
                                                    Inverter Air Conditioner (residential) in the range of 9000 BTU to 24000
                                                    BTU
                                                    and 05-year warranty for the compressor of all other inverter and
                                                    non-inverter Air Conditioner (residential) brands in the range 9000 BTU
                                                    to
                                                    36000 BTU shall apply only if the service agreement is signed with Abans
                                                    Electrical PLC for 04 years at the end of the first year. Customer shall
                                                    bear any charges for the labour and accessories in relation to the
                                                    replacement of the compressor. <br><br>Additional services will be
                                                    provided
                                                    subject to additional payments. <br><br>No warranty for corrosion on
                                                    outdoor
                                                    unit of air conditioner due to environment conditions/sea
                                                    breeze.<br><br>05-year warranty for the compressor of all Air
                                                    Conditioner
                                                    brands (Commercial) in the range of 12000 BTU to 100000 BTU shall apply
                                                    only
                                                    if the service agreement is signed with Abans Electrical PLC for 04
                                                    years at
                                                    the end of the first year. Customer shall bear any charges for the
                                                    labour
                                                    and accessories in relation to the replacement of the compressor.</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Computers Laptops Tablets</strong></td>
                                                <td>Colour dots up to 7 numbers on Laptops, Tablet Screens and Monitors
                                                    shall be
                                                    considered as a normal industrial cause as a result of pixel burnt and
                                                    shall
                                                    not replace the said products on that effect.</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Mobile Phones</strong></td>
                                                <td>12-month warranty for main unit, 06-month for battery and charger,
                                                    01-month
                                                    for any other accessories</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Apple Products</strong></td>
                                                <td>
                                                    <div><strong>The Apple One-Year Limited Warranty is a voluntary
                                                            manufacturer’s warranty that can be claimed from any Apple store
                                                            world-wide and only at Abans Apple Authorized Service
                                                            Centres</strong></div>
                                                    <br>Apple, as defined, warrants Apple-branded hardware product against
                                                    defects in materials and workmanship under normal use for a period of
                                                    ONE
                                                    (1) YEAR from the date of retail purchase by the original end-user
                                                    purchaser
                                                    ("Warranty Period").<br><br>If a hardware defect arises and a valid
                                                    receipt
                                                    is provided within the warranty period, it will be as below in guidance
                                                    as
                                                    per Apple's diagnosis system report set up at the service
                                                    centre.<br><br>
                                                    <ol style="list-style-type: lower-roman;">
                                                        <li>&nbsp;For iPhones, iPads, Apple Watch and Apple branded
                                                            accessories:
                                                            exchange the defective product with a product that is new or
                                                            which
                                                            has been manufactured from new or serviceable used parts and is
                                                            at
                                                            least functionally equivalent to the original product.</li>
                                                        <li>&nbsp;For Macs: repair the hardware defect at no charge, using
                                                            new
                                                            spare parts. Apple Care can be enabled for Macs through service
                                                            before the first year warranty period is over. Once enabled, an
                                                            additional 2-year warranty will be extended (visit the link for
                                                            more
                                                            info <a target="_blank"
                                                                href="https://www.apple.com/legal/sales-support/applecare/appmacapacen.html">Apple
                                                                Legal - AppleCare Protection Plan for Mac</a>).</li>
                                                        <li>&nbsp;If the product is dropped, water damage or physically
                                                            damaged
                                                            due to customer's negligence there will be no warranty for the
                                                            same.
                                                        </li>
                                                        <li>&nbsp;No DOA policy for any Apple products and replacement will
                                                            only
                                                            be done through service.</li>
                                                        <li>&nbsp;A sufficient lead time will be required to get the spare
                                                            parts
                                                            to repair the product or replace the product in guidance with
                                                            Apple.
                                                        </li>
                                                    </ol>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p class="txt-new" style="font-style: italic;">Please note that these are standard
                                    warranty details therefore the warranty remarks/conditions printed on the invoice/
                                    warranty card will be applicable.</p>
                            </div>

                        </div>


                        <div class="tab-pane fade " id="v-pills-five" role="tabpanel"
                            aria-labelledby="v-pills-five-tab">
                            <h3 class="title-terms">Return Products Request</h3>

                            <div class="row">
                                <p class="order-title">Order Information</p>
                                <div class="form-group col-sm-6">
                                    <label class="fs-14">Order ID<span class="req">*</span></label>
                                    <input type="text" class="form-control" name="username" id="username" required>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label class="fs-14">Billing Last Name <span class="req">*</span></label>
                                    <input type="text" class="form-control" name="username" id="username" required>
                                </div>


                                <div class="form-group col-sm-6">
                                    <label class="fs-14">Find Order By <span class="req">*</span></label>
                                    <input type="text" class="form-control" name="orderby" id="orderby" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="fs-14">Email<span class="req">*</span></label>
                                    <input type="text" class="form-control" name="username" id="username" required>
                                </div>

                            </div>

                            <div class="form-group col-sm-12">
                                <div class="tacbox terms-conditions-container">
                                    <input id="t_and_c_agree" type="checkbox" name="t_and_c_agree" required="required"
                                        data-parsley-error-message="Please agree to Terms &amp; Conditions."
                                        data-parsley-errors-container="#t_and_c_error_container"
                                        data-parsley-multiple="t_and_c_agree"> <label for="checkbox" class="fs-14">I
                                        agree
                                        to <a href="terms-and-conditions.html">Terms &amp;
                                            Conditions</a></label>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <button class="btn btn-site-default btn-inq fl">Submit Inquiry</button>
                            </div>

                        </div>

                    </div>
                </div>



    </main>
@endsection
