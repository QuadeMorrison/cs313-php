<?php
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
?>