@extends('layouts.affiliate_main.master')

@section('content')

<!-- Font and Icon Styles -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    .bg-gradient-warning {
        background: linear-gradient(45deg, #FF9800, #FFC107);
    }
    .bg-gradient-success {
        background: linear-gradient(45deg, #4CAF50, #81C784);
    }
    .bg-gradient-info {
        background: linear-gradient(45deg, #00ACC1, #4DD0E1);
    }
    .bg-gradient-danger {
        background: linear-gradient(45deg, #F44336, #E57373);
    }
    .text-end {
        font-weight: bold;
    }
    .chart-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .chart-item {
        display: flex;
        flex-direction: column;
    }
    .chart-container {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background: #fff;
        border-radius: 5px;
        padding: 20px;
    }
    .card-body h3 {
        font-weight: bold;
    }
</style>

<!-- Main Layout -->
<main style="margin-top: 58px">
    <div class="container pt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row align-items-center mb-3 mt-2">
            <div class="col">
                <h2 class="h5 page-title">Welcome! </h2>
            </div>
        </div>

        <!-- Metrics Section -->
        <div class="row">
            <!-- Total Referrals Card -->
            <div class="col-xl-3 col-sm-6 col-12 mb-4">
                <div class="card bg-gradient-warning text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div><i class="material-icons" style="font-size: 3rem;">person_add</i></div>
                        <div class="text-end">
                            <h3>{{ $totalReferrals }}</h3>
                            <p class="mb-0">Total Referrals</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Views Card -->
            <div class="col-xl-3 col-sm-6 col-12 mb-4">
                <div class="card bg-gradient-success text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div><i class="material-icons" style="font-size: 3rem;">visibility</i></div>
                        <div class="text-end">
                            <h3>{{ $totalViews }}</h3>
                            <p class="mb-0">Total Views</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Paid Earnings Card -->
            <div class="col-xl-3 col-sm-6 col-12 mb-4">
                <div class="card bg-gradient-danger text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div><i class="material-icons" style="font-size: 3rem;">account_balance_wallet</i></div>
                        <div class="text-end">
                            <h3>LKR {{ number_format($completedPayments, 2) }}</h3>
                            <p class="mb-0">Paid Earnings</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Balance and Withdraw Card -->
            <div class="col-xl-3 col-sm-6 col-12 mb-4">
                <div class="card bg-gradient-info text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <i class="material-icons" style="font-size: 3rem;">account_balance</i>
                        </div>
                        <div class="text-end">
                            <h3>LKR {{ number_format($totalPaidEarnings, 2) }}</h3>
                            <p class="mb-0">Account Balance</p>
                        </div>
                    </div>
                    <div class="card-footer text-center bg-transparent">
                        <a href="{{ route('withdrawals') }}" class="btn btn-light btn-sm">Withdraw</a>
                    </div>
                </div>
            </div>
        </div>


        <!-- Charts Section -->
        <div class="row">
            <!-- Referrals Over Time Chart -->
            <div class="col-md-8 mb-4 chart-item">
                <div class="chart-container">
                    <div class="chart-title">Referrals Over the Last 12 Months</div>
                    <div id="referralsChart"></div>
                </div>
            </div>

            <!-- Earnings Distribution Chart -->
            <div class="col-md-4 mb-4 chart-item">
                <div class="chart-container">
                    <div class="chart-title">Earnings Distribution</div>
                    <div id="earningsChart"></div>
                </div>
            </div>
        </div>

        
    </div>
</main>

<!-- ApexCharts Scripts for Affiliate Dashboard -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Referrals Over Time (Line Chart)
    document.addEventListener('DOMContentLoaded', function () {
        var referralOptions = {
            series: [{
                name: 'Referrals',
                data: @json($referralsOverMonths)
            }],
            chart: {
                type: 'line',
                height: 300,
                toolbar: { show: false }
            },
            colors: ['#4CAF50'],
            xaxis: {
                categories: @json($months),
                labels: { style: { colors: '#6c757d' } }
            },
            yaxis: { labels: { style: { colors: '#6c757d' } } },
            stroke: { curve: 'smooth', width: 2 }
        };
        var referralChart = new ApexCharts(document.querySelector("#referralsChart"), referralOptions);
        referralChart.render();
    });

    // Earnings Distribution (Donut Chart)
    document.addEventListener('DOMContentLoaded', function () {
        var earningsOptions = {
            series: [@json($completedPayments), @json($totalPaidEarnings)], // Completed payments and account balance
            chart: {
                type: 'donut',
                height: 250,
            },
            labels: ['Withdrawn Amount', 'Account Balance'],
            colors: ['#FFC107', '#4CAF50'],
            plotOptions: {
                pie: {
                    donut: { size: '65%' }
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: { width: '100%' },
                    legend: { position: 'bottom' }
                }
            }]
        };
        var earningsChart = new ApexCharts(document.querySelector("#earningsChart"), earningsOptions);
        earningsChart.render();
    });

</script>

@endsection
