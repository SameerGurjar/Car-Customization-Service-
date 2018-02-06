<?php 
    require_once('config.php');

    if(isUserLoggedIn()){
        $res = deleteUser();
        if(!res){
            header('Location: user_page.php');
            die();
        }
    }
    
    header('Location: car.php');
    die();
?>