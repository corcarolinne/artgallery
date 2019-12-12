<?php
include('../private/db_connection_GCP.php');

function deleteArt($art_id) {
    global $connection;

    // we need to that to be able to find if this art piece was already favorited or not by this user
    $sql_checkFavouritesTable = "SELECT * FROM favourites WHERE ArtID='$art_id'";
    $sql_checkArtsTable = "SELECT * FROM arts WHERE ArtID='$art_id'";
    $res_delete = mysqli_query($connection, $sql_checkFavouritesTable);
    $res_delete2 = mysqli_query($connection, $sql_checkArtsTable);

    // if our query finds a row on both favourites and art tables, delete both
    if (mysqli_num_rows($res_delete) > 0 && mysqli_num_rows($res_delete2) > 0) {
        $sql = "DELETE FROM favourites WHERE ArtID='$art_id'";
        $sql2 = "DELETE FROM arts WHERE ArtID='$art_id'";
        $results = mysqli_query($connection, $sql);
        $results = mysqli_query($connection, $sql2);
    } else {
        $sql = "DELETE FROM arts WHERE ArtID='$art_id'";
        $results = mysqli_query($connection, $sql);
    }
}


// to delete art pieces
if(isset($_POST['delete-art'])) {
    $artToBeDeleted = $_COOKIE['artToBeDeleted'];

    // calling function to delete art pieces by ArtID selected
    deleteArt($artToBeDeleted);
}

// to delete artists pieces
if(isset($_POST['delete-artist'])) {
    $artistToBeDeleted = $_COOKIE['artistToBeDeleted'];

    $select_arts_from_artist = "SELECT ArtID from arts WHERE artistID='$artistToBeDeleted';";
    $arts_from_artist = mysqli_query($connection, $select_arts_from_artist);

    // if we find any art piece from this artist in arts table
    if (mysqli_num_rows($arts_from_artist) > 0) {
        while($art = mysqli_fetch_assoc($arts_from_artist)) {
            // call the function to delete this art using its ID
            deleteArt($art["ArtID"]);
        } 
    }

    // otherwise, just delete artist in artist table
    $sql = "DELETE FROM artists WHERE ArtistID='$artistToBeDeleted'";

    $arts_from_artist = mysqli_query($connection, $sql);
}

// to delete administrator accounts
if(isset($_POST['delete-admin'])) {

    $adminToBeDeleted = $_COOKIE['adminToBeDeleted'];

    // check if there's an admin with this ID
    $sql_checkUsersTable = "SELECT * FROM users WHERE UserID='$adminToBeDeleted'";
    $res_delete = mysqli_query($connection, $sql_checkUsersTable);

    // if our query finds a row, delete it
    if (mysqli_num_rows($res_delete) > 0) {
        $sql = "DELETE FROM users WHERE UserID='$adminToBeDeleted'";
        $results = mysqli_query($connection, $sql);
    }
    
}
    
?>
