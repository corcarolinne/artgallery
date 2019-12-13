<?php
include('../private/db_connection_GCP.php');

$first_name = "";
$last_name = "";
$username = "";
$email = "";
$address = "";
$password = "";

// to edit administrator accounts
if(isset($_POST['edit-admin'])){
    echo "entrou no codigo q pega o cookie";
    // save the id of this admin in the cookie
    $adminToBeEdited = $_COOKIE['adminToBeEdited'];

    // check if there's an admin with this ID
    $sql_checkUsersTable = "SELECT * FROM users WHERE UserID='$adminToBeEdited' AND isAdmin=1";
    $res_edit = mysqli_query($connection, $sql_checkUsersTable);

    // if our query finds a row, update it
    if (mysqli_num_rows($res_edit) > 0) {
        header('Location: admin-dashboard.php');
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
    
}   
?>
