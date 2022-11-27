<?php
//include constants
include('../config/constants.php');
//check  if image name and id are set

if(isset($_GET['id'])&& isset($_GET['image_name']))
{
//getting value and delete
$id=$_GET['id'];
$image_name=$_GET['image_name'];

//remove the physical image file and redirect to category page with message 

if($image_name!="")
{
    //remove image
    $path="../images/category/".$image_name;
//remove
$remove=unlink($path);
//if process fails 
    if($remove==false)
    {
//set session massage
$_SESSION['remove']="<div class='error'>Operation encountered an error!</div>";
header('location;'.SITEURL.'admin/category.php');
//stop process
die();
    }
}


//Deleting from DB
$sql="DELETE FROM tbl_category WHERE id=$id";
//execute
$res=mysqli_query($conn,$sql);
//cehcking if data is deleted from DB
if($res==true)
{
    //success message
    $_SESSION['delete']="<div class='success text-center'>Deleted successfully</div>";
    header('location:'.SITEURL.'admin/category.php');
}
else

{
//fail message
$_SESSION['delete']="<div class='error text-center'>Operation encountered an error!</div>";
header('location:'.SITEURL.'admin/category.php');
}

}
else
{
//redirect to category page
header('location:'.SITEURL.'admin/category.php');
}

?>