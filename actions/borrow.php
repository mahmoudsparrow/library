<?php
ob_start();
require_once(__DIR__.'/../Classes/User.php');

if(!isset($_SESSION)){ session_start(); }
if (empty($_SESSION['userObj']) && !isset($_SESSION['userObj'])){
    header("Location: ../login.php");
}else{
    $user_id = $_GET['userid'];
    $book_id = $_GET['bookid'];
    $user = new User();
    if($user->borrow($user_id, $book_id)){
        echo 'true';
        return true;
    }
    echo 'false';
    header("Location: ../index.php");
}
ob_end_flush();
?>