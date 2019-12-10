<?php
include('../private/db_connection_GCP.php');

if(isset($_POST['register-artist'])) {

    // Escape user inputs for security
    $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $website = mysqli_real_escape_string($connection, $_POST['website']);


    
    // Attempt insert query execution
    //$sql = "INSERT INTO user (fname, lname, username, email, password) VALUES ('$first_name', '$last_name', '$username' '$email)";
    $sql = "INSERT INTO artists (FirstName, LastName, Address, Website) VALUES ('$first_name','$last_name', '$address', '$website')";


    if(mysqli_query($connection, $sql)){
        echo "Records added successfully.";
        header('Location: admin-dashboard.php');
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
    }

}
?>
