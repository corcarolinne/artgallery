<?php
include('../private/db_connection_GCP.php');

// if favourites button is clicked
if(isset($_POST['favourite-art'])) {

    // save using cookies the art clicked, and the logged user id using session
    $artToBeFavorited = $_COOKIE['artToBeFavorited'];
    $loggedUserId = $_SESSION['loggedUserId'];

    // do this query to find if this art piece was already favorited or not by this user
    $sql_checkFavourite = "SELECT * FROM carol_2018250.favourites
    WHERE ArtID='$artToBeFavorited' AND UserID='$loggedUserId'";
    $res_f = mysqli_query($connection, $sql_checkFavourite);

  // if our query returns a row, this means the user already liked this piece and it's clicking in the button to unlike it
    if (mysqli_num_rows($res_f) > 0) {
        // if the user unlike the art piece, delete this art piece or this row from favourites table
        $sql = "DELETE FROM carol_2018250.favourites WHERE ArtID = '$artToBeFavorited' AND UserID = '$loggedUserId'";
        $results = mysqli_query($connection, $sql);
    // if our query doesn't return a row it means that the user wants to favourite an art piece
    }else{
        // if the user likes the art piece, insert this art piece or this row on the database
        $sql = "INSERT INTO carol_2018250.favourites (ArtID, UserID) VALUES ('$artToBeFavorited','$loggedUserId')";
        $results = mysqli_query($connection, $sql);
    }
}
    
?>
