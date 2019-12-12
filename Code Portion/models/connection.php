<?php
$dsn = 'mysql:host=localhost;dbname=groupproject';
	$username = 'DonadMe';
	$password = 'dDEoFcBK3yLYvbNY';

	try
	{
		$db = new PDO($dsn, $username, $password);
	}
	catch(PDOException $error)
	{
		echo $error;
	}


?>