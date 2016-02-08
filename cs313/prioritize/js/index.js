// no way to declare constant, but this is a const
var COLORS = [ 'red-border',
			   'blue-border',
			   'yellow-border',
			   'purple-border',
			   'green-border',
			   'organ-border' ];

$(document).ready(function () {
	/** Fill sidenav with user's schedules from database **/
	$.getJSON("getSchedules.php", scheduleToNav);

	/** Change which schedule is displayed **/
	$("#slide-out").on("click", ".nav_button", function() {
		changeActive(this); // switch which schedule is selected on the side-nav
		createSchedule($(this).text()); // replace current schedule with new schedule
	});

	/** display side-nav on mobile when collapsable button is clicked prevent side-nav from
	 	collapsing on large screens **/
	$('.button-collapse').sideNav({ edge: 'left', closeOnClick: false });

	/** collapse side-nav on mobile devices when clicked **/ 
	$('.side-nav').on('click', function(e) {
		w = $(window).width();
		if (w < 992) { // Anything smaller is a small mobile screen
			$('.button-collapse').sideNav('hide');;
		}
	});

	/** Configuration for dropdown menus **/
	$('.dropdown-button').dropdown({
    	inDuration: 300,
    	outDuration: 225,
     	constrain_width: false, // Does not change width of dropdown to that of the activator
     	hover: true, // Activate on hover
     	belowOrigin: true, // Displays dropdown below the button
     	alignment: 'right' // Displays dropdown with edge aligned to the right of button
  	});

	/** Calls request to end session and log user out **/
	$('#log-out').click(function() {
		// loadPage function from loadPage.js
		$.ajax({ url: "logOut.php", success: loadPage, async: true });
	});
});

/** Switches css to indicate which schedule is active in the side-nav **/
function changeActive(button) {
	$(".active").removeClass("active");
	$(button).parent().addClass("active");
}

/** Dynamically creates the side-nav with all the users pre-existing schedules **/
function scheduleToNav(schedules) {
	var first = true; // logic to only create first schedule
	var liClass = "active"; // implement css to indicate first schedule is active
	var so = $('#slide-out');

	schedules.forEach(function(schedule) {
		var name = schedule['name'];
		so.append(createScheduleButton(name, liClass));

		if (first) {
			liClass = ""; // no other schedule should indicate it's active
			first = false;
			createSchedule(name); // display first schedule on screen
		}
	});

	so.append(createNewButton());
}

/** Provides html for a schedule button for the side-nav **/
function createScheduleButton(scheduleName, liClass) {
	var button = '<li class=' + liClass + '><a class="nav_button waves-effect waves-teal"' + 
			                  ' href="#!" value="0">' + scheduleName + '</a></li>';

	return button;
}

/** Provides html for newScheduleButton **/
function createNewButton() {
	var button = '<li class="teal lighten-2">' +
		'<a class="waves-effect waves-red waves-lighten">' + 
		'<i id="plus" class="material-icons" style="display:inline-block">add</i>' + 
		'<span id="new-schedule">NEW SCHEDULE</span></a></li>';

	return button;
}

/** Generates a schedule and replaces onscreen schedule **/
function createSchedule(scheduleName) {
	$.ajax({ url: "getEvents.php", 
			 type: "POST",
			 data: { scheduleName: scheduleName },
			 success: createEvents });
}

/** Helper function for createSchedule, generates schedule events **/
function createEvents(data, status) {
	var events = $.parseJSON(data); // request database for events
	var colorNum = 0; // indicates what color top-border each event card gets
	var e = $('#events');
	e.html("");

	events.forEach(function(event) {
		e.append(createEventCard(event, colorNum++));
	});
}

/** Creates a properly formatted event card **/
function createEventCard(event, colorNum) {
	var event = '<div class="card col lg3 md4 sm12 ' + COLORS[colorNum++] + '">' + 
		'<span class="card-title">' + event['name'] + '</span>' +
		'<div class="card-content">' + event['description'] + '</div>' +
		'<div class="card-content">' + event['startTime'] + '-' + event['endTime'] + "</div>" +
		'</div>';

	return event;
}