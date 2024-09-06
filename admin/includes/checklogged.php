<?php
if(!isset($_SESSION['logged']) or $_SESSION['logged']!== true){
    header('location:login.php');
    die();
}
?>