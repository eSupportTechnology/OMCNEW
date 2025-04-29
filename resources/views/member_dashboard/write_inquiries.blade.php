@extends('member_dashboard.user_sidebar')

@section('dashboard-content')
<style>
    /* Title and Content in a Single Box */
    .review-header {
        margin-bottom: 20px;
        padding: 10px 0;
        text-align:left;
        border-bottom: 1px solid #ddd;
    }

    .review-product {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .review-product-info {
        flex-grow: 1;
    }

    .review-rating-container h6 {
        font-weight: bold;
    }

    .review-rating-container {
        display: flex;
        align-items: center;
        gap: 60px; /* Gap between text and stars */
    }

    .review-rating {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 15px;
    }

    .review-rating i {
        font-size: 1.5rem;
        color: #ccc; /* Default unfilled star color */
        cursor: pointer; /* Clickable stars */
    }

    .review-rating i.filled {
        color: #FFD700; /* Gold filled star color */
    }

    .review-textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        resize: none;
        margin-bottom: 20px;
    }

    .review-upload {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        flex-wrap: wrap; /* Allow wrapping of images/videos */
    }

    .review-upload div {
        flex: 1;
        text-align: center;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
        position: relative;
    }

    .review-upload input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0; /* Invisible but clickable */
        cursor: pointer;
    }

    .uploaded-item {
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .uploaded-item img,
    .uploaded-item video {
        max-width: 100px;
        max-height: 100px;
        margin-right: 10px;
    }

    .remove-item {
        color: red;
        cursor: pointer;
        margin-left: 5px;
    }

    .review-checkbox {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .review-submit {

        width: 15%;
        padding: 10px;
        background: linear-gradient(to right, hsl(226, 93%, 27%), hsl(226, 91%, 58%));
        border: none;
        border-radius: 5px;
        color: #fff;
        font-size: 1rem;
        cursor: pointer;
    }


</style>
@if (session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success("{{ session('status') }}", 'Success', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
@endif


<div class="review-container">
    <!-- Combined Title and Container -->
    <div class="review-header">
        <h4>Send an Inquiry</h4>
    </div>


    <form action="{{ route('inquiry.store') }}" method="POST">
        @csrf
        <!-- Order ID Field -->
        <div class="form-group">
            <label for="order_id">Order ID:</label>
            <input type="text" name="order_id" id="order_id" class="form-control" placeholder="Enter your Order ID" required>
        </div>

        <!-- Email Field 
        <div class="form-group mt-1">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email" required>
        </div>-->

        <!-- Phone Number Field 
        <div class="form-group mt-1">
            <label for="phone">Phone Number:</label>
            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter your Phone Number" required>
        </div>-->

        <!-- Subject Field -->
        <div class="form-group mt-1">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject" required>
        </div>

        <!-- Message Field -->
        <div class="form-group mt-1">
            <label for="message">Message:</label>
            <textarea name="message" id="message" class="form-control" rows="5" placeholder="Enter your inquiry" required></textarea>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="default-btn mt-2">Submit</button>
        </div>
    </form>

        


   


@endsection