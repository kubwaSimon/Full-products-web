<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>
            CHANGE PASSWORD
        </h1><br><br>
<?php

if(isset($_GET['id']))
{
    $id=$_GET['id'];
}
?>
        <form action="" method="POST">

        <table class="tbl-30">
<tr>
    <td>Current password:</td>
    <td>
        <input type="password" name="current_password" placeholder="current password">
    </td>
</tr>

<tr>

<td>New password:</td>
<td>
    <input type="password" name="new_password" placeholder="New password">
</td>
</tr>

<tr>
    <td>Confirm password:</td>
    <td>
        <input type="password" name="confirm_password" placeholder="confirm new password">
</td>
</tr>

<tr>
    <td colspan="2">
    <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="submit" name="submit" value="change password" class="btn-primary">
    </td>
</tr>
        </table>
        </form>
    </div>
</div>

<?php
//check if button is clicked
if(isset($_POST['submit']))
{
    //Get data from form
$id=$_POST['id'];
$current_password=md5($_POST['current_password']);
$new_password=md5($_POST['new_password']);
$confirm_password=md5($_POST['confirm_password']);
    //check if user exists

    $sql="SELECT*FROM tbl_admin WHERE id=$id AND password='$current_password'";
    $res=mysqli_query($conn,$sql);
    if($res==true)
    {
        //check data availability
        $count=mysqli_num_rows($res);
        if($count==1)
        {
if($new_password==$confirm_password)
{
//echo "Success";
$sql2="UPDATE tbl_admin SET 
password='$new_password'  
WHERE id=$id
";
//execute query

$res2=mysqli_query($conn,$sql);

//query executed or not
if($res2==true)
{
    //Message-success
    $_SESSION['change-pwd']="<div class='success'>Changed successfully.</div>";
    //redirect
    header('location:'.SITEURL.'admin/manage.admin.php');
}
else
{
//Fail-success
$_SESSION['change-pwd']="<div class='error'>Password change failed.</div>";
//redirect
header('location:'.SITEURL.'admin/manage.admin.php');
}
}
else
{
//if user exists password can change
$_SESSION['pwd-not-found']="<div class='error'>password mismatch.</div>";
//redirect
header('location:'.SITEURL.'admin/manage.admin.php');
}
        }
        else
        {
//user does not exist and redirect
$_SESSION['user-not-found']="<div class='error'>User non-existant</div>";
//redirect
header('location:'.SITEURL.'admin/manage.admin.php');
        }
    }
    //check if new password is set and confirm match

    //change password 
}
?>

<?php include('partials/footer.php');?>