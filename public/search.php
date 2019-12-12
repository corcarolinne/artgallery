<?php
include('../private/db_connection_GCP.php');

// this code it's only gonna run if we click in search
// if search button is clicked
if(isset($_POST['search'])) {

    // Escape user inputs for security
    $search_input = mysqli_real_escape_string($connection, $_POST['search_input']);
    
    displayArtTable($search_input);
}

?>