<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>My First 3 Tier Application</title>
		<meta name="description" content="Test page to learn big picture of  AMP architecture" />
		<meta name="author" content="akhilesh-bajaj" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<link rel="shortcut icon" href="/3TierLabRefactored/images/ING.ico" />
		<link rel="stylesheet" href="/3TierLabRefactored/styles/register.css">
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<?php 	include_once('./scripts/ViewFiles/print_menu.php') ?>
	</head>
	<body>
		<header>
			<h1>Welcome to My First 3 tier application! </h1>
			<?php printMenu('Home'); ?>
		</header>
		<section >
			<img src="images/ThreeTierOverview.png" alt="Overview of 3 tier architecture" height="500" width="500">
		</section>
		<footer>
			<p>
				&copy; Copyright  by akhilesh-bajaj
			</p>
		</footer>
	</body>
</html>