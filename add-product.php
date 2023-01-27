<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
       <h1>New product</h1>

       <?php
          if(isset($_SESSION['upload']))
          {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
          }
       
       ?>
       <br><br><br>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">

            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" placeholder="product title">
                </td>

            </tr>

            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="" cols="30" rows="6" placeholder="Enter product description"></textarea>
            
                </td>
            </tr>

            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>
            <tr>
                <td>Select image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

           <tr>
                <td>Category:</td>
                <td>
                    <select name="category">

                        <?php
                        //displaying categories from DB
                        //create sql to get all active categories from DB
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                        //executing

                        $res = mysqli_query($conn, $sql);

                        //count rows to check whether we have categories
                        $count = mysqli_num_rows($res);

                         //check if count is greater than zero we have categories 
                         if($count>0)
                           {
                             //we have categories
                                 while($row=mysqli_fetch_assoc($res))
                              {
                                //get the details of category
                               $id = $row['id'];
                               $title = $row['title'];
                         ?>

                            <option value="<?php echo $id;?>"><?php echo $title; ?></option>

                         <?php
                             }

                         }
                         else
                         {
                         //no categories available
                         ?>

                         <option value="0">Categories not available</option>

                         <?php
    
                         }
                 ?>
                        
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add product" class="btn-primary">
                </td>
            </tr>

            </table>
    </form>



    <?php
    //check if button was clicked.
    if(isset($_POST['submit']))
     {
        //Add food in database
        //1.Get data from form 
        $title = $_POST['title'];
        $Description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category']; 

        //check whether Radio button are set 
        if (isset($_POST['featured'])) {

            $featured = $_POST['featured'];
        } else {
            $featured = "No";//setting default value
        }
       
        if (isset($_POST['active'])) {

            $active = $_POST['active'];
        }
         else
         {
            $active = "No";//setting default value
        }
       
        //2.upload the image if selected-check if the image is clicked
        if(isset($_FILES['image']['name']))
           {
            //Get details of the selected image
            $image_name = $_FILES['image']['name'];

            //check image selection and upload only if selected.
            if($image_name!="")
            {
                //image is selected.
                //Rename the image
                $ext = end(explode('.', $image_name));

                //create new name for image
                $image_name = "Product-Name-".rand(0000, 9999).".". $ext;

                //upload the image
                //Get src path and destination path
                $src = $_FILES['image']['tmp_name'];
                //DEstination path
                $dst = "../images/products/".$image_name;
                //upload image
                $upload = move_uploaded_file($src, $dst);
                //check if image was uploaded
                if($upload==false)
                {
                    //Failed operation

                    //Redirect to add food 
                    $_SESSION['upload'] = "<div class='error'>Operation stopped</div>";
                    header('location:'.SITEURL.'admin/add-product.php');

                    //stop the process
                    die();
                }
            }

           }
           else
           {
            $image_name = "";//setting default image value as blank
           }


        //3.insert data into DB
        $sql2 = "INSERT INTO tbl_products SET
        title='$title',
        Description='$description',
        price=$price,
        image_name='$image_name',
        category_id=$category,
        featured='$featured',
        active='$active'
        
        ";
        //execute query
        $res2 = mysqli_query($conn, $sql2);
        //check whether data is inserted

        if($res2==true)
        {
            //data inserted
            $_SESSION['add'] = "<div class='success' >Product added successfully.</div>";
            header('location:' . SITEURL . 'admin/manage-product.php');

        }
        else
        {
            //Failed
            $_SESSION['add'] = "<div class='error' >Failed to add.</div>";
            header('location:' . SITEURL . 'admin/manage-product.php');
        }

        
     }
    
    
    ?>
 </div>


</div>
<?php include('partials/footer.php');?>