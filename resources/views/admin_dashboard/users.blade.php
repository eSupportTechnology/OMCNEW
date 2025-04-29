@extends('layouts.admin_main.master')

@section('content')

<style>


    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        font-weight: 500;
    }

    .form-group input {
        border: 1px solid #ced4da;
    }

    .form-control[readonly] {
        background-color: #e9ecef;
    }

    .form-check {
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    .form-check label {
        margin-left: 10px;
    }

    .select-width {
        width: 100%;
        border: 1px solid #ced4da;
    }

    .form-control-file {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }




</style>  

<main style="margin-top: 58px">
    <div class="container pt-4 px-4"> 
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="py-3 mb-0">Users</h3>
            <button type="button" class="btn btn-primary btn-create" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fa-solid fa-plus"></i> Add
            </button>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="container mt-4 mb-4">
                    <div class="table-responsive">
                        <table id="example" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact No.</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="width: 15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <img src="{{ $user->image_path ? asset('storage/user_images/' . $user->image_path) : asset('assets/images/default-user.png') }}" width="40" alt="User Image">
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->contact }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>
                                        @if($user->status)
                                            <span class="status-badge badge bg-success">Active</span>
                                        @else
                                            <span class="status-badge badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="action-buttons">
                                        <button class="btn btn-info btn-sm view-btn" data-bs-toggle="modal" data-bs-target="#UserdetailsModal" data-id="{{ $user->id }}" style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm"  style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('delete_user', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" style="font-size: 0.75rem; padding: 0.25rem 0.5rem;" onclick="confirmDelete('delete-form-{{ $user->id }}', 'Are you sure you want to delete this user?')">
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



<!-- add user Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="addUserForm" action="{{ route('admin_users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="contact">Contact</label>
                            <input type="text" id="contact" name="contact" class="form-control" placeholder="Enter Contact Number">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="role">Role</label>
                            <select id="role" name="role" class="form-control select-width">
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="userImage">User Image</label><br>
                            <input type="file" id="userImage" name="userImage" class="form-control-file" style="width:100%">
                        </div>

                        <div class="col-md-6 form-group position-relative">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password">
                            <span class="position-absolute end-0 translate-middle-y pe-3" style="margin-top: -15px;">
                                <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                            </span>
                        </div>

                        <div class="col-md-6 form-group position-relative">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                            <span class="position-absolute end-0 translate-middle-y pe-3" style="margin-top: -15px;">
                                <i class="fas fa-eye" id="toggleConfirmPassword" style="cursor: pointer;"></i>
                            </span>
                            <small id="passwordError" class="text-danger d-none">Passwords do not match</small>

                        </div>
                        <div class="form-check form-switch ms-3">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="status" {{ old('status', 'on') ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Status</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-create">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>





<!-- User Details Modal -->
<div class="modal fade" id="UserdetailsModal" tabindex="-1" aria-labelledby="UserdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg-8">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="UserdetailsModalLabel">Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="userDetailsContainer">
                  
                </div>
            </div>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    var viewButtons = document.querySelectorAll('.view-btn');

    viewButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var userId = this.getAttribute('data-id');

            fetch('/admin/users/' + userId)
                .then(response => response.json())
                .then(data => {
                    var userDetailsContainer = document.getElementById('userDetailsContainer');
                    userDetailsContainer.innerHTML = `
                        <div class="modal-user-details">
                            <img src="${data.image_path ? '/storage/user_images/' + data.image_path : '/assets/images/default-user.png'}" class="img-fluid mb-3" alt="User Image" />
                            <h5>${data.name}</h5>
                            <p>USER ID: #${String(data.id).padStart(4, '0')}</p>
                        </div>
                        <div class="user-info">
                            <p><strong>Email:</strong> <span>${data.email}</span></p>
                            <p><strong>Contact No:</strong> <span>${data.contact}</span></p>
                            <p><strong>Role:</strong> <span>${data.role}</span></p>
                            <p><strong>Status:</strong> 
                                ${data.status ? '<span class="badge status-badge bg-success">Active</span>' : '<span class="badge status-badge bg-danger">Inactive</span>'}
                            </p>
                           
                        </div>
                    `;
                })
                .catch(error => console.error('Error fetching user details:', error));
        });
    });
});

</script>

<script>
    // Toggle Password Visibility
    document.getElementById('togglePassword').addEventListener('click', function () {
        const password = document.getElementById('password');
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        const confirmPassword = document.getElementById('password_confirmation');
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    // Check if passwords match
    document.getElementById('password_confirmation').addEventListener('input', function() {
        const password = document.getElementById('password').value;
        const confirmPassword = this.value;
        const passwordError = document.getElementById('passwordError');

        if (password !== confirmPassword) {
            passwordError.classList.remove('d-none');
        } else {
            passwordError.classList.add('d-none');
        }
    });


</script>
@endsection
