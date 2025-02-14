<?php
include('../private/db_connection_GCP.php');

$first_name = "";
$last_name = "";
$username = "";
$email = "";
$address = "";
$password = "";
$website = "";
$title = "";
$artist = "";
$type = "";

// to edit administrator accounts
if(isset($_GET['adminToBeEdited'])){
    // save the id of this admin
    $adminToBeEdited = $_GET['adminToBeEdited'];

    // check if there's an admin with this ID
    $sql_checkUsersTable = "SELECT * FROM carol_2018250.users WHERE UserID='$adminToBeEdited' AND isAdmin=1";
    $res_edit = mysqli_query($connection, $sql_checkUsersTable);

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

    // if this button is clicked
    if(isset($_POST['update-admin'])) {

        // Escape user inputs for security, pick users input
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
    
        // select all from these tables where username and email are the same as users input
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
            if (mysqli_num_rows($res_u) > 0 && $userID_from_username_check !== $adminToBeEdited) {
                $name_error = "Sorry, this username was already taken"; 	
            }else if(mysqli_num_rows($res_e) > 0 && $userID_from_email_check !== $adminToBeEdited) {
                $email_error = "Sorry, this email was already used"; 	
            }else{
                // update query
                $sql = "UPDATE carol_2018250.users
                        SET FirstName= '$first_name', LastName= '$last_name', Username= '$username', Pass= '$password', Address= '$address', Email= '$email'
                        WHERE UserID = '$adminToBeEdited';";
                $results = mysqli_query($connection, $sql);
                header('Location: admin-dashboard.php');
            }
        }
    }   
}
// to edit artist details
if(isset($_GET['artistToBeEdited'])){
    // save the id of this artist
    $artistToBeEdited = $_GET['artistToBeEdited'];

    // check if there's an artist with this ID
    $sql_checkArtistsTable = "SELECT * FROM carol_2018250.artists WHERE ArtistID='$artistToBeEdited'";
    $res_edit = mysqli_query($connection, $sql_checkArtistsTable);

    // if our query finds a row
    if (mysqli_num_rows($res_edit) > 0) {
        while($artistData = mysqli_fetch_assoc($res_edit)) {
            // set the variables to pick the input
            $first_name = $artistData["FirstName"];
            $last_name = $artistData["LastName"];
            $address = $artistData["Address"];
            $website = $artistData["Website"];
        } 
    }

    // if this button is clicked
    if(isset($_POST['update-artist'])) {

        // Escape user inputs for security, pick users input
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $website = mysqli_real_escape_string($connection, $_POST['website']);
    
        // checking if required fields are not empty
        if (empty($first_name) || empty($last_name) || empty($website)) {
            $empty_field_error = "This field is required"; 		
        }else{
        // Attempt to update record
            $sql = "UPDATE carol_2018250.artists
            SET FirstName= '$first_name', LastName= '$last_name', Address= '$address',  Website= '$website'
            WHERE ArtistID = '$artistToBeEdited';";
                // if the query is sucessful
                if(mysqli_query($connection, $sql)){
                    header('Location: admin-dashboard.php');
                } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
                }
        }
    }
}    
// to edit art piece details
if(isset($_GET['artToBeEdited'])){
    // save the id of this art
    $artToBeEdited = $_GET['artToBeEdited'];

    // check if there's an art with this ID
    $sql_checkArtsTable = "SELECT * FROM carol_2018250.arts WHERE ArtID='$artToBeEdited'";
    $res_edit = mysqli_query($connection, $sql_checkArtsTable);

    // if our query finds a row
    if (mysqli_num_rows($res_edit) > 0) {
        while($artData = mysqli_fetch_assoc($res_edit)) {
            // set the variables to pick the input
            $title = $artData["Title"];
            $artist = $artData["ArtistID"];
            $type = $artData["ArtType"];
        } 
    }

    // if this button is clicked
    if(isset($_POST['update-art'])) {

        // Escape user inputs for security, pick users input
        $title = mysqli_real_escape_string($connection, $_POST['title']);
        $artist = mysqli_real_escape_string($connection, $_POST['artist']);
        $type = mysqli_real_escape_string($connection, $_POST['type']);
    
        // checking if requiered fields are not empty
        if (empty($title)) {
            $empty_field_error = "This field is required"; 		
        }else{
        // Attempt to update
            $sql = "UPDATE carol_2018250.arts
                    SET Title= '$title', ArtistID= '$artist', ArtType= '$type'
                    WHERE ArtID = '$artToBeEdited';";
            // if the query is sucessful
            if(mysqli_query($connection, $sql)){
                header('Location: admin-dashboard.php');
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
            }
        }
    }
    
}  
?>
