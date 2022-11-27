<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1 class='text-center''>Category</h1>
        <br>

        <?php
if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}

if(isset($_SESSION['remove']))
{
    echo $_SESSION['remove'];
    unset($_SESSION['remove']);
}

if(isset($_SESSION['delete']))
{
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
if(isset($_SESSION['no-category']))
{
    echo $_SESSION['no-category'];
    unset($_SESSION['no-category']);
}
if(isset($_SESSION['update']))
{
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}
?>
<br>
        <!----button--->
        <a href="<?php echo SITEURL?>admin/add-category.php" class="btn-primary">New Category</a>
        <br><br>
       <table class="tbl-full">
        <tr>
                <th>serial No.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
        </tr>
        <?php
        //fetching categories from DB
        $sql = "SELECT * FROM tbl_category";
        //eecuting
        $res=mysqli_query($conn,$sql);
        //count rows
        $count=mysqli_num_rows($res);
        //serial number variable
        $Sn=1.01;
        //checking data iin DB
        if($count>0)
        {
                //we have data in DB
          while($row=mysqli_fetch_assoc($res))
          {
                $id=$row['id'];
                $title=$row['title'];
                $image_name=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];

                ?>
                   <tr>
                <td><?php echo $Sn++; ?></td>
                <td><?php echo $title; ?></td>

                <td>
                        <?php 
                        //check if image name is available
                        if($image_name!="")
                        {
                                //display image
                                ?>
                                     <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                <?php
                        }
                        else
                        {
                                //messsage
                                echo "<div class='error'>No image </div>";
                        }
                        ?>
                </td>

                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                        <a href="<?php echo SITEURL; ?>admin/update-product.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                        <a href="<?php echo SITEURL; ?>admin/delete-product.php?id=<?php echo $id; ?>&image_name="<?php echo$image_name;?>" class="btn-danger" >Delete</a>
                </td>
        </tr> 
                <?php
          }
          
        }
        else
        {
                //no data
                ?>
                <tr><td colspan="6"><div class="error">No categories found</div></td></tr>
                
                <?php

        }
        
        ?>

        

       </table> 
       
</div>
</div>
<div class="clearfix"></div>
<?php include('partials/footer.php');?>