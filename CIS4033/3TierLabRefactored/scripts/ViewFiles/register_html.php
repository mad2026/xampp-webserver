<?php include_once('print_menu.php') ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Registration Page</title>
		<meta name="description" content="Test page to learn big picture of  AMP architecture" />
		<meta name="author" content="akhilesh-bajaj" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		
		<link rel="shortcut icon" href="/3TierLabRefactored/images/ING.ico" />
		<link rel="stylesheet" href="/3TierLabRefactored/styles/register.css">
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<script language = "javascript">

			//-----------------------------------------------------------------------------
			function onLoad() {
				onerror = handleErr;
			}

			//----------------------------------------------------------------------------
			function validateForm() {
				valid = true;

				//if full name field is empty return false
				if(document.registration_form.password.value != document.registration_form.verify.value) {
					alert("Passwords don't match. Please re-enter. ");
					valid = false;
					document.registration_form.password.value = "";
					document.registration_form.verify.value = "";
					document.registration_form.password.focus();
					return valid;
				}
				//if full name field is a number return false

				alert("Form filled out correctly. Press OK to submit");
				return valid;
			}//validateForm

			//--------------------------------------------------------------------------------------
			//generic error handler called if there is an unexpected error
			function handleErr(msg, url, l) {
				var txt = "";
				txt = "There was an error on this page.\n\n";
				txt += "Error: " + msg + "\n";
				txt += "URL: " + url + "\n";
				txt += "Line: " + l + "\n\n";
				txt += "Click OK to continue.\n\n";
				alert(txt);
				return true;
			}

			
			
		</script>
	</head>
	<body onLoad="javascript:onLoad();">
		<header>
			<h1>Customer Registration</h1>
			<?php printMenu('Register'); ?>
		</header>
		<aside>
		<a href="/3TierLabRefactored/scripts/ViewFiles/update_account_login_html.php">Update Existing Information</a>
		</aside>
		<section id="main_form">
			<form action="/3TierLabRefactored/scripts/register.php" method="post"
			name="registration_form" id="registration_form" onsubmit="return validateForm();">
				<fieldset>
					<legend>
						Registration Information
					</legend>
					<label for="email">E-Mail:</label>
					<input type="email" name="email" id="email"
					autofocus required>
					<br>
					<label for="password">Password:</label>
					<input type="password" name="password" id="password"
					required pattern="[a-zA-Z0-9]{6,}"
					placeholder="At least 6 letters or numbers">
					<br>
					<label for="verify">Verify Password:</label>
					<input type="password" name="verify" id="verify"
					required>
					<br>
				</fieldset>
				<fieldset>
					<legend>
						Member Information
					</legend>
					<label for="first_name">First Name:</label>
					<input type="text" name="first_name" id=
					"first_name" required>
					<br>
					<label for="state">State:</label>
					<input type="text" name="state" id="state" required
					maxlength="2" placeholder="2-character code">
					<br>
					<label for="zip">ZIP Code:</label>
					<input type="text" name="zip" id="zip" required
					placeholder="5 or 9 digits"
					pattern="^\d{5}(-\d{4})?$"
					title="Either 5 or 9 digits">
					<br>
					<label for="phone">Phone Number:</label>
					<input type="tel" name="phone" id="phone"
					placeholder="999-999-9999"
					pattern="\d{3}[\-]\d{3}[\-]\d{4}"
					title="Must be 999-999-999 format">
					<br>
				</fieldset>
				<fieldset>
					<legend>
						Membership Information
					</legend>
					<label for="membership_type">Membership Type:</label>
					<select name="membership_type" id="membership_type">
						<option value="gold">Gold</option>
						<option value="silver">Silver</option>
						<option value="bronze">Bronze</option>
					</select>
					<br>
					<label for="starting_date">Starting Date:</label>
					<input type="date" name="starting_date"
					placeholder="YYYY-MM-DD"
					id="starting_date" required>
					<br>
				</fieldset>
				<fieldset id="buttons">
					<legend>
						Submit Your Membership
					</legend>
					<label>&nbsp;</label>
					<input type="submit" id="submit" value="Submit">
					<input type="reset" id="reset" value="Reset Fields">
					<br>
				</fieldset>
			</form>
		</section>
		<footer>
			<p>
				&copy; Copyright  by akhilesh-bajaj
			</p>
		</footer>
	</body>
</html>
