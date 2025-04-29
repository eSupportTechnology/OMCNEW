@extends('layouts.user_sidebar')

@section('dashboard-content')

<style>
.card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.card h1 {
    font-size: 48px;
    font-weight: bold;
}

.card a {
    font-weight: bold;
}

.form-group {
    margin-bottom: 1rem;
}

.form-text {
    font-size: 0.875rem;
}

.btn-primary {
    padding: 10px 20px;
    font-size: 16px;
}
</style>


<h3 class="py-2 px-2 text-center">Available Points</h3>
<div class="container p-3">

    <!-- Available Points Section -->
        <h1 class="my-2 text-center mb-5">10</h1>
        <div class="d-flex justify-content-between" style="background-color: #f8f8a9;">
            <div class="p-2" style="flex: 1; text-align: center; border-right: 1px solid #ddd;">
                <a href="#" class="text-decoration-none text-dark">Withdraw Points</a>
            </div>
            <div class="p-2" style="flex: 1; text-align: center; border-right: 1px solid #ddd;">
                <a href="#" class="text-decoration-none text-dark">Deleted Points</a>
            </div>
            <div class="p-2" style="flex: 1; text-align: center;">
                <a href="#" class="text-decoration-none text-dark">Balance Points</a>
            </div>
        </div>
    


        <form class="mt-4">
            <div class="form-group row mb-3">
                <label for="convertPoints" class="col-sm-3 col-form-label">Convert your Point LKR:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="convertPoints">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="withdrawAmount" class="col-sm-3 col-form-label">Withdraw your point value (Amount):</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="withdrawAmount">
                </div>
                <small class="form-text text-danger mt-0">
                A value less than one thousand rupees (LKR 1000/=) cannot be exchanged
            </small><br>
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>

</div>

@endsection
