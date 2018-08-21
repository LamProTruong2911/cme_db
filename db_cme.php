
<?php
$server = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'CME01_DB';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;charset=utf8;", $username, $password);
    //mysqli_set_charset($conn,"utf8");

} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}