<?php include('partials/menu.php');?>
        <!---------------------------->
        <!----main content section----->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        
<?php
if(isset($_SESSION['add'])){
        echo $_SESSION['add'];//Display session
        unset($_SESSION['add']);//Remove session
}
if(isset($_SESSION['delete']))
{
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
}
if(isset($_SESSION['update']))
{
        echo $_SESSION['update'];
        unset($_SESSION['update']);
}
if(isset($_SESSION['user-not-found']))
{
        echo $_SESSION['user-not-found'];
        unset($_SESSION['user-not-found']);
}
if(isset($_SESSION['pwd-not-found']))
{
        echo $_SESSION['pwd-not-found'];
        unset($_SESSION['pwd-not-found']);
}
if(isset($_SESSION['change-pwd']))
{
        echo $_SESSION['change-pwd'];
        unset($_SESSION['change-pwd']);
}
?>
<br><br>
        <!----button--->
        <a href="add.admin.php" class="btn-primary">ADD ADMIN</a>
        <!------------------>
        <br><br>
       <table class="tbl-full">
        <tr>
                <th>serial</th>
                <th>Full name</th>
                <th>Username</th>
                <th>Actions</th>
        </tr>

        <?php
        //  Query to display admins on site
        $sql="SELECT*FROM tbl_admin";
        //Execute
        $res = mysqli_query($conn,$sql);
        //Checking query execution
        if($res == TRUE)
        {
                //counting rows 
                $count = mysqli_num_rows($res);//Function for getting rows in DB
                $serial =1;
                //check no. of rows
                if($count>0)
                {
//Data in DB-CHECK
                     while($rows=mysqli_fetch_assoc($res))
                     {
//Getting data from DB-while loop

//Getting individual data
                        $id=$rows['id'];
                        $full_name=$rows['full_name'];
                        $username=$rows['username'];

                        //Display table values
                        ?>
                        <tr>
                <td><?php echo $serial++;?></td>
                <td><?php echo $full_name;?></td>
                <td><?php echo $username;?></td>
                <td>
                        <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Pwd</a>
                        <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">UPDATE</a>
                        <a href="<?php echo SITEURL;?>admin/deleteadmin.php?id=<?php echo $id;?>" class="btn-danger">DELETE</a>
                </td>
        </tr>
                        <?php
                     }
                }
                else
                {
//No data in DB-CHECK
                }
        }
        ?>

        
       </table> 
       
</div>
</div>
<div class="clearfix"></div>
<?php include('partials/footer.php');?>