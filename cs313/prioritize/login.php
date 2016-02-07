<?php
session_start();
require_once "config.php"

try {
	$email = $_POST['email'];
	$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);
	$queryString = "SELECT password FROM user WHERE email='$email'";
	$query = $db->query($queryString);

	if ($query->fetchColumn() === $_POST['password']) {
		$_SESSION['user'] = $email;
		$content = file_get_contents('schedules.php');
		echo eval(' ?>'. $content);
	} else {
		echo "Failure";
	}

} catch (PDOException $ex) {
	echo $ex;
}


?>