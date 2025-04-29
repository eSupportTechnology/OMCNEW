@extends('layouts.affiliate_main.master')

@section('content')
<style>
    .table thead {
        background-color: #9FC5E8;
    }
    h3{
        text-align:center;
    }
    p{
        text-align:center;
    }
    .section{
        padding:30px;
    }
    .btun{
        align:center;
    }
    .card {
        padding: 10px;
        border: 20px;
        margin-left: 40px;
        margin-right: 40px;
    }

   .btn-primary {
        padding: 8px 15px;
        font-size: 14px;
    }

    .card h3 {
        font-size: 20px;
    }

    .card p {
        font-size: 14px;
    }
</style>

<main style="">
    <div class="container pt-4 px-4">
        <h2 class="py-3">Payment Information</h2>
    <br><br>
        
        <div class="card m-0 ">
            <div class="section">
                @if($customer && $customer->account_number)
                    <!-- Show Payment Details -->
                    <h3>Bank Account Details</h3>
                    <p>Bank Name: {{ $customer->bank_name }}</p>
                    <p>Branch: {{ $customer->branch }}</p>
                    <p>Account Halder Name: {{ $customer->account_name }}</p>
                    <p>Account Number: {{ $customer->account_number }}</p>
                @else
                    <!-- No Payment Information -->
                    <h3>Bank Account Not Linked</h3>
                    <p>You have not linked any bank account</p>
                @endif
                <br><br>
            </div>    

            <div style="display: flex; justify-content: center;">
                <a href="{{ route('bank_acc') }}" class="btn btn-secondary btn-sm">UPDATE BANK ACCOUNT</a>
            </div>
        </div>
    </div>
</main>

@endsection
