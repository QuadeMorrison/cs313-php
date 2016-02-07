<?php
session_start();

if (isset($_SESSION['user'])) {
	$content = file_get_contents('schedules.php');
	echo eval(' ?>'. $content);
} else {
	readfile('loginPage.php');
}
?>