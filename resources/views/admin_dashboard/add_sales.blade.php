
@extends('layouts.admin_main.master')

@section('content')

<style>
   .btn-create {
        font-size: 0.8rem;
    }

    input[type="text"], input[type="number"], input[type="datetime-local"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 20px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .product-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }
</style>

<main style="margin-top: 20px">
    <div class="container py-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="py-2 mb-0 ms-4">Create Sales</h4>
        </div>

        <div class="card-container px-4">
            <div class="card py-2 px-4">
                <div class="card-body">
                    <form action="{{ route('store_sales') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <div class="form-group col-4">
                                <label for="end_date">Flash Sale End Date and Time *</label>
                                <input type="datetime-local" id="end_date" name="end_date" required>
                            </div>
                        </div>

                        <table class="table table-bordered" id="products-table">
                            <thead>
                                <tr>
                                    <th style="width: 30%">Product Image & ID *</th>
                                    <th>Normal Price</th>
                                    <th>Sale Rate (%)</th>
                                    <th>Sale Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                    <select name="products[0][product_id]" class="form-control product-select" required>
        <option value="">Select a product</option>
        @foreach ($products as $product)
            <option value="{{ $product->product_id }}" data-price="{{ $product->normal_price }}">
                <img src="{{ asset('storage/'.$product->image) }}" class="product-image" alt="{{ $product->product_name }}">
                {{ $product->product_id }} - {{ $product->product_name }}
            </option>
        @endforeach
    </select>
                                    </td>
                                    <td><input type="text" name="products[0][normal_price]" class="form-control product-price" required readonly></td>
                                    <td><input type="text" name="products[0][sale_rate]" class="form-control sale-rate" required></td>
                                    <td><input type="text" name="products[0][sale_price]" class="form-control sale-price" required readonly></td>
                                    <td><button type="button" class="btn btn-danger remove-row">Delete</button></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <button type="button" class="btn btn-primary" id="add-row">Add New Product</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let rowIndex = 1;

    document.getElementById('add-row').addEventListener('click', function() {
        const table = document.getElementById('products-table').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        newRow.innerHTML = `
            <tr>
                <td>
                    <select name="products[${rowIndex}][product_id]" class="form-control product-select" required>
                        <option value="">Select a product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->product_id }}" data-price="{{ $product->normal_price }}">
                                <img src="{{ asset('storage/'.$product->image) }}" class="product-image" alt="{{ $product->product_name }}">
                                {{ $product->product_id }} - {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td><input type="text" name="products[${rowIndex}][normal_price]" class="form-control product-price" required readonly></td>
                <td><input type="text" name="products[${rowIndex}][sale_rate]" class="form-control sale-rate" required></td>
                <td><input type="text" name="products[${rowIndex}][sale_price]" class="form-control sale-price" required readonly></td>
                <td><button type="button" class="btn btn-danger remove-row">Delete</button></td>
            </tr>
        `;
        rowIndex++;
    });

    document.getElementById('products-table').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });

    document.getElementById('products-table').addEventListener('change', function(e) {
        if (e.target.classList.contains('product-select')) {
            const select = e.target;
            const selectedOption = select.options[select.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            const row = select.closest('tr');
            const priceInput = row.querySelector('.product-price');

            priceInput.value = price ? price : '';
            updateSalePrice(row);
        }
    });

    document.getElementById('products-table').addEventListener('input', function(e) {
        if (e.target.classList.contains('sale-rate')) {
            const row = e.target.closest('tr');
            updateSalePrice(row);
        }
    });

    function updateSalePrice(row) {
        const normalPrice = parseFloat(row.querySelector('.product-price').value) || 0;
        const saleRate = parseFloat(row.querySelector('.sale-rate').value) || 0;
        const salePriceInput = row.querySelector('.sale-price');

        if (normalPrice > 0 && saleRate >= 0) {
            const salePrice = normalPrice - (normalPrice * (saleRate / 100));
            salePriceInput.value = salePrice.toFixed(2);
        } else {
            salePriceInput.value = '';
        }
    }
});
</script>

@endsection
