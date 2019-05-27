<?php


	$host = "localhost";
	$user = "root";
	$pass = "root";
	$db   = "abdelrahman";

	try{
		
		$conn = new pdo("mysql:host=$host; dbname=$db", $user, $pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $er){
		
		echo "not connected :" . $e->getMessage();
} 




              


           