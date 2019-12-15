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
// collect data from this user
$sql_checkUserID = "SELECT * FROM carol_2018250.users WHERE UserID='$loggedUserId'";
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

// if this button is clicked
if(isset($_POST['update-account'])) {

    // Escape user inputs for security, pick user's input
    $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);

    // check if there's any user with this email or username
    $sql_checkUser = "SELECT * FROM carol_2018250.users WHERE Username='$username'";
    $sql_checkEmail = "SELECT * FROM carol_2018250.users WHERE Email='$email'";
    $res_u = mysqli_query($connection, $sql_checkUser);
    $res_e = mysqli_query($connection, $sql_checkEmail);

    // saving UserID corresponding to the result of the query of usernames
    $row_u= mysqli_fetch_array($res_u);
    $userID_from_username_check = $row_u['UserID'];

    // saving UserID corresponding to the result of the query of emails
    $row_e= mysqli_fetch_array($res_e);
    $userID_from_email_check = $row_e['UserID'];

    // first, check if the required fields are not empty
    if (empty($first_name) || empty($last_name) || empty($email) || empty($username) || empty($password)) {
        $empty_field_error = "This field is required";
    }else{
        // if it's not empty, checking if there's not any other user with the same username or email
        if (mysqli_num_rows($res_u) > 0 && $userID_from_username_check !== $loggedUserId) {
            $name_error = "Sorry, this username was already taken"; 	
        }else if(mysqli_num_rows($res_e) > 0 && $userID_from_email_check !== $loggedUserId) {
            $email_error = "Sorry, this email was already used"; 	
        }else{
            // Attempt update query
            $sql = "UPDATE carol_2018250.users
                    SET FirstName= '$first_name', LastName= '$last_name', Username= '$username', Pass= '$password', Address= '$address', Email= '$email'
                     WHERE UserID = '$loggedUserId';";
            $results = mysqli_query($connection, $sql);
        }
    }
}    
?>
