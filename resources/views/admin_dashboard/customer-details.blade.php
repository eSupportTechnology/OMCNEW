@extends('layouts.admin_main.master')

@section('content')

    <style>
        .card {
            margin-bottom: 20px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .order-cards-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }


        .details-cards-row {
            display: flex;
            justify-content: space-between;
        }

        .details-cards-row .item-details-card {
            width: 100%;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .card-name {
            font-size: 14px;
            font-weight: 500;
        }

        .icon-container {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background-color: white;
            margin: auto;
        }
    </style>

    <main style="margin-top: 58px">
        <div class="container px-5 py-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-1">Customer Details</h3>
            </div>

            <div class="order-cards-row mt-2 d-flex">
                <div class="card" style="width: 40%;">
                    <div class="card-title">Profile</div>
                    <div class="card-body p-2">
                        <div class="text-center">
                            <div class="profile-image mb-3">
                                <img src="{{ $customer->profile_image ? asset('storage/' . $customer->profile_image) : asset('assets/images/default-user.png') }}"
                                    alt="Profile Image" class="rounded-circle" width="100" height="100"
                                    style="object-fit: cover;">
                            </div>
                            <p class="mb-1 text-muted">USER ID: #{{ str_pad($customer->id, 4, '0', STR_PAD_LEFT) }}</p>
                            <h5 class="mb-2">{{ $customer->name }}</h5>
                        </div>

                        <div class="text-start ps-3 mt-4">
                            <p class="mb-1"><i class="fa fa-envelope me-3"></i>{{ $customer->email }}</p>
                            <p class="mb-1"><i class="fa-solid fa-phone me-3"></i>{{ $customer->phone_num }}</p>
                            <p class="mb-1"><i class="fa fa-birthday-cake me-3"></i>{{ $customer->date_of_birth }}</p>
                            <p class="mb-1"><i class="fa-solid fa-address-book me-3"></i>{{ $customer->address }},
                                {{ $customer->district }}</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap" style="width: 55%; height: auto;">
                    <div class="card me-2 mb-2"
                        style="flex: 1 1 45%; height: 45%; border: 1px dotted #007bff; background-color: #f0f8ff;">
                        <div class="card-body text-center">
                            <div class="icon-container" style="border: 2px dotted #007bff;">
                                <i class="fa fa-dollar-sign" style="color: #007bff; font-size: 28px;"></i>
                            </div>
                            <h4 class="fw-bold mt-2">Rs {{ number_format($totalCost, 2) }}</h4>
                            <div class="card-name">TOTAL COST</div>
                        </div>
                    </div>
                    <div class="card me-2 mb-2"
                        style="flex: 1 1 44%; height: 45%; border: 1px dotted #28a745; background-color: #eafaf1;">
                        <div class="card-body text-center">
                            <div class="icon-container" style="border: 2px dotted #28a745;">
                                <i class="fa fa-shopping-cart" style="color: #28a745; font-size: 28px;"></i>
                            </div>
                            <h4 class="fw-bold mt-2">{{ $totalOrders }}</h4>
                            <div class="card-name">TOTAL ORDERS</div>
                        </div>
                    </div>
                    <div class="card me-2 mb-2"
                        style="flex: 1 1 45%; height: 45%; border: 1px dotted #ffc107; background-color: #fff8e1;">
                        <div class="card-body text-center">
                            <div class="icon-container" style="border: 2px dotted #ffc107; ">
                                <i class="fa fa-box" style="color: #ffc107; font-size: 28px;"></i>
                            </div>
                            <h4 class="fw-bold mt-2">{{ $totalProducts }}</h4>
                            <div class="card-name">TOTAL PRODUCTS</div>
                        </div>
                    </div>
                    <div class="card me-2 mb-2"
                        style="flex: 1 1 44%; height: 45%; border: 1px dotted #dc3545; background-color: #ffeef0;">
                        <div class="card-body text-center">
                            <div class="icon-container" style="border: 2px dotted #dc3545;">
                                <i class="fa fa-star" style="color: #dc3545; font-size: 28px;"></i>
                            </div>
                            <h4 class="fw-bold mt-2">{{ $totalReviews }}</h4>
                            <div class="card-name">TOTAL REVIEWS</div>
                        </div>
                    </div>
                </div>

            </div>



            <div class="details-cards-row">
                <div class="card item-details-card">
                    <div class="card-title">Customer Order History</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if ($orders->isEmpty())
                                <div class="text-center" style="padding: 20px;">
                                    <p>No orders found for this customer.</p>
                                </div>
                            @else
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Items</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>#{{ $order->order_code }}</td>
                                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <div class="order-card-body"
                                                        style="display: flex; align-items: center;">
                                                        @php
                                                            $firstItem = $order->items->first();
                                                            $productImage = null;
                                                            $totalCount = $order->items->count();
                                                            $itemsToShow = $order->items->take(1);
                                                            $additionalCount = $totalCount - $itemsToShow->count();

                                                            if (
                                                                $firstItem &&
                                                                $firstItem->product &&
                                                                $firstItem->product->images->isNotEmpty()
                                                            ) {
                                                                $productImage = $firstItem->product->images->first();
                                                            }
                                                        @endphp
                                                        @if ($productImage)
                                                            <img src="{{ asset('storage/' . $productImage->image_path) }}"
                                                                alt="Product Image" width="50">
                                                        @else
                                                            <p>No image available</p>
                                                        @endif
                                                        @if ($additionalCount > 0)
                                                            <span class="additional-count"
                                                                style="position: relative; top: 15px; margin-left: -28px; background: rgba(0, 0, 0, 0.3); color: white; padding: 5px; border-radius: 5px;">+{{ $additionalCount }}</span>
                                                        @endif
                                                        <div style="margin-left: 10px;">
                                                            <p class="order-summary">
                                                                @foreach ($itemsToShow as $item)
                                                                    {{ $item->product->product_name }}{{ !$loop->last ? ' | ' : '' }}
                                                                @endforeach
                                                                @if ($totalCount > 1)
                                                                    <strong style="font-weight: 500;">&
                                                                        {{ $additionalCount }} more
                                                                        item{{ $additionalCount > 1 ? 's' : '' }}</strong>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Rs {{ $order->total_cost }}</td>
                                                <td>
                                                    <span
                                                        class="status {{ strtolower(str_replace(' ', '-', $order->status)) }} fw-bold">
                                                        {{ $order->status }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </main>

@endsection
