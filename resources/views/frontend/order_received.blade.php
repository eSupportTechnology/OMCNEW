@extends ('frontend.master')

@section('content')

<style>
 

  .card {
    border-radius: 0; 
    width: 90%;
  }

  .thank-you-section {
    display: flex;
    justify-content: center; 
    align-items: center;

  }

  .card-container {
    display: flex;
    justify-content: center; 
    align-items: center; 

  }
</style>

 <!-- Start Page Title -->
 <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>Order Received</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li>Order Received</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

<div class="container mt-4">
 
  <section class="thank-you-section mb-4" >
    <!-- Payment -->
    <div class="col-md-12 mb-4 card-container" >
      <div class="card shadow-0 border" style="background-color:#f5f5f5">
        @csrf
        <div class="p-4 text-center">
          <h4 style="color: orange;">Thank You for Your Purchase!</h4>
          <h6 class="mt-4">Your order has been confirmed. Your order code is: <strong>{{ $order_code }}</strong></h6>
          <p class="mt-4">Please have this amount ready on the delivery day.</p>
          <h5 style="color: orange;">Rs.{{ $total_cost }}</h5>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection
