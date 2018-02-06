<?php 
    require_once('config.php');
    $user_id = $_GET['userId'];
    deleteUser($user_id);
    header('Location: admin_page.php');
    die();
?>