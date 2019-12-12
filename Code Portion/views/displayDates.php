<h2 class="center">View All Reservations</h2>
<br />



<?php 
	include('models/Calendar.php');		 
	$Calendar = new Calendar();
	echo $Calendar->displayWeekCalendar($allData, isset($_SESSION['loggedin']));
?>