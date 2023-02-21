<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Thank you for regsitering! </title>
		<meta name="description" content="Test page to learn big picture of  AMP architecture" />
		<meta name="author" content="akhilesh-bajaj" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<link rel="shortcut icon" href="/3TierLabRefactored/images/ING.ico" />
		<link rel="stylesheet" href="/3TierLabRefactored/styles/register.css">
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<?php 	include_once('./ViewFiles/print_menu.php') ?>
	</head>

<!-- the body section -->
<body>
   
<header>
            <h1>Error in Database Entry</h1>
			<?php printMenu('Register'); ?>       
 </header>

        <section>
            <h2> Error</h2>
            <p><?php echo $error; ?></p>
        </section>

       <footer>
			<p>
				&copy; Copyright  by akhilesh-bajaj
			</p>
		</footer>


</body>
</html>