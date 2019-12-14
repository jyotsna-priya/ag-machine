Uername
Email
PASSWORD_DEFAULT
First Name
Last Name
HomeAddrLine1
HomeAddrLine2
HomeCity
HomeState
HomeZip
FarmAddrLine1
FarmAddrLine2
FarmCity
FarmState
FarmZip
CardNumber
NameOnCard
ExpiryDate
CVV
<?php
    if(isset($_POST['submitbtn'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $homeAddrLine1 = $_POST['homeAddrLine1'];
        $homeAddrline2 = $_POST['homeAddrLine2'];
        $homeCity = $_POST['homeCity'];
        $homeState = $_POST['homeState'];
        $homeZip = $_POST['homeZip'];
        $homePhone = $_POST['homePhone'];
        $farmAddrLine1 = $_POST['farmAddrLine1'];
        $farmAddrline2 = $_POST['farmAddrLine2'];
        $farmCity = $_POST['farmCity'];
        $farmState = $_POST['farmState'];
        $farmZip = $_POST['farmZip'];
        $cardNumber = $_POST['cardNumber'];
        $nameOnCard = $_POST['nameOnCard'];
        $expiryDate = $_POST['expiryDate'];
        $CVV = $_POST['CVV'];
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
        /*Validation for city*/
        if ( ($homeCity == '') || ($farmCity == '') || !preg_match("/^([a-zA-Z' ]+)$/", $homeCity) || !preg_match("/^([a-zA-Z' ]+)$/", $farmCity)) {
            $flag = 0;
            echo "<div style='padding-left:10em;'><b>Please enter a valid city name!</b><br></div>";
        }
        /*Validation for state*/
        if (($homeState == '') || ($farmState == '') || !preg_match("/^([a-zA-Z' ]+)$/", $homeState) || !preg_match("/^([a-zA-Z' ]+)$/", $farmState)){
            $flag = 0;
            echo "<div style='padding-left:10em;'><b>Please enter a valid state name!</b><br></div>";
        } 
        /*Validation for home zip code*/
        if ( ($homeZip != '') && (!preg_match('/[0-9]/', $homeZip) || strlen($homeZip) != 5) ){
            $flag = 0;
            echo "<div style='padding-left:10em;'><b>Please enter a valid 5 digit zip code!</b><br></div>";
        }
        /*Validation for farm zip code*/
        if ( ($farmZip != '') && (!preg_match('/[0-9]/', $farmZip) || strlen($farmZip) != 5) ){
            $flag = 0;
            echo "<div style='padding-left:10em;'><b>Please enter a valid 5 digit zip code!</b><br></div>";
        }
        /*Validation for home phone number*/
        if ( $homePhone== '' || !preg_match('/[0-9]/', $homePhone) || (strlen($homePhone) != 10)){
            $flag = 0;
            echo "<div style='padding-left:10em;'><b>Please enter a valid 10-digits home phone number!</b><br></div>";
        }
        /*Validation for card number*/
        if ( $cardNumber == '' || !preg_match('/[0-9]/', $cardNumber) || (strlen($cardNumber) != 11) ){
            $flag = 0;
            echo "<div style='padding-left:10em;'><b>Please enter a valid 11-digits card number!</b><br></div>";
        }
        /*Validation for card number*/
        if ( $CVV == '' || !preg_match('/[0-9]/', $CVV) || (strlen($CVV) != 11) ){
            $flag = 0;
            echo "<div style='padding-left:10em;'><b>Please enter a valid 3-digits cvv number!</b><br></div>";
        }
        /*Validation for name on card*/
        if(($nameOnCard =='') || !preg_match("/^([a-zA-Z' ]+)$/",$nameOnCard)){ 
            $flag= 0; 
            echo "<div style='padding-left:10em;'><b>Please enter a name on card!</b><br></div>"; 
            
        }
        if ( $flag == 0 ) {
            echo "<div style='padding-left:10em;'><b>User not created because of incorrect credentials!</b></div>"; 
        }
        else {
            /*set up connection with the database*/
            $conn = mysqli_connect("ec2-54-161-132-160.compute-1.amazonaws.com", "ag-machine", "password123", "agmachinedb");
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT county, city, edgestation_id, rented FROM edgestation";
                                      $result = $conn->query($sql);
                                      if ($result->num_rows > 0) {
                                      // output data of each row
                                      while($row = $result->fetch_assoc()) {
                                        $_SESSION['county'] = $row["county"];
                                        $_SESSION['city'] = $row["city"];
                                        $_SESSION['edgestation_id'] = $row["edgestation_id"];
                                        $_SESSION['rented'] = $row["rented"];
                                        /*echo "<tr><td>" . $row["county"]. "</td><td>" . $row["city"] . "</td><td>"
                                      . $row["edgestation_id"]. "</td><td>" . "<a href = 'sensors.php'>Select</a>" . "</td></tr>";*/
                                        echo "<tr><td>";
                                        echo $row["county"];
                                        echo "</td><td>";
                                        echo $row["city"];
                                        echo "</td><td>";
                                        echo $row["edgestation_id"];
                                        echo "</td><td>";
                                        echo "<a href = 'sensors.php'>Select</a>";
                                        echo "</td></tr>";
                                      }
                                      echo "</table>";
                                      } else { echo "0 results"; }
                                      $conn->close();
            $table_name = 'RegisteredUsers';
            $Result = $wpdb->insert($table_name, array (
                'FirstName' => $firstname, 
                'LastName' => $lastname,
                'Email' => $email,
                'Password' => $password,
                'AddressLine1' => $addressline1,
                'AddressLine2' => $addressline2,
                'City' => $city,
                'State' => $state,
                'Zip' => $zip,
                'HomePhone' => $homephone,
                'CellPhone' => $cellphone
                ));
            if ($Result == 1){
                echo "<div style='padding-left:10em;'>User created and details submitted successfully in the database!</div>";
            }
            else{
                echo "<div style='padding-left:10em;'>Error in creating the user!</div>";
            }
        }
    }
?>