<?php include('../config/constants.php');?>

<html>

<head>
    <title>System Loogin</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="login">
    <h1 class="text-center">Login</h1>
    <?php
    if(isset($_SESSION['login']))
{
        echo $_SESSION['login'];
        unset($_SESSION['login']);
}
if(isset($_SESSION['no-login-message']))
{
        echo $_SESSION['no-login-message'];
        unset($_SESSION['no-login-message']);
}
?>
    <!-------Form----->
    <form action="" method="post">

    username:
    <input type="text" name="username" placeholder="Enter username">
    password: 
    <input type="password" name="password" placeholder="Enter password.">

    <input type="submit" name="submit" value="LOGIN" class="btn-primary">
    </form>
</div>

</body>


</html>
<?php
// check if submit button is clicked and return message
if(isset($_POST['submit']))
{
//process login data
//Get data froim the login form
$username=$_POST['username'];
$password=md5($_POST['password']);
//query to check whether password and username exists in DB
$sql="SELECT*FROM tbl_admin WHERE username='$username' AND password='$password'";
//Executing query
$res=mysqli_query($conn,$sql);

//count rows to check user existence
$count=mysqli_num_rows($res);

if($count==1)
{
//user available & login success
$_SESSION['login']="<div class='success text-center'>Login successful</div>";
$_SESSION['user']=$username;//check user login and logout to unset
//Redirect to homepage /Dashboard
header('location:'.SITEURL.'admin/');

}
else{
    //User not found
    $_SESSION['login']="<div class='error text-center'>User not found</div>";
//Redirect to homepage /Dashboard
header('location:'.SITEURL.'admin/login.php');
}
}

?>