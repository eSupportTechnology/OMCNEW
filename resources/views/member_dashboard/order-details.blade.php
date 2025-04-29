@extends('member_dashboard.user_sidebar')

@section('dashboard-content')


<style>
    .card-order {
        margin: 10px; 
        padding: 15px;
        display: flex; 
        flex-direction: column;
        justify-content: space-between;
    }

    .card-title {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .orderdetail-cards-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .orderdetail-cards-row .card {
        width: 48%; 
    }


    .order-card {
    border: 1px solid #e8ebec;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
}



</style>

<h4 class="py-2 px-4">Order Details</h4>
<h6 class="px-4">Order ID: {{ $order->order_code }}</h6>
<h6 class="px-4 order-date">Order date: {{ $order->date }}</h6>
<h6 class="px-4 order-date">
    <span class="status {{ strtolower(str_replace(' ', '-', $order->status)) }}">
        {{ $order->status }}
    </span>
</h6>


<div class="card" style="z-index: 0; border:none;">
    <div class="d-flex justify-content-center">
        <div class="col-12">
            <div class="container">
                <div class="card-body px-5 mt-4 mb-3">
                    <ul id="progressbar-2" class="d-flex justify-content-between mx-0 mt-0 px-0 pt-0">
                        <li class="step0 {{ $order->status === 'confirmed' ? '' : 'active' }}" id="step1"></li>
                        <li class="step0 {{ in_array($order->status, ['In Progress', 'Shipped', 'Delivered']) ? 'active' : '' }}" id="step2"></li>
                        <li class="step0 {{ in_array($order->status, ['Shipped', 'Delivered']) ? 'active' : '' }}" id="step3"></li>
                        <li class="step0 {{ $order->status === 'Delivered' ? 'active' : '' }}" id="step4"></li>
                    </ul>
                    <div class="d-flex justify-content-between">
                        <div class="d-lg-flex align-items-center">
                            <i class="fas fa-check-circle me-lg-2 mb-lg-0"></i>
                            <div>
                                <p class="mb-0">Order Confirmed</p>
                            </div>
                        </div>
                        <div class="d-lg-flex align-items-center">
                            <i class="fas fa-clipboard-list me-lg-2 mb-lg-0"></i>
                            <div>
                                <p class="mb-0">Order Processed</p>
                            </div>
                        </div>
                        <div class="d-lg-flex align-items-center">
                            <i class="fas fa-shipping-fast me-lg-2 mb-lg-0"></i>
                            <div>
                                <p class="mb-0">Order Shipped</p>
                            </div>
                        </div>
                        <div class="d-lg-flex align-items-center">
                            <i class="fas fa-home me-lg-2 mb-lg-0"></i>
                            <div>
                                <p class="mb-0">Order Delivered</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="orderdetail-cards-row mx-3">
    <div class="card card-order" style="height: auto; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1); position: relative;">
        <i class="fa-solid fa-location-dot fa-2x" style="position: absolute; top: 10px; right: 20px; color: #0056b3"></i>
        <div class="card-body p-0">
            <p class="mb-1">{{ $order->customer_fname }} {{ $order->customer_lname }}</p>
            <p class="mb-1">{{ $order->email }}</p>
            <p class="mb-1">{{ $order->phone }}</p>
            <p class="mb-1">{{ $order->address }}, {{ $order->apartment }}, {{ $order->city }}</p>
            <p class="mb-1">{{ $order->postal_code }}</p>
        </div>
    </div>

    <div class="card card-order" style="height: auto; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">
        <i class="fa-solid fa-clipboard-list fa-2x" style="position: absolute; top: 10px; right: 20px; color: #0056b3"></i>
        <div class="card-body p-0">
            <p class="mb-1">Payment Method: {{ $order->payment_method }}</p>
            <p class="mb-1">Sub Total: Rs {{ number_format($order->total_cost - 300, 2) }}</p>
            <p class="mb-1">Delivery Charge: Rs 300.00</p>
            <p class="mb-1">Total: Rs {{ number_format($order->total_cost, 2) }}</p>
        </div>
    </div>
</div>

<div class="order-items mt-3">
    <h6 class="px-4">Order Items: {{ $order->items->count() }}</h6>
    <div class="order-items-list px-3">
        @foreach($order->items as $item)
            <div class="order-item" style="display: flex; align-items: center; padding: 10px; border-bottom: 1px solid #eaeaea;">
                <div style="margin-right: 15px;">
                    @if($item->product->images->isNotEmpty())
                        <a href="{{ route('product-description', ['product_id' =>  $item->product->product_id]) }}"><img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" alt="Product Image" width="70" height="auto"></a>
                    @endif
                </div>
                <div style="line-height: 1.5;">
                    <span style="font-weight: 600; font-size: 15px;">{{ $item->product->product_name }}</span><br>
                    <div class="d-flex align-items-center">
                        @if($item->color)
                            <span class="d-flex align-items-center me-2">
                                <strong>Color:</strong> 
                                <span style="display: inline-block; background-color: {{ $item->color }}; border: 1px solid #e8ebec; height: 15px; width: 15px; border-radius: 50%;" 
                                    title="{{ $item->color }}"></span>
                            </span>
                            |
                        @endif
                        @if($item->size)
                            <span class="me-2 ms-2">Size: <span style="font-weight: 600;">{{ $item->size ? $item->size : '-' }}</span></span>
                            |
                        @endif 
                        @if($item->quantity)
                        <span class="ms-2">Qty: <span style="font-weight: 600;">{{ $item->quantity }}</span></span>
                        @endif
                    </div>

                    <h6 class="mt-2" style="font-weight: bold;">Rs {{ number_format($item->cost, 2) }}</h6>  
                </div>
            </div>
        @endforeach
    </div>
</div>





@endsection
