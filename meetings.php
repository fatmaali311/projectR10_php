<?php 
include_once('admin/includes/conn.php');
$page_active="meetings";
$page="Education - List of Meetings";
// Number of meetings per page
$meetings_per_page = 4;

// Get the current page number from URL, default is 1
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) {
  $current_page = 1;
}

// Calculate the offset
$offset = ($current_page - 1) * $meetings_per_page;

try {
  // Retrieve the total number of meetings
  $total_sql = "SELECT COUNT(*) FROM `meetings`";
  $total_stmt = $conn->prepare($total_sql);
  $total_stmt->execute();
  $total_meetings = $total_stmt->fetchColumn();

  // Calculate the total number of pages
  $total_pages = ceil($total_meetings / $meetings_per_page);

  // Retrieve the meetings for the current page
  $sql = "SELECT * FROM `meetings` LIMIT :limit OFFSET :offset";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':limit', $meetings_per_page, PDO::PARAM_INT);
  $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
  $stmt->execute();

} catch(PDOException $e) {
  $msg = $e->getMessage();
  $alertType = "alert-danger";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
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
          <h6>Here are our upcoming meetings</h6>
          <h2>Upcoming Meetings</h2>
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
              <div class="filters">
                <ul>
                  <li data-filter="*" class="active">All Meetings</li>
                  <li data-filter=".soon">Soon</li>
                  <li data-filter=".imp">Important</li>
                  <li data-filter=".att">Attractive</li>
                </ul>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="row grid">
                <?php
                $meetings = $stmt->fetchAll();
                foreach($meetings as $row){
                  $id = $row['id'];
                  $meeting_date = $row['meeting_date'];
                  $title = $row['title'];
                  $image = $row['image'];
                  $content = $row['content'];
                  $price = $row['price'];
                  $views = $row['views'];
                  $class = 'all ';
                  if (strtotime($meeting_date) > strtotime('-1 week')) {
                    $class .= 'soon ';
                  }
                  if ($views > 1) {
                    $class .= 'imp ';
                  }
                  if ($price < 5000) {
                    $class .= 'att ';
                  }
                ?>
                <div class="col-lg-4 templatemo-item-col <?php echo $class; ?>">
                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">
                        <span>$<?php echo $price; ?></span>
                      </div>
                      <a href="meeting-details.php?id=<?php echo $id; ?>"><img src="assets/images/<?php echo $image; ?>" alt=""></a>
                    </div>
                    <div class="down-content">
                      <div class="date">
                        <h6><?php echo date('M', strtotime($meeting_date)); ?> <span><?php echo date('d', strtotime($meeting_date)); ?></span></h6>
                      </div>
                      <a href="meeting-details.php?id=<?php echo $id; ?>"><h4><?php echo $title; ?></h4></a>
                      <p><?php echo $content; ?></p>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="pagination">
                <ul>
                  <?php if ($current_page > 1){ ?>
                    <li><a href="?page=<?php echo $current_page - 1; ?>"><i class="fa fa-angle-left"></i></a></li>
                  <?php }; ?>
                  <?php for ($i = 1; $i <= $total_pages; $i++){ ?>
                    <li class="<?php echo ($i == $current_page) ? 'active' : ''; ?>"><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                  <?php }; ?>
                  <?php if ($current_page < $total_pages){ ?>
                    <li><a href="?page=<?php echo $current_page + 1; ?>"><i class="fa fa-angle-right"></i></a></li>
                  <?php }?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>Copyright © 2022 Edu Meeting Co., Ltd. All Rights Reserved. 
        <br>Design: <a href="https://templatemo.com/page/1" target="_parent" title="website templates">TemplateMo</a></p>
    </div>
  </section>

  <!-- Scripts -->
  <?php include_once('includes/scripts.php'); ?>
</body>

</html>
