<?php echo '
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<link rel="shortcut icon" href="/3TierLabRefactored/images/ING.ico" />
		<link rel="stylesheet" href="/3TierLabRefactored/styles/register.css">
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	</head>
	<body>
		<header>
			<h1>Input information again </h1>
			
		</header>
		
		<section id="main_form">
			<form action="./update_account.php" method="post"
			name="update_account_login_form" id="update_account_login_form" >
				<fieldset>
					<legend>
						Login
					</legend>
					<label for="email">E-Mail:</label>
					<input type="email" name="email" id="email"
					autofocus required>
					<br>
					<label for="password">Password:</label>
					<input type="password" name="password" id="password"
					required pattern="[a-zA-Z0-9]{6,}"
					placeholder="At least 6 letters or numbers">
				</fieldset>
				<fieldset id="buttons">
					<legend>
						Submit Your Login Info
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
		
			</p>
		</footer>
	</body>
</html>
' ?>