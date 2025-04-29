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

    .order-cards-row .card {
        width: 32%;
    }

    .details-cards-row {
        display: flex;
        justify-content: space-between;
    }

    .details-cards-row .item-details-card {
        width: 70%;
    }

    .details-cards-row .summary-card {
        width: 28%;
    }

    .table th, .table td {
        vertical-align: middle;
    }

</style>  

<main style="margin-top: 58px">
    <div class="container px-5 py-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="me-auto"> 
                <h3 class="mb-1">Order Details</h3>
                <h5 class="mb-1 mt-2">Order #{{ $order->order_code }}</h5>
                <span class="status {{ strtolower(str_replace(' ', '-', $order->status)) }} fw-bold" style="font-size: 13px;">
                    {{ $order->status }}
                </span>
            </div>
            <div style="width: 20%;">
                <div>Update Order Status</div>
                <div class="card-body">
                    <form action="{{ route('update_order_status', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <select id="orderStatus" name="status" class="form-select" required>
                                <option value="In Progress" {{ $order->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary p-2">Update</button>
                    </form>
                </div>
            </div>
        </div>



        <div class="order-cards-row mt-2">
            <div class="card">
                <div class="card-title">Customer Details</div>
                <div class="card-body p-0">
                    <p class="mb-1">Name: {{ $order->customer_fname }} {{ $order->customer_lname }}</p>
                    <p class="mb-1">Email: {{ $order->email }}</p>
                    <p class="mb-1">Contact No.: {{ $order->phone }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-title">Shipping Details</div>
                <div class="card-body p-0">
                    <p class="mb-0">Shipping Address: {{ $order->address }}, {{ $order->apartment }}</p>
                    <p class="mb-0">City: {{ $order->city }}</p>
                    <p class="mb-0">Postal Code: {{ $order->postal_code }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-title">Billing Details</div>
                <div class="card-body p-0">
                    <p class="mb-0">Payment Method: {{ $order->payment_method }}</p>
                    <p class="mb-0">Amount Charged: Rs {{ number_format($order->total_cost, 2) }}</p>
                    <p class="mb-0">Payment Status: {{ $order->payment_status }}</p>
                </div>
            </div>
        </div>

        <!-- Cards for Item Details and Order Summary -->
        <div class="details-cards-row">
            <div class="card item-details-card">
                <div class="card-title">Item Details ({{ $totalQuantity }} items)</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Product ID</th>
                                    <th scope="col">Image</th> 
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Size</th>
                                    <th scope="col" style="width:20%">Unit Price</th>
                                    <th scope="col" style="width:20%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->product_id }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" alt="Product Image" width="50">
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>
                                        @if($item->color)
                                            <span style="display: inline-block; width: 20px; height: 20px; background-color: {{ $item->color }}; border: 1px solid #e8ebec; border-radius: 50%;"></span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->size ? $item->size : '-' }}
                                    </td>
                                    <td>Rs {{ number_format($item->cost, 2) }}</td>
                                    <td>Rs {{ number_format($item->quantity * $item->cost, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card summary-card" style="height: 250px;">
                <div class="card-title">Order Summary</div>
                <div class="card-body">
                    <p>Subtotal: Rs {{ number_format($order->total_cost - 300, 2) }}</p>
                    <p>Delivery Charge: Rs 300.00</p>
                    <hr>
                    <p><strong>Total: Rs {{ number_format($order->total_cost, 2) }}</strong></p>
                </div>
            </div>
        </div>


    

        
    </div>
</main>
@endsection