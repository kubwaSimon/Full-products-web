<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1> products Available</h1>
        
        <br><br>
        <?php
        if(isset($_SESSION['add']))
           {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
           }



        ?>
        
        <!----button--->
        <a href="<?php echo SITEURL;?>admin/add-product.php" class="btn-primary">ADD Product</a>
        <br>
        <br>
       <table class="tbl-full">
        
        <tr>
                <th>sn</th>
                <th>Title</th>
                <th>price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
        </tr>

        <?php
        //create query to get products
        $sql = "SELECT*FROM tbl_products";
        //execute
        $res = mysqli_query($conn, $sql);
        //count rows
        $count = mysqli_num_rows($res);
        if($count>0)
          {
                //we have products in DB
                while ($row = mysqli_fetch_assoc($res))

                        //create serial no 
                        $sn = 1;
                 {
                        //get values of individual columns.
                        $id = isset($row['id']);
                        $title = isset($row['title']);
                        $price = isset($row['price']);
                        $image_name = isset($row['image_name']);
                        $featured = isset($row['featured']);
                        $active = isset($row['active']);
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                              <td><?php echo $price; ?></td>
                            <td>
                              <?php 
                                //check for image
                                  if($image_name=="")
                                    {
                                      //we dont have image
                                      echo "<div class='error'>No image was added</div>";
                                    }
                                      else
                                      {
                                      //we have image
                                ?>
                                      <img src="<?php echo SITEURL; ?>images/products/<?php echo $image_name; ?>"width=100px>

                                      <?php
                                      }
                                    
                                      ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                  <td><?php echo $active; ?></td>
                               <td>
                
                                  <a href="#" class="btn-secondary">Update Product</a>
                                  <a href="<?php echo SITEURL; ?>admin/deleteproduct.php" class="btn-danger">Delete Product</a>
                      </td>
                    </tr>


                        <?php
                 }
          }
          else
          {
                //products not added in DB
                echo "<tr><td colspan='7' class='error'>No Added products.</tr>";
          }
        ?>

        

        
       </table> 
</div>
</div>
<div class="clearfix"></div>
<?php include('partials/footer.php');?>