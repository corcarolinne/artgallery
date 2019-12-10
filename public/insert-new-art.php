<?php
include('../private/db_connection_GCP.php');

if(isset($_POST['register-art'])) {

    // Escape user inputs for security
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $artist = mysqli_real_escape_string($connection, $_POST['artist']);
    $type = mysqli_real_escape_string($connection, $_POST['type']);

    // Attempt insert query execution
    //$sql = "INSERT INTO user (fname, lname, username, email, password) VALUES ('$first_name', '$last_name', '$username' '$email)";
    $sql = "INSERT INTO arts (Title, ArtistID, ArtType) VALUES ('$title','$artist', '$type')";


    if(mysqli_query($connection, $sql)){
        echo "Records added successfully.";
        header('Location: admin-dashboard.php');
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
    }

}
?>
