<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br>
<?php
if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}

if(isset($_SESSION['upload']))
{
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}
?>
<br>
        <!--------------ADD cATEGORY----------->
<form action="" method="post" enctype="multipart/form-data">

<table class="tbl-30">
    <tr>

    <td>Title:</td>
    <td>
    <input type="text" name="title" placeholder="category title">
</td>
<tr>
    <td>Select Image:</td>
    <td>
<input type="file" name="image">

    </td>
</tr>

<tr>
    <td>Featured:</td>
<td class="td">
    Yes
<input type="radio"  name="featured" value="Yes">
No
<input type="radio"  name="featured" value="No">
</td>
</tr>

<br>

<tr>
    <td>Active:</td>
<td class="td">
    Yes
<input type="radio"  name="active" value="Yes">
No
<input type="radio"  name="active" value="No">
</td>
<br>

</tr>
<tr>
    <td colspan="2">
        <input type="submit" name="submit" value="ADD" class="btn-primary width=10%">
</td>
</tr>
</table>
</form>
<?php
//ccheck button
if(isset($_POST['submit']))
{
    //get values from form
    $title=$_POST['title'];
    //for raadio input-check if button is selected
    if(isset($_POST['featured']))
    {
        //Get the value from form
$featured=$_POST['featured'];
    }
    else{
        //set the default value
$featured="No";
    }
    if(isset($_POST['active']))
    {
        $active=$_POST['active'];
    }
    else{
        $active="No";
    }


    //check image selected and set value for image name accordingly

    if(isset($_FILES['image']['name']))
    {

        //upload image
        $image_name=$_FILES['image']['name'];

        //upload image when image is selected
        if($image_name!="")
    {
        

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
            header('location'.SITEURL.'admin/add-category.php');
            //stop the process
            die();
        }

    }
}
    else
    {
        //dont upload image.set image value as blank
      $image_name="";
    }
    //create query to insert category into DB
    $sql="INSERT INTO tbl_category SET
    title='$title',
    image_name='$image_name',
    featured='$featured',
    active='$active'
    ";
    //execute query and save in DB
    $res=mysqli_query($conn,$sql);

    //check query execution and data added
    if($res==true)
    {
        //query executed
        $_SESSION['add']="<div class='success'>Category Added</div>";
        //redirect to manage category
        header('location:'.SITEURL.'admin/category.php');
    }
    else
    {
        //opeation failed
        $_SESSION['add']="<div class='error'>Operation Failed</div>";
        //redirect to manage category
        header('location:'.SITEURL.'admin/add-category.php');
    }
}

?>

    </div>


</div>
<?php include('partials/footer.php'); ?>