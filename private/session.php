<?php
  include('db_connection_GCP.php');
  
  // starts session
  session_start();
   
  // if global variable session is not set, redirects the user to index page
  if(!isset($_SESSION['login_user'])){
    header("location:index.php");
  }

?>