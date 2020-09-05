<?php
    require_once ('../Services/init.php');
    $adminUser = new AdminUser();
    if(!isset($_SESSION['adminuser'])){
        header('location: login.php');
    }
?>