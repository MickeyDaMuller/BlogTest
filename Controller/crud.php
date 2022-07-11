<?php 
namespace dbn;
use PDO;


class Crud{

public $dbhost = 'localhost';
public $dbname = 'blog_post';
public $dbpass = 'root';
public $dbuser = 'root';
public $conn;

function __construct()
    {
        $this->conn = $this->dbConn();
    }

	public function dbConn(){

			try{
			$conn = new PDO("mysql:host={$this->dbhost};dbname={$this->dbname}",$this->dbuser,$this->dbpass);

			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			return $conn;

			}catch(PDOException $e){

			return "Error message:".$e->getMessage();
			exit;
			}


	}


	public function select($query, $arrayValue = array()){


				if($this->conn){
			$stmt = $this->conn->prepare($query);
			$stmt->execute($arrayValue);
			 if ($stmt->rowCount() > 0) {
			 	 while ($row = $stmt->fetch()) {
			 	 	$resultset[] = $row;

			 	 	return $resultset;

            }
			 	
			 }else{

			 	return "Not available";

			 }

		}

	} 



}

?>