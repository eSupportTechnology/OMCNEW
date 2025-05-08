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

        .monial-graph {
            margin-bottom: 15px;
            font-size: 14px;
            line-height: 1.6;
        }

        a {
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
    </style>

    <div class="container" style="margin-top: 20px;">

        <div class="sidebar">
            <ul class="sidebar-nav">
                <li><a href="#" style="font-weight: normal">Terms and Conditions</a></li>
                <li><a href="#" style="font-weight: normal">Privacy Policy</a></li>
                <li class="active"><a href="#">Return and Refund Policy</a></li>
            </ul>
        </div>

        <div class="content">
            <h3 class="title-terms">Return and Refund Policy</h3>
            <ul>
                <li>
                    <strong>Period :</strong>
                    BuyAbans must be informed within 3 days for Electronics & 7 days for Lifestyle brands (Skechers,
                    Under Armour, Hugo Boss) of receiving the item to be eligible for return.
                </li>
                <li>
                    Item must be in the original packaging with tags intact in the same condition it was delivered
                    in.
                </li>
                <li>
                    Items returned after the Return Period has lapsed will not be accepted.
                </li>
                <li>
                    Our customers' safety is of utmost importance, and we take hygiene very seriously. Therefore,
                    items
                    such as underwear, bras, briefs, and swimwear are not eligible for return.
                </li>
                <li>
                    Items to be returned are the sole responsibility of the customer until they reach us, and
                    customer
                    needs to ensure items are properly packed to prevent any damages en route to us. Items damaged
                    en
                    route will not be accepted.
                </li>
                <li>
                    It is the customer's responsibility to ensure proof of postage for parcels that contain items to
                    be
                    returned.
                </li>
                <li>
                    BuyAbans will require minimum 05-07 business days to process your return request and prepare the
                    replacement unit.
                </li>
            </ul>

            <div class="content-section">
                <h3 class="title-terms">Refund Policy</h3>
                <ul>
                    <li>
                        If a replacement unit for the size/specific model is no longer available, the customer will
                        be
                        issued a full refund. The refund will not include any delivery charges borne by the customer
                        for
                        return of item.
                    </li>
                    <li>
                        All refunds will be processed within 3-5 working days. Processing refunds back to your
                        credit
                        card/ bank account may require additional time depending on the bank due to its own
                        operational
                        time for which BuyAbans will not be responsible.
                    </li>
                    <li>
                        In the event of purchasing an AC unit with low capacity, the consumer is only eligible for a
                        credit note for the amount of their purchase or they can switch to a unit with a higher
                        capacity. BuyAbans.com will not be issuing refunds for these cases.
                    </li>
                    <li>
                        Customers can use the BTU calculator when purchasing AC to calculate the exact capacity that
                        best suits their needs by providing an exact measurement of the site, or they can call <a
                            href="tel:+94112222888">0112 222 888</a> for further assistance.
                    </li>
                    <li>
                        The total warranty and the comprehensive warranty will not apply if an under-capacity air
                        conditioner is purchased.
                    </li>
                    <li>
                        All manufacturing and material defects that require repair or return must be informed and
                        returned to BuyAbans within the warranty period of 30 days. Any repair or return that failed
                        to
                        be reported or returned within the specified time frame will not be accepted or refunded.
                    </li>
                    <li>
                        Refunds will not be provided for change of mind. All sales are final. Refunds will only be
                        issued under specific circumstances as outlined in our policy.
                    </li>
                </ul>
                <p class="monial-graph pt-2 pb-2">
                    The prices for all the items mentioned on <a href="www.buyabans.com">BuyAbans.com</a> are the
                    final
                    and last prices of sale via online means.
                </p>
            </div>
        </div>
    </div>
@endsection
