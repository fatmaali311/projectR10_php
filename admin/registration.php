<?php
$page="Register";
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        include_once('includes/conn.php');
        $fullName = $_POST['fullName'];
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        try{
            $sql = "INSERT INTO `users`(`fullName`, `userName`, `email`, `password`) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fullName,$userName,$email,$password]);
            $msg = "sign in Successfully";
            $alertType = "alert-success";
        } catch(PDOException $e) {
            $msg = $e->getMessage();
            $alertType = "alert-danger";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php    include_once('includes/head.php');   ?>
  </head>

  <body class="login">

    <div>
    <?php
        include_once('includes/alert.php');
        ?>
      <div class="login_wrapper">
     
      <div id="register" class="animate form login_form">
        <section class="login_content">
            <form action="" method="POST">
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Fullname" required name="fullName" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Username" required name="userName" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required name="email" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required name ="password" />
              </div>
              <div>
              <button type="submit" class="btn btn-default submit"> Submit </button>
              </div>
              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="login.php" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-graduation-cap"></i></i> Education Admin</h1>
                  <p>©2016 All Rights Reserved. Education Admin is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        
      </div>
    </div>
  </body>
</html>
