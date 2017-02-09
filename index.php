<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale = 1">
	<title>Quade Morrison</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<div class="container-fluid">
		<nav class="navbar navbar-default center
					col-xs-12 col-sm-11 col-md-10 col-lg-9">

			<div class="container-fluid">
				<div class="navbar-header">
					<span class="navbar-brand">
						<span id="brandFirst">Q</span>
						<span id="brandSecond">M</span>
					</span>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="https://github.com/QuadeMorrison/">
						<img id="github" class="img-responsive" src="img/github.png">
					</a></li>
				</ul>
				</div>

				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="resume.pdf">Resume</a></li>
					<li><a href="projects.php">Projects</a></li>
				</ul>
			</div>
		</nav>

		<div id="myCarousel" class="carousel slide center col-lg-11 hidden-xs" data-ride="carousel">
			<div class="carousel-inner" role="listbox">

				<div class="item active">
					<img class="img-responsive center-block" src="img/spaceneedle.jpg">
					<div class="carousel-caption">
						<h1>Get Con<br />nected.</h1> <br /><br /><br />
						<a id="linkedin-btn" class="btn">linkedin</a>
					</div>
				</div>
				<div class="item">
					<img id="group" class="img-responsive center-block" src="img/group.jpg">
				</div>

				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>

			</div>
		</div>
		<div class="hidden-lg hidden-md hidden-sm col-xs-12">
			<img class="img-responsive center-block" src="img/spaceneedle.jpg">
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/index.js"></script>
</body>
</html>
