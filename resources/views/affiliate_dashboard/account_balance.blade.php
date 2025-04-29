@extends('layouts.affiliate_main.master')

@section('content')
<style>
   

    .table thead{
        background-color: #f9f9f9; 
    }

    .filter-option {
    cursor: pointer;
    font-size: 0.8rem;
    color: #007bff; 
    }

    .filter-option.active {
        font-weight: bold;
    }

  
</style>  

<main style="margin-top: 58px">
    <div class="container pt-4 px-4"> 
        <h3 class="py-3">Account Balance</h3>

        <div class="card">
            <div class="card-body">
                <div class="tab-pane fade show active" role="tabpanel">
                    <div class="row align-items-center mb-3">
                        <div class="col-md-4 mb-2 d-flex align-items-center">
                            <input type="date" id="date" class="form-control" style="font-size: 0.8rem;">
                        </div>
                        <div class="col-md-8 mb-2 d-flex align-items-center">
                            <span id="last3Months" class="filter-option me-3 active">Last 3 Months</span>
                            <span id="last6Months" class="filter-option me-3">Last 6 Months</span>
                            <span id="oneYear" class="filter-option">1 Year</span>
                        </div>
                    </div>

                    <div class="container mt-4 mb-4">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Type Of Income</th>
                                    <th scope="col">Income</th>
                                    <th scope="col">Deductions</th>
                                    <th scope="col">Withdrawals</th>
                                </tr>
                                </thead>
                                <tbody id="incomeTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Card Footer -->
            <div class="card-footer d-flex justify-content-between align-items-center">
                <span>Total: 0</span>
                <div class="d-flex align-items-center">
                    <label for="items-per-page" class="form-label me-2 mb-0">Items per page:</label>
                    <select id="items-per-page" class="form-select items-per-page" style="font-size: 0.8rem; width: auto;">
                        <option value="2">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                </div>
                <!-- Pagination controls -->
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#"><i class="fa-solid fa-arrow-left"></i></a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-arrow-right"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</main>

@endsection
