@extends('frontend.master')

@section('content')
    <style>
        /* body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            } */

        .container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .sidebar {
            width: 225px;
            padding-top: 50px;
            flex-shrink: 0;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            border: 1px solid #ddd;
        }

        .sidebar-nav li {
            border-bottom: 1px solid #ddd;
        }

        .sidebar-nav li:last-child {
            border-bottom: none;
        }

        .sidebar-nav li a {
            display: block;
            padding: 12px 15px;
            text-decoration: none;
            color: #333;
            background-color: #fff;
        }

        .sidebar-nav li.active {
            background-color: #736382;
        }

        .sidebar-nav li.active a {
            color: #fff;
            background-color: #736382;
        }

        .content {
            flex-grow: 1;
            padding: 20px 30px;
        }

        .title-terms {
            color: #6a1b9a;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .monial-graph,
        p {
            margin-bottom: 15px;
            font-size: 14px;
            line-height: 1.6;
        }

        a {
            color: #6a1b9a;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        ul {
            padding-left: 20px;
            margin-bottom: 20px;
        }

        li {

            font-size: 14px;
            line-height: 1.6;
        }

        strong {
            font-weight: 700;
        }

        .content-section {
            margin-top: 30px;
        }

        .pt-2 {
            padding-top: 0.5rem;
        }

        .pb-2 {
            padding-bottom: 0.5rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .warrenty-first-strong,
        .warrenty-second-strong {
            font-weight: 700;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered td {
            border: 1px solid #dee2e6;
            padding: 12px 15px;
            vertical-align: top;
        }

        .table tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }

        strong {
            font-weight: 700;
        }

        .title-terms {
            font-size: 18px;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 15px;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .txt-new {
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        ol {
            padding-left: 20px;
        }

        ol li {
            margin-bottom: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .contact-box-wrapper {
            display: flex;
            gap: 100px;
            flex-wrap: wrap;
        }

        .border-box-table {
            border: 1px solid purple;
            padding: 35px;
            width: 40%;
            box-sizing: border-box;
        }

        .border-box-table p {
            margin: 0 0 20px;
        }

        .border-box-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .border-box-table td {
            padding: 2px 6px;
            font-size: 14px;
        }
    </style>

    <div class="container" style="margin-top: 20px;">

        <div class="sidebar">
            <ul class="sidebar-nav">
                <li class="active"><a href="#">Terms and Conditions</a></li>
                <li><a href="#" style="font-weight: normal;">Privacy Policy</a></li>
                <li><a href="#" style="font-weight: normal;">Return and Refund Policy</a></li>
            </ul>
        </div>

        <div class="content">
            <h3 class="title-terms">Terms & Conditions</h3>
            <p>
                Welcome to <a href="www.BuyAbans.com">www.BuyAbans.com</a>, the online
                purchasing platform for Abans PLC (Sri Lanka). The BuyAbans.com website
                provides services to its valued customers under the following
                conditions. Please read and accept the under-mentioned conditions and
                guidelines carefully before using the services of this website.
            </p>
            <h3 class="title-terms">Product information at BuyAbans.com website</h3>
            <p>
                The BuyAbans.com website attempts to be as accurate as possible with the
                information displayed on the site. However, BuyAbans.com does not
                guarantee that product descriptions or other content on this site are
                100% accurate, complete, reliable or completely free of errors. If a
                product offered by BuyAbans.com is not as described on the website, a
                customer's sole remedy is to return it in an unused condition within two
                days of delivery. If there is any external damage to the package, a
                customer is responsible for checking the item when it is handed over. An
                item will not be exchanged for a refund or replacement if there is
                external damage e.g. packaging damage or dents. Refunds or replacements
                will only apply for items with confirmed technical in-built faults and
                are subjected to a fine or penalty for the cost.
            </p>
            <p>
                In case the item received is found defective, customers should
                immediately inform BuyAbans.com within 24 hours to arrange a replacement
                with a brand-new unit or a full refund will be provided if the stock is
                unavailable.
            </p>
            <p>
                Regarding the items sold through BuyAbans.com, the price of an item
                cannot be confirmed until the customer orders the item. Even though
                every effort is made to provide accurate pricing, there may be a
                negligible probability that some items can be mispriced. If the new
                price is higher than the mentioned price, we will not cancel or deliver
                the item without your confirmation about the new price, and all
                cancellations of items will be informed prior. If the new price is
                higher and you still wish to purchase, you can pay the additional amount
                but if you decide to cancel, we will issue a refund.
            </p>
            <p>
                Due to current international exchange laws and conventions, even if
                delivery of the selected item is canceled, BuyAbans.com cannot refund
                your money. You will, however, be provided with credit on the website to
                purchase another available product up to the value of the previous item.
            </p>
            <div>
                <h3 class="title-terms">Return and Refund Policy</h3>
                <ul>
                    <li>
                        <strong>Period :</strong>
                        BuyAbans must be informed within 3 days for Electronics & 7 days for
                        Lifestyle brands (Skechers, Under Armour, Hugo Boss) of receiving
                        the item to be eligible for return.
                    </li>
                    <li>
                        Item must be in the original packaging with tags intact in the same
                        condition it was delivered in.
                    </li>
                    <li>
                        Items returned after the Return Period has lapsed will not be
                        accepted.
                    </li>
                    <li>
                        Our customers' safety is of utmost importance, and we take hygiene
                        very seriously. Therefore, items such as underwear, bras, briefs,
                        and swimwear are not eligible for return.
                    </li>
                    <li>
                        Items to be returned are the sole responsibility of the customer
                        until they reach us, and customer needs to ensure items are properly
                        packed to prevent any damages en route to us. Items damaged en route
                        will not be accepted.
                    </li>
                    <li>
                        It is the customer's responsibility to ensure proof of postage for
                        parcels that contain items to be returned.
                    </li>
                    <li>
                        BuyAbans will require minimum 05-07 business days to process your
                        return request and prepare the replacement unit.
                    </li>
                </ul>
            </div>
            <div class="content-section">
                <h3 class="title-terms">Refund Policy</h3>
                <ul>
                    <li>
                        If a replacement unit for the size/specific model is no longer
                        available, the customer will be issued a full refund. The refund
                        will not include any delivery charges borne by the customer for
                        return of item.
                    </li>
                    <li>
                        All refunds will be processed within 3-5 working days. Processing
                        refunds back to your credit card/ bank account may require
                        additional time depending on the bank due to its own operational
                        time for which BuyAbans will not be responsible.
                    </li>
                    <li>
                        In the event of purchasing an AC unit with low capacity, the
                        consumer is only eligible for a credit note for the amount of their
                        purchase or they can switch to a unit with a higher capacity.
                        BuyAbans.com will not be issuing refunds for these cases.
                    </li>
                    <li>
                        Customers can use the BTU calculator when purchasing AC to calculate
                        the exact capacity that best suits their needs by providing an exact
                        measurement of the site, or they can call
                        <a href="tel:+94112222888">0112 222 888</a> for further assistance.
                    </li>
                    <li>
                        The total warranty and the comprehensive warranty will not apply if
                        an under-capacity air conditioner is purchased.
                    </li>
                    <li>
                        All manufacturing and material defects that require repair or return
                        must be informed and returned to BuyAbans within the warranty period
                        of 30 days. Any repair or return that failed to be reported or
                        returned within the specified time frame will not be accepted or
                        refunded.
                    </li>
                    <li>
                        Refunds will not be provided for change of mind. All sales are
                        final. Refunds will only be issued under specific circumstances as
                        outlined in our policy.
                    </li>
                </ul>
                <p class="pt-2 pb-2">
                    The prices for all the items mentioned on
                    <a href="www.buyabans.com">BuyAbans.com</a> are the final and last
                    prices of sale via online means.
                </p>
            </div>
            <div>
                <h3 class="title-terms">Using BuyAbans.com accounts</h3>
                <p>
                    It is the responsibility of the users of this site to keep their
                    passwords, other account information, and the computer used to log on
                    to the site, secure. Website account holders are solely responsible
                    for all activities conducted via through their BuyAbans.com account or
                    their passwords and BuyAbans shall be indemnified from any such
                    liability.
                </p>
            </div>
            <div>
                <h3 class="title-terms">
                    Abans Duty Free purchase via www.BuyAbans.com
                </h3>
                <p>
                    The payment will be considered as conditional purchase as the
                    transaction will complete once the passenger physically arrives to the
                    BIA and fulfil the requirements of the custom regulations, therefore
                    in case of cancellation or refund of payment we will follow up the
                    refund/cancellation policy as stated. Please note that a full refund
                    will be credited if the information provided in the portal does not
                    tally with original documents upon arrival (subject to SL Customs
                    approval). In addition, note that the payment will be consider only as
                    a pre-payment and the legal right to claim the goods from the
                    duty-free shop will only be processed upon the exchange of the items
                    physically at our Duty-free shop. BuyAbans website has the legal right
                    to process a refund in any case upon the approval of the Sri Lanka
                    Customs officers based at Bandaranayake International Airport (BIA).
                </p>
                <p>
                    The total allowance applicable for an incoming passenger includes
                    their accompanied passenger luggage and the dutiable goods in their
                    unaccompanied passenger baggage (UPB).
                </p>
            </div>
            <div>
                <h3 class="title-terms mb-4">Warranty</h3>
                <p>
                    The warranty provided through the BuyAbans.com website is the same as
                    the common warranty provided to all Abans PLC showrooms. For any
                    warranty-related issues, please contact the Service Centre via the
                    contact details on the warranty card.
                </p>
                <p>
                    We guarantee that all products sold by Abans PLC are in good quality
                    and working order and tested for quality and handed over to the
                    customer for normal and standard usage, subject to the following terms
                    and conditions. Abans PLC agrees to repair the manufacturing defects
                    in products on free of charge basis only
                    <strong class="warrenty-first-strong">within the 01-year standard warranty period except for
                        products
                        covered under different warranty periods.</strong>
                </p>
                <p>
                    Extended warranty will be provided subject to payments, for extended
                    warranty terms and conditions refer the extended warranty card.
                </p>
                <p>
                    The warranty will not be effective for
                    <strong class="warrenty-second-strong">
                        repairs/installations/services done by any 03rd party other than
                        Abans Electricals PLC/Abans PLC or its authorized service agents,
                        damage caused by ancillary equipment and non-recommended
                        accessories, normal wear, tear and corrosion, corrosion of copper
                        tanks, promotional Items given free of charge with the main product,
                        damages due to split and liquid, drop damages, seepage, secretion
                        from insects, rodents or domestic pets, accident, fire, theft, act
                        of god, power surges, electrical leakage, voltage fluctuations,
                        negligence, misuse, abuse, incorrect installations, modifications,
                        improper testing operation, maintenance installation, charging of
                        batteries other than standard charges, defaced, obliterated or
                        removed, substance damage to coil cards and connectors due to
                        misuse, damage due to shock or external force, lightning, being
                        operated in alkaline or unsuitable atmosphere, use of products
                        outside specification, use for purpose not recommended, use beyond
                        the guidelines, directions and user capacity of product,
                        alterations, defaced or suspected warranty cards and serial number
                        alteration, unclear rubber stamp of showroom managers and dealers,
                        any damage or loss to any 03rd party or property, batteries,
                        chargers, carrying cases, laptop bags, power adaptors, power cables,
                        internet connection cables, printer cables, cartridges, toner,
                        knobs, locks, bulbs, filters, racks, shelves, gas charging,
                        switches, remote controllers, AV cables, antenna cables, inter
                        connection cables, brushers, drive belts, pulleys, pads, plug tops,
                        burner caps, trivet, tube, ignition plugs, telephone shower, plastic
                        jug, blades, handles, lids, pouches, speaker cables, speakers,
                        speaker boxes, water tap and any other consumable parts.</strong>
                </p>
                <p>
                    Failure to install software, video, audio and file formats are not
                    considered as manufacturing defects. No warranty is provided for the
                    quality of the software and hardware used by the customer, hardware
                    and software defects and corruption, virus attacks, spywares, firmware
                    upgrades, defects due to use of third-party application and
                    unauthorized and illegal software and company will not be responsible
                    for any data losses at point of repair.
                </p>
                <p>
                    If the product delivered by the company contains any damage during
                    transit or handling, customer shall be informed at the same time on
                    date of delivery. If the product is delivered by the customer, company
                    shall not be liable for any damage arising while transporting.
                    Customer is advised to check before moving out product from showroom
                    premises/Duty Free showrooms.
                </p>
                <p>
                    Services shall not be provided if Hire Purchase Instalments are due.
                </p>
                <p>
                    If the product is beyond economical repair, product replacement with
                    similar working condition and warranty shall be effective for
                    remaining period.
                </p>
                <p>
                    It is recommended to use the product with power guard and stabilizers.
                </p>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 30%">
                                <strong>Refrigerators Bottle Coolers Freezers</strong>
                            </td>
                            <td style="width: 70%">
                                05 years for compressor only. Customer shall bear any charges
                                for labour or accessories in relation to the replacement of
                                compressor. 10-Year warranty shall apply only on compressors of
                                selected refrigerator models. Humidity on the surface shall not
                                be considered as defect.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Televisions LCD/LED</strong>
                            </td>
                            <td>
                                If it is a manufacturing fault within the warranty period, Abans
                                PLC will repair it free of charge.
                                <br />
                                <br />
                                1-year warranty for panel and 3-year warranty for other parts
                                including Main and Power PCB.
                                <br />
                                <br />
                                Colour dots up to 7 numbers on LCD/LED TV screens shall be
                                considered as a normal industrial cause as a result of pixel
                                burnt and shall not replace the said products on that effect.
                                <br />
                                <br />
                                No warranty for Main/Power PCB damages due to signal wire
                                connections/careless plugging/unplugging and usage of multi
                                plugs.
                                <br />
                                <br />
                                No replacements allowed for back light replacements. No warranty
                                for TV and AV accessories / remotes / speakers / mics / wires /
                                HDMI ports / Cables.
                                <br />
                                Televisions fixed on mobile vehicles shall not be covered under
                                this warranty.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Audio</strong>
                            </td>
                            <td>
                                No warranty for Speaker body corrosion, colour fading and
                                fungus.
                                <br />
                                No warranty for Remote / Audio Speakers / Mics / Wires / Jacks.
                                <br />
                                <br />
                                If similar model is not available and customer request for
                                refund, the refund value depends on the usage period.
                                <br />
                                Usage Period 00-06 months: Refund 85% from the invoiced value.
                                <br />
                                Usage Period 06-12 months: Refund 75% from the invoiced value.
                                <br />
                                <br />
                                <strong>When customer request upgrade</strong>
                                <br />
                                Usage Period 00-06 months: Get balance amount + Remaining
                                warranty.
                                <br />
                                Usage Period 06-12 months: Get balance amount + Remaining
                                warranty.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Washing Machine</strong>
                            </td>
                            <td>
                                05/10-year warranty on Stainless Steel Drum against rusting /
                                Direct Drive or Smart Inverter Motor for selected models only.
                                <br />
                                05-year warranty on selected washing machines.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Water Purifier</strong>
                            </td>
                            <td>Refer warranty instruction sheet for more details.</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Solar System</strong>
                            </td>
                            <td>Refer warranty instruction sheet for more details.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table2" style="margin-top: 30px">
                <p class="title-terms mb-4">SPECIAL WARRANTY TERMS</p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width: 30%">
                                    <strong>Product</strong>
                                </td>
                                <td style="width: 70%">
                                    <strong>Special Warranty Terms for Products / Parts /
                                        Accessories</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Air Conditioners</strong>
                                </td>
                                <td>
                                    Within the standard one-year warranty period, 3 services will
                                    be provided free of charge.
                                    <br />
                                    <br />
                                    10-year warranty for the compressor of the LG Inverter Air
                                    Conditioner (residential) in the range of 9000 BTU to 24000
                                    BTU and 05-year warranty for the compressor of all other
                                    inverter and non-inverter Air Conditioner (residential) brands
                                    in the range 9000 BTU to 36000 BTU shall apply only if the
                                    service agreement is signed with Abans Electrical PLC for 04
                                    years at the end of the first year. Customer shall bear any
                                    charges for the labour and accessories in relation to the
                                    replacement of the compressor.
                                    <br />
                                    <br />
                                    Additional services will be provided subject to additional
                                    payments.
                                    <br />
                                    <br />
                                    No warranty for corrosion on outdoor unit of air conditioner
                                    due to environment conditions/sea breeze.
                                    <br />
                                    <br />
                                    05-year warranty for the compressor of all Air Conditioner
                                    brands (Commercial) in the range of 12000 BTU to 100000 BTU
                                    shall apply only if the service agreement is signed with Abans
                                    Electrical PLC for 04 years at the end of the first year.
                                    Customer shall bear any charges for the labour and accessories
                                    in relation to the replacement of the compressor.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Computer Laptops Tablets</strong>
                                </td>
                                <td>
                                    Colour dots up to 7 numbers on Laptops, Tablet Screens and
                                    Monitors shall be considered as a normal industrial cause as a
                                    result of pixel burnt and shall not replace the said products
                                    on that effect.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Mobile Phones</strong>
                                </td>
                                <td>
                                    12-month warranty for main unit, 06-month for battery and
                                    charger, 01-month for any other accessories
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Apple Products</strong>
                                </td>
                                <td>
                                    <div>
                                        <strong>
                                            The Apple One-Year Limited Warranty is a voluntary
                                            manufacturer's warranty that can be claimed from any Apple
                                            store world-wide and only at Abans Apple Authorized
                                            Service Centres
                                        </strong>
                                    </div>
                                    <br />
                                    Apple, as defined, warrants Apple-branded hardware product
                                    against defects in materials and workmanship under normal use
                                    for a period of ONE (1) YEAR from the date of retail purchase
                                    by the original end-user purchaser ("Warranty Period").
                                    <br />
                                    <br />
                                    If a hardware defect arises and a valid receipt is provided
                                    within the warranty period, it will be as below in guidance as
                                    per Apple's diagnosis system report set up at the service
                                    centre.
                                    <br />
                                    <br />
                                    <ol style="list-style-type: lower-roman">
                                        <li>
                                            For iPhones, iPads, Apple Watch and Apple branded
                                            accessories: exchange the defective product with a product
                                            that is new or which has been manufactured from new or
                                            serviceable used parts and is at least functionally
                                            equivalent to the original product.
                                        </li>
                                        <li>
                                            For Macs: repair the hardware defect at no charge, using
                                            new spare parts. Apple Care can be enabled for Macs
                                            through service before the first year warranty period is
                                            over. Once enabled, an additional 2-year warranty will be
                                            extended (visit the link for more info
                                            <a target="_blank"
                                                href="https://www.apple.com/legal/sales-support/applecare/appmacapacen.html">
                                                Apple Legal - AppleCare Protection Plan for Mac
                                            </a>
                                            ).
                                        </li>
                                        <li>
                                            If the product is dropped, water damage or physically
                                            damaged due to customer's negligence there will be no
                                            warranty for the same.
                                        </li>
                                        <li>
                                            No DOA policy for any Apple products and replacement will
                                            only be done through service.
                                        </li>
                                        <li>
                                            A sufficient lead time will be required to get the spare
                                            parts to repair the product or replace the product in
                                            guidance with Apple.
                                        </li>
                                    </ol>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="txt-new" style="font-style: italic">
                    Please note that these are standard warranty details therefore the
                    warranty remarks/conditions printed on the invoice/ warranty card will
                    be applicable.
                </p>
            </div>
            <div>
                <h3 class="title-terms">Exchange of Goods:</h3>
                <p>
                    BuyAbans.com may exchange the purchased item on valid for another item
                    requested by the customer. The said customer will have to pay for any
                    difference in the price and that payment will also need to be
                    completed within 48 hours from the time of purchase.
                </p>
                <p>
                    BuyAbans.com is not allowed to exchange any goods purchased at the BIA
                    Duty Free unless the products sold contain internal technical
                    faults.BuyAbans.com can only provide like-for-like exchanges when
                    stock is available at our showrooms outside the Duty-Free zones.
                </p>
            </div>
            <div>
                <h3 class="title-terms">
                    Policy for information gathered by BuyAbans.com
                </h3>
                <p>
                    All information entered in to BuyAbans.com by site visitors will be
                    collected and stored. If certain visitors decide not to provide
                    certain information, they will not be able to acquire the valuable
                    advantages and features of this website. This vital information is
                    used for quick and fruitful responses to your requests, and for
                    communicating with you in present and future instances. Information
                    about customers is important to BuyAbans and will be treated with
                    utmost confidentiality and will not be divulged to 03rd parties.
                    Customer information is used only as described below and with
                    affiliates of BuyAbans.com.
                </p>
                <p>
                    <i>
                        Note: Customer is responsible for informing the change of his/her
                        phone no. and/or email address to Buyabans.
                    </i>
                </p>
            </div>
            <div>
                <h3 class="title-terms">Copyrights</h3>
                <p>
                    The content of the BuyAbans.com site is the property of Abans PLC (Sri
                    Lanka) and is protected under international copyright laws. The
                    trademark of www.BuyAbans.com is a registered trademark and the sole
                    rights of changing, modifying, assigning, or using this trademark is
                    solely with Abans PLC (Sri Lanka). Anyone other than Abans PLC who is
                    involved in changing, modifying, assigning, or using this trademark
                    without prior written authorization of Abans PLC (Sri Lanka) will be
                    violating international copyright laws.
                </p>
            </div>
            <div>
                <h3 class="title-terms">Communication between you and BuyAbans.com</h3>
                <p>
                    When you visit the BuyAbans.com website or communicate with
                    BuyAbans.com via e-mails, you are considered as communicating with
                    BuyAbans.com. This permits BuyAbans.com to send e-mails and to
                    communicate with you and you are deemed as agreeing to all terms and
                    conditions, notices and other means of communications that we provide
                    to you electronically, satisfying all legal requirements.
                </p>
            </div>
            <div>
                <h3 class="title-terms">Contact Details:</h3>
                <div class="contact-box-wrapper">
                    <div class="border-box-table">
                        <p><strong>www.Buyabans.com</strong></p>
                        <p>
                            No. 498, <br />
                            Galle Road, Colombo 03.<br />
                            Sri Lanka
                        </p>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Tel</td>
                                    <td>: +94 112 222 888</td>
                                </tr>
                                <tr>
                                    <td>Web</td>
                                    <td>: www.Buyabans.com</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="border-box-table">
                        <p><strong>Abans PLC</strong></p>
                        <p>
                            No. 498, <br />
                            Galle Road, Colombo 03.<br />
                            Sri Lanka
                        </p>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Tel</td>
                                    <td>: +94 11 555 5888</td>
                                </tr>
                                <tr>
                                    <td>Fax</td>
                                    <td>: +94 11 461 7444</td>
                                </tr>
                                <tr>
                                    <td>Web</td>
                                    <td>: www.buyabans.com</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
