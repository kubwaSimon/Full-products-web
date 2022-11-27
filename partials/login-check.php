<?php
//user access control
//check whether user is logged in
if(!isset($_SESSION['user']))//if user is not set 
{
//user not logged 
//redirect to login
$_SESSION['no-login-message']="<div class='error text-center'>Login to Access!!</div>";
//redirect to login page
header('location:'.SITEURL.'admin/login.php');
}
?>