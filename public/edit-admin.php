<?php
    include('../private/session.php');
    include('update-entities.php');
?>

 <!--Page with the for form to edit Administrator Accounts-->
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
        <!--Using php in input tags to echo the value from user input and if an error occurs span a message-->
        <div class="container-form">
            <h2>Update Account</h2>
            <form method="POST">
                <div class="form-group" <?php if (isset($empty_field_error)): ?> class="form_error" <?php endif ?>>
                    <label for="name">First Name:</label>
                    <input type="name" class="form-control" placeholder="First name" name="first_name" value="<?php echo $first_name; ?>">
                    <?php if (isset($empty_field_error)): ?>
	  	            <span><?php echo $empty_field_error; ?></span>
	                <?php endif ?>
                </div>
                <div class="form-group" <?php if (isset($empty_field_error)): ?> class="form_error" <?php endif ?>>
                    <label for="name">Last Name:</label>
                    <input type="name" class="form-control" placeholder="Last name" name="last_name" value="<?php echo $last_name; ?>">
                    <?php if (isset($empty_field_error)): ?>
	  	            <span><?php echo $empty_field_error; ?></span>
	                <?php endif ?>
                </div>
                <div class="form-group" <?php if (isset($name_error)): ?> class="form_error" <?php endif ?> <?php if (isset($empty_field_error)): ?> class="form_error" <?php endif ?>>
                    <label for="name">Username:</label>
                    <input type="name" class="form-control" placeholder="Username" name="username" value="<?php echo $username; ?>">
                    <?php if (isset($name_error)): ?>
	  	            <span><?php echo $name_error; ?></span>
	                <?php endif ?>
                    <?php if (isset($empty_field_error)): ?>
	  	            <span><?php echo $empty_field_error; ?></span>
	                <?php endif ?>
                </div>
                <div class="form-group">
                    <label for="name">Adress:</label>
                    <input type="name" class="form-control" placeholder="Address" name="address" value="<?php echo $address; ?>">
                </div>
                <div class="form-group" <?php if (isset($name_error)): ?> class="form_error" <?php endif ?> <?php if (isset($empty_field_error)): ?> class="form_error" <?php endif ?>>
                    <label for="pwd">Email:</label>
                    <input type="email" class="form-control" id="pwd" placeholder="theiremail@domain.com" name="email" value="<?php echo $email; ?>">
                    <?php if (isset($email_error)): ?>
	  	            <span><?php echo $email_error; ?></span>
	                <?php endif ?>
                    <?php if (isset($empty_field_error)): ?>
	  	            <span><?php echo $empty_field_error; ?></span>
	                <?php endif ?>
                </div>
                <div class="form-group" <?php if (isset($empty_field_error)): ?> class="form_error" <?php endif ?>>
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" placeholder="password" name="password">
                    <?php if (isset($empty_field_error)): ?>
	  	            <span><?php echo $empty_field_error; ?></span>
	                <?php endif ?>
                </div>
                <button type="submit" name="update-admin" class="btn btn-default">Update Account</button>
            </form>
        </div>
    </div>    
</body>
</html> 