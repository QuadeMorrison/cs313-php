$(document).ready(function() {
	// loadPage function from loadPage.js
	$.ajax({ url: "isLoggedIn.php", success: loadPage, async: true });
});