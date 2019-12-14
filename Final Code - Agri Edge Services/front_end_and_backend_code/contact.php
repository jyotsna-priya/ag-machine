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
    .con{
      padding: 10px;
      height:600px;
    }
    .cfield{
      padding: 3%;
      margin-bottom: 1%;
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
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="pricing.php">Pricing</a></li>
        <li><a href="catalog.php">Order</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a class="active" href="contact.php"><span></span> Contact Us</a></li>
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


  
  <div class="container con text-center" >
  <div class="row">
      <div>
        <h2>Contact Us</h2>
        
      </div>
    
    <div class="col-md-9 " align="center">
      <div class="contact-form" align="center">
        <form action="" name="form_contact" id="form_contact" method="post">
        <div class="form-group cfield">
          <label class="control-label col-sm-2" for="first_name">First Name:</label>
          <div class="col-sm-10">          
          <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name">
          </div>
        </div>
        <div class="form-group cfield">
          <label class="control-label col-sm-2" for="last_name">Last Name:</label>
          <div class="col-sm-10">          
          <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name">
          </div>
        </div>
        <div class="form-group cfield">
          <label class="control-label col-sm-2" for="email">Email:</label>
          <div class="col-sm-10">
          <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
          </div>
        </div>
        <div class="form-group cfield">
          <label class="control-label col-sm-2" for="sub">Subject:</label>
          <div class="col-sm-10">          
          <input type="text" class="form-control" id="sub" placeholder="Enter subject" name="sub">
          </div>
        </div>
        <div class="form-group cfield">
          <label class="control-label col-sm-2" for="message">Message:</label>
          <div class="col-sm-10">
          <textarea class="form-control" rows="5" id="message" name="message"></textarea>
          </div>
        </div>
        <div class="form-group cfield">        
          <div class="col-sm-offset-2 col-sm-10">
          <input type="submit" class="btn btn-primary" name="submit" value="Send message">
          </div>
        </div>
      </form>
      </div>
    
    </div>
 
    </div>
  </div>

<?php
if(isset( $_POST['submit'])){
  $firstname = $_POST['first_name'];
  $lastname = $_POST['last_name'];
  $email = $_POST['email'];
  $subject = $_POST['sub'];
  $message = $_POST['message'];

$mail_header = "From: $email \r\n";
mail("dhiv408@gmail.com", $subject, $message,"dhiv408@gmail.com") or die("Error!");
echo "<script>alert('Email Sent');</script>";

}

?>

<footer class="container-fluid text-center">
  <p>Copyright Agri Edge 2019</p>
</footer>

</body>
</html>
