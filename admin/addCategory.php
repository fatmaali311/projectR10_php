<?php
session_start();
$page2="Add Category";
include_once('includes/checkLogged.php');
$page = "category";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include_once('includes/conn.php');
    
    try {
        $sql = "INSERT INTO `categories`(`category_name`) VALUES (?)";
        $category_name = $_POST['category_name'];
        $stmt = $conn->prepare($sql);
        $stmt->execute([$category_name]);
        $msg = "Added Successfully";
        $alertType = "alert-success";
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
<?php if (isset($msg)) { ?>
            <div class="alert <?php echo $alertType; ?>"><?php echo $msg; ?></div>
        <?php } ?>
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
							<h3>Manage Categories</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
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
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Add Category</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a class="dropdown-item" href="#">Settings 1</a>
												</li>
												<li><a class="dropdown-item" href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form   action=""  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="add-category">Add Category <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="add-category" required="required"  name="category_name" class="form-control ">
											</div>
										</div>
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>
												<button type="submit" class="btn btn-success" name ="add">Add</button>
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

</body></html>
