@extends('layouts.admin_main.master')

@section('content')
    <main style="margin-top: 58px">
        <div class="container pt-4 px-4">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="py-3 mb-0">Edit Shipping Charges</h3>
                <a href="{{ route('shipping-charges.create') }}" class="btn btn-primary btn-create">Add Shipping Charges</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="container  mb-4">

                        <div class="table-responsive p-0">

                            <form action="{{ route('shipping-charges.update', $shippingCharge->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="min_quantity">Min Quantity</label>
                                    <input type="number" name="min_quantity" class="form-control" required
                                        value="{{ old('min_quantity', $shippingCharge->min_quantity) }}">
                                    @error('min_quantity')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="max_quantity">Max Quantity</label>
                                    <input type="number" name="max_quantity" class="form-control" required
                                        value="{{ old('max_quantity', $shippingCharge->max_quantity) }}">
                                    @error('max_quantity')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="charge">Charge (LKR)</label>
                                    <input type="number" name="charge" class="form-control" step="0.01" required
                                        value="{{ old('charge', $shippingCharge->charge) }}">
                                    @error('charge')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Update Charge</button>
                                <a href="{{ route('shipping-charges.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
