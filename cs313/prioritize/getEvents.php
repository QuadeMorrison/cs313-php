<?php
session_start();
require_once "config.php";
try {
	$email = $_SESSION['user'];
	$name = $_POST['scheduleName'];
	$db = loadDatabase();
	$queryString = "SELECT event.name, description, startTime, endTime FROM scheduleEvent JOIN schedule" .
	" ON scheduleId = schedule.id JOIN event ON eventId = event.id WHERE scheduleId = (SELECT schedule.id" .
	" FROM schedule JOIN user ON userId = user.id WHERE user.email = '$email' AND schedule.name = '$name')"; 
	$events = $db->query($queryString);
	$json = json_encode($events->fetchAll(PDO::FETCH_ASSOC));
	echo $json;
} catch (PDOException $ex) {
	echo "Fail";
}
?>