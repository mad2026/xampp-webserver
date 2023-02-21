<?php
// get the data from the form
$first_name = $_POST['first_name'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$phone = $_POST['phone'];
$email = $_POST['email'];

// error check here
if (empty($email) || empty($zip) || empty($first_name) || empty($state)) {
	$error = "Invalid data. Check all fields and try again.";
	include ('error.php');
	exit();
}

// If valid, add the product to the database
require_once ('database.php');
try {$query = "UPDATE my_customers 
               SET first_name ='$first_name',state ='$state' ,zip = '$zip' ,phone = '$phone'
               WHERE email = '$email'";
	$db ->exec($query);
	$db->exec('commit;');
} catch (Exception $e) {
    $error_message = $e->getMessage();
    echo "<p>Error message: $error_message </p>";
}//catch

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Thank you for updating your information! </title>
		<meta name="description" content="Test page to learn big picture of  AMP architecture" />
		<meta name="author" content="akhilesh-bajaj" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<link rel="shortcut icon" href="../images/ING.ico" />
		<link rel="stylesheet" href="../styles/register.css">
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	</head>
	<body>
		<header>
			<h1>Your information was successfully updated!!</h1>
			<nav>
				<ul>
					<li>
						<a href="../index.html">Home</a>
					</li>
					<li>
						<a class="current" href="../html_pages/register.html">Register</a>
					</li>
					<li>
						<a  href="mailto:akhilesh-bajaj@utulsa.edu">Email Us</a>
					</li>
				</ul>
			</nav>
		</header>
				<footer>
			<p>
				&copy; Copyright  by akhilesh-bajaj
			</p>
		</footer>
	</body>
</html>
