<?php
//include constants.php for SITEURL
include('../config/constants.php');
//destroy the session and redirect to login for logout
  session_destroy();   //unsets $_SESSION['user]
  header('location:'.SITEURL.'admin/login.php');
?>