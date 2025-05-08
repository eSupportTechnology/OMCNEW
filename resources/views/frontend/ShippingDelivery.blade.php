@extends('frontend.master')

@section('content')
    <style>
        /* body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                margin: 0;
                padding: 0;
                display: flex;
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
            color: #5a2382;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        ol {
            padding-left: 20px;
        }

        .monial-graph {
            margin-bottom: 15px;
            color: #666;
        }

        .table-responsive {
            margin-top: 20px;
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
            padding: 10px 15px;
        }

        tr:first-child td {
            background-color: #f9f9f9;
        }

        td strong {
            font-weight: bold;
        }

        td:first-child {
            width: 50%;
        }

        td:last-child {
            width: 50%;
            font-weight: 500;
        }
    </style>

    <body>
        <div class="container" style="margin-top: 20px;">

            <div class="sidebar">
                <ul class="sidebar-nav">
                    <li><a href="#" style="font-weight: normal;">FAQ</a></li>
                    <li><a href="#" style="font-weight: normal;">How To Buy</a></li>
                    <li class="active"><a href="#">Shipping & Delivery</a></li>
                    <li><a href="#" style="font-weight: normal;">Warranty Information</a></li>
                    <li><a href="#" style="font-weight: normal;">Return Products</a></li>
                </ul>
            </div>


            <div class="content">
                <h3 class="title-terms">Shipping & Delivery</h3>
                <ol>
                    <li class="monial-graph">
                        Items ordered online on BuyAbans.com will be delivered in within 3 to
                        5 working days anywhere in Sri Lanka.
                    </li>
                    <li class="monial-graph">
                        Estimated delivery time may vary based on the availability of items
                        ordered and the delivery address.
                    </li>
                    <li class="monial-graph">
                        The following delivery charges will apply based on the total value of
                        your order.
                    </li>
                </ol>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr style="height: 18px">
                                <td style="width: 50%; height: 18px">
                                    <strong>Order Amount (Rs.)</strong>
                                </td>
                                <td style="width: 50%; height: 18px">
                                    <strong>Delivery Charge</strong>
                                </td>
                            </tr>
                            <tr style="height: 18px">
                                <td style="width: 50%; height: 18px">Up to 10,000</td>
                                <td style="width: 50%; height: 18px">Rs. 490</td>
                            </tr>
                            <tr style="height: 18px">
                                <td style="width: 50%; height: 18px">10,001 – 20,000</td>
                                <td style="width: 50%; height: 18px">Rs. 590</td>
                            </tr>
                            <tr>
                                <td style="width: 50%">20,001 - 50,000</td>
                                <td style="width: 50%">Rs. 790</td>
                            </tr>
                            <tr>
                                <td style="width: 50%">50,001 - 100,000</td>
                                <td style="width: 50%">Rs. 1090</td>
                            </tr>
                            <tr>
                                <td style="width: 50%">100,001 - 200,000</td>
                                <td style="width: 50%">Rs. 1590</td>
                            </tr>
                            <tr>
                                <td style="width: 50%">200,001 & above</td>
                                <td style="width: 50%">Rs. 2090</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
