<?php
include('../private/db_connection_GCP.php');

$first_name = "";
$last_name = "";
$username = "";
$email = "";
$address = "";
$password = "";

// to edit administrator accounts

if(isset($_GET['adminToBeEdited'])){
    // save the id of this admin in the cookie
    $adminToBeEdited = $_GET['adminToBeEdited'];

    // check if there's an admin with this ID
    $sql_checkUsersTable = "SELECT * FROM users WHERE UserID='$adminToBeEdited' AND isAdmin=1";
    $res_edit = mysqli_query($connection, $sql_checkUsersTable);

    
    // die(var_dump(mysqli_num_rows($res_edit) > 0));
    // if our query finds a row, update it
    if (mysqli_num_rows($res_edit) > 0) {
        while($userData = mysqli_fetch_assoc($res_edit)) {
            // set the variables to pick the user details
            $first_name = $userData["FirstName"];
            $last_name = $userData["LastName"];
            $username = $userData["Username"];
            $address = $userData["Address"];
            $email = $userData["Email"];
            $password = $userData["Pass"]; 
        } 
    }

    
}   
?>
