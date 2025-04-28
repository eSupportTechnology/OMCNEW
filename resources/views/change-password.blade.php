@extends('layouts.sidebar')

@section('dashboard-content')

<h3 class="py-2 px-2">Change Password</h3>
<div class="container p-3">
    <form>
        <div class="mb-3 position-relative">
            <label for="current-password" class="form-label">Current Password</label>
            <input type="password" class="form-control" id="current-password" placeholder="Current password">
            <span toggle="#current-password" class="fa fa-fw fa-eye field-icon toggle-password position-absolute" style="top: 38px; right: 10px; cursor: pointer;"></span>
        </div>
        <div class="mb-3 position-relative">
            <label for="new-password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="new-password" placeholder="New password">
            <span toggle="#new-password" class="fa fa-fw fa-eye field-icon toggle-password position-absolute" style="top: 38px; right: 10px; cursor: pointer;"></span>
        </div>
        <div class="mb-3 position-relative">
            <label for="retype-new-password" class="form-label">Retype New Password</label>
            <input type="password" class="form-control" id="retype-new-password" placeholder="Retype new password">
            <span toggle="#retype-new-password" class="fa fa-fw fa-eye field-icon toggle-password position-absolute" style="top: 38px; right: 10px; cursor: pointer;"></span>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Change Password</button>
    </form>
</div>


    <script>
        document.querySelectorAll('.toggle-password').forEach(item => {
            item.addEventListener('click', function () {
                const input = document.querySelector(this.getAttribute('toggle'));
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                } else {
                    input.type = 'password';
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                }
            });
        });
    </script>
@endsection


