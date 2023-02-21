<?php
function echoHead($jsFile, $cssFile) {
	echo '
    	<!DOCTYPE html>
      <html>
       <head>
         <title>Product Discount Calculator</title>
         <link rel="stylesheet" type="text/css" href="' . $cssFile . ' ">
         <script src="' . $jsFile . '"></script>
       </head>
    	';
}//echoHead

function echoHeader($title) {
	require_once ('../app_config.php');
	echo '
	<body>
	<header>
        	<h2>'.$title.'</h2>  
        	<img src ="'.WEB_ROOT.APP_FOLDER_NAME. '/images/companyLogo.jpg" height="40px" width = "40px" />     	
    </header>
	';
}//echoHeader

function echoFooter() {
	$currYear = date('Y');
	echo '
	<footer>
	
        	&copy; Akhilesh Bajaj, '.$currYear.'. Please contact <a href="mailto:chimp@gmail.com"> Admin </a> for more information
			
			<button id = "backButton" onclick="goBack()">Go Back</button>
        </footer>
        </body>
        </html>
	
	';
}//echoFooter
?>