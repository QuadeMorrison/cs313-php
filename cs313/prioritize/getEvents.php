<?php
session_start();
require_once "config.php"; // for database credentials
try {
	$email = $_SESSION['user']; // check which user is logged in
	$name = $_POST['scheduleName'];
	$db = loadDatabase(); 
	$queryString = "SELECT event.name, description, startTime, endTime FROM scheduleEvent JOIN schedule" .
	" ON scheduleId = schedule.id JOIN event ON eventId = event.id WHERE scheduleId = (SELECT schedule.id" .
	" FROM schedule JOIN user ON userId = user.id WHERE user.email = '$email' AND schedule.name = '$name')"; 
	$events = $db->query($queryString); // query database of events
	$json = json_encode($events->fetchAll(PDO::FETCH_ASSOC));
	echo $json; // send back event information to client
} catch (PDOException $ex) {
	echo $ex;
}
?>