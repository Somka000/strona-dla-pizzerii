<?php
	$typ 	= 'mysql';
	$server = 'localhost';
	$db		= 'pizzeria';
	$port	= '3306';
	
	$user	= 'root';
	$pass	= '';
	$dsn = "$typ:host=$server;dbname=$db;port=$port";
	try {
		$pdo = new PDO($dsn,$user,$pass);
		//echo 'ok'.'<br />';
		
 	  } catch(PDOException $e)
   	  {
     		echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
   	  }
?>