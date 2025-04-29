@extends('layouts.affiliate_main.master')

@section('content')
<style>
    .table thead {
        background-color: #f9f9f9; 
    }

    .btn-create {
        font-size: 0.8rem;
    }

    .modal-header {
        background-color: #f9f9f9;
    }

    .form-text {
        font-size: 0.8rem;
    }
</style>  

<main style="margin-top: 58px">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container pt-4 px-4"> 
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="py-3 mb-0">Tracking ID</h3>
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-primary btn-create" data-bs-toggle="modal" data-bs-target="#createTrackingIdModal">Create Tracking ID</button>
        </div>
        
        <div class="card">
            <div class="card-body">
                <div class="tab-pane fade show active" role="tabpanel">
                    <div class="container mt-4 mb-4">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tracking ID</th>
                                        <th scope="col">Generation Time</th>
                                        <th scope="col">Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($raffletickets as $ticket)
    <tr>
        <td>{{ $ticket->id }}</td>
        <td>{{ $ticket->token }}</td>
        <td>{{ $ticket->created_at }}</td>
        <td>
            

            <!-- Form to delete the ticket -->
            <form action="{{ route('raffletickets.destroy', $ticket->id) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger mt-2">Delete</button>
            </form>

            <!-- View Report button -->
            <form action="{{ route('realtime_tracking') }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="raffle_ticket_id" value="{{ $ticket->id }}">
                <button type="submit" class="btn btn-sm btn-info">View Report</button>
            </form>
        </td>
    </tr>
@endforeach



                                </tbody>
                            </table>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="card-footer d-flex justify-content-between align-items-center">
                <span>Total: {{ $raffletickets->count() }}</span>
                <!-- Pagination controls can be implemented here -->
            </div>
        </div>

    </div>
</main>


<!-- Create Tracking ID Modal -->
<div class="modal fade" id="createTrackingIdModal" tabindex="-1" aria-labelledby="createTrackingIdModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="trackingIdForm" action="{{ route('tracking_id_store') }}" method="post">
                @csrf <!-- Laravel CSRF token -->
                <div class="modal-header">
                    <h5 class="modal-title" id="createTrackingIdModalLabel">Create Tracking ID</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="trackingIdInput" class="form-label">Tracking ID</label>
                        <input type="text" class="form-control" id="trackingIdInput" name="tracking_id" placeholder="Enter tracking ID" required>
                        <div class="form-text">
                            Please note that your tracking ID should contain only English letters, Arabic numerals, and the symbols ampersand (&), underscore (_) and hyphen (-).
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Tracking ID</button>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection
