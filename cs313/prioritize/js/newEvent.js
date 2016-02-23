$(document).ready(function () {
	$('select').material_select();

	$('#cancel-btn').click(closeCreationWizard);

	$('#add-btn').click(function() {
		var event;
		var url;

		if ($('#schedule-for-me').is(':checked')) {
			event = scheduleForMe();
			url = "addEventToDatabase.php";
		}
		else {
			event = scheduleMyself();
			url = "addEventToDatabaseMyself.php";
		}

		$.ajax({ url: url,
			 	 type: "POST",
			 	 data: event,
			 	 success: addEventToDatabase,
			 	 async: true });
	})

	$('#schedule-for-me').click(function() {
		var checkBox = $("#schedule-for-me");

		if (!checkBox.is(":checked"))
			getPHP("scheduleMyselfMenu.php", "#when-to-schedule");
		else
			getPHP("scheduleForMeMenu.php", "#when-to-schedule");
	});
})

function getPHP(url, where_to_put_data) {
	$.ajax({ url: url,
			 success: function(data, status) { 
			 	$(where_to_put_data).html(data)
			 	$('select').material_select(); 
			 } 
			});
}

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

function scheduleForMe() {
	var scheduleName = $('.active .nav_button').text();
	var eventName = $('#event-name').val();
	var description = $('#description').val();
	var time = $('#hour').val() + ":" + $('#min').val();
	var event = { scheduleName: scheduleName,
		eventName: eventName,
		description: description,
		time: time };

	return event;
}

function scheduleMyself() {
	var scheduleName = $('.active .nav_button').text();
	var eventName = $('#event-name').val();
	var description = $('#description').val();
	var eventStartTime = getTime($('#event-start-hour').val(), $('#event-start-min').val(), $('#start-AM-PM').val());
	var eventEndTime = getTime($('#event-end-hour').val(), $('#event-end-min').val(), $('#end-AM-PM').val());
	console.log(eventStartTime);
	console.log(eventEndTime);

	var event = { scheduleName: scheduleName,
		eventName: eventName,
		description: description,
		eventStartTime: eventStartTime,
		eventEndTime: eventEndTime };

	return event;
}

function getTime(hour, min, am_pm) {
	console.log(am_pm);
	if (am_pm == "PM" && hour != 12) {
		hour = +hour + 12;
	} else if (am_pm == "AM" && hour == 12) {
		hour = +hour - 12;
	}

	return hour + ":" + min + ":00";	
}

function compareTime(startTime, endTime) {
	startTime = startTime.split(':');
	endTime = endTime.split(':');

	return endTime[0] >= startTime[0] ||
	(endTime[0] >= startTime[0] && endTime[1] > startTime[1]);
}