<?php
session_start();
if(isset($_POST['letter']) && 
   isset($_POST['questionNumber']) &&
   !$_SESSION['results']) {

	 $file = "../../json/results.json";
	 $letter = $_POST['letter'];
	 $questionNumber = $_POST['questionNumber'];

	 $json = json_decode(file_get_contents($file), true);
	 $json['results'][$questionNumber][$letter]++;
	 file_put_contents($file, json_encode($json, true));

	 if ($questionNumber == 3)
	 	$_SESSION['results'] = true;
    }
?>