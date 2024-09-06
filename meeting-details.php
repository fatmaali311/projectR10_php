<?php
$page_active="meetings" ;
$page="Education Template - Meeting Detail Page";
include_once('admin/includes/conn.php');
$id = $_GET['id'];
try {
  // Update views count
  $sql = "UPDATE `meetings` SET `views` = views + 1 WHERE `id` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
} catch (PDOException $e) {
  $msg = $e->getMessage();
  $alertType = "alert-danger";
}
try{
    $sql = "SELECT * FROM `meetings` WHERE `id`=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $Result = $stmt->fetch();
    $title =  $Result['title'];
    $image =  $Result['image'];
    $price =  $Result['price'];
    $content =  $Result['content'];
    $active =  $Result['active'] ;
    $meeting_date =$Result['meeting_date'] ;
    $location =  $Result['location'] ;
    $cat_id=$Result['cat_id'];
} catch(PDOException $e) {
    $msg = $e->getMessage();
    $alertType = "alert-danger";
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/head.php'); ?>
  </head>

<body>

   

  <!-- Sub Header -->
  <?php include_once('includes/sub_header.php'); ?>

  <!-- ***** Header Area Start ***** -->
  <?php include_once('includes/header_area.php'); ?>

  <!-- ***** Header Area End ***** -->

  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>Get all details</h6>
          <h2><?php echo $title ?></h2>
        </div>
      </div>
    </div>
  </section>

  <section class="meetings-page" id="meetings">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-12">
              <div class="meeting-single-item">
                <div class="thumb">
                  <div class="price">
                    <span>$<?php echo $price?></span>
                  </div>
                  <div class="date">
                    <h6><?php echo date('M', strtotime($meeting_date)); ?> <span><?php echo date('d', strtotime($meeting_date)); ?></span></h6>
                  </div>
                  <a href="meeting-details.php"><img src="assets/images/<?php echo $image ?>" alt=""></a>
                </div>
                <div class="down-content">
                  <a href="meeting-details.php"><h4><?php echo $title ?></h4></a>
                  <p><?php echo $location ?></p>
                  <p class="description">
                  <?php echo $content ?>
                  </p>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="hours">
                        <h5>Hours</h5>
                        <p>Monday - Friday: 07:00 AM - 13:00 PM<br>Saturday- Sunday: 09:00 AM - 15:00 PM</p>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="location">
                        <h5>Location</h5>
                        <p><?php echo $location ?></p>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="book now">
                        <h5>Book Now</h5>
                        <p>010-020-0340<br>090-080-0760</p>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="share">
                        <h5>Share:</h5>
                        <ul>
                          <li><a href="#">Facebook</a>,</li>
                          <li><a href="#">Twitter</a>,</li>
                          <li><a href="#">Linkedin</a>,</li>
                          <li><a href="#">Behance</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="main-button-red">
                <a href="meetings.php">Back To Meetings List</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>Copyright © 2022 Edu Meeting Co., Ltd. All Rights Reserved. 
          <br>Design: <a href="https://templatemo.com" target="_parent" title="free css templates">TemplateMo</a></p>
    </div>
  </section>


  <!-- Scripts -->
  <?php include_once('includes/scripts.php'); ?>
</body>


  </body>

</html>
