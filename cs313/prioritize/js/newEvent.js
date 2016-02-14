$(document).ready(function () {
	$('select').material_select();

	$('#cancel-btn').click(closeCreationWizard);

	$('#add-btn').click(function() {
		var scheduleName = $('.active .nav_button').text();
		var eventName = $('#event-name').val();
		var description = $('#description').val();
		var time = $('#hour').val() + ":" + $('#min').val();
		var event = { scheduleName: scheduleName,
					  eventName: eventName,
					  description: description,
					  time: time };


		console.log(scheduleName);
		$.ajax({ url: "addEventToDatabase.php",
				 type: "POST",
				 data: event,
				 success: addEventToDatabase,
				 async: true });
	})
})

function closeCreationWizard() {
	$('#transparent-bg').fadeOut("fast");
	$('#CreationWizard').fadeOut("fast");
	$('#events').fadeIn("fast");
	$('#newEvent').fadeIn("fast");

	$('#row-wrapper').html("");
}

function addEventToDatabase(data, status) {
	var scheduleName = $('.active .nav_button').text();
	createSchedule(scheduleName);	
	closeCreationWizard();
}