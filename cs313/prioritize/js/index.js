// no way to declare constant, but this is a const
var COLORS = [ 'red-border',
			   'blue-border',
			   'yellow-border',
			   'purple-border',
			   'green-border',
			   'organ-border' ];

$(document).ready(function () {
	$.getJSON("getSchedules.php", scheduleToNav);

	$("#side_nav").on("click", "li>a", function() {
		changeActive(this);
		createSchedule($(this).text());
	});
});

function changeActive(button) {
	$(".active").removeClass("active");
	$(button).parent().addClass("active");
}

function scheduleToNav(schedules) {
	var first = true;
	var liClass = "active";

	schedules.forEach(function(schedule) {
		$("#side_nav").append('<li class=' + liClass + '><a class="nav_button waves-effect waves-teal"' + 
			                  ' href="#!" value="0">' + schedule['name'] + '</a></li>');

		if (first) {
			liClass = "";
			first = false;

			createSchedule(schedule['name']);
		}
	});
}

function createSchedule(scheduleName) {
	$.ajax({ url: "getEvents.php", 
			 type: "POST",
			 data: { scheduleName: scheduleName },
			 success: createEvents });
}

function createEvents(data, status) {
	var events = $.parseJSON(data);
	var colorNum = 0;
	$('#events').html("");

	events.forEach(function(event) {
		$('#events').append('<div class="card col lg3 md4 sm12 ' + COLORS[colorNum++] + '">' + 
								'<span class="card-title">' + event['name'] + '</span>' +
								'<div class="card-content">' + event['description'] + '</div>' +
								'<div class="card-content">' + event['startTime'] + '-' + event['endTime'] + "</div>" +
							'</div>');
	});
}