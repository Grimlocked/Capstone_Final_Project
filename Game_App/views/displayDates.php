<form action="index.php" method="post">
	<?php if(isset($_SESSION['loggedin'])): ?>
		<button class="btn waves-effect waves-light logsubmit blue" type="submit" name="action" value="createRequestForm">Create Reservation</button>
		<button class="btn waves-effect waves-light logsubmit blue" type="submit" name="action" value="logout">Logout</button>
	<?php else: ?>
		<button class="btn waves-effect waves-light logsubmit blue" type="submit" name="action" value="login">LogIn</button>
	<?php endif; ?>
	
</form>

<?php 
	include('models/Calendar.php');		 
	$Calendar = new Calendar();
	echo $Calendar->displayWeekCalendar($allData, isset($_SESSION['loggedin']));
?>