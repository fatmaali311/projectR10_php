<?php
session_start();
$page2="Edit User";
include_once('includes/checklogged.php');
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    include_once('includes/conn.php');
    $id = $_POST['id'];
    if (isset($_POST['update'])) {
        try {
            $fullName = $_POST['fullName'];
            $email = $_POST['email'];
            $userName = $_POST['userName'];
            $active = isset($_POST['active']) ? '1' : '0';
            $newPassword = $_POST['password'];
            $currentPassword = $_POST['currentPassword'];

            // Check if a new password was provided
            if (!empty($newPassword)) {
                $password = password_hash($newPassword, PASSWORD_DEFAULT); // Hash the new password
            } else {
                $password = $currentPassword; // Keep the current password
            }

            $sql = "UPDATE users SET fullName=?, email=?, userName=?, `password`=?, active=? WHERE id=?";
            $stmtUpdate = $conn->prepare($sql);
            $stmtUpdate->execute([$fullName, $email, $userName, $password, $active, $id]);

            $msg = "Updated Successfully";
            $alertType = "alert-success";
        } catch (PDOException $e) {
            $msg = $e->getMessage();
            $alertType = "alert-danger";
        }
    }

    try {
        $sql = "SELECT * FROM users WHERE id =?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        $id = $result['id'];
        $fullName = $result['fullName'];
        $email = $result['email'];
        $userName = $result['userName'];
        $currentPassword = $result['password'];
        $active = $result['active'];
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
                            <h3>Manage Users</h3>
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
                                    <h2>Edit User</h2>
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
                                        <input type="hidden" name="id" value="<?php echo $id ; ?>">
                                        <input type="hidden" name="currentPassword" value="<?php echo $currentPassword; ?>">
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Full Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="text" id="first-name" required="required" class="form-control" name="fullName" value="<?php echo $fullName; ?>">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="user-name">Username <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="text" id="user-name" name="userName" required="required" class="form-control" value="<?php echo $userName; ?>">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Email <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input id="email" class="form-control" type="email" name="email" value="<?php echo $email; ?>" required="required">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="flat" name="active" <?php echo $active ? 'checked' : ''; ?>>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="password" id="password" name="password" class="form-control">
                                                <small>Leave blank to keep current password</small>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 offset-md-3">
                                                <button class="btn btn-primary" type="button">Cancel</button>
                                                <button type="submit" class="btn btn-success" name="update">Update</button>
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

    <!-- jQuery -->
    <?php include_once('includes/jQuery.php'); ?>
</body>
</html>
