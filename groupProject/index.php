<?php

	//Get the database connection
	require("models/connection.php");

	//Get the action
	if(isset($_POST['action']))
	{
		$action = trim(filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING));
	}
	else
	{
		$action = "home";
	}


	include("views/header.php");


	//Determine actions based on Action
	if($action == "home")
	{
		//Get all the reservations 
		$allData = $db->query("SELECT * FROM reservation");

		//Display all the reservation dates
		include("views/displayDates.php");
	}
	else if($action == "createRequestForm")
	{
		//display the request form
		include("views/requestTime.php");
	}
	else if($action == "createRequest")
	{
		//Get all the data from the form
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
			$reservedDate = date("Y-m-d", strtotime(trim(filter_input(INPUT_POST, 'reservedDate', FILTER_SANITIZE_STRING))));
		}
		else
		{
			$reservedDate = "";
		}

		if(isset($_POST['startTime']))
		{
			$startTime = date("H:i:s",strtotime(trim(filter_input(INPUT_POST, 'startTime', FILTER_SANITIZE_STRING))));
		}
		else
		{
			$startTime = "";
		}

		if(isset($_POST['endTime']))
		{
			$endTime = date("H:i:s",strtotime(trim(filter_input(INPUT_POST, 'endTime', FILTER_SANITIZE_STRING))));
		}
		else
		{
			$endTime = "";
		}

		if(isset($_POST['color']))
		{
			$color = trim(filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING));
		}
		else
		{
			$color = "red";
		}


		//Determine if the end time is after the start time
		if(date("His",strtotime($startTime)) < date("His",strtotime($endTime)))
		{
			//Get all reservatioons this event intersects with
			$colisions = $db->query("SELECT id FROM reservation WHERE ('$startTime' >= starttime AND '$startTime' <= endtime AND '$reservedDate' = reservedDate) OR ('$endTime' >= starttime AND '$endTime' <= endtime AND' $reservedDate' = reservedDate)");

			//Determine if the query returned any values
			if(count($colisions->fetchAll()) == 0)
			{
				//Insert the new reservation
				$db->query("INSERT INTO reservation(starttime, endtime, groupname, reservedDate, color) VALUES('$startTime', '$endTime', '$groupName', '$reservedDate', '$color');");
			}
			else
			{
				echo "Error: An even already exists at this time"
			}
		}
		else
		{
			echo "Error: The end time is before the start time";
		}

		//Get all the reservations
		$allData = $db->query("SELECT * FROM reservation");

		//Display the reservations
		include("views/displayDates.php");
	}


	include("views/footer.php");
?>





