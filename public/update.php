<?php
include('../private/db_connection_GCP.php');

$first_name = "";
$last_name = "";
$username = "";
$email = "";
$address = "";
$password = "";

// save the userID from the user logged in this variable to run the query
$loggedUserId = $_SESSION['loggedUserId'];
$sql_checkUserID = "SELECT * FROM users WHERE UserID='$loggedUserId'";

$res_id = mysqli_query($connection, $sql_checkUserID);

// if we find any user with this id
if (mysqli_num_rows($res_id) > 0) {
    while($userData = mysqli_fetch_assoc($res_id)) {
        // set the variables to pick the user details
        $first_name = $userData["FirstName"];
        $last_name = $userData["LastName"];
        $username = $userData["Username"];
        $address = $userData["Address"];
        $email = $userData["Email"];
        $password = $userData["Pass"];
        
    } 
}

if(isset($_POST['update-account'])) {

    // Escape user inputs for security

    $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);

    // Attempt to update record
    $sql = "UPDATE users
            SET FirstName= '$first_name', LastName= '$last_name', Pass= '$password', Address= '$address'
            WHERE UserID = '$loggedUserId';";

    $results = mysqli_query($connection, $sql);
    header('Location: admin-dashboard.php');
}    
?>
