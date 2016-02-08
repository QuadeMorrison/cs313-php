<?php
session_start();

// check if user is already logged in
if (isset($_SESSION['user'])) { // take user to their schedules
	$content = file_get_contents('schedules.php');
	echo eval(' ?>'. $content);
} else { // take user to login page
	readfile('loginPage.php');
}
?>