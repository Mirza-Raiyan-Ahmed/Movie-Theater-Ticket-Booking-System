<?php 

session_start();

if(isset($_SESSION['movie_theater_user_id'])){
    $_SESSION['movie_theater_user_id'] = NULL;
    unset($_SESSION['movie_theater_userid']);
}
    


header("Location: login_beta.php");
die;