@extends('layouts.admin_main.master')

@section('content')

<style>
   .btn-create {
        font-size: 0.8rem;
    }

</style>



<main style="margin-top: 20px">
    <div class="container p-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="py-2 mb-0 ms-4">Edit Offers</h4>
        </div>

        <div class="card-container px-4">
            <div class="card py-2 px-4">
                <div class="card-body">
                    <form action="{{ route('edit_offers', $offer->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $offer->id }}">
                        
                        <div class="form-group">
                            <label for="product_name">Product</label> 
                            <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $offer->product->product_name }}" required readonly>
                        </div>

                        <div class="form-group mt-3">
                            <label for="month">Month</label>
                            <input type="month" class="form-control" id="month" name="month" placeholder="Select Month" value="{{ $offer->month }}" required>
                        </div>
                        @error('month')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group mt-3">
                            <label for="normal_price">Normal Price</label>
                            <input type="text" name="normal_price" id="normal_price" class="form-control" value="{{ $offer->normal_price }}" required readonly>
                        </div>

                        <div class="form-group mt-3">
                            <label for="offer_rate">Offer Rate (%)</label>
                            <input type="text" name="offer_rate" id="offer_rate" class="form-control" value="{{ $offer->offer_rate }}" required>
                        </div>
                        @error('offer_rate')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group mt-3">
                            <label for="offer_price">Offer Price</label>
                            <input type="text" name="offer_price" id="offer_price" class="form-control" value="{{ $offer->offer_price }}" required readonly>
                        </div>

                        <div class="form-group mt-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="Active" {{ $offer->status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ $offer->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>    
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Offer</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</main>





<script>
   document.addEventListener('DOMContentLoaded', function() {
    const normalPriceInput = document.getElementById('normal_price');
    const offerRateInput = document.getElementById('offer_rate');
    const offerPriceInput = document.getElementById('offer_price');

    offerRateInput.addEventListener('input', function() {
        const normalPrice = parseFloat(normalPriceInput.value) || 0;
        const offerRate = parseFloat(offerRateInput.value) || 0;
        const offerPrice = normalPrice - (normalPrice * (offerRate / 100));
        
        if (!isNaN(offerPrice)) {
            offerPriceInput.value = offerPrice.toFixed(2);
        }
    });
});
</script>


@endsection
