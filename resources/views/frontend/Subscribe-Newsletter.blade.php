@extends ('frontend.master')

@section('content')
    <main class="content-container">




        <div class="nav-ash">
            <div class="site-common-con">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Newsletter Subscription</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="site-common-con">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="title color-purple mt-3 mb-3">Newsletter Subscription</h3>
                </div>
            </div>

            <!-- left contact data for mobile begin-->
            <div class="accordion accordion-flush acc-contact acc-contact-res-mobi" id="accordion-contact">


            </div>
            <!-- left contact data for mobile end-->

            <!-- left contact data for destop begin-->
            <div class="row">

                <div class="col-xl-12">

                    <div class="contact-form">

                        <form>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control">
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="mobile">Mobile</label>
                                <input type="tel" id="mobile" name="mobile" class="form-control">
                            </div>

                            {{-- <div class="recaptcha-container">
                                <div class="recaptcha">
                                    <input type="checkbox" id="recaptcha" name="recaptcha">
                                    <label for="recaptcha">I'm not a robot</label>
                                    <div class="recaptcha-logo">
                                        <img src="/api/placeholder/60/38" alt="reCAPTCHA logo">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="form-group col-sm-12">
                                <button type="submit" class="btn btn-site-default btn-inq fl mt-3">Subscribe</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <!-- left contact data for mobile end-->
        </div>



    </main>

    <br>
@endsection
