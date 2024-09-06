<?php
   session_start();
   $page1="Users";
   include_once('includes/checklogged.php');
   include_once('includes/conn.php');  
        try{
            $sql = "SELECT * FROM users";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        } catch(PDOException $e) {
            $msg = $e->getMessage();
            $alertType = "alert-danger";
        }
   
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php    include_once('includes/head2.php');   ?>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-graduation-cap"></i></i> <span>Education Admin</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <?php    include_once('includes/menu_profile.php');   ?>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php include_once('includes/sidebar.php');   ?>

					<!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <?php    include_once('includes/footer_buttons.php');   ?>

            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <?php    include_once('includes/top_nav.php');   ?>

        <!-- /top navigation -->

        <!-- page content -->
        <?php    include_once('includes/page_content.php');   ?>

        <!-- /page content -->

        <!-- footer content -->
        <?php    include_once('includes/footer_content.php');   ?>

        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <?php    include_once('includes/jQueryTable.php');   ?>

  </body>
</html>