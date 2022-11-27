<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update product</h1>
        <br>
        <br>



 <?php
 //check if id is set
 if(isset($_GET['id']))
 {
    //getbid and all the data
$id=$_GET['id'];
//create query to get details
$sql = "SELECT * FROM tbl_category WHERE id=$id";

//execute 
$res = mysqli_query($conn, $sql);
//count rows
$count=mysqli_num_rows($res);
if($count==1)
{
    //get all data
    $row=mysqli_fetch_assoc($res);
    $title=$row['title'];
    $image_name=$row['image_name'];
    $featured=$row['featured'];
    $active=$row['active'];

}
else
{
    //redirect to category home
$_SESSION['no-category']= "<div class='error'>Category not found</div>";
       header('location:'.SITEURL.'admin/category.php');
}


 }
else
{
    //redirect to category home
    header('location:'.SITEURL.'admin/category.php');
}


?>
<form action="" method="post" enctype="multipart/form-data">
        <table class="tbl-30">
        <tr>

<td>Title:</td>
<td>
<input type="text" name="title" placeholder="category title" value="<?php echo $title; ?>">
</td>
<tr>
<td>Current Image:</td>
<td>
       <?php
       if($image_name!="")
       {
        //Display image
        ?>
        <ing src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>">
        <?php
       }
       else
       {
        //display error messagge
        echo "<div class='error'>Image not added</div>";
       }


        ?>
</td>
</tr>

<tr>
<td>New image:</td>
<td>
<input type="file" name="image">
</td>
</tr>

<br>

<tr>
<td >Featured:</td>
<td class="td">
Yes<input <?php if($featured=="Yes"){echo "checked";}?> type="radio"  name="featured" value="Yes">
No<input <?php if($featured=="No"){echo "checked";}?> type="radio"  name="featured" value="No">
</td>
</tr>


<br>
<tr>
<td>Active:</td>
<td class="td">
Yes<input <?php if($active=="Yes"){echo "checked";}?> type="radio"  name="active" value="Yes" >
No<input <?php if($active=="No"){echo "checked";}?> type="radio"  name="active" value="No">
</td>
</tr>



</tr>
<tr>
<td colspan="2">
    <input type="hidden" name="image" value="<?php echo $image_name;?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" name="submit" value="UPDATE" class="btn-secondary btn">
</td>
</tr>
</table>
</form>

<?php
    if(isset($_POST['submit']))
    {
        //echo "Clicked";
        //get values from form
        $id=$_POST['id'];
        $title=$_POST['title'];
        $image_name=$_POST['image'];
        $active=$_POST['active'];
        $featured=$_POST['featured'];

        //updating image=new
//image selection check
                   if(isset($_FILES['image']['name']))

                   {
                        //get image details
                        $image_name=$_FILES['image']['name'];
                        //check image availability
                        if($image_name!="")
                        {
                         //upload new image
                         //Renaming image
        //get the image extension
        $ext=end(explode('.',$image_name));
        //rename image
        $image_name="product_cat_".rand(000,999).'.'.$ext;

        $source_path=$_FILES['image']['tmp_name'];
        $destination_path="../images/category/".$image_name;

        //image upload
        $upload=move_uploaded_file($source_path,$destination_path);

        //check if image is uploaded 
        if($upload==false)
        {
            $_SESSION['upload']="<div class=error>upload failed</div>";
            //redirect to add category page
            header('location'.SITEURL.'admin/category.php');
            //stop the process
            die();
        }
                         //remove current image
                         if($image!="")
                         {
                         $remove_path="../images/category/".$image;
                         $remove=unlink($remove_path);

                         if($remove==false)
                           {
                            $_SESSION['fail']="<div class='error'>Try again!</div>";
                            header('location:'.SITEURL.'admin/category.php');
                            die();
                           }
                        }
        
                        }
                        else
                        {
                            $image_name=$image;
                        }
                   }
                   else
                   {
                        $image_name=$image;
                   }
        //update DB
               $sql2="UPDATE tbl_category SET
               title='$title',
               image_name='$image_name',
               featured='$featured',
               active='$active'
               WHERE id=$id
               ";
                 //execute
                  $res2=mysqli_query($conn,$sql2);
                 

        //redirect to category
                     if($res2==true)
                     {
                        //updated
                        $_SESSION['update']="<div class='success'>Update successful</div>";
                        header('location:'.SITEURL.'admin/category.php');
                     }
                     else{
                        //failed
                        $_SESSION['update']="<div class='error'>Update Failed</div>";
                        header('location:'.SITEURL.'admin/category.php');
                     }
    }

?>
    </div>
</div>







<?php include('partials/footer.php'); ?>