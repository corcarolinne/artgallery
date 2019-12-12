<?php
    include('../private/session.php');
    include('insert-favourite.php');
    include('search.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

    <!--Icons Lib-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!--CSS-->
    <link rel="stylesheet" href="./css/style.css">

    <!--JS for Table-->
    <script src="./js/table.js"></script>
    <script src="./js/customerDashboard.js"></script>

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
                <li class="active"><a href="customer-dashboard.php">HOME</a></li>
                <li><a href="favourites.php">FAVOURITES</a></li> 
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
        <h1>Meet our collection</h1>
        <h3>These are the art pieces currently in our catalogue. Find your new favourite one today.</h3>
    </div>

    <!--Search Bar-->
    <div class="search">
        <form class="search-form" method="POST">
            <input type="text" placeholder="Search for art pieces, artists, types..." name="search_input">
            <div class="search-buttons">
                <div class="dropdown">
                    <button class="dropdown" type="button" data-toggle="dropdown">Filter
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                    <li><a href="#">Title</a></li>
                    <li><a href="#">Artist</a></li>
                    <li><a href="#">Type</a></li>
                    </ul>
                </div>
                <button class="btn btn-default" type="submit" value="Search" name="search">Search</button>
                
            </div> 
        </form>
    </div>

    <div class="tables">
        <table class="table table-striped" id="customerTable">
        </table>
    </div>  

    <?php

        function displayArtTable($user_input) {
            global $connection;
            
            // this query is required to be able to show properly the arts table
            $sql_fav = "SELECT * from favourites  WHERE favourites.UserID = ".$_SESSION['loggedUserId'].";";
            // $result_fav is a row from favourites table
            $result_fav = mysqli_query($connection, $sql_fav);

            // if mysqli_query returns true (which means there is a row in favourites table with this UserID) do this
            if ($result_fav) {
                // use JS to declare array favData that's gonna be used in table.js inside the function to create buttons
                echo '<script type="text/javascript">
                        var favData = []; 
                    </script>';
                // while there's a row in my favourites table in the database do this
                while($row_fav = mysqli_fetch_assoc($result_fav)) {
                    // using the associative array generated by the mysqli_fetch_assoc I can access the UserID index or column
                    // and compares it to the loggedUserID in the SESSION if they are equal do this
                    // use JS to include this favourite in the favData array, saving the the ArtID and the UserID because??
                    echo '<script type="text/javascript">
                        favData.push("'.$row_fav["ArtID"].'");
                    </script>';
                }
            }

            // in case the user entered something in the search bar
            if(!empty($user_input)) {
                // query to show the art table for customer with only the results from their search
                $sql = "SELECT arts.ArtID, arts.Title, artists.FirstName, artists.LastName, arts.ArtType
                FROM arts
                INNER JOIN artists ON arts.ArtistID =  artists.ArtistID
                WHERE Title = '$user_input'
                ORDER BY arts.ArtID;";
                $result = mysqli_query($connection, $sql);

                // if it exists a row in this inner join table do this
                if ($result) {
                    // use JS to create artData table
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
                    echo "entrou na parte da funcao q procura no database pelo input";

                } else {
                    echo "0 results";
                }

            } else {
                // query to show the art table for customer when there's nothing entered on search
                $sql = "SELECT arts.ArtID, arts.Title, artists.FirstName, artists.LastName, arts.ArtType
                FROM arts
                INNER JOIN artists ON arts.ArtistID =  artists.ArtistID
                ORDER BY arts.ArtID;";
                $result = mysqli_query($connection, $sql);

                // if it exists a row in this inner join table do this
                if ($result) {
                    // use JS to create artData table
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
            }

        }
            
            // setting null because this means the user didn't enter any input on search bar
            displayArtTable(null);
    ?>

    
</body>
</html> 