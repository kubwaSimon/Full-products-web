<?php
//include constants.php link
include('../config/constants.php');
//Destroy the session and redirect to login page
session_destroy();//unsets $_SESSION['user]
//redirect to login
header('location:'.SITEURL.'admin/login.php');

?>