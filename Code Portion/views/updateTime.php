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
    <div class="input-field col s12">
        <select name="color" id="color">
            <option value="red" selected>Red</option>
            <option value="blue">Blue</option>
            <option value="green">Green</option>
            <option value="purple">Purple</option>
            <option value="lightblue">Light Blue</option>
            <option value="yellow">yellow</option>
            <option value="orange">Orange</option>
        </select>
        <label>Color</label>
    </div>
    <div class="center-align col s12">
		<button class="btn waves-effect waves-light logsubmit blue" type="submit" name="action" value="createRequest">Submit</button>
	</div>
</form>

