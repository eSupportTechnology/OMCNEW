<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  

    <style>


      #introCarousel,
      .carousel-inner,
      .carousel-item,
      .carousel-item.active {
        height: 85vh;
      }

      .carousel-item {
        background-size: cover;
        background-repeat: no-repeat;
      }

      .carousel-item h1,
      .carousel-item h5,
      .carousel-item a {
        text-align: left;
        position: absolute;
        left: 10%; 
      }

      .carousel-item h1 {
        font-size: 70px;
        text-transform: uppercase;
        font-weight: bold;
        color: #1c0a60;
        transform: translateY(-50%);
        padding-bottom: 150px;
        top: 50%; 
      }

      .carousel-item h5 {
        top: 50%; 
        padding-bottom: 20px;
        font-size: 35px;
        font-weight: bold;
        color: #341f82;
      }

      .carousel-item a {
        top: 65%;
        background: #1c0a60;
        display: inline-block;
        color: white;
        border-radius: 25px;
        text-decoration: none;
      }

      .carousel-item a:hover {
        background-color: black;
        color: white;
      }

      @media (min-width: 992px) {
        #introCarousel {
          
        }
      }

     .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.1);
        border: none;
      }

      .carousel-indicators .active {
        background-color: rgba(0, 0, 0, 0.5);
      }
    </style>
</head>
<body>
  <header>
    <!-- Carousel wrapper -->
    <div id="introCarousel" class="carousel slide carousel-fade shadow-2-strong" data-mdb-ride="carousel">

       <div class="carousel-indicators">
        <button type="button" data-mdb-target="#introCarousel" data-mdb-slide-to="0" class="active me-1"></button>
        <button type="button" data-mdb-target="#introCarousel" data-mdb-slide-to="1" class="me-1"></button>
        <button type="button" data-mdb-target="#introCarousel" data-mdb-slide-to="2"></button>
      </div>

      <div class="carousel-inner">
        <div class="carousel-item active" style="background-image: url('/assets/images/slider/slider.png');">
          <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-white" data-mdb-theme="dark">
              <h1 class="mb-3">Elevate Your <br>Lifestyle</h1>
              <h5 class="mb-4">On home & living, leisure & more</h5>
              <a class="btn btn-outline-light btn-lg m-2"  href="" role="button" rel="nofollow">Add to Cart</a>
            </div>
          </div>
        </div>

        <div class="carousel-item" style="background-image: url('/assets/images/slider/slider.png');">
          <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-white" data-mdb-theme="dark">
              <h1 class="mb-3">Elevate Your <br>Lifestyle</h1>
              <h5 class="mb-4">On home & living, leisure & more</h5>
              <a class="btn btn-outline-light btn-lg m-2"  href="" role="button" rel="nofollow">Add to Cart</a>
            </div>
          </div>
        </div>

        <div class="carousel-item" style="background-image: url('/assets/images/slider/slider.png');">
          <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-white" data-mdb-theme="dark">
              <h1 class="mb-3">Elevate Your <br>Lifestyle</h1>
              <h5 class="mb-4">On home & living, leisure & more</h5>
              <a class="btn btn-outline-light btn-lg m-2"  href="" role="button" rel="nofollow">Add to Cart</a>
            </div>
          </div>
        </div>
      </div>

      <a class="carousel-control-prev" href="#introCarousel" role="button" data-mdb-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#introCarousel" role="button" data-mdb-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>

  <script type="text/javascript" src="/assets/carousel/js/mdb.umd.min.js"></script>
  <script>
    const carousel = new mdb.Carousel(document.querySelector('#introCarousel'), {
      interval: 2000,
      ride: 'carousel'
    });
  </script>
</body>
</html>
