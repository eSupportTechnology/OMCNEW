@extends('layouts.app')

@section('content')
<style>
    .inquiry-form-container {
        width: 60%;
        margin: 50px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .inquiry-form-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
        color: #555;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        margin-top: 5px;
    }

    .form-control:focus {
        border-color: #66afe9;
        outline: none;
        box-shadow: 0 0 5px rgba(102, 175, 233, 0.6);
    }

    .btn-submit {
        display: inline-block;
        width: 100%;
        padding: 10px;
        background-color: hsl(36, 90%, 49%);
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        margin: 0 auto;
        display: block;
    }

    .btn-submit:hover {
        background-color: hsl(36, 90%, 49%);
    }

    /* Responsive Styles */
    @media screen and (max-width: 768px) {
        .inquiry-form-container {
            width: 80%; /* Adjust width for tablets */
        }

        .btn-submit {
            width: 80%; /* Reduce button width for tablets */
        }
    }

    @media screen and (max-width: 480px) {
        .inquiry-form-container {
            width: 95%; /* Adjust width for mobile devices */
            margin: 20px auto; /* Reduce top margin for smaller screens */
        }

        .btn-submit {
            width: 100%; /* Button will take full width for mobile */
        }

        h2 {
            font-size: 18px; /* Adjust heading size for mobile */
        }

        label {
            font-size: 14px; /* Adjust label size for mobile */
        }

        .form-control {
            font-size: 14px; /* Adjust input field font size for mobile */
        }
    }
</style>

<div class="inquiry-form-container">
    <h2>Customer Inquiry Form</h2>

    @if (session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success("{{ session('status') }}", 'Success', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
@endif

@if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.error("{{ session('error') }}", 'Error', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
@endif



    <form action="{{ route('inquiry.store') }}" method="POST">
        @csrf
        <!-- Order ID Field -->
        <div class="form-group">
            <label for="order_id">Order ID:</label>
            <input type="text" name="order_id" id="order_id" class="form-control" placeholder="Enter your Order ID" required>
        </div>

        <!-- Email Field -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email" required>
        </div>

        <!-- Phone Number Field -->
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter your Phone Number" required>
        </div>

        <!-- Subject Field -->
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject" required>
        </div>

        <!-- Message Field -->
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea name="message" id="message" class="form-control" rows="5" placeholder="Enter your inquiry" required></textarea>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn-submit">Submit Inquiry</button>
        </div>
    </form>
</div>

@endsection
