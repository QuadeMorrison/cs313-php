<?php
session_start();
if (!isset($_SESSION['results'])) {
	$_SESSION['results'] = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Survey</title>
	<link rel="stylesheet" type="text/css" href="../../css/survey.css"
</head>
<body>
	<div id="survey">
		<p id="instructions">
			Make your choice using the WASD keys on your keyboard
		</p>
		<h1 id="question"></h1>
		<div id="checkBoxes">
			<div id="w" class="checkbox">W</div> <br />
			<div id="a" class="checkbox">A</div> <br />
			<div id="s" class="checkbox">S</div> <br />
			<div id="d" class="checkbox">D</div> <br />
		</div>
		<div id="answers">
			<h2 id="wAnswer" class="answer"></h2><br />
			<h2 id="aAnswer" class="answer"></h2><br />
			<h2 id="sAnswer" class="answer"></h2><br />
			<h2 id="dAnswer" class="answer"></h2><br />
		</div>
	</div>

	<script src="../../js/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="../../js/survey.js"></script>
</body>
</html>