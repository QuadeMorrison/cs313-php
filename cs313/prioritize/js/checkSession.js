$(document).ready(function() {
	$.ajax({ url: "isLoggedIn.php", success: logIn, async: true });
});

function logIn(data, status) {
	var prevTitle = '.' + $('#title').attr('class').split()[0];
	$(prevTitle + "[src]").remove();
	$('#main').html(data);

	var currentTitle = $('#title').attr('class').split()[0];
	$(prevTitle + ":first").attr({"class": currentTitle, 
								  "href": "css/" + currentTitle + ".css"});
}