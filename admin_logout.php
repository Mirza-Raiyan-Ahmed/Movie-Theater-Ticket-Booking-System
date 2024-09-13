<?php 

session_start();

if(isset($_SESSION['movie_theater_admin_id'])){
    $_SESSION['movie_theater_admin_id'] = NULL;
    unset($_SESSION['movie_theater_admin_id']);
}



header("Location: login_admin.php");
die;