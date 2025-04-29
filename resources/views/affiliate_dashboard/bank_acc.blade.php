@extends('layouts.affiliate_main.master')

@section('content')
<style>
    /* Blur everything except the form container */
    body {
        position: relative;
        overflow: hidden; /* Disable scrolling */
    }

    .blur-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(1, 1, 1, 0.1); /* Darken the background */
        backdrop-filter: blur(8px); /* Apply blur effect */
        z-index: 1; /* Ensure it's behind the form */
    }

    .add-bank-account-container {
        position: relative;
        z-index: 2; /* Ensure form is on top of the blur */
        width: 100%;
        max-width: 500px;
        margin: 150px auto;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .add-bank-account-container h1 {
        text-align: center;
        margin-bottom: 15px;
        font-size: 22px;
    }

    .form-group {
        margin-bottom: 10px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 15px;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        display: block;
        width: 100%;
        text-align: center;
        font-size: 15px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .add-bank-account-container {
            padding: 10px;
        }

        .add-bank-account-container h1 {
            font-size: 20px;
        }

        .form-group label {
            font-size: 14px;
        }

        .form-control {
            font-size: 14px;
            padding: 7px;
        }

        .btn-primary {
            font-size: 14px;
            padding: 7px 14px;
        }
    }

    @media (max-width: 576px) {
        .add-bank-account-container {
            padding: 8px;
        }

        .add-bank-account-container h1 {
            font-size: 18px;
        }

        .form-group label {
            font-size: 13px;
        }

        .form-control {
            font-size: 13px;
            padding: 6px;
        }

        .btn-primary {
            font-size: 13px;
            padding: 6px 12px;
        }
    }
</style>

<!-- Overlay to blur the entire page -->
<div class="blur-overlay"></div>

<div class="add-bank-account-container">
    <h1>Add New Bank Account</h1>
    <form action="{{ route('updatebank') }}" method="POST">
        @csrf
        <!-- Bank Name -->
        <div class="form-group">
            <label for="bank_name">Bank Name</label>
            <input type="text" class="form-control" id="bank_name" name="bank_name" required>
        </div>

        <!-- Branch Name -->
        <div class="form-group">
            <label for="branch">Branch</label>
            <input type="text" class="form-control" id="branch" name="branch" required>
        </div>

        <!-- Account Holder Name -->
        <div class="form-group">
            <label for="account_name">Account Holder Name</label>
            <input type="text" class="form-control" id="account_name" name="account_name" required>
        </div>

        <!-- Account Number -->
        <div class="form-group">
            <label for="account_number">Account Number</label>
            <input type="text" class="form-control" id="account_number" name="account_number" required>
        </div>

        <!-- Submit Button -->
        <div style="display: flex; justify-content: center;">
            <button type="submit" class="btn btn-primary">Add Bank Account</button>
        </div>
    </form>
</div>

@endsection
