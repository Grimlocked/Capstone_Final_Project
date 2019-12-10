<?php
	session_start();
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
				echo "Error: An even already exists at this time";
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
	else if($action == "editRequestForm")
	{
		if(isset($_POST['groupId']))
		{
			$groupId = trim(filter_input(INPUT_POST, 'groupId', FILTER_SANITIZE_NUMBER_INT));

			$allData = $db->query("SELECT * FROM reservation WHERE reservation.id = $groupId");
			$allData = $allData->fetchAll();

			include("views/updateTime.php");
		}
		else
		{
			echo "Error: Reservation not found";
			$allData = $db->query("SELECT * FROM reservation");
			//Display the reservations
			include("views/displayDates.php");
		}
	}
	else if($action == "editRequest")
	{
		if(isset($_POST['groupId']))
		{
			$groupId = trim(filter_input(INPUT_POST, 'groupId', FILTER_SANITIZE_NUMBER_INT));

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
				$colisions = $db->query("SELECT id FROM reservation WHERE ('$startTime' >= starttime AND '$startTime' <= endtime AND '$reservedDate' = reservedDate AND $groupId != id) OR ('$endTime' >= starttime AND '$endTime' <= endtime AND' $reservedDate' = reservedDate AND $groupId != id)");
				$colisions = $colisions->fetchAll();


				//Determine if the query returned any values
				if(count($colisions) == 0)
				{
					$db->query("UPDATE reservation SET starttime = '$startTime', endtime = '$endTime', groupname = '$groupName', reservedDate = '$reservedDate', color = '$color' WHERE reservation.id = $groupId");
				}
				else
				{
					echo "Error: An even already exists at this time";
				}
			}
			else
			{
				echo "Error: The end time is before the start time";
			}
		}
		else
		{
			echo "Error: Reservation not found";
		}

		$allData = $db->query("SELECT * FROM reservation");
		//Display the reservations
		include("views/displayDates.php");
		
	}
	else if($action == "deleteRequest")
	{
		if(isset($_POST['groupId']))
		{
			$groupId = trim(filter_input(INPUT_POST, 'groupId', FILTER_SANITIZE_NUMBER_INT));

			$db->query("DELETE FROM reservation WHERE reservation.id = $groupId");
		}
		else
		{
			echo "Error: Reservation not found";
			
		}

		$allData = $db->query("SELECT * FROM reservation");
		//Display the reservations
		include("views/displayDates.php");
	}
	else if($action == "login")
	{
		
		$username = $password = "";
		$username_err = $password_err = "";

		include("views/formLogin.php");
	}
	else if($action == "checkLogin")
	{
		// Processing form data when form is submitted
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
		 
		    // Check if username is empty
		    if(empty(trim($_POST["username"]))){
		        $username_err = "Please enter username.";
		    } 
		    else
		    {
		        $username = trim($_POST["username"]);
		    }
		    
		    // Check if password is empty
		    if(empty(trim($_POST["password"]))){
		        $password_err = "Please enter your password.";
		    } 
		    else
		    {
		        $password = trim($_POST["password"]);
		    }
		    
		    // Validate credentials
		    if(empty($username_err) && empty($password_err))
		    {
		        // Prepare a select statement
		        $sql = "SELECT id, username, password FROM users WHERE username = :username";
		        if($stmt = $db->prepare($sql))
		        {
		            // Set parameters
		            $param_username = trim($_POST["username"]);
		            // Bind variables to the prepared statement as parameters
		            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
		            
		            // Attempt to execute the prepared statement
		            if($stmt->execute())
		            {
		                // Check if username exists, if yes then verify password
		                if($stmt->rowCount() == 1)
		                {
		                    if($row = $stmt->fetch())
		                    {
		                        $id = $row["id"];
		                        $username = $row["username"];
		                        $password = $row["password"];
		                        if($_POST["password"] == $row["password"])
		                        {
		                            // Password is correct, so start a new session
		                            
		                            // Store data in session variables
		                            $_SESSION["loggedin"] = true;
		                            $_SESSION["id"] = $id;
		                            $_SESSION["username"] = $username;                            
		                            
		                            // Redirect user to welcome page
		                            header("location: index.php");
		                        } else
		                        {
		                            // Display an error message if password is not valid
		                            $password_err = "The password you entered was not valid.";
		                        }
		                    }
		                } 
		                else
		                {
		                    // Display an error message if username doesn't exist
		                    $username_err = "No account found with that username.";
		                }
		            } 
		            else
		            {
		                echo "Oops! Something went wrong. Please try again later.";
		            }
		        }
		        
		        // Close statement
		        unset($stmt);
		    }
		}


		if($_SESSION["loggedin"] != true)
		{
			include("views/formLogin.php");
		}
		else
		{
			$allData = $db->query("SELECT * FROM reservation");
			//Display the reservations
			include("views/displayDates.php");
		}
	}



	include("views/footer.php");
?>





