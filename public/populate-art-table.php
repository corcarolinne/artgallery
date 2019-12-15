<?php
include('../private/db_connection_GCP.php');

// function to display art table
function displayArtTable() {
    global $connection;
    // this query is required to be able to show properly the arts table with the arts favourited by the user
    $sql_fav = "SELECT * from carol_2018250.favourites  WHERE favourites.UserID = ".$_SESSION['loggedUserId'].";";
    // $result_fav is a row from favourites table
    $result_fav = mysqli_query($connection, $sql_fav);

    // if mysqli_query returns true (which means there is a row in favourites table with this UserID) do this
    if ($result_fav) {
        // use JS to declare array that will contain favourites data
        echo '<script type="text/javascript">
                var favData = []; 
            </script>';
        // while there's a row in my favourites table in the database
        while($row_fav = mysqli_fetch_assoc($result_fav)) {
            // use JS to include this favourite in the favData array
            echo '<script type="text/javascript">
                favData.push("'.$row_fav["ArtID"].'");
            </script>';
        }
    }

    // query to show the art table for customer when there's nothing entered on search
    $sql = "SELECT arts.ArtID, arts.Title, artists.FirstName, artists.LastName, arts.ArtType
    FROM carol_2018250.arts
    INNER JOIN carol_2018250.artists ON arts.ArtistID =  artists.ArtistID
    ORDER BY arts.ArtID;";
    $result = mysqli_query($connection, $sql);

    // if there's any results
    if ($result) {
        // use JS to create artData table
        echo '<script type="text/javascript">
                var artData = []; 
            </script>';

        // for each row
        while($row = mysqli_fetch_assoc($result)) {
            // use JS to populate the array
            echo '<script type="text/javascript">
                    artData.push({
                        ID: "'.$row["ArtID"].'",
                        Title: "'.$row["Title"].'",
                        Artist: "'.$row["FirstName"].' '.$row["LastName"].'",
                        Type: "'.$row["ArtType"].'",
                        Actions: ["favourite"]
                    });
                </script>';
        }
    } else {
        echo "0 results";
    }
}
?>