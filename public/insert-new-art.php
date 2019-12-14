<?php
include('../private/db_connection_GCP.php');

$title = "";

if(isset($_POST['register-art'])) {

    // Escape user inputs for security
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $artist = mysqli_real_escape_string($connection, $_POST['artist']);
    $type = mysqli_real_escape_string($connection, $_POST['type']);

    // checking if requiered fields are not empty
    if (empty($title)) {
        $empty_field_error = "This field is required"; 		
    }else{
      // Attempt insert query execution
        $sql = "INSERT INTO carol_2018250.arts (Title, ArtistID, ArtType) VALUES ('$title','$artist', '$type')";
        // if the query is sucessful
        if(mysqli_query($connection, $sql)){
            header('Location: admin-dashboard.php');
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
        }
    }

}
?>
