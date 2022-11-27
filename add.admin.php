<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Administrator.</h1>
        <br>
        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];//check session
            unset($_SESSION['add']);
        }
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter name"></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="your username"></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="input password"></td>
                </tr>
                <tr>
                    <td colspan="2">
<input type="submit" name="submit" value="Add Admin" class="btn-primary">
                    </td>
            </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php');?>


<?php
//processing form and saving in database
//check if button is submitted
if(isset($_POST['submit']))
{
    //buttonclicked
   
    //button not clicked
    //Get data from form
    $full_name=$_POST['full_name'];
   $username=$_POST['username'];
    $password=md5($_POST['password']);//password encryption
    //sql query to save data in DB
    $sql="INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
    ";
   //Executing query.saving data in DB
    $res=mysqli_query($conn, $sql) or die(mysqli_error());
    //check data insertion in DB
    if($res == TRUE)
    {
//Data inserted
//echo "Data sent successfully";
//A variable to display message 
$_SESSION['add']="Admin added succesfully";
//redirect page to manage admin
header("location:".'manage.admin.php');
    }
    else
    {
        //Failed to insert data
       //echo "Operaion failed";
//A variable to display message 
$_SESSION['add']="The operation failed";
//redirect page tto add admin
header("location:".'add.admin.php');
    }
}

?>