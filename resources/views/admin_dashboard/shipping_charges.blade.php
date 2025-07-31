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
                <h3 class="py-3 mb-0">Shipping Charges</h3>
                <a href="{{ route('shipping-charges.create') }}" class="btn btn-primary btn-create">Add Shipping Charges</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="container  mb-4">

                        <div class="table-responsive p-0">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Min Quantity</th>
                                        <th>Max Quantity</th>
                                        <th>Charge (LKR)</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($charges as $charge)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $charge->min_quantity }}</td>
                                            <td>{{ $charge->max_quantity }}</td>
                                            <td>{{ number_format($charge->charge, 2) }}</td>
                                            <td>
                                                <a href="{{ route('shipping-charges.edit', $charge->id) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>

                                                <form action="{{ route('shipping-charges.destroy', $charge->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure to delete?')"
                                                        class="btn btn-sm btn-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($charges->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center">No shipping charges found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
