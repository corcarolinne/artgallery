<?php
include('../private/db_connection_GCP.php');


if(isset($_POST['favourite-art'])) {

    $artToBeFavourited = $_COOKIE['artToBeFavourited'];
    $loggedUserId = $_SESSION['loggedUserId'];

    $sql_checkFavourite = "SELECT * FROM favourites
    WHERE ArtID='$artToBeFavourited' AND UserID='$loggedUserId'";

    $res_f = mysqli_query($connection, $sql_checkFavourite);

  // checking if there's not any other user with the same username or email
    if (mysqli_num_rows($res_f) > 0) {
        $sql = "DELETE FROM favourites WHERE ArtID = '$artToBeFavourited' AND UserID = '$loggedUserId'";
        $results = mysqli_query($connection, $sql);
    }else{
    // Attempt insert query execution
        $sql = "INSERT INTO favourites (ArtID, UserID) VALUES ('$artToBeFavourited','$loggedUserId')";
        $results = mysqli_query($connection, $sql);
    }
}
    
?>
