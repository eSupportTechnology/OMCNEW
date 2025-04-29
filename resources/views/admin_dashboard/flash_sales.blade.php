@extends('layouts.admin_main.master')

@section('content')

<!-- Include Font Awesome for icons -->
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<style>
    .btn-create {
        font-size: 0.9rem;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;

    }
    th {
        background-color: #f2f2f2;
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
            <h3 class="py-3 mb-0">Flash Sales</h3>
            <a href="{{ route('add_sales') }}" class="btn btn-primary btn-create">Add Sales</a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="container mb-4">
                    <div class="table-responsive p-0">

                        <table id="example" class="table" style="width:100%">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Sale Date & Time</th>
                                    <th scope="col">Normal Price</th>
                                    <th scope="col">Sale Rate%</th>
                                    <th scope="col">Sale Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($sales as $index => $sale)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $sale->product_id }}</td>
                                    <td>{{ $sale->product ? $sale->product->product_name : 'No Product Available' }}</td>
                                    <td>
                                        <img src="{{ $sale->product && $sale->product->images->first() ? asset('storage/' . $sale->product->images->first()->image_path) : asset('path/to/default-image.jpg') }}" 
                                        alt="{{ $sale->product ? $sale->product->product_name : 'No Product Available' }}" 
                                        style="width: 50px; height: auto;">
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($sale->end_date)->format('Y-m-d H:i') }}</td>
                                    <td>{{ number_format($sale->normal_price, 2) }}</td>
                                    <td>{{ $sale->sale_rate }}</td>
                                    <td>{{ number_format($sale->sale_price, 2) }}</td>
                                    <td>{{ $sale->status == 'active' ? 'Active' : 'Inactive' }}</td>
                                    <td class="action-buttons">
                                        <a href="{{ route('edit_sales', $sale->id) }}" class="btn btn-warning btn-sm mb-1" style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form id="delete-form-{{ $sale->id }}" action="{{ route('delete_sale', $sale->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="btn btn-danger btn-sm mb-1" onclick="confirmDelete('delete-form-{{ $sale->id }}', 'You want to delete this Sale?')"
                                                style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
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
</main>

@endsection