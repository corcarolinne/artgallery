<?php
include('../private/db_connection_GCP.php');

$first_name = "";
$last_name = "";
$address = "";
$website = "";

if(isset($_POST['register-artist'])) {

    // Escape user inputs for security
    $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $website = mysqli_real_escape_string($connection, $_POST['website']);

    // checking if requiered fields are not empty
    if (empty($first_name) || empty($last_name) || empty($website)) {
        $empty_field_error = "This field is required"; 		
    }else{
      // Attempt insert query execution
        $sql = "INSERT INTO carol_2018250.artists (FirstName, LastName, Address, Website) VALUES ('$first_name','$last_name', '$address', '$website')";
        // if the query is sucessful
        if(mysqli_query($connection, $sql)){
            header('Location: admin-dashboard.php');
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
        }
    }

}
?>
