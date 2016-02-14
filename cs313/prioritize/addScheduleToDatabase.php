<?php
	session_start();

	$email = $_SESSION['user'];
	$scheduleName = $_POST['name'];
	$startTime = $_POST['startTime'];
	$endTime = $_POST['endTime'];

	if (compareTime($startTime, $endTime) !== "Invalid Time") {
		require_once "config.php";
		$db = loadDatabase();
		$userId = getUserId($db, $email);
		insertIntoSchedule($db, $userId, $scheduleName, $startTime, $endTime);
	} else {
		echo "Invalid Time";
	}

	function compareTime($startTime, $endTime) {
		$startTime = explode(':', $startTime);
		$endTime = explode(':', $endTime);

		if ($endTime[0] >= $startTime[0] || 
			($endTime[0] >= $startTime[0] && $endTime[1] > $startTime[1])) {
			return true;
		} else {
			return "Invalid Time";
		}
	}

	function getUserId($db, $email) {
		$userIdQuery = "SELECT id FROM user WHERE email=?";
		$userIdQuery = $db->prepare($userIdQuery);
		$userIdQuery->execute(array($email));

		return $userIdQuery->fetchColumn();
	}

	function insertIntoSchedule($db, $userId, $scheduleName, $startTime, $endTime) {
		$query = "INSERT INTO schedule(userId, name, dayBeginning, dayEnd) VALUES(:userId, " . 
		   		 ":name, :startTime, :endTime)";
		$query = $db->prepare($query);
		$query->execute(array(':userId' => $userId,
							  ':name' => $scheduleName,
							  ':startTime' => $startTime,
							  ':endTime' => $endTime));
	}
?>