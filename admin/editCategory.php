
<?php
session_start();
$page2="Edit Category";
include_once('includes/checklogged.php');
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    include_once('includes/conn.php');
    $id = $_POST['id'];
    if (isset($_POST['update'])) {
        try {
            $category_name = $_POST['category_name'];

            $sql = "UPDATE `categories` SET `category_name`=? WHERE `id`=?";
            $stmtUpdate = $conn->prepare($sql);
            $stmtUpdate->execute([$category_name, $id]);

            $msg = "Updated Successfully";
            $alertType = "alert-success";
        } catch (PDOException $e) {
            $msg = $e->getMessage();
            $alertType = "alert-danger";
        }
    }
    try {
        $sql = "SELECT * FROM categories WHERE id =?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        $id = $result['id'];
        $category_name = $result['category_name'];
        
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        $alertType = "alert-danger";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('includes/head3.php'); ?>
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

                    <!-- /menu footer buttons -->
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
                            <h3>Edit Category</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">Go!</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Edit Category</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a class="dropdown-item" href="#">Settings 1</a></li>
                                                <li><a class="dropdown-item" href="#">Settings 2</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                            
                        
                                    <form action="" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="add-category">Edit Category <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="text" id="add-category" name="category_name" required="required" class="form-control" value="<?php echo $category_name; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="ln_solid"></div>
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 offset-md-3">
                                                <button class="btn btn-primary" type="button">Cancel</button>
                                                <button type="submit" name="update" class="btn btn-success">Update</button>
                                            </div>
                                        </div>
                                    </form>
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

    <?php include_once('includes/jQuery.php'); ?>
</body>
</html>
