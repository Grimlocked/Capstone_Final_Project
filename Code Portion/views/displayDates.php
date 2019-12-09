<form action="index" method="post">
	<button class="btn waves-effect waves-light logsubmit blue" type="submit" name="action" value="createRequestForm">Create Reservation</button>
	
</form>
<table>
	<?php foreach($allData as $arow): ?>
	<tr>
		<td><?php echo $arow["groupname"] ?></td>
		<td><?php echo $arow["starttime"] ?></td>
		<td><?php echo $arow["endtime"] ?></td>
		<td><?php echo $arow["reservedDate"] ?></td>
		<td><?php echo $arow["color"] ?></td>
		<td>
			<form action="index" method="post">
				<input type="hidden" name="groupId" value="<?php echo $arow["id"] ?>">
				<button class="btn waves-effect waves-light logsubmit blue" type="submit" name="action" value="editRequestForm">Edit Reservation</button>
				<button class="btn waves-effect waves-light logsubmit blue" type="submit" name="action" value="deleteRequest">Delete Reservation</button>
			</form>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

