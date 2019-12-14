<?php
session_start();
echo $_SESSION['isLogged'];
$farmer_id=$_SESSION['farmer_id'];
echo $farmer_id;
if ((isset($_SESSION['isLogged'])) && ($_SESSION['isLogged'] == "TRUE")) {
    //echo $_SESSION['isLogged'];
 echo "<script>alert()</script>";
  //echo $_SESSION["farmer_id"];
} 
else {
    echo "<script>alert('Please Login to Rent')</script>";
    echo"<script>window.location='./signin.php'</script>";
}
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset="="UTF-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edge machine catalog</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

        <link rel= "stylesheet" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="cart.js" async></script>
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
        <li><a class="active" href="catalog.php">Order</a></li>
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
        <section>
            <div>
                <h1 class="heading">Edge Machines</h1>
                <div class="card-wrapper">
                    <div class="image">
                        <img src="assets/plant.jpg" alt="card background" class="card-img">
                        <img src="assets/drone1.jpg" alt="machine image" class="machine-img">
                        <h1 class="shop-item">Simple Drone</h1>
                        <p>base price: </p> 
                        <p class="price">$50</p>
                        <p>price per day:</p> 
                        <p>$2</p> 
                        <button class="btn btn-add" type="button">Add to Cart</button>                           
                    </div>
                    <div class="image">
                        <img src="assets/plant.jpg" alt="bard background" class="card-img">
                        <img src="assets/drone2.png" alt="machine image" class="machine-img">
                        <h1 class="shop-item">Deluxe Drone</h1>
                        <p>base price: </p> 
                        <p class="price">$100</p>
                        <p>price per day:</p> 
                        <p>$4</p>  
                        <button class="btn btn-add" type="button">Add to Cart</button>                            
                    </div>
                    <div class="image">
                        <img src="assets/plant.jpg" alt="bard background" class="card-img">
                        <img src="assets/tractor1.jfif" alt="machine image" class="machine-img">
                        <h1 class="shop-item">Simple Tractor</h1>
                        <p>base price: </p> 
                        <p class="price">$200</p>
                        <p>price per day:</p> 
                        <p>$6</p> 
                        <button class="btn btn-add" type="button">Add to Cart</button>                            
                    </div>
                    <div class="image">
                        <img src="assets/plant.jpg" alt="bard background" class="card-img">
                        <img src="assets/tractor2.jpg" alt="machine image" class="machine-img">
                        <h1 class="shop-item">Deluxe Tractor</h1>
                        <p>base price: </p> 
                        <p class="price">$400</p>
                        <p>price per day:</p> 
                        <p>$8</p> 
                        <button class="btn btn-add" type="button">Add to Cart</button>                            
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div>
                <h1 class="heading">Cart</h1>
                <div class="cart-row">
                    <span class="cart-item cart-header cart-column">ITEM</span>
                    <span class="cart-price cart-header cart-column">PRICE</span>
                    <span class="cart-quantity cart-header cart-column">QUANTITY</span>
                </div>
                <div class="cart-items">
                </div>
                <div class="cart-sub-total">
                    <strong class="cart-sub-total-title">Sub Total</strong>
                    <span class="cart-sub-total-price">$0</span>
                </div>
                <div class="cart-tax">
                        <strong class="cart-tax-title">Tax (10%)</strong>
                        <span class="cart-tax-price">$0</span>
                </div>
                <div class="cart-total">
                            <strong class="cart-total-title">Total</strong>
                            <span class="cart-total-price">$0</span>
                </div>
            </div>
            <p class="tooltip">final price will be charged when machines are returned</p>
            <button class="btn btn-remove-all" type="button">REMOVE ALL</button>
            <!-- <button onclick= "location.href='purchase.php'" class="btn btn-purchase" type="button">CONFIRM</button> -->
            <div id="paypal-button" class="btn-paypal btn-purchase"></div>
            
            <script src="https://www.paypalobjects.com/api/checkout.js"></script>
            <script>
            paypal.Button.render({
                // Configure environment
                env: 'sandbox',
                client: {
                sandbox: 'ATaYxwWBe9qznmdTuSmXYEexdMY1dir_9gJGXwHA3cGAp8U24SsElKICf4yXcELoYZ9GjRquHipBfZd6',
                production: 'demo_production_client_id'
                },
                // Customize button (optional)
                locale: 'en_US',
                style: {
                size: 'medium',
                color: 'black',
                shape: 'pill',
                },

                // Enable Pay Now checkout flow (optional)
                commit: true,
                // Set up a payment
                payment: function(data, actions) {
                    var subtotal = document.getElementsByClassName("cart-total-price")[0].innerHTML;
                    var thetotal = subtotal.replace("$","")
                    
                        return actions.payment.create({
                            transactions: [{
                            amount: {
                                total: thetotal,
                                currency: 'USD'
                            }
                            }]
                        });
                    
                
                },
                // Execute the payment
                onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        var subtotal = document.getElementsByClassName("cart-total-price")[0].innerHTML;
        var thetotal = subtotal.replace("$","")
        var mcType = document.getElementsByClassName("cart-item-title")[0].innerHTML;
        var farmerId = <?php echo $_SESSION['farmer_id']; ?>;
        console.log(farmerId);
        var totalArray = {}
        totalArray.total = thetotal
        totalArray.purchase="yes"
        totalArray.mcType = mcType
        totalArray.farmerId = farmerId

                    $.ajax({
                        url: 'mapping.php',
                        method: 'post',
                        data: totalArray,
                        success: function(res){
                            console.log(res)
                            // body...
                        }


                    })
       
        window.alert('Thank you for your purchase!');

      });
    }
  }, '#paypal-button');

            </script>
            
                                     
<?php

                                      
           
                              
?>
        
        </section>
        <footer class="container-fluid text-center">
  <p>Copyright AG-Machine Services 2019</p>
</footer>
    </body>
</html>