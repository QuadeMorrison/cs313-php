<?php
session_start();
require_once "config.php";
try {
	$email = $_SESSION['user'];
	$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);
	$queryString = "SELECT name, schedule.id FROM schedule JOIN user ON user.id = schedule.userId" . 
	" WHERE user.email = '$email'";
	$schedules = $db->query($queryString);
	$json = json_encode($schedules->fetchAll(PDO::FETCH_ASSOC));
	echo $json;
} catch (PDOException $ex) {
	echo "Fail";
}
?>