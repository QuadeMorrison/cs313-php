// no way to declare constant, but this is a const
var COLORS = [ 'red-border',
			   'blue-border',
			   'yellow-border',
			   'purple-border',
			   'green-border',
			   'organ-border' ];

$(document).ready(function () {
	$.getJSON("getSchedules.php", scheduleToNav);

	$("#slide-out").on("click", "li>a", function() {
		changeActive(this);
		createSchedule($(this).text());
	});

	$('.button-collapse').sideNav({ edge: 'left', closeOnClick: false });

	$('.side-nav').on('click', function(e) {
		w = $(window).width();
		if (w < 992) {
			$('.button-collapse').sideNav('hide');;
		}
	});

	$('.dropdown-button').dropdown({
    	inDuration: 300,
    	outDuration: 225,
     	constrain_width: false, // Does not change width of dropdown to that of the activator
     	hover: true, // Activate on hover
     	belowOrigin: true, // Displays dropdown below the button
     	alignment: 'left' // Displays dropdown with edge aligned to the left of button
  	});

	$('#log-out').click(function() {
		$.ajax({ url: "logOut.php", success: logIn, async: true });
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
		$("#slide-out").append('<li class=' + liClass + '><a class="nav_button waves-effect waves-teal"' + 
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

function logIn(data, status) {
	var prevTitle = '.' + $('#title').attr('class').split()[0];
	$(prevTitle + "[src]").remove();
	$('#main').html(data);

	var currentTitle = $('#title').attr('class').split()[0];
	$(prevTitle + ":first").attr({"class": currentTitle, 
								  "href": "css/" + currentTitle + ".css"});
}