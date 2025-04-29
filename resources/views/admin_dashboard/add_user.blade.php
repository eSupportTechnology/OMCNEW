@extends('layouts.admin_main.master')

@section('content')
<style>
    .btn-create {
        font-size: 0.8rem;
    }

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

<main style="margin-top: 50px">
    <div class="container p-5"> 
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="py-3 mb-0">Add New User</h4>
        </div>

        <div class="card p-4">
            <div class="card-body">
                <form id="productForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Enter First Name">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Enter Last Name">
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
                    </div>

                    <button type="submit" class="btn btn-success btn-create">Add</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
