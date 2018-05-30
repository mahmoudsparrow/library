<?php

class DataBase {
	
	
    protected $link , $result , $_numRows;
    protected $db_localhost = 'localhost', $db_username = 'root', $db_password = '', $db_name = 'library';
    private static $instance = NULL;
	private $conn = NULL ;
    
    private function __construct(){
		$this->conn = new mysqli($this->db_localhost, $this->db_username, $this->db_password, $this->db_name);
	}
    
    public static function objDB(){
        if(!isset(DataBase::$instance))
            DataBase::$instance = new DataBase();
        return DataBase::$instance;
    }
	
    public function excute ($sql){
        $this->result = $this->conn->query($sql);
        return $this->result;
    }
    
}
?>