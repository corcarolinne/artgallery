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

    if(isset($_POST['update-admin'])) {

        //die(var_dump(isset($_POST['update-admin']));

        // Escape user inputs for security
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
    
        // Attempt to update record
        $sql = "UPDATE users
                SET FirstName= '$first_name', LastName= '$last_name', Pass= '$password', Address= '$address'
                WHERE UserID = '$adminToBeEdited';";
    
        $results = mysqli_query($connection, $sql);
        header('Location: admin-dashboard.php');
    }   
}
// to edit artist details
if(isset($_GET['artistToBeEdited'])){
    $artistToBeEdited = $_GET['artistToBeEdited'];

    // check if there's an art with this ID
    $sql_checkArtistsTable = "SELECT * FROM artists WHERE ArtistID='$artistToBeEdited'";
    $res_edit = mysqli_query($connection, $sql_checkArtistsTable);

    
    // die(var_dump(mysqli_num_rows($res_edit) > 0));
    // if our query finds a row, update it
    if (mysqli_num_rows($res_edit) > 0) {
        while($artistData = mysqli_fetch_assoc($res_edit)) {
            // set the variables to pick the user details
            $first_name = $artistData["FirstName"];
            $last_name = $artistData["LastName"];
            $address = $artistData["Address"];
            $website = $artistData["Website"];
        } 
    }

    if(isset($_POST['update-artist'])) {

        // Escape user inputs for security
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $website = mysqli_real_escape_string($connection, $_POST['website']);
    
        // Attempt to update record
        $sql = "UPDATE artists
                SET FirstName= '$first_name', LastName= '$last_name', Address= '$address',  Website= '$website'
                WHERE ArtistID = '$artistToBeEdited';";
    
        $results = mysqli_query($connection, $sql);
        header('Location: admin-dashboard.php');
    }
}    
// to edit art piece details
if(isset($_GET['artToBeEdited'])){
    $artToBeEdited = $_GET['artToBeEdited'];

    // check if there's an art with this ID
    $sql_checkArtsTable = "SELECT * FROM arts WHERE ArtID='$artToBeEdited'";
    $res_edit = mysqli_query($connection, $sql_checkArtsTable);

    
    // die(var_dump(mysqli_num_rows($res_edit) > 0));
    // if our query finds a row, update it
    if (mysqli_num_rows($res_edit) > 0) {
        while($artData = mysqli_fetch_assoc($res_edit)) {
            // set the variables to pick the user details
            $title = $artData["Title"];
            $artist = $artData["ArtistID"];
            $type = $artData["ArtType"];
        } 
    }

    if(isset($_POST['update-art'])) {

        // Escape user inputs for security
        $title = mysqli_real_escape_string($connection, $_POST['title']);
        $artist = mysqli_real_escape_string($connection, $_POST['artist']);
        $type = mysqli_real_escape_string($connection, $_POST['type']);
    
        // checking if requiered fields are not empty
        if (empty($title)) {
            $empty_field_error = "This field is required"; 		
        }else{
        // Attempt insert query execution
            $sql = "UPDATE arts
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
