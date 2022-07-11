<?php 

class Dbconn{

    private $dbhost = "localhost";
    private $dbname = "blog_post";
    private $dbuser = "root";
    private $dbpass = "root";

    private function dbconnection(){
        try{
        $mysqlconn = "mysql:host=".$this->dbhost.";dbname=".$this->dbname;
        $conn = new PDO($mysqlconn,$this->dbuser,$this->dbpass);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
            return $conn;
       
        }catch(PDOException $e){

            return "Error message".$e->getMessage();

        }
    }

    protected function connection(){
        return $this->dbconnection();
    } 


}

?>