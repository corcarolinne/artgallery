<?php
    include('../private/session.php');
    include('insert-new-art.php');
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
    <script src="./js/populateDropdownWithData.js"></script>

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
                <li><a href="admin-dashboard.php">HOME</a></li> 
                <li><a href="admin-profile.php">ACCOUNT</a></li>
                <li class="active">
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

    <div class="container-contact">
        <!--Form-->
        <div class="container-form">
            <h2>Create Art Piece</h2>
            <form method="POST">
                <div class="form-group" <?php if (isset($empty_field_error)): ?> class="form_error" <?php endif ?>>
                    <label for="name">Title:</label>
                    <input type="name" class="form-control" placeholder="Title" name="title" value="<?php echo $title; ?>">
                    <?php if (isset($empty_field_error)): ?>
	  	            <span><?php echo $empty_field_error; ?></span>
	                <?php endif ?>
                </div>
                <div class="form-group">
                    <label for="name">Artist:</label>
                    <select id="artistsSelect" type="name" class="form-control" placeholder="Artist" name="artist">
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Type:</label>
                    <input type="name" class="form-control" placeholder="Type" name="type">
                </div>
                <button type="submit" name="register-art" class="btn btn-default">Create Art Piece</button>
            </form>
        </div>
    </div> 
    
    <?php

        $sql = "SELECT FirstName, LastName, ArtistID FROM artists;";
        $result = mysqli_query($connection, $sql);
    
        if ($result) {
            echo '<script type="text/javascript">
                    var artists = []; 
                </script>';

            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo '<script type="text/javascript">
                        artists.push({
                            ID: "'.$row["ArtistID"].'",
                            Name: "'.$row["FirstName"].' '.$row["LastName"].'"
                        });
                    </script>';
            }

            echo '<script type="text/javascript">
                populateDropdownWithData("artistsSelect", artists);
            </script>';

        } else {
            echo "0 results";
        }
    ?>    
</body>
</html> 