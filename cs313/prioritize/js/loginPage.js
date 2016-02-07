$(document).ready(function() {
	$('#login_button').click(function() {
		console.log("test");
		var user = { email: $('#email').val(), password: $('#password').val() };
		$.ajax({ url: "login.php", type: "POST", data: user, success: logIn, async: true });
	});
});

function logIn(data, status) {
	var prevTitle = '.' + $('#title').attr('class').split()[0];
	$(prevTitle + "[src]").remove();
	$('#main').html(data);

	var currentTitle = $('#title').attr('class').split()[0];
	$(prevTitle + ":first").attr("href", "css/" + currentTitle + ".css");
}