@extends('layouts.admin_main.master')

@section('content')

<style> 


</style>  

<main style="margin-top: 58px">
    <div class="container pt-4 px-4"> 
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="py-3 mb-0">Special offers</h3>
            <a href="{{ route('add_offers') }}" class="btn btn-primary btn-create">Add Offer</a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="container  mb-4">
                    <div class="table-responsive p-0">
                        <table id="example" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Offer month</th>
                                    <th scope="col">Normal Price</th>
                                    <th scope="col">Offer Rate%</th>
                                    <th scope="col">Offer Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($offers as $index => $offer)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $offer->product_id }}</td>
                                    <td>{{ $offer->product ? $offer->product->product_name : 'No Product Available' }}</td>

                                    <td>
                                    <img src="{{ $offer->product && $offer->product->images->first() ? asset('storage/' . $offer->product->images->first()->image_path) : asset('path/to/default-image.jpg') }}" 
                                        alt="{{ $offer->product ? $offer->product->product_name : 'No Product Available' }}" 
                                        style="width: 50px; height: auto;">
                                    </td> 
                                    <td>{{ $offer->month }}</td>
                                    <td>{{ $offer->normal_price }}</td>
                                    <td>{{ $offer->offer_rate }}</td>
                                    <td>{{ $offer->offer_price }}</td>
                                    <td>{{ $offer->status }}</td>
                                    <td class="action-buttons">
                                        <a href="{{ route('edit_offers', $offer->id) }}" class="btn btn-warning btn-sm mb-1" style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form id="delete-form-{{ $offer->id }}" action="{{ route('delete_offer', $offer->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm mb-1" onclick="confirmDelete('delete-form-{{ $offer->id }}', 'You want to delete this Offer?')"
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
