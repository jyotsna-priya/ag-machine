?php
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
        <li><a href="index.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="pricing.php">Pricing</a></li>
        <li><a href="catalog.html">Order</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a class="active" href="contact.php"><span></span> Contact Us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="signup.php"><span ></span>Sign Up</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a class="active" href="signin.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
    

    
        


  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <form class="form-signin" action="" method="post">
              <div class="form-label-group">
                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="FirstName" required autofocus>
                <label for="lastname"></label>
            </div>
            <div class="form-label-group">
                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="LastName" required >
                <label for="lastname"></label>
              </div>
              <div class="form-label-group">
                <input type="text" name="email" id="email" class="form-control" placeholder="email" required>
                <label for="email"></label>
              </div>
              <div class="form-label-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <label for="password"></label>
              </div>
                <div class="form-label-group">
                <input type="password"   class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Repeat your password" required/>
                <label for="confirmPassword"  > </label>
            </div>
                            
                            <div class="form-label-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                           <input class="btn btn-lg btn-primary btn-block text-uppercase" id="signup" value="Sign Up" type="submit" name="submitbtn">
                        </form>
                    </div>
                    <div class="signup-image">
                       
                        <a href="signin.php" class="signup-image-link">I am already member</a>
                    </div>

             
                
            
             
              
                  
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
    if(isset($_POST['submitbtn'])){
        echo "inside isset";
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        
        

        
        $flag = 1;
        /*Validation for first name*/
        if(($firstname =='') || !preg_match("/^([a-zA-Z' ]+)$/",$firstname)){ 
            $flag= 0; 
            echo "<div style='padding-left:10em;'><b>Please enter a valid first name!</b><br></div>"; 
            
        }
        /*Validation for last name*/
        if(($lastname =='') || !preg_match("/^([a-zA-Z' ]+)$/",$lastname)){ 
            $flag= 0; 
            echo "<div style='padding-left:10em;'><b>Please enter a valid last name!</b><br></div>"; 
            
        }
        /*Validation for email*/
        if( ($email == '') || !filter_var($email, FILTER_VALIDATE_EMAIL) ) { 
            $flag= 0; 
            echo "<div style='padding-left:10em;'><b>Please enter valid E-mail!</b><br></div>"; 
        }
        /*Validation for passwords*/
        if ( ($password=='') || ($confirmPassword=='') ){
            $flag=0;
            echo "<div style='padding-left:10em;'><b>Password fileds are required!</b><br></div>";
        }
        if (strcmp($password, $confirmPassword) != 0){
            $flag= 0;
            echo "<div style='padding-left:10em;'><b>Your passwords do not match!</b><br></div>";
        }
        
        /*Validation for home phone number*/

       
        if ( $flag == 0 ) {
            echo "<div style='padding-left:10em;'><b>User not created because of incorrect credentials!</b></div>"; 
        }
        else {
            /*set up connection with the database*/
           
            $conn = mysqli_connect("ec2-54-161-132-160.compute-1.amazonaws.com", "ag-machine", "password123", "agmachinedb");
            // Check connection
            if ($conn->connect_error) {
                echo "connect failed";
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "INSERT INTO farmers(firstname_farmer, lastname_farmer, email_id, password) values('$firstname', '$lastname', '$email', '$password')";
            echo $sql;
            if( !mysqli_query($conn,$sql)){
                echo "inside if";
                echo("Error:".mysqli_error($conn));

            }
            

           else{
                //echo "You have successfully created your account!";
                 echo"<script>window.location='./signin.php'</script>";
            }
        
    
        }
    }
?>

        

 

<footer class="container-fluid text-center">
  <p>Copyright AG-Machine Services 2019</p>
</footer>

    <!-- JS -->
    <script src="vendor/jquery/jquery1.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>