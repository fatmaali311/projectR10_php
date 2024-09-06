<?php
session_start();
$page1="categories";
include_once('includes/checklogged.php');
include_once('includes/conn.php');  

try {
    $sql = "SELECT * FROM categories";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
} catch(PDOException $e) {
    $msg = $e->getMessage();
    $alertType = "alert-danger";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    try { 
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {
            $sql = "DELETE FROM categories WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            $msg = "Record deleted successfully";
            $alertType = "alert-success";
        } else {
            throw new Exception("Invalid ID");
        }
    } catch(PDOException $e) {
        $msg = $e->getMessage();
        $alertType = "alert-danger";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('includes/head2.php'); ?>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this category?');
        }
    </script>
</head>
<body class="nav-md">
<?php
        include_once('includes/alert.php');
		?>
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.html" class="site_title"><i class="fa fa-graduation-cap"></i> <span>Education Admin</span></a>
                </div>
                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <?php include_once('includes/menu_profile.php'); ?>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <?php include_once('includes/sidebar.php'); ?>
                <!-- /sidebar menu -->

                <!-- menu footer buttons -->
                <?php include_once('includes/footer_buttons.php'); ?>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <?php include_once('includes/top_nav.php'); ?>
        <!-- /top navigation -->

  <!-- page content -->
  <div class="right_col" role="main">
      <div class="">
          <div class="page-title">
              <div class="title_left">
                  <h3>Manage Categories</h3>
              </div>
              <div class="title_right">
                  <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                      <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search for...">
                          <span class="input-group-btn">
                              <button class="btn btn-secondary" type="button">Go!</button>
                          </span>
                      </div>
                  </div>
              </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
              <div class="col-md-12 col-sm-12 ">
                  <div class="x_panel">
                      <div class="x_title">
                          <h2>List of Categories</h2>
                          <ul class="nav navbar-right panel_toolbox">
                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                              <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="#">Settings 1</a>
                                      <a class="dropdown-item" href="#">Settings 2</a>
                                  </div>
                              </li>
                              <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                          </ul>
                          <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="card-box table-responsive">
                                      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                          <thead>
                                              <tr>
                                                  <th>Category Name</th>
                                                  <th>Edit</th>
                                                  <th>Delete</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php foreach ($categories as $row) {
                                                  $id = $row['id'];
                                                  $category_name = $row['category_name'];
                                              ?>
                                                  <tr>
                                                      <td><?php echo $category_name; ?></td>
                                                      <td>
                                                          <form action="editCategory.php" method="POST">
                                                              <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                              <button type="submit" class="btn btn-primary btn-sm">
                                                                  <img src="./images/edit.png" alt="Edit" style="height:18px;">
                                                              </button>
                                                          </form>
                                                      </td>
                                                      <td>
                                                          <form action="" method="POST" onsubmit="return confirmDelete();">
                                                              <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                              <button type="submit" class="btn btn-primary btn-sm" name="delete">
                                                                  <img src="./images/delete.png" alt="Delete" style="height:18px;">
                                                              </button>
                                                          </form>
                                                      </td>
                                                  </tr>
                                              <?php } ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include_once('includes/footer_content.php'); ?>
        <!-- /footer content -->
    </div>
</div>
<?php include_once('includes/jQueryTable.php'); ?>
</body>
</html>
