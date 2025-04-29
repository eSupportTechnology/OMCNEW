@extends('layouts.affiliate_main.master')

@section('content')
<style>
   

    .table thead{
        background-color: #f9f9f9; 
    }
    *{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
}
body{
    font-family: Helvetica;
    -webkit-font-smoothing: antialiased;
    background: rgba( 71, 147, 227, 1);
}
h2{
    text-align: left;
    font-size: 12px;
    letter-spacing: 1px;
    color: gray;
    padding: 30px 0;
}

/* Table Styles */

.table-wrapper{
    margin: 10px 10px 
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
    padding: -5px;
}

.fl-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.fl-table td, .fl-table th {
    text-align: center;
    padding: 15px;
}

.fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 14px;
}

.fl-table thead th {
    color: #0456b0;
    background: #d7e6f5;
    font-style: serif;
}


.fl-table thead th:nth-child(odd) {
    color: #0456b0;
    background: #d7e6f5;
}

.fl-table tr:nth-child(even) {
    background: #F8F8F8;
}

/* Responsive */

@media (max-width: 767px) {
    .fl-table {
        display: block;
        width: 100%;
    }
    .table-wrapper:before{
        content: "Scroll horizontally >";
        display: block;
        text-align: right;
        font-size: 11px;
        color: white;
        padding: 0 0 10px;
    }
    .fl-table thead, .fl-table tbody, .fl-table thead th {
        display: block;
    }
    .fl-table thead th:last-child{
        border-bottom: none;
    }
    .fl-table thead {
        float: left;
    }
    .fl-table tbody {
        width: auto;
        position: relative;
        overflow-x: auto;
    }
    .fl-table td, .fl-table th {
        padding: 20px .625em .625em .625em;
        height: 60px;
        vertical-align: middle;
        box-sizing: border-box;
        overflow-x: hidden;
        overflow-y: auto;
        width: 120px;
        font-size: 13px;
        text-overflow: ellipsis;
    }
    .fl-table thead th {
        text-align: left;
        border-bottom: 1px solid #f7f7f9;
    }
    .fl-table tbody tr {
        display: table-cell;
    }
    .fl-table tbody tr:nth-child(odd) {
        background: none;
    }
    .fl-table tr:nth-child(even) {
        background: transparent;
    }
    .fl-table tr td:nth-child(odd) {
        background: #F8F8F8;
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tr td:nth-child(even) {
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tbody td {
        display: block;
        text-align: center;
    }
}

  
</style>  

<main style="margin-top: 58px">
    <div class="container pt-4 px-4"> 
        <h3 class="py-3">Commission Rules</h3>

     <div class="wrap">
        <div class="search">
        <div style="display: flex; justify-content: left;">
        <input type="text" class="searchTerm"  placeholder="Please enter a Sub-participant"style="font-size: 0.9rem; width: 30%;">
        
            <button type="button" id="toggleSelectAll2" class="btn btn-secondary btn-sm" style="font-size: 0.9rem; width: 10%;">
            VIEW
            </button> 
        </div>
        <br>
        <br>

        <!-- Generate Button -->
        <div style="display: flex; justify-content: right;">
            <button type="button" id="toggleSelectAll2" class="btn btn-secondary btn-sm" style="font-size: 0.9rem; width: 35%;">
            Downlode Sub-participants' Commission Model
            </button>
        </div>
    </div>
        <h2>Commission Rates </h2>
    <div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
          <th><div class="col-md-1 mb-3">
              <label id="selectedCountLabel" style="font-size: 0.9rem;">
                Categary Name /ID <span id="selectedCount"></span>
              </label>
          </div></th>
          <th><div class="col-md-1 mb-3">
              <label id="selectedCountLabel" style="font-size: 0.9rem;">
              Categary Level <span id="selectedCount"></span>
              </label>
          </div></th>
          <th><div class="col-md-1 mb-3">
              <label id="selectedCountLabel" style="font-size: 0.9rem;">
              Commission rate of Affiliate Products<br> 
              made by new buyers <span id="selectedCount"></span>
              </label>
          </div></th>
          <th><div class="col-md-1 mb-3">
              <label id="selectedCountLabel" style="font-size: 0.9rem;">
              Commission rate of Affiliate Products<br> 
              made by old buyers <span id="selectedCount"></span>
              </label>
          </div></th>
          <th><div class="col-md-1 mb-3">
              <label id="selectedCountLabel" style="font-size: 0.9rem;">
              Commission rate of Non - Affiliate Products <span id="selectedCount"></span>
              </label>
          </div></th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>  
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tbody>
    </table>
</div>
</main>
