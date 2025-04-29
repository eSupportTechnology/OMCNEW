@extends('layouts.affiliate_main.master')

@section('content')
<style>
    .table thead {
        background-color: #9FC5E8;
    

    /* Container Styling */
    
    }

    /* Select Box Styling */
    .select-box {
        position: relative;
        display: inline-block;
        width: 100%;
        max-width: 300px; /* Limits the max width for larger screens */
        margin-top: 20px;
        text-align: center;
    }

    select {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
        background-color: #fff;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
    }

    select:focus {
        border-color: #666;
        outline: none;
    }

    .select-box::after {
        content: '▼';
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        pointer-events: none;
    }

    /* No Data Message Styling */
    #no-data-message {
        display: none;
        margin-top: 20px;
        color: gray;
        font-size: 18px;
        font-weight: bold;
        text-align: center; /* Center-align message */
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .container1 {
            margin: 20px;
            margin-left: 0; /* Remove the left shift on smaller screens */
        }

        h2 {
            font-size: 20px;
        }

        h3 {
            font-size: 18px;
        }

        .select-box {
            max-width: 100%;
        }

        select {
            font-size: 14px;
        }

        #no-data-message {
            font-size: 16px;
        }
    }

    @media (max-width: 576px) {
        .container1 {
            margin: 10px;
        }

        h2 {
            font-size: 18px;
        }

        h3 {
            font-size: 16px;
        }

        select {
            font-size: 13px;
            padding: 8px;
        }

        #no-data-message {
            font-size: 14px;
        }
    }
</style>

<main style="margin-top: 58px">
    <div class="container pt-4 px-4">
        <h2 class="py-3">Incentive Campaign</h2>
        <ul class="nav nav-tabs mb-3" id="myTab0" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab0" data-bs-toggle="tab" data-bs-target="#unregisterd" type="button"
                    role="tab" aria-controls="unregisterd" aria-selected="true">
                    Unregistered
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="commision-tab0" data-bs-toggle="tab" data-bs-target="#commision" type="button"
                    role="tab" aria-controls="commision" aria-selected="false">
                    Registered
                </button>
            </li>
        </ul>

        <!-- Select Box -->
        <div class="select-box">
            <select>
                <option>Campaign Type</option>
                <option>Show By Profit</option>
                <option>Show By Orders</option>
            </select>
        </div>

        <!-- No Data Message -->
        <div id="no-data-message">No Data</div>
    </div>
</main>

<script>
    // 'Unregistered' tab is clicked
    document.querySelector('#home-tab0').addEventListener('click', function () {
        // Show the select box and hide "No Data" message
        document.querySelector('.select-box').style.display = 'block';
        document.querySelector('#no-data-message').style.display = 'none';
    });

    // 'Registered' tab is clicked
    document.querySelector('#commision-tab0').addEventListener('click', function () {
        // Hide the select box and show "No Data" message
        document.querySelector('.select-box').style.display = 'none';
        document.querySelector('#no-data-message').style.display = 'block';
    });
</script>

@endsection
