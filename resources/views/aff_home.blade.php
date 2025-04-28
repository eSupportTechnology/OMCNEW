@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


@section('content')
<style>
    .submit-btn {
        display: flex;
        justify-content: flex-start;
    }

    .modal-content {
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .modal-header .modal1{
        background-color: #f1f1f1;
        border-bottom: 1px solid #ddd;
    }

    .modal-footer {
        border-top: 1px solid #ddd;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

   

    .form-control {
                border: 2px solid rgb(234, 236, 240); /* Border color for search input */
                padding-right: 20px; /* Padding added to the right to make space for the icon */
                border-top-right-radius: 0;
                border-bottom-right-radius: 0;
               
            }
            .input-group {
                width: 500px; /* Ensure the input group can adjust to its content */
            }

            .input-group-text {
                background: transparent; /* Make the background transparent */
                border: none; /* Remove border */
                cursor: pointer;
                padding-left: 5px; /* Adjust padding for icon */
                padding-right: 5px;
                border-top-left-radius: 0;
                border-bottom-left-radius: 0;

            }

            .input-group-text i {
                color: rgb(77, 76, 92); /* Search icon color */
                font-size: 17px; /* Icon size */
            }

            /* Main Navigation Bar Styles */
            .signup-btn {
                background-color: black;
                color: white;
                padding: 5px 10px;
                border-radius: 5px;
                text-decoration: none;
            }

            /* Main Section Styles */
            .main {
                text-align: center;
                padding: 50px 0;
                background-image: url('/assets/images/team-meet-scaled.jpg'); 
                background-size: cover; /* Cover the entire section */
                background-position: center; /* Center the image */
                background-repeat: no-repeat; /* Prevent repeating */
                color: black; /* Text color to stand out on image */
                height: 400px; /* Adjust height based on your preference */
            }
            .main h1 {
                font-size: 50px;
                font-family: Aria, Helvetic, sans-seri;
                color: white;
                margin-bottom: 20px;
            }
            .main p {
                font-size: 18px;
                color: white;
            }
            

            .button {
                margin-top: 20px;
            }
            .button a {
                background-color: #007bff;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 16px;
            }
            .statistics {
                display: flex;
                justify-content: space-around;
                padding: 20px;
                background-color: hsl(214, 76%, 68%);
                margin-top: 40px;
            }
            .statistics div {
                text-align: center;
            }
            .statistics h2{
                font-size: 30px;
                color: aliceblue;
                font:bold;

            }
            .statistics p{
                font-size: 20px;
                color: hsl(240, 96%, 21%);
            }
            .affiliate-container {
                text-align: center;
                padding: 20px;
                background-color: #f5f5f5;
            }

           .affiliate-container h1 {
                font-size: 2.5rem;
                color: #333;
                margin-bottom: 10px;
            }

            .affiliate-container p {
                font-size: 1.2rem;
                color: #666;
                margin-bottom: 20px;
            }

          


           .card {
               height: 100%;
               min-height: 500px;
               width: 100%;
               background-color: rgba(0, 0, 0, 0.1); 
               color: white; 
               border: none;
               border-radius: 10px; 
               box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
              
            }
            .card-img-top {
              
               height: 300px;
            
               object-fit: cover;
               border-radius: 8px 8px 0 0;
             }


           .card-title {
               font-size: 1.25rem;
               font-weight: bold;
            }

           .card-text {
               font-size: 14px;
               color: #040408;
              
            }

            .container text-center mt-5 {
               background-color: #f8f9fa; 
               font-family: Arial, sans-serif;
            }

            .container text-center mt-5 h2 {
               font-weight: bold;
               margin-bottom: 40px;
               
            }

            .step {
               text-align: center;
               padding: 20px;
            }

            .step .icon {
               position: relative;
               font-size: 50px;
               color: #007bff; /* Icon color */
               margin-bottom: 10px;
            }

           .step .number {
               position: absolute;
               top: -15px;
               left: -25px;
               font-size: 80px;
               font-weight: bold;
               color: rgba(0, 0, 0, 0.1); /* Large number behind icon */
               z-index: -1;
            }

            p {
               font-size: 14px;
            }


        </style>




        <header>
            <div class="text-center bg-white border-bottom" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <div class="px-5">
                    <div class="row">
                    <div class="col-md-4 d-flex justify-content-center justify-content-md-start align-items-center mb-md-0">
                        <a href="#" class="d-flex align-items-center" style="text-decoration: none">
                            <div class="navbar-brand">
                                <img src="/assets/images/logo.png" height="60" width="40" alt="Logo"/>
                            </div>
                            <img src="/assets/images/brand_name.png" height="27" width="310" alt="brand"/>
                        </a>
                    </div>

                        <div class="col-md-5 p-3">
                            <form class="d-flex input-group w-auto my-auto mb-3 mb-md-0">
                                <input autocomplete="off" type="search" class="form-control rounded" placeholder="Search" />
                                <span class="input-group-text border-0 d-none d-lg-flex"><i class="fas fa-search"></i></span>
                            </form>
                        </div>

                        <div class="col-md-3 d-flex justify-content-center justify-content-md-end align-items-center">
                            <div class="d-flex align-items-center">                      
                                    <a class="text-reset me-3 signup-btn p-2" href="#" data-bs-toggle="modal" data-bs-target="#affloginModal">
                                        <div style="font-weight:500; color:white">
                                           LOGIN
                                        </div>
                                    </a>
                                    <a class="text-reset me-3 signup-btn p-2" href="{{ route('register_form') }}">
                                        <div style="font-weight:500; color:white">
                                            SIGN UP
                                        </div>
                                    </a>
                                <div class="dropdown me-3">
                                    <a id="navbarDropdown" class="text-reset dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</header>


 
        <!-- Main Section -->
        <div class="main-css">
            <h1>Promote, earn and grow with the Affiliate Program</h1>
            <p>Earn commission from orders you bring to Online marketing complex by joining the Affiliate Program.</p>

            <div class="button">
                <a href="#">Start earning</a>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="statistics">
            <div>
                <h2>150 +</h2>
                <p>Supported Countries & Regions</p>
            </div>
            <div>
                <h2>Up to 8%</h2>
                <p>Basic Commission Rate</p>
            </div>
            <div>
                <h2>150M</h2>
                <p>Affiliated Products</p>
            </div>
        </div>

         <!-- affiliate-container -->
         <div class="affiliate-container">
            <h1>Online marketing complex Affiliate partners & channels</h1>
            <p>If you have or want experience with (but not limited to) any of the following, come join us!</p>
            
        
         <div class="container mt-5">
            <div class="row g-3">
                <div class="col-md-3 d-flex">
                    <div class="card h-100">
                        <img src="https://media.istockphoto.com/id/1583075965/photo/closeup-microphone-in-auditorium-with-blurred-people-in-the-background.jpg?s=612x612&w=0&k=20&c=rj8qkn8M0VaiuZ_DFLxAcFb_5ZatY2VVduOErk0ViEg=" class="card-img-top" alt="Influencer">
                        <div class="card-body">
                            <h5 class="card-title">Influencer</h5>
                            <p class="card-text">Post Online marketing complex product info on social media</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="card h-100">
                        <img src="https://media.istockphoto.com/id/2162383464/photo/top-view-of-a-a-heart-shape-of-people-showing-unity-and-teamwork.jpg?s=612x612&w=0&k=20&c=uKHuYCRvSXCavfkpvT97k_g1ZM33phDT5zu1UZQBTlY=" class="card-img-top" alt="Chat groups">
                        <div class="card-body">
                            <h5 class="card-title">Chat groups</h5>
                            <p class="card-text">Online marketing complex product info in social chat groups</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="card h-100">
                        <img src="https://media.istockphoto.com/id/1499666574/photo/young-business-woman-watching-live-streaming-people-using-social-media-application-concept.jpg?s=612x612&w=0&k=20&c=nb0nICswbYn4AhyxEPsu4xua_c7QBi5PKHw6TTG3EsY="  class="card-img-top" alt="Content/blog sites">
                        <div class="card-body">
                            <h5 class="card-title">Content/blog sites</h5>
                            <p class="card-text">Promote Online marketing complex product copy in articles</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="card h-100">
                        <img src="https://media.istockphoto.com/id/1933784268/photo/multi-ethnics-teamwork-collaboration-team-meeting-communication-concept-in-business-people.jpg?s=612x612&w=0&k=20&c=scpuOEc5aT0Yibk0S42EoCmBoFpnY_CHiLkAjaYpSIE="  class="card-img-top" alt="Coupon sites">
                        <div class="card-body">
                            <h5 class="card-title">Deal sites</h5>
                            <p class="card-text">List great deals from Online marketing complex</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 d-flex">
                    <div class="card h-100">
                        <img src="https://media.istockphoto.com/id/1488521147/photo/global-network-usa-united-states-of-america-north-america-global-business-flight-routes.jpg?s=612x612&w=0&k=20&c=GUHBDWeC4QNzfvpv1UHFWXMPvd2FZ-7rQD-OfG9zIsY="  class="card-img-top" alt="Coupon sites">
                        <div class="card-body">
                            <h5 class="card-title">Networks and agencies</h5>
                            <p class="card-text">Promote Online marketing products through cooperation with multiple sites and channels</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 d-flex">
                    <div class="card h-100">
                        <img src="https://media.istockphoto.com/id/942169754/photo/handsome-man-offering-surprise-present-invitation-in-envelope-gift-to-his-young-woman.jpg?s=612x612&w=0&k=20&c=axhADMOdwOTAhL184G43Tvo5N2EYI_YRIr9sT84W8_A=" class="card-img-top" alt="Coupon sites">
                        <div class="card-body">
                            <h5 class="card-title">Coupon sites</h5>
                            <p class="card-text">Share Online marketing complex discount codes and store coupons with shoppers</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 d-flex">
                    <div class="card h-100">
                        <img src="https://media.istockphoto.com/id/1499914382/vector/online-money-transfer-money-transaction-to-an-electronic-wallet-or-bank-card.jpg?s=612x612&w=0&k=20&c=K1m79QxaJ6UOSlmlZM2f14lVLhIbFoRFWAHNLYiZrVI=" class="card-img-top" alt="Cashback sites">
                        <div class="card-body">
                            <h5 class="card-title">Cashback sites</h5>
                            <p class="card-text">Reward cashback to shoppers for making purchases with Online marketing complex</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 d-flex">
                    <div class="card h-100">
                        <img src= "https://media.istockphoto.com/id/1496036245/photo/startup-or-small-business-entrepreneur-make-a-note-of-delivery-address-from-the-customer.jpg?s=612x612&w=0&k=20&c=FvcQRQKW_yUpfjVne8dWBcGrc277yDj77bR1bI-u5_g=" class="card-img-top" alt="Coupon sites">
                        <div class="card-body">
                            <h5 class="card-title">Price comparison sites</h5>
                            <p class="card-text">Highlight price comparisons between Online marketing complex</p>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
 </div>

 <!--icon section-->

    <div class="container text-center mt-5">
        <h2>Promote and earn in 4 simple steps</h2>
        <div class="row mt-5">
            <div class="col-md-3">
                <div class="step">
                    <div class="icon">
                        <span class="number">1</span>
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <p>Choose products and get tracking links</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step">
                    <div class="icon">
                        <span class="number">2</span>
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <p>Promote products in channels</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step">
                    <div class="icon">
                        <span class="number">3</span>
                        <i class="fas fa-users"></i>
                    </div>
                    <p>Bring more traffic and orders to Online Marketing complex</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step">
                    <div class="icon">
                        <span class="number">4</span>
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <p>Get commission from shoppers' orders</p>
                </div>
            </div>
        </div>
    </div>





<!-- Login Modal -->
<div class="modal fade" id="affloginModal" tabindex="-1" aria-labelledby="affloginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="affloginModalLabel">Login for Affiliate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('aff_login') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email Address<i class="text-danger">*</i></label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password<i class="text-danger">*</i></label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary submit-button mt-2">
                            Sign In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Login Modal -->

@if ($errors->has('email') || $errors->has('password'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var affloginModal = new bootstrap.Modal(document.getElementById('affloginModal'));
            affloginModal.show();
        });
    </script>
@endif


<!-- Pending Modal -->
<div class="modal fade" id="pendingModal" tabindex="-1" aria-labelledby="pendingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal1">
                <h5 class="modal-title" id="pendingModalLabel">Registration Under Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="/assets/images/images.png" width="80px" alt="Review Image" class="mb-3">
                <p style="color:blue">Your registration is under review, please wait.<br>This may take 2-3 days.</p>
            </div>
        </div>
    </div>
</div>


<!-- Rejected Modal -->
<div class="modal fade" id="rejectedModal" tabindex="-1" aria-labelledby="rejectedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal1">
                <h5 class="modal-title" id="rejectedModalLabel">Registration Rejected</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="color:red">
                Unfortunately, your registration has been rejected.
            </div>
        </div>
    </div>
</div>

@if (session('status1') === 'pending')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var pendingModal = new bootstrap.Modal(document.getElementById('pendingModal'));
            pendingModal.show();
        });
    </script>
@elseif (session('status1') === 'rejected')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rejectedModal = new bootstrap.Modal(document.getElementById('rejectedModal'));
            rejectedModal.show();
        });
    </script>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
