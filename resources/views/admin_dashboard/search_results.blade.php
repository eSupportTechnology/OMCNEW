<!-- resources/views/products/search_results.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Search Results for "{{ $searchQuery }}"</h1>

        @if($product->isEmpty())
            <p>No products found.</p>
        @else
            <div class="row">
                @foreach($product as $product)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->product_name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->product_name }}</h5>
                                <p class="card-text">{{ $product->product_description }}</p>
                                <p class="card-text"><strong>Price: ${{ $product->price }}</strong></p>
                                <a href="#" class="btn btn-primary">View Product</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
