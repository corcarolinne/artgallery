<?php
    include('../private/session.php');
    include('delete-record.php');
?>

<!--ADMINISTRATOR DASHBOARD-->
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

    <!--JS-->
    <script src="./js/table.js"></script>
    <script src="./js/adminDashboard.js"></script>

    <title>domus: Art Gallery</title>

</head>
<body>
    <!-- Top navigation bar-->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="pull-left" href="admin-dashboard.php">
                    <img src="./img/logo.png" alt="company logo: word domus and two squares, one black and one blue"  width="180" height="55">
                </a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="admin-dashboard.php">HOME</a></li> 
                <li><a href="admin-profile.php">ACCOUNT</a></li>
                <li>
                    <div class="dropdown-create">
                        <button class="dropdown" type="button" data-toggle="dropdown">CREATE</button>
                        <ul class="dropdown-menu">
                            <li><a href="new-admin-account.php">Admin Account</a></li>
                            <li><a href="new-art-piece.php">Art Piece</a></li>
                            <li><a href="new-artist.php">Artist</a></li>
                        </ul>
                    </div>
                </li>
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
        <h1>Administrator Dashboard</h1>
        <h3>Use the search bar to navigate through art pieces and artists. Edit details by clicking on the buttons on Actions.</h3>
    </div>
    <!-- Tag to identify the page to be redirected if the user clicks to edit art-->
    <a id="go-to-edit-art" href="edit-art.php"> </a>
    <!--Art Table-->
    <h2>Art Pieces</h2>
    <div class="tables">
        <table class="table table-striped" id="artTable">
        </table>
    </div>
    <!--PHP connecting with database and collecting data for table-->
    <?php
        // do a query to pick the right data and table head for arts table
        $sql = "SELECT arts.ArtID, arts.Title, artists.FirstName, artists.LastName, arts.ArtType FROM carol_2018250.arts INNER JOIN carol_2018250.artists ON arts.ArtistID =  artists.ArtistID;";
        $result = mysqli_query($connection, $sql);
    
        // if there's any result
        if ($result) {  
            // using JS to create an array to save the data from art table
            echo '<script type="text/javascript">
                    var artData = []; 
                </script>';

            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                // using JS to populate the array
                echo '<script type="text/javascript">
                        artData.push({
                            ID: "'.$row["ArtID"].'",
                            Title: "'.$row["Title"].'",
                            Artist: "'.$row["FirstName"].' '.$row["LastName"].'",
                            Type: "'.$row["ArtType"].'",
                            Actions: ["delete","edit"]
                        });
                    </script>';
            }
        } else {
            echo "0 results";
        }
    ?>
    
    <!-- Tag to identify the page to be redirected if the user clicks to edit artist-->
    <a id="go-to-edit-artist" href="edit-artist.php"> </a>
    <!--Artist Table-->
    <h2>Artists</h2>
    <div class="tables">
        <table class="table table-striped" id="artistTable"></table>
    </div>
    <!--PHP connecting with database and collecting data for table-->
    <?php
        // query to select all artists
        $sql = "SELECT * FROM carol_2018250.artists;";
        $result = mysqli_query($connection, $sql);
    
        // if query returns any results
        if ($result) {  
            // create this array to store the data using JS
            echo '<script type="text/javascript">
                    var artistData = []; 
                </script>';

            // while there's data
            while($row = mysqli_fetch_assoc($result)) {
                // use JS to populate the array
                echo '<script type="text/javascript">
                        artistData.push({
                            ID: "'.$row["ArtistID"].'",
                            Name: "'.$row["FirstName"].' '.$row["LastName"].'",
                            Address: "'.$row["Address"].'",
                            Website: "'.$row["Website"].'",
                            Actions: ["delete","edit"]
                        });
                    </script>';
            }
        } else {
            echo "0 results";
        }
    ?>

    <!-- Tag to identify the page to be redirected if the user clicks to edit artist-->
    <a id="go-to-edit-admin" href="edit-admin.php"> </a>

    <!-- Administrator Accounts Table-->
    <h2>Administrator Accounts</h2>
    <div class="tables">
        <table class="table table-striped" id="adminTable"></table>
    </div>
    <!--PHP connecting with database and collecting data for table-->
    <?php
        // query to pick all the administrator accounts from users table
        $sql = "SELECT * FROM carol_2018250.users WHERE isAdmin=1;";
        $result = mysqli_query($connection, $sql);
    
        // if there's any result
        if ($result) {  
            // create an array using JS
            echo '<script type="text/javascript">
                    var adminData = []; 
                </script>';

            // while there's a row
            while($row = mysqli_fetch_assoc($result)) {
                // populate the array with the data
                echo '<script type="text/javascript">
                        adminData.push({
                            ID: "'.$row["UserID"].'",
                            Name: "'.$row["FirstName"].' '.$row["LastName"].'",
                            Address: "'.$row["Address"].'",
                            Username: "'.$row["Username"].'",
                            Email: "'.$row["Email"].'",
                            Actions: ["delete","edit"]
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