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
<<<<<<< Updated upstream:Code Portion/models/connection.php

	$link = mysqli_connect("127.0.0.1", "root", "", "groupproject");

=======
>>>>>>> Stashed changes:Game_App/models/connection.php
?>