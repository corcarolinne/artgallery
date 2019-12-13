<?php
    include('../private/session.php');
    include('update-entities.php');
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

    <div class="container-contact">
        <!--Form-->
        <div class="container-form">
            <h2>Update Account</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="name">First Name:</label>
                    <input type="name" class="form-control" placeholder="First name" name="first_name"  value="<?php echo $first_name; ?>">
                </div>
                <div class="form-group">
                    <label for="name">Last Name:</label>
                    <input type="name" class="form-control" placeholder="Last name" name="last_name" value="<?php echo $last_name; ?>">
                </div>
                <div class="form-group">
                    <label for="name">Adress:</label>
                    <input type="name" class="form-control" placeholder="Address" name="address" value="<?php echo $address; ?>">
                </div>
                <div class="form-group">
                    <label for="website">Website:</label>
                    <input type="name" class="form-control" placeholder="artistwebsite.com" name="website" value="<?php echo $website; ?>">
                </div>
                <button type="submit" name="update-artist" class="btn btn-default">Update Artist</button>
            </form>
        </div>
    </div>    
</body>
</html> 