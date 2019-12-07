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
    <form class="form-signin" action="" method="post">
  <div class="container text-center">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <form class="form-signin" action="" method="post">
              <div class="form-label-group">
                <input type="text" name="email" id="username" class="form-control" placeholder="User Name" required autofocus>
                <label for="username"></label>
              </div>

              <div class="form-label-group">
                <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Password" required>
                <label for="pwd"></label>
              </div>

             
                
            
             <div class="form-group">
      <label for="role">Sign in As</label>
      <select class="form-control" id="role" name="role">
        <option value="F">Farmer</option>
        <option value="M">Machine Controller</option>
        <option value="S">Service Carrier</option>
       
      </select>
      </div>
              <input class="btn btn-lg btn-primary btn-block text-uppercase" id="signin" name= "signin" type="submit" value="Sign In">
                  
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


         


        

 

<?php
    if(isset($_POST['signin'])){
        echo "inside post";
        $email = $_POST['email'];
        echo $email;
        $password = $_POST['pwd'];
        echo $password;
        $role=$_POST['role'];
        echo $role;
        $conn = mysqli_connect("localhost", "root", "root", "db");
            // Check connection
            if ($conn->connect_error) {
                echo "connect failed";
                die("Connection failed: " . $conn->connect_error);
            }

             if(!empty($email) && !empty($password)){
                echo "inside main loop";
                if($role == 'F') {
                    $sql="SELECT password FROM farmers WHERE email = '$email'";
                    echo $sql;
                    $output= $conn->query($sql);
                     $row = $output->fetch_assoc();
                    if($output->num_rows > 0 && ($row['password'] == $password)){
                       echo "<script>window.location='./farmer.html'</script>";
                       session_start();
                       $_SESSION["isLogged"] = "1";

                    }
                    else{
                        echo "<div style='padding-left:10em;'><b>Incorrect Credentials!</b></div>";
                    }

                }
                    else if($role == 'S'){
                        echo "not farmers";
                    $sql="SELECT pwd FROM users WHERE user_name = '$email'";
                    echo $sql;
                    $output= $conn->query($sql);
                    $row = $output->fetch_assoc();
                    echo $row["pwd"];
                    if($output->num_rows > 0 && ($row['pwd'] == $password)){
                       echo "inside fetch";
                       echo "<script>window.location='./service.php'</script>";
                       session_start();
                       $_SESSION["isLogged"] = "1";
                        }
                        else{
                            echo "not valid";
                            echo "<div style='padding-left:10em;'><b>Incorrect Credentials!</b></div>";
                    }
                    }
                    else if($role == 'M'){
                        echo "not farmers";
                    $sql="SELECT pwd FROM users WHERE user_name = '$email'";
                    echo $sql;
                    $output= $conn->query($sql);
                    $row = $output->fetch_assoc();
                    echo $row["pwd"];
                    if($output->num_rows > 0 && ($row['pwd'] == $password)){
                       echo "inside fetch";
                       echo "<script>window.location='./solutions.php'</script>";
                       session_start();
                       $_SESSION["isLogged"] = "1";
                        }
                        else{
                            echo "not valid";
                            echo "<div style='padding-left:10em;'><b>Incorrect Credentials!</b></div>";
                    }
                    }
                    }
                    else{
                            echo "error";
                            echo "<div style='padding-left:10em;'><b>Fields cannot be empty</b></div>";

                        }
                    $conn->close();

             }
              
      
?>

   <footer class="container-fluid text-center">
  <p>Copyright AG-Machine Services 2019</p>
</footer>
    
</body>
</html>