<?php
session_start();
require_once "config.php"; // load database credentials
try {
	$email = $_SESSION['user']; // check which user is logged in
	$db = loadDatabase();
	$queryString = "SELECT name, schedule.id FROM schedule JOIN user ON user.id = schedule.userId" . 
	" WHERE user.email = '$email'";
	$schedules = $db->query($queryString); // query database for users schedules
	$json = json_encode($schedules->fetchAll(PDO::FETCH_ASSOC));
	echo $json; // return all found schedules to client
} catch (PDOException $ex) {
	echo $ex;
}
?>