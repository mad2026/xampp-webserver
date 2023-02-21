<?php
// get the data from the form
$email = $_POST['email'];
$password = $_POST['password'];


// error check here
if (empty($email) || empty($password))  {
	$error = "Invalid data. Check all fields and try again.";
	include ('error.php');
	exit();
}
// If valid, add the product to the database
require_once ('database.php');
try {$query = "SELECT first_name,state,zip,phone FROM  my_customers AS M
                 WHERE M.email = '$email' AND M.password = '$password' ";
	$edit_rows = $db->query($query);
	
} catch (Exception $e) {
    $error_message = $e->getMessage();
    echo "<p>Error message: $error_message </p>";
}//catch
if (count($edit_rows)>1) {
	$error = "There is an error in the database. PLease contact the site admin.";
	include ('error.php');
	exit();
}
if (count($edit_rows)==0) {
	$error = "Your login information could not be found. PLease try logging in again or create a new account.";
	include ('error.php');
	exit();
}
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
			<h1>Here is your Information!</h1>
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
			<form action="./sendUpdate.php" method="post"
			name="sendUpate_form" id="sendUpdate_form">
			<?php foreach ($edit_rows as $edit_row) { ?>
				<fieldset>
					<legend>
					Please edit any changes as needed
					</legend>
					<label for="first_name">First Name:</label>
					<input type="text" name="first_name" id=
					"first_name" autofocus value="<?php echo $edit_row['first_name'];?>">
					<br>
					<label for="state">State:</label>
					<input type="text" name="state" id="state" required
					maxlength="2" placeholder="2-character code" value="<?php echo $edit_row['state'];?>">
					<br>
					<label for="zip">ZIP Code:</label>
					<input type="text" name="zip" id="zip" required
					placeholder="5 or 9 digits"
					pattern="^\d{5}(-\d{4})?$"
					title="Either 5 or 9 digits" value="<?php echo $edit_row['zip'];?>">
					<br>
					<label for="phone">Phone Number:</label>
					<input type="tel" name="phone" id="phone"
					placeholder="999-999-9999"
					pattern="\d{3}[\-]\d{3}[\-]\d{4}"
					title="Must be 999-999-999 format" value="<?php echo $edit_row['phone'];?>">
					<br>
					<input type="hidden" name="email" value="<?php echo $email; ?>">
				</fieldset>
				<fieldset id="buttons">
					<legend>
						Submit Your Updated Information
					</legend>
					<label>&nbsp;</label>
					<input type="submit" id="submit" value="Submit">
					<input type="reset" id="reset" value="Reset Fields">
					<br>
				</fieldset>
				
			<?php }//foreach edit_rows ?>
				
				
		</section>
		<footer>
			<p>
				&copy; Copyright  by akhilesh-bajaj
			</p>
		</footer>
	</body>
</html>