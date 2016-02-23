$(document).ready(function() {
  $("#signup-btn").click(function() {
    $('#error').html("");
    var valid = validateRegistration();

    if (valid) {
      var email = $('#email').val();
      var password = $('#password').val();
      var password_conf = $('#password-conf').val();
      var user = { email: email, password: password, password_conf: password_conf };

      $.ajax({ url: "signup.php", type: "POST", data: user, success: signup, async: true });
    }
  });

  $("#login-link").click(function() {
    $.ajax({ url: "loginPage.php", success: loadPage, async: true });
  });

	/** Make the enter key work as expected **/
	$(document).keydown(function(e) {
		if (e.keyCode == 13) {
			$('#signup-btn').trigger('click');
		}
	});
});

function signup(data, status) {
  var e = $("#error");

  if (data === "Success") {
    var email = $('#email').val();
    var password = $('#password').val();
    var user = { email: email, password: password };
    $.ajax({ url: "login.php", type: "POST", data: user, success: loadPage, async: true });
  } else {
    e.html(data);
  }
}

function getEmailError() {
  return "Your email isn't valid (accepted format example@example.com)";
}

function getPasswordError() {
  return "Either your passwords don't match, a field is blank, or your password isn't long" +
         "enough. (Must be atleast 6 characters)";
}

/** Check if user input is valid on the clientside **/
function validateRegistration() {
	var e = $('#error');
	var valid = true;

	if ($('#email').val().search('^[\\w-]+@[\\w]+.(com|edu|gov|net|org|io|me|ca|co)$') !== 0) {
    e.html(getEmailError());
		valid = false;
	} else if ($('#password').val().search('^[\\w\\W]{6,}$') !== 0 ||
             $('#password').val() !== $('#password-conf').val()) {
    e.html(getPasswordError());
		valid = false;
	}

	return valid;
}
