<h3>Update Time Block</h3>
<form action="index.php" method="post">
	<div class="input-field col s12">
    	<input name="groupName" id="groupName" type="text" value="<?php echo $allData[0]['groupname'] ?>" required>
        <label for="groupName">Group Name</label>
    </div>
    <div class="input-field col s12">
    	<input name="reservedDate" id="reservedDate" type="text" class="datepicker" value="<?php echo $allData[0]['reservedDate'] ?>" required>
        <label for="reservedDate">Date</label>
    </div>
    <div class="input-field col s12">
    	<input name="startTime" id="startTime" type="text" class="timepicker" value="<?php echo $allData[0]['starttime'] ?>" required>
        <label for="startTime">Start Time</label>
    </div>
    <div class="input-field col s12">
    	<input name="endTime" id="endTime" type="text" class="timepicker" value="<?php echo $allData[0]['endtime'] ?>" required>
        <label for="endTime">End Time</label>
    </div>
    <div class="input-field col s12">
        <select name="color" id="color">
            <option value="red" <?php if($allData[0]['color'] == "red") {echo "selected";}?>>Red</option>
            <option value="blue" <?php if($allData[0]['color'] == "blue") {echo "selected";}?>>Blue</option>
            <option value="green" <?php if($allData[0]['color'] == "green") {echo "selected";}?>>Green</option>
            <option value="purple" <?php if($allData[0]['color'] == "purple") {echo "selected";}?>>Purple</option>
            <option value="light-blue" <?php if($allData[0]['color'] == "light-blue") {echo "selected";}?>>Light Blue</option>
            <option value="yellow" <?php if($allData[0]['color'] == "yellow") {echo "selected";}?>>yellow</option>
            <option value="orange" <?php if($allData[0]['color'] == "orange") {echo "selected";}?>>Orange</option>
        </select>
        <label>Color</label>
    </div>
    <input type="hidden" name="groupId" value="<?php echo $allData[0]['id'] ?>">
    <div class="center-align col s12">
		<button class="btn waves-effect waves-light logsubmit blue" type="submit" name="action" value="editRequest">Submit</button>
	</div>
</form>
<<<<<<< Updated upstream:Code Portion/views/updateTime.php
=======

>>>>>>> Stashed changes:Game_App/views/updateTime.php
