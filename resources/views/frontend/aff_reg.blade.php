@extends('layouts.aff-master')



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

</style>

@if (session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success("{{ session('status') }}", 'Success', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
@endif



        <header>
            <div class="text-center bg-white border-bottom" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <div class="px-5">
                    <div class="row">
                    <div class="col-md-4 d-flex justify-content-center justify-content-md-start align-items-center mb-md-0">
                        <a href="{{ url('/home/affiliate/affiliate_home') }}" class="d-flex align-items-center" style="text-decoration: none">
                            <div class="navbar-brand">
                                <img src="/assets/images/logo.png" height="70" width="40" alt="Logo"/>
                            </div>
                            <img src="/assets/images/brand_name.png" style="height:27px; width:320;" alt="brand"/>
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


 
<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <h2 class="text-center mb-4 mt-3">Create Your Affiliate Account</h2>
            <div class="card register-card mt-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('aff_reg') }}">
                        @csrf

                        <h4>Basic Information</h4>
                        <br><br>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-start">Name <span class="text-danger"> *</span></label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-start">Address <span class="text-danger"> *</span></label>
                            <div class="col-md-7">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="district" class="col-md-4 col-form-label text-md-start">District <span class="text-danger"> *</span></label>
                            <div class="col-md-7">
                                <input id="district" type="text" class="form-control @error('district') is-invalid @enderror" name="district" value="{{ old('district') }}" required autocomplete="district">
                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="dob-day" class="col-md-4 col-form-label text-md-start">Date Of Birth <span class="text-danger"> *</span></label>
                            <div class="col-md-7 d-flex">
                              
                                <input id="dob-day" type="number" class="form-control me-2 @error('dob_day') is-invalid @enderror" name="dob_day" value="{{ old('dob_day') }}" placeholder="Day" required>
                                @error('dob_day')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                
                                <input id="dob-month" type="number" class="form-control me-2 @error('dob_month') is-invalid @enderror" name="dob_month" value="{{ old('dob_month') }}" placeholder="Month" required>
                                @error('dob_month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                
                                <input id="dob-year" type="number" class="form-control @error('dob_year') is-invalid @enderror" name="dob_year" value="{{ old('dob_year') }}" placeholder="Year" required>
                                @error('dob_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-start">Gender <span class="text-danger"> *</span></label>
                            <div class="col-md-7">
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                                    <option selected disabled>Select Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-start">Email Address <span class="text-danger"> *</span></label>
                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone_num" class="col-md-4 col-form-label text-md-start">Phone Number <span class="text-danger"> *</span></label>
                            <div class="col-md-7">
                                <input id="phone_num" type="text" class="form-control @error('phone_num') is-invalid @enderror" name="phone_num" value="{{ old('phone_num') }}" required autocomplete="phone_num">
                                @error('phone_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="NIC" class="col-md-4 col-form-label text-md-start">NIC <span class="text-danger"> *</span></label>
                            <div class="col-md-7">
                                <input id="NIC" type="text" class="form-control @error('NIC') is-invalid @enderror" name="NIC" value="{{ old('NIC') }}" required autocomplete="NIC">
                                @error('NIC')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-start">Password <span class="text-danger"> *</span></label>
                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-start">Confirm Password <span class="text-danger"> *</span></label>
                            <div class="col-md-7">
                                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>
                        <hr>
                        <br>

                        <h4>Promotional Methods</h4>
                        <br><br>


                        <!-- Promotion Method -->
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-start">Promotion Method</label>
                            <div class="col-md-7">
                                <div class="form-check">
                                    <input class="form-check-input @error('promotion_method') is-invalid @enderror" type="checkbox" name="promotion_method[]" value="Instagram" id="instagram" {{ is_array(old('promotion_method')) && in_array('Instagram', old('promotion_method')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="instagram">Instagram</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('promotion_method') is-invalid @enderror" type="checkbox" name="promotion_method[]" value="Facebook" id="facebook" {{ is_array(old('promotion_method')) && in_array('Facebook', old('promotion_method')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="facebook">Facebook</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('promotion_method') is-invalid @enderror" type="checkbox" name="promotion_method[]" value="TikTok" id="tiktok" {{ is_array(old('promotion_method')) && in_array('TikTok', old('promotion_method')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tiktok">TikTok</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('promotion_method') is-invalid @enderror" type="checkbox" name="promotion_method[]" value="YouTube" id="youtube" {{ is_array(old('promotion_method')) && in_array('YouTube', old('promotion_method')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="youtube">YouTube</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('promotion_method') is-invalid @enderror" type="checkbox" name="promotion_method[]" value="Content website/blog" id="content_website" {{ is_array(old('promotion_method')) && in_array('Content website/blog', old('promotion_method')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="content_website">Content website/blog</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('promotion_method') is-invalid @enderror" type="checkbox" name="promotion_method[]" value="WhatsApp" id="whatsapp" {{ is_array(old('promotion_method')) && in_array('WhatsApp', old('promotion_method')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="whatsapp">Through WhatsApp groups and status</label>
                                </div>
                                @error('promotion_method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <!-- Instagram Profile URL -->
                        <div class="row mb-3">
                            <label for="instagram_url" class="col-md-4 col-form-label text-md-start">Instagram Profile URL</label>
                            <div class="col-md-7">
                                <input id="instagram_url" type="url" class="form-control @error('instagram_url') is-invalid @enderror" name="instagram_url" value="{{ old('instagram_url') }}" autocomplete="instagram_url">
                                @error('instagram_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Facebook Page URL -->
                        <div class="row mb-3">
                            <label for="facebook_url" class="col-md-4 col-form-label text-md-start">Facebook Page URL</label>
                            <div class="col-md-7">
                                <input id="facebook_url" type="url" class="form-control @error('facebook_url') is-invalid @enderror" name="facebook_url" value="{{ old('facebook_url') }}" autocomplete="facebook_url">
                                @error('facebook_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- TikTok Profile URL -->
                        <div class="row mb-3">
                            <label for="tiktok_url" class="col-md-4 col-form-label text-md-start">TikTok Profile URL</label>
                            <div class="col-md-7">
                                <input id="tiktok_url" type="url" class="form-control @error('tiktok_url') is-invalid @enderror" name="tiktok_url" value="{{ old('tiktok_url') }}" autocomplete="tiktok_url">
                                @error('tiktok_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- YouTube Channel URL -->
                        <div class="row mb-3">
                            <label for="youtube_url" class="col-md-4 col-form-label text-md-start">YouTube Channel URL</label>
                            <div class="col-md-7">
                                <input id="youtube_url" type="url" class="form-control @error('youtube_url') is-invalid @enderror" name="youtube_url" value="{{ old('youtube_url') }}" autocomplete="youtube_url">
                                @error('youtube_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Content Website/Blog URL -->
                        <div class="row mb-3">
                            <label for="content_website_url" class="col-md-4 col-form-label text-md-start">Content Website/Blog URL</label>
                            <div class="col-md-7">
                                <input id="content_website_url" type="url" class="form-control @error('content_website_url') is-invalid @enderror" name="content_website_url" value="{{ old('content_website_url') }}" autocomplete="content_website_url">
                                @error('content_website_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Content whatsapp Group URL -->
                        <div class="row mb-3">
                            <label for="content_whatsapp_url" class="col-md-4 col-form-label text-md-start">Content Whatsapp Group URL</label>
                            <div class="col-md-7">
                                <input id="content_whatsapp_url" type="url" class="form-control @error('content_whatsapp_url') is-invalid @enderror" name="content_whatsapp_url" value="{{ old('content_whatsapp_url') }}" autocomplete="content_whatsapp_url">
                                @error('content_whatsapp_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>
                        <hr>
                        <br>

                        <h4>Payment Informations</h4>
                        <br><br>

                        <!-- Bank Name -->
                        <div class="row mb-3">
                            <label for="bank_name" class="col-md-4 col-form-label text-md-start">Bank Name<span class="text-danger"> *</span></label>
                            <div class="col-md-7">
                                <input id="bank_name" type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" value="{{ old('bank_name') }}" required autocomplete="bank_name">
                                @error('bank_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Branch -->
                        <div class="row mb-3">
                            <label for="branch" class="col-md-4 col-form-label text-md-start">Branch<span class="text-danger"> *</span></label>
                            <div class="col-md-7">
                                <input id="branch" type="text" class="form-control @error('branch') is-invalid @enderror" name="branch" value="{{ old('branch') }}" required autocomplete="branch">
                                @error('branch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Account Name -->
                        <div class="row mb-3">
                            <label for="account_name" class="col-md-4 col-form-label text-md-start">Account Name<span class="text-danger"> *</span></label>
                            <div class="col-md-7">
                                <input id="account_name" type="text" class="form-control @error('account_name') is-invalid @enderror" name="account_name" value="{{ old('account_name') }}" required autocomplete="account_name">
                                @error('account_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Account Number -->
                        <div class="row mb-3">
                            <label for="account_number" class="col-md-4 col-form-label text-md-start">Account Number<span class="text-danger"> *</span></label>
                            <div class="col-md-7">
                                <input id="account_number" type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ old('account_number') }}" required autocomplete="account_number">
                                @error('account_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>

                        <!-- Agree to Terms of Service and Privacy Policy -->
                        <div class="row mb-3">
                            <div class="col-md-7 ">
                                <div class="form-check">
                                    <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" name="terms" id="terms" {{ old('terms') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="terms">
                                        I agree to the <a href="/terms" target="_blank">Terms of Service</a> and <a href="/privacy" target="_blank">Privacy Policy</a>.
                                    </label>
                                </div>
                                @error('terms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>

                        <div class="row submit-btn mb-0">
                            <div class="col-md-7 offset-md-0.5">
                                <button type="submit" class="btn btn-warning">Register As Affiliate</button>
                            </div>
                        </div>
                    </form>
                </div>
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
