<?php
    include('../private/session.php');
    include('delete-record.php')
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

    <!--Tables-->
    <h2>Art Pieces</h2>
    <div class="tables">
        <table class="table table-striped" id="artTable">
        </table>
    </div>

    <?php

        $sql = "SELECT arts.ArtID, arts.Title, artists.FirstName, artists.LastName, arts.ArtType FROM arts INNER JOIN artists ON arts.ArtistID =  artists.ArtistID;";
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
                            Actions: ["delete","edit"]
                        });
                    </script>';
            }

        } else {
            echo "0 results";
        }
    ?>
    
    <h2>Artists</h2>
    <div class="tables">
        <table class="table table-striped" id="artistTable"></table>
    </div>

    <?php

        $sql = "SELECT * FROM artists;";
        $result = mysqli_query($connection, $sql);
    
        if ($result) {  
            //output table header
            //echo "<table class='list'><tr><th>Username</th><th>Email</th><th>Password</th><th>&nbsp</th><th>&nbsp</th><th>&nbsp</th></tr>";
            echo '<script type="text/javascript">
                    var artistData = []; 
                </script>';

            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
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
    
    <h2>Administrator Accounts</h2>
    <div class="tables">
        <table class="table table-striped" id="adminTable"></table>
    </div>
    <?php

        $sql = "SELECT * FROM users WHERE isAdmin=1;";
        $result = mysqli_query($connection, $sql);
    
        if ($result) {  
            //output table header
            //echo "<table class='list'><tr><th>Username</th><th>Email</th><th>Password</th><th>&nbsp</th><th>&nbsp</th><th>&nbsp</th></tr>";
            echo '<script type="text/javascript">
                    var adminData = []; 
                </script>';

            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
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