<!--Firs Page / Login Page-->

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
                <a class="pull-left" href="index.php">
                    <img src="./img/logo.png" alt="company logo: word domus and two squares, one black and one blue"  width="180" height="55">
                </a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="new-account.php">CREATE ACCOUNT</a></li>
            </ul>
        </div>
    </nav>

    <!--Headline of this page-->
    <div class="headline-pages">
        <h1>Join us today!</h1>
        <h3>Login or Create an account to have access to the best art pieces!</h3>
    </div>

    <!--Login-->
    <div class="container-contact">
        <!--Form-->
        <div class="container-form">
            <h2>Login</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="name">Username:</label>
                    <input type="name" class="form-control" placeholder="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" placeholder="password" name="password">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>

    <!--Using PHP to do the login-->
    <?php
        //start session
        session_start();
        include '../private/db_connection_GCP.php';

        // Check to see if the form (login section) has been submitted
        if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username= $_POST['username'];
        $pass= $_POST['password'];

        // create SQL statement
        $sql = "SELECT * FROM carol_2018250.users WHERE Username='$username' and pass='$pass'";

        // Query database
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);


        // count the number of records found
        $count = mysqli_num_rows($result);

            // If result matched $myusername and $mypassword, table row must be 1 row
            if($count > 0 && $row['IsAdmin'] == 1) {
                $_SESSION['login_user'] = $row['Username'];
                // storing globally the loggedUserID with is the UserID value in the row
                $_SESSION['loggedUserId'] = $row['UserID'];
                header('Location: admin-dashboard.php');
            }
            elseif ($count > 0 && $row['IsAdmin'] == 0) {
                $_SESSION['login_user'] = $row['Username'];
                $_SESSION['loggedUserId'] = $row['UserID'];
                header('Location: customer-dashboard.php');
            }
            else {
                $error = "Your Login Name or Password is invalid!";
                echo $error;
            }
        }
    ?>
</body>
</html> 