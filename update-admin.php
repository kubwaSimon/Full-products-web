<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
<br><br>

<?php
//get user id selected

$id=$_GET['id'];
//create sql query to get details
$sql="SELECT*FROM tbl_admin WHERE id=$id";
//execute query
$res=mysqli_query($conn,$sql);
//checking execution of query
if($res==true)
{
    //check data availability
    $count=mysqli_num_rows($res);
    //check if we havr admin data
    if($count==1)
    {
        //get details
//echo "Admin available";
$row=mysqli_fetch_assoc($res);

$full_name=$row['full_name'];
$username=$row['username'];
    }
    else
    {
        //redirect to manage admin
        header('location:'.SITEURL.'admin/manage.admin.php');
    }
}


?>
        <form action="" method="post">

        <table class="tbl-30">
            <tr>
                <td>Full name:</td>
                <td>
                    <input type="text" name="full_name" value="<?php echo $full_name;?>"   >
</td>        
                 </tr>

                 <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                 </tr>

                 <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
<input type="submit" name="submit" value="UPDATE" class="btn-primary">
                 </td>
                </tr>

        </table>
        </form>
    </div>
</div>

<?php

//check whether submit button was clicked
if(isset($_POST['submit']))
{
//echo "Clicked";
//get values from the form 
$id=$_POST['id'];
$full_name=$_POST['full_name'];
$username=$_POST['username'];

//sql query to update admin
$sql="UPDATE tbl_admin SET
full_name='$full_name',
username='$username' 
WHERE id='$id'
";
//query execution
$res=mysqli_query($conn,$sql);
//if query executed

if($res==true)
{
    //check if updated
$_SESSION['update']="<div class='success'>Admin updated</div>";
//redirect to manage admin
header('location:'.SITEURL.'admin/manage.admin.php');
}
else
{
    //Failed operation
    $_SESSION['update']="<div class='error'>Operation failed</div>";
//redirect to manage admin
header('location:'.SITEURL.'admin/manage.admin.php');
}
}


?>
<?php include('partials/footer.php');?>