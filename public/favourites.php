<?php
    include('../private/session.php');
    include('insert-favourite.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
     <!--Icons Lib-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="./css/style.css">

    <!--JS for Table-->
    <script src="./js/table.js"></script>
    <script src="./js/favouritesTable.js"></script>

    <title>domus: Art Gallery</title>

</head>
<body>
   <!-- Top navigation bar-->
   <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="pull-left" href="customer-dashboard.php">
                <img src="./img/logo.png" alt="company logo: word domus and two squares, one black and one blue"  width="180" height="55">
            </a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="customer-dashboard.php">HOME</a></li>
            <li class="active"><a href="favourites.php">FAVOURITES</a></li> 
            <li><a href="profile.php">PROFILE</a></li>
            <li><a href="logout.php">
                <button type="button" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-log-out"></span> Log out
                </button>
            </a>
            </li>
        </ul>
    </div>
</nav>

    <!--Headline of this page-->
    <div class="headline-pages">
        <h1>Your favourites list</h1>
    </div>

    <!--Table-->
    <div class="tables">
        <table class="table table-striped" id="favTable">
        </table>
    </div>

    <?php

        $sql_fav = "SELECT * from carol_2018250.favourites";
        $result_fav = mysqli_query($connection, $sql_fav);

        if ($result_fav) {
            echo '<script type="text/javascript">
                    var favData = []; 
                </script>';
            while($row_fav = mysqli_fetch_assoc($result_fav)) {
                if ($row_fav["UserID"] == $_SESSION['loggedUserId']) {
                    echo '<script type="text/javascript"> 
                        favData.push("'.$row_fav["ArtID"].'");
                    </script>';
                }
            }
        }

        $sql = "SELECT arts.ArtID, arts.Title, artists.FirstName, artists.LastName, arts.ArtType, favourites.ArtID, favourites.UserID
        FROM carol_2018250.favourites
        INNER JOIN carol_2018250.arts ON arts.ArtID = favourites.ArtID
        INNER JOIN carol_2018250.artists ON arts.ArtistID =  artists.ArtistID
        WHERE favourites.UserID = ".$_SESSION['loggedUserId'].";";

        $result = mysqli_query($connection, $sql);
    
        if ($result) {  
            //output table header
            //echo "<table class='list'><tr><th>Username</th><th>Email</th><th>Password</th><th>&nbsp</th><th>&nbsp</th><th>&nbsp</th></tr>";
            echo '<script type="text/javascript">
                    var artData = []; 
                </script>';

            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
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

        // close connection
        $connection->close();
    ?>
</body>
</html> 