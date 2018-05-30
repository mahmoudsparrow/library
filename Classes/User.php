<?php
ob_start();
if(!isset($_SESSION)){ session_start(); }
require_once(__DIR__.'/DataBase.php');


class User {
    private $userID, $username, $email, $password, $phone, $address, $role_id, $userStatus;
    
    public function setUserID($id){
        if (is_numeric($id)){
            $this->userID = $id;
            return true;
        }
        return false;
    }
    
    public function getUserID (){
        return $this->userID;
    }
    
    public function setUsername($username){
        if (is_string($username)){
            $this->username = $username;
            return true;
        }
        return false;
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function setEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->email = $email;
            return true;
        }
         return false;   
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function setPassword ($password){
        $this->password = $password;
        return true;
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    public function setPhone ($phone){
        if (strlen($phone) == 11){
            $this->phone = $phone;
            return true;
        }
        return false;
    }
    
    public function getPhone(){
        return $this->phone;
    }
    
    public function setAddress ($address){
        $this->address = $address;
        return true;
    }
    
    public function getAddress (){
        return $this->address;
    }
    
    public function setRoleID ($role_id){
        if (is_numeric($role_id)){
            $this->role_id = $role_id;
            return true;
        }
        return false;
    }
    
    public function getRoleID (){
        return $this->role_id;
    }
    
    public function setUserStatus ($userStatus){
        if (is_numeric($userStatus)){
            $this->userStatus = $userStatus;
            return true;
        }
        return false;
    }
    
    public function getUserStatus (){
        return $this->userStatus;
    }
    
    public function registration(){
        $db = DataBase::objDB();
        $sqlCheck = "SELECT * FROM users where email = '$this->email'";
        $checkedData = $db->excute($sqlCheck);
        $num = $checkedData->num_rows;
        if($num == 0){
            $sql = "INSERT INTO users (fullname, email, password, phone, address)
                     VALUES('$this->username','$this->email','$this->password','$this->phone','$this->address')";
            if($db->excute($sql))
                return true;           
        }else{
            echo"<script type='text/javascript'>
                alert('This mail is already used, please use another one');
                window.location.replace(\"../register.php\");
                </script>";
        }
        return false;
    }
    
    public function login () {
        $db = DataBase::objDB();
        $sql ="SELECT * FROM users where email='$this->email' AND password='$this->password'";
        $data_row = $db->excute($sql);
        $login_result = $data_row->num_rows;
        if ($login_result == 1 ){
            $user_data = $data_row->fetch_assoc();
            if(!isset($_SESSION)){ session_start(); }
            $user = new User();
            
            $user->setUserID($user_data['id']);
            $user->setUsername($user_data['fullname']);
            $user->setEmail($user_data['email']);
            $user->setPassword($user_data['password']);
            $user->setPhone($user_data['phone']);
            $user->setAddress($user_data['address']);
            $user->setRoleID($user_data['role_id']);
            $user->setUserStatus($user_data['statusID']);
            $_SESSION['userObj'] = $user;
            return true;
        }
        else{
            return false;
        }
    }
    
    public function checkLogin($userID){
        if(!isset($_SESSION)){ session_start(); }
        if (empty($_SESSION['userObj']) && !isset($_SESSION['userObj'])){
            return false;
        }else{
            $userObj = $_SESSION['userObj'];
            $ses_userID = $userObj->getUserID();
            if ($userID == $ses_userID)
                return true;
        }
        return false;
    }
    
    public function is_Logged_in(){
        if(!isset($_SESSION)){ session_start(); }
        if (empty($_SESSION['userObj']) && !isset($_SESSION['userObj'])){
            return false;}
        return true;
    }
    
    public function logout (){
        session_destroy();
        header("Location: ../index.php");
    }
    
    public function checkPassword ($password, $confirmPassword){
        if ($password == $confirmPassword)
            return true;
        return false;
    }
    
    
    public function getUserInfo ($userID)
    {
        $sql = "SELECT * FROM users WHERE id = '$userID'";
        $db = DataBase::objDB();
        $result = $db->excute($sql);
        return $result;
    }
    
    public function checkEmail ($email){
        $db = DataBase::objDB();
        $sqlCheck = "SELECT * FROM users where email = '$email'";
        $checkedData = $db->excute($sqlCheck);
        $num = $checkedData->num_rows;
        if($num == 1)
            return true;
        else
            return false;
    }

    public function borrow($user_id, $book_id)
    {
        $db = DataBase::objDB();
        $sql = "SELECT * FROM borrow where user_id=$user_id AND book_id=$book_id";
        $data = $db->excute($sql);
        $num = $data->num_rows;
        if($num < 1){
            $date_from = Date("Y-n-j");
            $date = strtotime($date_from);
            $date = strtotime("+7 day", $date);
            $date_to = Date("Y-n-j", $date);

            // $date_from = $date_from->format("Y-n-j");
            // $date_to = $date_to->format("Y-n-j");
            // echo $date_from;
            // die();

            $sql = "INSERT INTO borrow (user_id, book_id, date_from, date_to) VALUES ('$user_id', '$book_id', '$date_from', '$date_to')";
            if($db->excute($sql))
                return true;
        }
        return false;
    }

    public function is_borrowed($book_id)
    {
        $db = DataBase::objDB();
        $sql = "SELECT * FROM borrow where book_id=$book_id";
        $data = $db->excute($sql);
        $num = $data->num_rows;
        if($num == 1)
            return true;
        return false;
    }

    public function info_about_borrowed_book($book_id)
    {
        $db = DataBase::objDB();
        $sql = "SELECT * FROM borrow where book_id=$book_id";
        $data = $db->excute($sql);
        return $data;
    }

    public function retrieveAllBooks()
    {
        $sql = "SELECT * FROM book WHERE 1";
        $db = DataBase::objDB();
        $result = $db->excute($sql);
        return $result;
    }

    public function retrieveMyBooks($user_id)
    {
        $db = DataBase::objDB();
        $sql = "SELECT * FROM borrow where user_id=$user_id";
        $data = $db->excute($sql);
        $book_ids = array();
        while($book_id = $data->fetch_assoc()){
            array_push($book_ids, $book_id['book_id']);
        }
        $book_ids = implode("','", $book_ids);
        $sql = "SELECT * FROM book where id in ('$book_ids')";
        $my_books = $db->excute($sql);
        return $my_books;
        // return $book_ids;
    }
    
}
ob_end_flush();
?>