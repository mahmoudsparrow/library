<?php
ob_start();
require_once(__DIR__.'/../Classes/User.php');

if(isset($_POST['registrationbtn'])){
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'] ) && isset($_POST['confirmPassword'])
            && isset($_POST['phone']) && isset($_POST['address'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        
        $user = new User();
        if (!$user->checkPassword($password, $confirmPassword)){
            echo"<script type='text/javascript'>
            alert('Passwords dont match');
            window.location.replace(\"../register\");
            </script>";
        }
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setPhone($phone);
        $user->setAddress($address);
        
        if($user->registration())
            echo"<script type='text/javascript'>
            alert('Registration is done successfully');
            window.location.replace(\"../login.php\");
            </script>";
        else
            echo"<script type='text/javascript'>
            alert('Could not register for some reasons please try again');
            window.location.replace(\"../register.php\");
            </script>";
    }
}
else {header("Location: ../index.php");}
ob_end_flush();
?>