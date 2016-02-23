<?php
function getUserId($db, $scheduleName, $email) {
	$query = "SELECT id FROM user WHERE email=?";
	$query = $db->prepare($query);
	$query->execute(array($email));

	return $query->fetchColumn();
}

function getScheduleId($db, $scheduleName, $userId) {
	$query = "SELECT id FROM schedule WHERE userId=:userId AND name=:name";
	$query = $db->prepare($query);
	$query->execute(array(':userId' => $userId, ':name' => $scheduleName));

	return $query->fetchColumn();
}

function getStartTime($db, $scheduleName, $scheduleId) {
	$query = "SELECT dayBeginning FROM schedule WHERE id=:id AND name=:name";
	$query = $db->prepare($query);
	$query->execute(array(':id' => $scheduleId, ':name' => $scheduleName));

	return $query->fetchColumn();
}

function getEndTime($db, $scheduleName, $scheduleId) {
	$query = "SELECT dayEnd FROM schedule WHERE id=:id AND name=:name";
	$query = $db->prepare($query);
	$query->execute(array(':id' => $scheduleId, ':name' => $scheduleName));

	return $query->fetchColumn();
}
?>