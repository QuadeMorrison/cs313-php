$(document).ready(function() {
	$('#login-btn').click(function() {
		var valid = validateLogin();

		if (valid) {
			$('#error').html("");
			var user = { email: $('#email').val(), password: $('#password').val() };
			$.ajax({ url: "login.php", type: "POST", data: user, success: logIn, async: true });
		}
	});
});

function logIn(data, status) {
	if (data != "invalid") {
		loadPage(data);
	} else {
		invalidLogin();
	}
}

function loadPage(data) {
	var prevTitle = '.' + $('#title').attr('class').split()[0];
	$(prevTitle + "[src]").remove();
	$('#main').html(data);

	var currentTitle = $('#title').attr('class').split()[0];
	$(prevTitle + ":first").attr({"class": currentTitle, 
		"href": "css/" + currentTitle + ".css"});
}

function invalidLogin() {
	var e = $('#error');
	var eMessage = "Either your email or password didn't match up with an existing account";
	e.html(eMessage); 
}

function validateLogin() {
	var eMessage = "";
	var e = $('#error');
	var valid = true;

	if ($('#email').val().search('^[\\w@.]+') != 0) {
		var eMessage = "Your email is either empty or contains invalid characters (premitted characters are a-z, @ and .)";
		valid = false;
	} else if ($('#password').val().search('^[\\w\\W]+') != 0) {
		var eMessage = "You must enter a password";
		valid = false;
	}

	e.html(eMessage);

	return valid;
}