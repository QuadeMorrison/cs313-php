<?php
session_start();

require_once "config.php";
$db = loadDatabase();

$email = $_SESSION['user'];
$eventName = $_POST['eventName'];
$description = $_POST['description'];
$scheduleName = $_POST['scheduleName'];
$timeToSchedule = $_POST['time'];
$userId = getUserId($db, $scheduleName, $email);
$scheduleId = getScheduleId($db, $scheduleName, $userId);
$startTime = getStartTime($db, $scheduleName, $scheduleId);
$endTime = getEndTime($db, $scheduleName, $scheduleId);
$whenToPlaceEvent = schedule($db, $scheduleId, $timeToSchedule, $startTime, $endTime);
addToDatabase($db, $eventName, $description, $whenToPlaceEvent, $scheduleId);


function schedule($db, $scheduleId, $timeToSchedule, $startTime, $endTime) {
	$query = "SELECT startTime, endTime FROM scheduleEvent se JOIN event e WHERE scheduleId=:id AND eventId = e.id";
	$query = $db->prepare($query);
	$query->execute(array(':id' => $scheduleId));
	$eventEndTime = addTime($startTime, $timeToSchedule);
	$eventStartTime = $startTime;

	foreach ($query->fetchAll() as $event) {
		if (greaterThanOrEqualToTime($event['startTime'], $eventEndTime)) {
			break;
		} else {
			$eventStartTime = $event['endTime'];
			$eventEndTime = addTime($event['endTime'], $timeToSchedule);
		}
	}

	return array('startTime' => $eventStartTime, 'endTime' => $eventEndTime);
}

function addToDatabase($db, $name, $description, $times, $scheduleId) {
	$query = "INSERT INTO event(name, description, startTime, endTime) " .
			 "VALUES(:name, :description, :startTime, :endTime)";
	$query = $db->prepare($query);
	$query->execute(array(':name' => $name,
						   ':description' => $description,
						   ':startTime' => $times['startTime'],
						   ':endTime' => $times['endTime']));

	$eventId = $db->lastInsertId();
	$query = "INSERT INTO scheduleEvent(scheduleId, eventId) VALUES(:sId, :eId)";
	$query = $db->prepare($query);
	$query->execute(array(':sId' => $scheduleId, ':eId' => $eventId));
}

function greaterThanOrEqualToTime($time1, $time2) {
	$time1 = explode(':', $time1);
	$time2 = explode(':', $time2);

	return $time1[0] > $time2[0] || ($time1[0] == $time2[0] && $time1[1] >= $time2[1]);
}

function addTime($time1, $time2) {
	$time1 = explode(':', $time1);
	$time2 = explode(':', $time2);

	$hour = $time1[0] + $time2[0];
	$min = $time1[1] + $time2[1];

	if ($min >= 60) {
		$hour += 1;
		$min -= 60;
	}

	return $hour . ':' . $min . ':00';
}

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