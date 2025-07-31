@extends('layouts.admin_main.master')

@section('content')
    <main style="margin-top: 58px">
        <div class="container pt-4 px-4">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="container  mb-4">

                        <div class="table-responsive p-0">
                            <form action="{{ route('shipping-charges.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="min_quantity">Min Quantity</label>
                                    <input type="number" name="min_quantity" class="form-control" required
                                        value="{{ old('min_quantity') }}">
                                    @error('min_quantity')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="max_quantity">Max Quantity</label>
                                    <input type="number" name="max_quantity" class="form-control" required
                                        value="{{ old('max_quantity') }}">
                                    @error('max_quantity')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="charge">Charge (LKR)</label>
                                    <input type="number" name="charge" class="form-control" step="0.01" required
                                        value="{{ old('charge') }}">
                                    @error('charge')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-success mt-3">Add Charge</button>
                                <a href="{{ route('shipping-charges.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
