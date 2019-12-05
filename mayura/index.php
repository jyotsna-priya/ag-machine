<?php
session_unset();
session_destroy();
session_regenerate_id();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>AGRI EDGE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  .navbar-brand {
    /*position: relative;*/
    background: url(logo.png);
    /*width: 7px;
    left: 15px;*/
    /*display:flex;*/
    height: 2em;
    width: 2em;
    background-size: contain;
}
.table th {
   text-align: center;   
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar">inside icon bar1</span>
        <span class="icon-bar">inside icon bar2</span>
        <span class="icon-bar">inside icon bar3</span>                        
      </button>
      <a class="navbar-brand" href="#">
          <!--img src="logo.jpg"-->
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a active href="index.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="pricing.php">Pricing</a></li>
        <li><a href="catalog.html">Order</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="contact.php"><span></span> Contact Us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="signup.php"><span ></span>Sign Up</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="signin.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
            <img src="tractor.jpeg" alt="tractor_image" style="height: 400px; width: 1200px">
        <div class="carousel-caption">
          <!--h3>AG Machine Tractors.</h3-->
          <!--p>AG Machine Tractors</p-->
        </div>      
      </div>

      <div class="item">
        <img src="drone.jpeg" alt="drone_image" style="height: 400px; width: 1200px">
        <div class="carousel-caption">
          <!--h3>More Sell $</h3-->
          <!--p>AG Machine Drones</p-->
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
  
<div class="container text-center">    
        <div class="container">
                <h2>AGRI EDGE</h2>
                <div align="center">
          <span class="d-block text-uppercase text-primary"> A Smart AG Machine Service</span>
          <h2 class="mb-4 section-title">WHO WE ARE </h2>
          <p>A cloud based company providing Agricultural IOT Edge Machines for farmers.</p>
          <p><a href="products.html" class="btn btn-outline-black">Learn More</a></p>
        </div>
              </div>
</div><br>

<footer class="container-fluid text-center">
  <p>Copyright AG-Machine Services 2019</p>
</footer>

</body>
</html>