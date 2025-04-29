@extends('layouts.affiliate_main.master')

@section('content')
<style>
    .rule-card {
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .rule-card-body {
        padding: 15px;
        padding-bottom: 0px;
    }
    .rule-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 2px;
    }
    .rule-description {
        font-size: 0.95rem;
        color: #555;
    }
</style>  

<main style="margin-top: 58px">
    <div class="container pt-4 px-4"> 
        <h3 class="py-3">Affiliate Rules</h3>
        <div class="row">
            @foreach($rules as $rule)
                <div class="col-md-12">
                    <div class="rule-card">
                        <div class="rule-card-body">
                            <div class="rule-title">Rule #{{ $loop->iteration }}</div>
                            <p class="rule-description">{{ $rule->rule }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
