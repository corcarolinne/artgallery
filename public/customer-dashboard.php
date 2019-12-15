<?php
    include('../private/session.php');
    include('insert-favourite.php');
    include('populate-art-table.php');
?>

<!--Customer Dashboard-->
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
        <form id="search-form" class="search-form" method="GET">
            <input id="art-filter-input" type="text" placeholder="Search for art pieces, artists, types..." name="search_input">
            <div class="search-buttons">
                <select id="art-filter-select" type="name" class="form-control" placeholder="Artist" name="search_select">
                    <option value = "Title">Title</option>
                    <option value = "Artist">Artist</option>
                    <option value = "Type">Type</option>
                </select>
                <button class="btn btn-default" type="submit">
                    Search
                </button>
                
            </div> 
        </form>
    </div>
    
    <div class="tables">
        <table class="table table-striped" id="customerTable">
        </table>
    </div>  

    <!--Using php to call the function to display art table-->
    <?php
        displayArtTable();  
    ?>

    
</body>
</html> 