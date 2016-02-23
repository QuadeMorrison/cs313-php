<?php
session_start();

require_once "config.php";
require_once "time.php";
require_once "getters.php";
$db = loadDatabase();

$email = $_SESSION['user'];
$eventName = $_POST['eventName'];
$description = $_POST['description'];
$scheduleName = $_POST['scheduleName'];
$eventStartTime = $_POST['eventStartTime'];
$eventEndTime = $_POST['eventEndTime'];
$userId = getUserId($db, $scheduleName, $email);
$scheduleId = getScheduleId($db, $scheduleName, $userId);
$startTime = getStartTime($db, $scheduleName, $scheduleId);
$endTime = getEndTime($db, $scheduleName, $scheduleId);
$placeEvent = schedule($db, $scheduleId, $eventStartTime, $eventStartTime, $startTime, $endTime);

if ($placeEvent) {
	addToDatabase($db, $eventName, $description, $eventStartTime, $eventEndTime, $scheduleId);
}

function schedule($db, $scheduleId, $eventStartTime, $eventEndTime, $startTime, $endTime) {
	$query = "SELECT startTime, endTime FROM scheduleEvent se JOIN event e WHERE scheduleId=:id AND eventId = e.id";
	$query = $db->prepare($query);
	$query->execute(array(':id' => $scheduleId));
	$prevScheduledEnd;
	$isFull = false;

	foreach ($query->fetchAll() as $event) {
		if (isset($prevScheduledEnd) &&
			greaterThanOrEqualToTime($eventStartTime, $prevScheduledEnd) &&
			greaterThanOrEqualToTime($event['startTime'], $eventEndTime))
			return true;

		$prevScheduledEnd = $event['endTime'];
		$isFull = true;
	}

	if (greaterThanOrEqualToTime($eventStartTime, $prevScheduledEnd)) {
		return true;
	}

	return !$isFull;
}

function addToDatabase($db, $name, $description, $eventStartTime, $eventEndTime, $scheduleId) {
	$query = "INSERT INTO event(name, description, startTime, endTime) " .
			 "VALUES(:name, :description, :startTime, :endTime)";
	$query = $db->prepare($query);
	$query->execute(array(':name' => $name,
						   ':description' => $description,
						   ':startTime' => $eventStartTime,
						   ':endTime' => $eventEndTime));

	$eventId = $db->lastInsertId();
	$query = "INSERT INTO scheduleEvent(scheduleId, eventId) VALUES(:sId, :eId)";
	$query = $db->prepare($query);
	$query->execute(array(':sId' => $scheduleId, ':eId' => $eventId));
}
?>