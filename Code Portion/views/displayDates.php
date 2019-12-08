
<!-- had to add .php to action -->
<form action="index.php" method="post">
	<button class="btn waves-effect waves-light logsubmit blue" type="submit" name="action" value="createRequestForm">Create Reservation</button>

	<table>
	<?php foreach($allData as $arow): ?>
		<tr>
			<td><?php echo $arow["groupname"] ?></td>
			<td><?php echo $arow["starttime"] ?></td>
			<td><?php echo $arow["endtime"] ?></td>
			<td><?php echo $arow["reservedDate"] ?></td>
			<td><?php echo $arow["color"] ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
</form>