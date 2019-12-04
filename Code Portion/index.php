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

	$allData = $db->query("SELECT * FROM reservation");

	if(isset($_POST['action']))
	{
		$action = trim(filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING));
	}
	else
	{
		$action = "null";
	}

	if($action == "createRequest")
	{
		if(isset($_POST['groupName']))
		{
			$groupName = trim(filter_input(INPUT_POST, 'groupName', FILTER_SANITIZE_STRING));
		}
		else
		{
			$groupName = "null";
		}

		if(isset($_POST['reservedDate']))
		{
			$reservedDate = trim(filter_input(INPUT_POST, 'reservedDate', FILTER_SANITIZE_STRING));
		}
		else
		{
			$reservedDate = "";
		}

		if(isset($_POST['startTime']))
		{
			$startTime = trim(filter_input(INPUT_POST, 'startTime', FILTER_SANITIZE_STRING));
		}
		else
		{
			$startTime = "";
		}

		if(isset($_POST['endTime']))
		{
			$endTime = trim(filter_input(INPUT_POST, 'endTime', FILTER_SANITIZE_STRING));
		}
		else
		{
			$endTime = "";
		}


		/*TODO: include checks to make sure end is after start and no conflicts with other reservations*/


		$db->query("INSERT INTO reservation(starttime, endtime, groupname, reservedDate) VALUES('$startTime', '$endTime', '$groupName', '$reservedDate');");
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  	<title>Game Room Schedule</title>

  	<!-- CSS  -->
  	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  	<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  	<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  	<script src="js/materialize.js"></script>
  	<script src="js/init.js"></script>
</head>
<body>
<div class="container">
	<form action="index" method="post">
	<table>
	<?php foreach($allData as $arow): ?>
		<tr>
			<td><?php echo $arow["groupname"] ?></td>
			<td><?php echo $arow["starttime"] ?></td>
			<td><?php echo $arow["endtime"] ?></td>
			<td><?php echo $arow["reservedDate"] ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
</form>

<h3>Request Time</h3>
<form action="index.php" method="post">
	<div class="input-field col s12">
    	<input name="groupName" id="groupName" type="text" required>
        <label for="groupName">Group Name</label>
    </div>
    <div class="input-field col s12">
    	<input name="reservedDate" id="reservedDate" type="text" class="datepicker" required>
        <label for="reservedDate">Date</label>
    </div>
    <div class="input-field col s12">
    	<input name="startTime" id="startTime" type="text" class="timepicker" required>
        <label for="startTime">Start Time</label>
    </div>
    <div class="input-field col s12">
    	<input name="endTime" id="endTime" type="text" class="timepicker" required>
        <label for="endTime">End Time</label>
    </div>
    <div class="center-align col s12">
		<button class="btn waves-effect waves-light logsubmit blue" type="submit" name="action" value="createRequest">Submit</button>
	</div>
</form>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>