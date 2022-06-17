<?php 

$dbhost = 'localhost';
$dbname = 'blog_post';
$dbpass = 'root';
$dbuser = 'root';

try{
$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){

echo $e->getMessage();

}



?>


