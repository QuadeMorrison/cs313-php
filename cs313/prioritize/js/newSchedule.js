$(document).ready(function () {
	$('select').material_select();

	$('#cancel-btn').click(closeCreationWizard);

	$('#add-btn').click(function () {
		var name = $('#schedule-name').val();
		var startTime = getTime($('#start-hour').val(), 
								$('#start-min').val(),
								$('#start-AM-PM').val());

		var endTime = getTime($('#end-hour').val(),
							  $('#end-min').val(),
							  $('#end-AM-PM').val());

		var schedule = { name: name, startTime: startTime, endTime: endTime };

		if (compareTime(startTime, endTime)) {
			$.ajax({url: "addScheduleToDatabase.php", 
					type: "POST",
					data: schedule,
					success: addScheduleToDatabase });
		}
	});
})

function closeCreationWizard() {
	$('#transparent-bg').fadeToggle("fast");
	$('#CreationWizard').fadeToggle("fast");
	$('#events').fadeToggle("fast");
	$('#newEvent').fadeToggle("fast");

	$('#creationWizard .row').html("");
}

function getTime(hour, min, am_pm) {
	if (am_pm == "PM") {
		hour = +hour + 12;
	}

	return hour + ":" + min + ":00";	
}

function compareTime(startTime, endTime) {
	startTime = startTime.split(':');
	endTime = endTime.split(':');

	return endTime[0] >= startTime[0] ||
	(endTime[0] >= startTime[0] && endTime[1] > startTime[1]);
}

function addScheduleToDatabase(data, status) {
	if (data !== "Invalid Time") {
		var name = $('#schedule-name').val();
		closeCreationWizard();
		$("#slide-out").html("");
		$.getJSON("getSchedules.php", scheduleToNav);
	}
}