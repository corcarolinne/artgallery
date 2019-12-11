<?php
include('../private/db_connection_GCP.php');

// to delete art pieces
if(isset($_POST['delete-art'])) {

    $artToBeDeleted = $_COOKIE['artToBeDeleted'];

    // we need to that to be able to find if this art piece was already favorited or not by this user
    $sql_checkFavouritesTable = "SELECT * FROM favourites WHERE ArtID='$artToBeDeleted'";
    $sql_checkArtsTable = "SELECT * FROM arts WHERE ArtID='$artToBeDeleted'";
    $res_delete = mysqli_query($connection, $sql_checkFavouritesTable);
    $res_delete2 = mysqli_query($connection, $sql_checkArtsTable);

    // if our query finds a row on both favourites and art tables, delete both
    if (mysqli_num_rows($res_delete) > 0 && mysqli_num_rows($res_delete2) > 0) {
        $sql = "DELETE FROM favourites WHERE ArtID='$artToBeDeleted'";
        $sql2 = "DELETE FROM arts WHERE ArtID='$artToBeDeleted'";
        $results = mysqli_query($connection, $sql);
        $results = mysqli_query($connection, $sql2);
    } else {
        $sql = "DELETE FROM arts WHERE ArtID='$artToBeDeleted'";
        $results = mysqli_query($connection, $sql);
    }
    
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
