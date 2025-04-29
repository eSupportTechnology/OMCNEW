@extends('layouts.affiliate_main.master')

@section('content')
<style>
    .table thead {
        background-color: #f9f9f9; 
    }

    .form-controls {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

   .form-label{
    width:100px;
   }
    .form-controls .btn {
        font-size: 10px;
    }
</style>  

<main style="margin-top: 58px">
    <div class="container pt-4 px-4"> 
        <h3 class="py-3">Transaction Product Report</h3>

        <div class="card">
            <div class="card-body">
                <div class="tab-pane fade show active" role="tabpanel">
                    <div class="row align-items-center mb-2 ms-2">
                        <div class="col-md-4 mb-2 d-flex align-items-center">
                            <input type="date" id="date" class="form-control" style="font-size: 0.8rem;">
                        </div>
                        <div class="col-md-4 mb-2 d-flex align-items-center">
                            <select id="tracking_id" class="form-select" style="font-size: 0.8rem;">
                                <option selected>Featured Products</option>
                            </select>
                        </div>
                    </div>

                
                    <div class="form-controls mb-3 ms-3">
                        <button class="btn btn-secondary">Reset</button>
                    </div>

                    <h5 class="py-3 mt-5 ms-3">Transaction Product Category Distribution</h5>
                    <div class="col-md-3 mb-2  ms-3 d-flex align-items-center">
                            <select id="tracking_id" class="form-select" style="font-size: 0.8rem;">
                                <option selected>Show By Sales</option>
                                <option>Show By GMW</option>
                            </select>
                        </div>

                    <div class="container mt-5 mb-4">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Platform</th>
                                    <th scope="col">Tracking ID</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Clicks</th>
                                    <th scope="col">Page Views</th>
                                    <th scope="col">Unique Visitors</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>  
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
