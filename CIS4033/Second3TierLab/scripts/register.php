<?php
// get the data from the form
$email = $_POST['email'];
$password = $_POST['password'];
$verify = $_POST['verify'];
$first_name = $_POST['first_name'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$phone = $_POST['phone'];
$membership_type = $_POST['membership_type'];
$starting_date = $_POST['starting_date'];

// error check here
if (empty($email) || empty($password) || empty($first_name) || empty($state)) {
	$error = "Invalid data. Check all fields and try again.";
	include ('error.php');
	exit();
}
// If valid, add the product to the database
require_once ('database.php');
try {$query = "INSERT INTO my_customers
                 (email,password,first_name,state,zip,phone,membership_type,starting_date)
              VALUES
                 ('$email', '$password', '$first_name', '$state','$zip','$phone','$membership_type','$starting_date')";
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
		<title>Thank you for registering! </title>
		<meta name="description" content="Test page to learn big picture of  AMP architecture" />
		<meta name="author" content="akhilesh-bajaj" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<link rel="shortcut icon" href="../images/ING.ico" />
		<link rel="stylesheet" href="../styles/register.css">
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	</head>
	<body>
		<header>
			<h1>Thank you for Registering! Welcome!!</h1>
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
		<section>
			<fieldset>
				<legend>
					Registration Information That You Submitted
				</legend>
				Email: <?php echo $email;?><br />
				First Name: <?php echo $first_name;?><br />
				State: <?php echo $state;?><br />
				Zip:<?php echo $zip;?><br />
				Phone:<?php echo $phone;?><br />
				Membership Type: <?php echo $membership_type;?><br />
				Starting Date: <?php echo $starting_date;?><br />
				<br>
			</fieldset>
		</section>
		<footer>
			<p>
				&copy; Copyright  by akhilesh-bajaj
			</p>
		</footer>
	</body>
</html>
