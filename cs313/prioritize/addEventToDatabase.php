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
$timeToSchedule = $_POST['time'];
$userId = getUserId($db, $scheduleName, $email);
$scheduleId = getScheduleId($db, $scheduleName, $userId);
$startTime = getStartTime($db, $scheduleName, $scheduleId);
$endTime = getEndTime($db, $scheduleName, $scheduleId);
$whenToPlaceEvent = schedule($db, $scheduleId, $timeToSchedule, $startTime, $endTime);
addToDatabase($db, $eventName, $description, $whenToPlaceEvent, $scheduleId);


function schedule($db, $scheduleId, $timeToSchedule, $startTime, $endTime) {
	$query = "SELECT startTime, endTime FROM scheduleEvent se JOIN event e WHERE scheduleId=:id AND eventId = e.id" .
			 " ORDER BY startTime";
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
?>