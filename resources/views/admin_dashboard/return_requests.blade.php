@extends('layouts.admin_main.master')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">

<style>
    .action-buttons {
        padding: 5px;
        width: 35px;
    }

    .tab-content .table {
        margin-top: 20px;
    }

    .dropdown-menu {
        min-width: 100px;
    }
</style>

<main style="margin-top: 58px">
    <div class="container pt-4 px-4">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <h3 class="py-3 mb-0">Manage Return Requests</h3>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>User</th>
                        <th>Name</th>
                        <th>Reason</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($returnRequests as $request)
                    <tr id="request-row-{{ $request->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $request->order_id }}</td>
                        <td>{{ $request->user->name ?? 'N/A' }}</td>
                        <td>{{ $request->billing_last_name }}</td>
                        <td>{{ $request->reason }}</td>
                        <td>{{ $request->email }}</td>
                        <td>
                            <span class="badge 
                                    @if($request->status == 'pending') bg-warning 
                                    @elseif($request->status == 'approved') bg-success 
                                    @elseif($request->status == 'rejected') bg-danger 
                                    @endif"
                                id="status-{{ $request->id }}">
                                {{ ucfirst($request->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    @if($request->status == 'pending')
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="updateStatus({{ $request->id }}, 'approved')">Approve</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="updateStatus({{ $request->id }}, 'rejected')">Reject</a>
                                    </li>
                                    @endif
                                    <li>
                                        <form id="delete-form-{{ $request->id }}" action="{{ route('return_requests.destroy', $request->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a class="dropdown-item" style="cursor:pointer;" onclick="confirmDelete('delete-form-{{ $request->id }}')">Delete</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    let csrfToken = '{{ csrf_token() }}';

    function updateStatus(requestId, status) {
        if (!confirm(`Are you sure you want to mark this request as ${status}?`)) return;

        fetch(`/admin/return_requests/${requestId}/update-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    status: status
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const statusBadge = document.getElementById(`status-${requestId}`);
                    statusBadge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                    statusBadge.className = 'badge ' +
                        (status == 'pending' ? 'bg-warning' : (status == 'approved' ? 'bg-success' : 'bg-danger'));
                } else {
                    alert('Error updating status: ' + data.message);
                }
            })
            .catch(err => console.error(err));
    }

    function confirmDelete(formId) {
        if (confirm('Are you sure you want to delete this return request?')) {
            document.getElementById(formId).submit();
        }
    }
</script>
@endsection