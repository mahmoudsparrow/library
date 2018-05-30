<?php
ob_start();
require_once(__DIR__.'/../Classes/User.php');
$user = new User();
//if(isset($_GET['logout_submit'])) {
    $user->logout();
//}

ob_end_flush();
?>