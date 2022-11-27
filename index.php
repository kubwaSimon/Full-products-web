<?php include('partials/menu.php');?>
        <!----main content section----->
<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">DASHBOARD</h1>
        <br>
        <br>
        <!--session message -->
        <?php
          if(isset($_SESSION['login']))
       {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
      }
       ?>
<!--session message -->
        <div class="col-4 text-center">
        <h1>5</h1>
        <br/>
        Categories
    </div>
        <div class="col-4 text-center">
        <h1>5</h1>
        <br/>
        Categories
    </div>
        <div class="col-4 text-center">
        <h1>5</h1>
        <br>
        Categories
    </div>
        <div class="col-4 text-center">
        <h1>5</h1>
        <br/>
        Categories
    </div>
</div>
</div>
<div class="clearfix"></div>
<?php include('partials/footer.php');?>