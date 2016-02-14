<?php
session_start();
require_once "config.php";

try {
$email = $_POST['email'];
	$db = loadDatabase();

	$queryString = "SELECT password FROM user WHERE email=?";
	$query = $db->prepare($queryString);
	$query->execute(array($email));
	$result = $query->fetchColumn();

	if ($result === $_POST['password']) {
		$_SESSION['user'] = $email;
		$content = file_get_contents('schedules.php');
		echo eval(' ?>'. $content);
	} else {
		echo "invalid";
	}

} catch (PDOException $ex) {
	echo $ex;
}


?>