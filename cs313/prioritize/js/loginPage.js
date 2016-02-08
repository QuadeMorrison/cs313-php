$(document).ready(function() {
	/** If user login information is valid the attempt to log user in **/
	$('#login-btn').click(function() {
		var valid = validateLogin(); // validate first

		if (valid) {
			var user = { email: $('#email').val(), password: $('#password').val() };
			$.ajax({ url: "login.php", type: "POST", data: user, success: logIn, async: true });
		}
	});
});

/** Helper function for login ajax request **/
function logIn(data, status) {
	if (data != "invalid") { // successfully found user in database
		loadPage(data); // from loadPage.js
	} else {
		invalidLogin(); // Warn user their credintials were invalid
	}
}

/** Change error message to indicate invalid credentials **/
function invalidLogin() {
	var e = $('#error');
	var eMessage = "Either your email or password didn't match up with an existing account";
	e.html(eMessage); 
}

/** Check if user input is valid on the clientside **/
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