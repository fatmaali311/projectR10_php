<?php
session_start();
$page="Login";
if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
    header('Location: users.php');
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once('includes/conn.php');
    try {
        $sql = "SELECT `fullName`, `password` FROM `users` WHERE `userName` = ? AND `active` = ?";
        $userName = $_POST['userName'];
        $active = 1;
        $password = $_POST['password'];
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userName, $active]);

        if ($stmt->rowCount()) { 
            $result = $stmt->fetch(); 
            $verify = password_verify($password, $result['password']);
            if ($verify) {
                $_SESSION['logged'] = true;
                $_SESSION['fullName'] = $result['fullName']; // Fixed typo
                header('Location: users.php');
                die(); // Ensure script stops after redirection
            } else {
                $msg = "Incorrect password";
                $alertType = "alert-danger";
            } 
        } else {
            $msg = "No data found";
            $alertType = "alert-danger";
        }
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        $alertType = "alert-danger";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('includes/head.php'); ?>
</head>
<body class="login">
    <div>
        <?php if (isset($msg)) { ?>
            <div class="alert <?php echo $alertType; ?>"><?php echo $msg; ?></div>
        <?php } ?>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="" method="POST">
                        <h1>Login Form</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required name="userName"/>
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required name="password"/>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit">Log in</button>
                            <a class="reset_pass" href="#">Lost your password?</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <p class="change_link">New to site?
                                <a href="registration.php" class="to_register"> Create Account </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-graduation-cap"></i> Education Admin</h1>
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
