<?php
include('../private/db_connection_GCP.php');

$first_name = "";
$last_name = "";
$username = "";
$email = "";
$address = "";
$password = "";

// if the register-admin button is clicked
if(isset($_POST['register-admin'])) {

    // Escape user inputs for security, pick users input and save into variables 
    $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);

    // select username and emails with the value of user's input
    $sql_checkUser = "SELECT * FROM carol_2018250.users WHERE Username='$username'";
    $sql_checkEmail = "SELECT * FROM carol_2018250.users WHERE Email='$email'";
    $res_u = mysqli_query($connection, $sql_checkUser);
    $res_e = mysqli_query($connection, $sql_checkEmail);

    // first, check if the required fields are not empty
    if (empty($first_name) || empty($last_name) || empty($email) || empty($username) || empty($password)) {
      $empty_field_error = "This field is required"; 		
    }else{
      // if it's not empty, checking if there's not any other user with the same username or email
      if (mysqli_num_rows($res_u) > 0) {
        $name_error = "Sorry, this username was already taken"; 	
      }else if(mysqli_num_rows($res_e) > 0){
        $email_error = "Sorry, this email was already used"; 	
      }else{
      // attempt to insert query
          $sql = "INSERT INTO carol_2018250.users (FirstName, LastName, Username, Pass, IsAdmin, Address, Email) VALUES ('$first_name','$last_name', '$username', '$password', '1', '$address', '$email')";
          $results = mysqli_query($connection, $sql);
          header('Location: admin-dashboard.php');
      }
    }

  
}
    
    
?>
