<?php
include('../private/db_connection_GCP.php');

// function to delete arts based on the received art ID
function deleteArt($art_id) {
    // setting global variable
    global $connection;

    // we need to that to be able to find if this art piece was already favorited or not by this user
    $sql_checkFavouritesTable = "SELECT * FROM carol_2018250.favourites WHERE ArtID='$art_id'";
    $sql_checkArtsTable = "SELECT * FROM carol_2018250.arts WHERE ArtID='$art_id'";
    $res_delete = mysqli_query($connection, $sql_checkFavouritesTable);
    $res_delete2 = mysqli_query($connection, $sql_checkArtsTable);

    // if our query finds a row on both favourites and art tables, delete both
    if (mysqli_num_rows($res_delete) > 0 && mysqli_num_rows($res_delete2) > 0) {
        $sql = "DELETE FROM carol_2018250.favourites WHERE ArtID='$art_id'";
        $sql2 = "DELETE FROM carol_2018250.arts WHERE ArtID='$art_id'";
        $results = mysqli_query($connection, $sql);
        $results = mysqli_query($connection, $sql2);
    } else {
        // otherwise delete only on arts table
        $sql = "DELETE FROM carol_2018250.arts WHERE ArtID='$art_id'";
        $results = mysqli_query($connection, $sql);
    }
}


// if the button with the name delete-art is set, delete art pieces selected
if(isset($_POST['delete-art'])) {
    // save the art to be deleted using cookies
    $artToBeDeleted = $_COOKIE['artToBeDeleted'];
    // calling function to delete art pieces by ArtID selected
    deleteArt($artToBeDeleted);
}

// if the button with the name delete-artist is set, delete artist selected
if(isset($_POST['delete-artist'])) {
    // save the artist to be deleted using cookies
    $artistToBeDeleted = $_COOKIE['artistToBeDeleted'];

    // do this query to find out if this artist has any arts in arts table
    $select_arts_from_artist = "SELECT ArtID from carol_2018250.arts WHERE artistID='$artistToBeDeleted';";
    $arts_from_artist = mysqli_query($connection, $select_arts_from_artist);

    // if we find any art piece from this artist in arts table
    if (mysqli_num_rows($arts_from_artist) > 0) {
        while($art = mysqli_fetch_assoc($arts_from_artist)) {
            // call the function to delete this art using its ID
            deleteArt($art["ArtID"]);
        } 
    }
    // otherwise, just delete artist in artist table
    $sql = "DELETE FROM carol_2018250.artists WHERE ArtistID='$artistToBeDeleted'";
    $arts_from_artist = mysqli_query($connection, $sql);
}

// if the button with the name delete-art is set, delete art pieces selected
if(isset($_POST['delete-admin'])) {
    // save the art to be deleted using cookies
    $adminToBeDeleted = $_COOKIE['adminToBeDeleted'];
    
    // check if there's an admin with this ID
    $sql_checkUsersTable = "SELECT * FROM carol_2018250.users WHERE UserID='$adminToBeDeleted'";
    $res_delete = mysqli_query($connection, $sql_checkUsersTable);

    // if our query finds a row, delete it
    if (mysqli_num_rows($res_delete) > 0) {
        $sql = "DELETE FROM carol_2018250.users WHERE UserID='$adminToBeDeleted'";
        $results = mysqli_query($connection, $sql);
    }
    
}
    
?>
