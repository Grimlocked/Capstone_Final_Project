<?php
$dsn = 'mysql:host=localhost;dbname=groupproject';
	$username = 'root';
	$password = '';

	try
	{
		$db = new PDO($dsn, $username, $password);
	}
	catch(PDOException $error)
	{
		
	}
?>