@extends('layouts.admin_main.master')

@section('content')

<style>

    .action-buttons  {
        padding: 5px;
        width: 35px;
    }

    .tab-content .table {
        margin-top: 20px;
    }

   
</style>

<main style="margin-top: 58px">
    <div class="container pt-4 px-4"> 
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center">
            <h3 class="py-3 mb-0">Manage Orders</h3>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active fw-bold" id="all-orders-tab" data-bs-toggle="tab" href="#all-orders" role="tab" aria-controls="all-orders" aria-selected="true">All Orders</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold" id="paid-tab" data-bs-toggle="tab" href="#paid" role="tab" aria-controls="paid" aria-selected="false">Paid</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold" id="inprogress-tab" data-bs-toggle="tab" href="#inprogress" role="tab" aria-controls="inprogress" aria-selected="false">In Progress</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold" id="shipped-tab" data-bs-toggle="tab" href="#shipped" role="tab" aria-controls="shipped" aria-selected="false">Shipped</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold" id="delivered-tab" data-bs-toggle="tab" href="#delivered" role="tab" aria-controls="delivered" aria-selected="false">Delivered</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold" id="cancelled-tab" data-bs-toggle="tab" href="#cancelled" role="tab" aria-controls="cancelled" aria-selected="false">Cancelled</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- All Orders Tab -->
            <div class="tab-pane fade show active" id="all-orders" role="tabpanel" aria-labelledby="all-orders-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allOrders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->order_code }}</td>
                                            <td>{{ $order->customer_fname }} {{ $order->customer_lname }}</td>
                                            <td>{{ $order->date }}</td>
                                            <td><span class="status {{ strtolower(str_replace(' ', '-', $order->status)) }}">
                                                    {{ $order->status }}
                                                </span></td>
                                            <td>{{ $order->total_cost }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td class="action-buttons">
                                                <button class="btn btn-info btn-sm" onclick="setOrderCode('{{ $order->order_code }}')"><i class="fas fa-eye"></i></button>
                                                <form id="delete-form-{{ $order->id }}" action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('delete-form-{{ $order->id }}', 'Do you want to delete this order?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

           

            <!-- In Progress Orders Tab -->
            <div class="tab-pane fade" id="inprogress" role="tabpanel" aria-labelledby="inprogress-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($inProgressOrders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->order_code }}</td>
                                            <td>{{ $order->customer_fname }} {{ $order->customer_lname }}</td>
                                            <td>{{ $order->date }}</td>
                                            <td>{{ $order->total_cost }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td class="action-buttons">
                                                <button class="btn btn-info btn-sm" onclick="setOrderCode('{{ $order->order_code }}')"><i class="fas fa-eye"></i></button>
                                                <form id="delete-form-{{ $order->id }}" action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('delete-form-{{ $order->id }}', 'Do you want to delete this order?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Paid Tab -->
            <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paidOrders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->order_code }}</td>
                                            <td>{{ $order->customer_fname }} {{ $order->customer_lname }}</td>
                                            <td>{{ $order->date }}</td>
                                            <td>{{ $order->total_cost }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td class="action-buttons">
                                                <button class="btn btn-info btn-sm" onclick="setOrderCode('{{ $order->order_code }}')"><i class="fas fa-eye"></i></button>
                                                <form id="delete-form-{{ $order->id }}" action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('delete-form-{{ $order->id }}', 'Do you want to delete this order?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Shipped Tab -->
            <div class="tab-pane fade" id="shipped" role="tabpanel" aria-labelledby="shipped-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shippedOrders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->order_code }}</td>
                                            <td>{{ $order->customer_fname }} {{ $order->customer_lname }}</td>
                                            <td>{{ $order->date }}</td>
                                            <td>{{ $order->total_cost }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td class="action-buttons">
                                                <button class="btn btn-info btn-sm" onclick="setOrderCode('{{ $order->order_code }}')"><i class="fas fa-eye"></i></button>
                                                <form id="delete-form-{{ $order->id }}" action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('delete-form-{{ $order->id }}', 'Do you want to delete this order?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- Delivered Orders Tab -->
            <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($deliveredOrders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->order_code }}</td>
                                            <td>{{ $order->customer_fname }} {{ $order->customer_lname }}</td>
                                            <td>{{ $order->date }}</td>
                                            <td>{{ $order->total_cost }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td class="action-buttons">
                                                <button class="btn btn-info btn-sm" onclick="setOrderCode('{{ $order->order_code }}')"><i class="fas fa-eye"></i></button>
                                                <form id="delete-form-{{ $order->id }}" action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('delete-form-{{ $order->id }}', 'Do you want to delete this order?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cancelled Orders Tab -->
            <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                <div class="card mt-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cancelledOrders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->order_code }}</td>
                                            <td>{{ $order->customer_fname }} {{ $order->customer_lname }}</td>
                                            <td>{{ $order->date }}</td>
                                            <td>{{ $order->total_cost }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td class="action-buttons">
                                                <button class="btn btn-info btn-sm" onclick="setOrderCode('{{ $order->order_code }}')"><i class="fas fa-eye"></i></button>
                                                <form id="delete-form-{{ $order->id }}" action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('delete-form-{{ $order->id }}', 'Do you want to delete this order?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
function setOrderCode(orderCode) {
    fetch('{{ route('set-order-code') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ order_code: orderCode })
    }).then(response => {
        if (response.ok) {
            window.location.href = '{{ route('customerorder_details') }}';
        } else {
            alert('Failed to set order code');
        }
    });
}
</script>
@endsection
