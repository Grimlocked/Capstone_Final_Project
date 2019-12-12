
	var detailsShown = false;
	var deleteConfirmationShown = false;

	checkboxs = document.getElementsByName("chekbox");

	for(var h = 0; h < checkboxs.length; h++){
		updateCalendar(checkboxs[h]);
	}



	function ShowForm(){

		var theForm = document.getElementById("addForm");

		if(theForm.className == 'active'){
			theForm.className = 'inactive';
			button.innerHTML = "Add Event";
		}
		else if(theForm.className == 'inactive'){
			theForm.className = 'active';
			button.innerHTML = "Cancel";
		}
		
	}

	function ShowRoomForm(){
	
		var theForm = document.getElementById("addForm");
	
		if(theForm.className == 'active'){
			theForm.className = 'inactive';
		}
		else if(theForm.className == 'inactive'){
			theForm.className = 'active';
		}
		
	}


	function updateCalendar(checkbox){

		things = document.getElementsByClassName("room" + checkbox.id);
		
		if(checkbox.checked){

			for(var y = 0; y < things.length; y++){
				things[y].firstChild.className  = 'active';
			}

		}
		else{

			for(var y = 0; y < things.length; y++){
				things[y].firstChild.className  = 'inactive';
			}

		}
		
	}

	
	function revealDetails(id){

		if(!detailsShown){
			document.getElementById(id + "Details").className = "activeDetails";
			detailsShown = true;
		}
		else{
			
			var openCards = document.getElementsByClassName('activeCard');

			for(var i = 0; i < openCards.length; i++){
				changeDeleteConfirmation(id);
			}

			document.getElementsByClassName('activeDetails')[0].className = 'inactiveDetails';
			document.getElementById(id + "Details").className = "activeDetails";
			detailsShown = true;
		}

		if(deleteConfirmationShown){
			changeDeleteConfirmation(id);
		}

	}

	function hideDetails(id){
		
		document.getElementById(id + "Details").className = "inactiveDetails";
		detailsShown = false;
	}


	function changeDeleteConfirmation(id){

		var deleteButton = document.getElementById('event' + id + 'Button');

		if(!deleteConfirmationShown){

			deleteButton.parentNode.parentNode.parentNode.nextSibling.className = 'activeCard';
			deleteButton.parentNode.parentNode.parentNode.className = "inactiveCard";
			deleteConfirmationShown = true;

		}
		else{

			deleteButton.parentNode.parentNode.parentNode.nextSibling.className = 'inactiveCard';
			deleteButton.parentNode.parentNode.parentNode.className = "activeCard";
			deleteConfirmationShown = false;
		}

	}

	

	

	