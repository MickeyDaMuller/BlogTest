<?php 

class Konn{
private $dbhost = 'localhost';
private $dbname = 'blog_post';
private $dbpass = 'root';
private $dbuser = 'root';

public function dbConn(){

try{
$pdo = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname",$this->dbuser,$this->dbpass);

$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

return $pdo;

}catch(PDOException $e){

echo "Error message:".$e->getMessage();
exit;
}


}

}

?>


