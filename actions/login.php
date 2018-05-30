<?php
ob_start();
require_once(__DIR__.'/../Classes/User.php');
if(isset($_POST['email'])&&isset($_POST['password'])){
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user = new User();
    $user->setEmail($email);
    $user->setPassword($password);
    
    if ($user-> login()) {
        if(!isset($_SESSION)){ session_start(); }
        $userObj = $_SESSION['userObj'];
        $ses_userID = $userObj->getUserID();
        
        header("Location: ../index.php");
    }
    else echo"<script type='text/javascript'>
                alert('Invalid email or password');
                window.location.replace(\"../login.php\");
             </script>";
}
else {header("Location: ../index.php");}
ob_end_flush();
?>