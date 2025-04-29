@extends('layouts.admin_main.master')

@section('content')

<style>
   .btn-create {
        font-size: 0.8rem;
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
            <h4 class="py-2 mb-0 ms-4">Create Offers</h4>
        </div>

        <div class="card-container px-4">
            <div class="card py-2 px-4">
                <div class="card-body">
                    <form action="{{ route('store_offers') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <div class="form-group col-4">
                                <label for="month_year">Month *</label>
                                <input type="month" class="form-control" id="month_year" name="month_year" required>
                            </div>
                        </div>

                        <table class="table table-bordered" id="products-table">
                            <thead>
                                <tr>
                                    <th style="width: 30%">Product Name *</th>
                                    <th>Normal Price</th>
                                    <th>Offer Rate (%)</th>
                                    <th>Offer Price</th>
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
                                                {{ $product->product_id }} - {{ $product->product_name }}
                                            </option>

                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="products[0][normal_price]" class="form-control product-price" required readonly></td>
                                    <td><input type="text" name="products[0][offer_rate]" class="form-control offer-rate" required></td>
                                    <td><input type="text" name="products[0][offer_price]" class="form-control offer-price" required readonly></td>
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
                                {{ $product->product_id }} - {{ $product->product_name }}
                            </option>
                        @endforeach
                </select>
            </td>
            <td><input type="text" name="products[${rowIndex}][normal_price]" class="form-control product-price" required readonly></td>
            <td><input type="text" name="products[${rowIndex}][offer_rate]" class="form-control offer-rate" required></td>
            <td><input type="text" name="products[${rowIndex}][offer_price]" class="form-control offer-price" required readonly></td>
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
        updateOfferPrice(row);
    }
});

document.getElementById('products-table').addEventListener('input', function(e) {
    if (e.target.classList.contains('offer-rate')) {
        const row = e.target.closest('tr');
        updateOfferPrice(row);
    }
});

function updateOfferPrice(row) {
    const normalPrice = parseFloat(row.querySelector('.product-price').value) || 0;
    const offerRate = parseFloat(row.querySelector('.offer-rate').value) || 0;
    const offerPriceInput = row.querySelector('.offer-price');

    if (normalPrice > 0 && offerRate >= 0) {
        const offerPrice = normalPrice - (normalPrice * (offerRate / 100));
        offerPriceInput.value = offerPrice.toFixed(2);
    } else {
        offerPriceInput.value = '';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const monthYearInput = document.getElementById('month_year');
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
    const currentMonth = `${year}-${month}`;

    monthYearInput.value = currentMonth;
    monthYearInput.setAttribute('min', currentMonth);
});
</script>



@endsection
