<?php
include('../private/db_connection_GCP.php');


if(isset($_POST['delete-record'])) {

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
    
?>
