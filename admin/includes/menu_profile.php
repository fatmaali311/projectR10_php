<?php

// Assuming $fullName is fetched from a database or session
$profileName = isset($_SESSION['fullName']) ? $_SESSION['fullName'] : 'user';

?>
<div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $profileName ; ?></h2>
              </div>
            </div>