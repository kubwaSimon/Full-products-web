<?php
//include constants.php file
include('../config/constants.php');

//get admin id to delete
echo $id=$_GET['id'];
//create sql query to delete admin
$sql="DELETE FROM tbl_admin WHERE id=$id";
//query execution
$res=mysqli_query($conn,$sql);
//check query status
if($res==true)
{
    //if executed
//echo "Deleted successfully";
//create session variable
$_SESSION['delete']="<div class='success'>Delete Successful.</div>";
//redirect tp manage admin page
header('location:'.SITEURL.'admin/manage.admin.php');
}
else{
    //operation fail
    //echo "Deletion failed";
    $_SESSION['delete']="<div class='error'>Delete Failed. Try again!</div>";
    header('location:'.SITEURL.'admin/manage.admin.php');
}
//redirect to manage admin page.
?>
