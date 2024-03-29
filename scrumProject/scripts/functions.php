<?php

function pdo_connect_mysql() {
    @include_once ('../app_config.php');    
    try {
    	return new PDO(DSN1.';charset=utf8', USER1, PASSWD1);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
function template_header($title) {
    @include_once ('../app_config.php'); 
    echo'
    <!DOCTYPE html>
    <html>
	   <head>
		<meta charset="utf-8">
		<title>CRUD</title>
		<link href="'.WEB_ROOT.APP_FOLDER_NAME.'/styles/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	   </head>
	   <body>
            <nav class="navtop">
    	       <div>
    		      <h1>ACME</h1>
						<label></label>
							
							
							<div>
							<a href="'.WEB_ROOT.APP_FOLDER_NAME.'/scripts/landingPage.php"><i class="fas fa-home"></i>Home</a>							
							
								<label id="dropdown">
								  <button id="drop-btn"><i class="fas fa-bars"></i> Menu</button>
								  <div id="dropdown-content">
									<a href="'.WEB_ROOT.APP_FOLDER_NAME.'/scripts/patients_table/patients_read.php"><i class="fas fa-users"></i> Patients</a>
									
									<a href="'.WEB_ROOT.APP_FOLDER_NAME.'/scripts/doctor_visit_fev1_table/doctor_visit_fev1_read.php"><i class="fas fa-notes-medical"></i></i> FEV1 Exams</a>
									
									<a href="'.WEB_ROOT.APP_FOLDER_NAME.'/scripts/medications_prescribed_table/medications_prescribed_read.php"><i class="fas fa-syringe"></i> Prescriptions</a>
									
									<a href="'.WEB_ROOT.APP_FOLDER_NAME.'/scripts/medications_table/medications_read.php"><i class="fas fa-vials"></i> Medications List</a>
									
									<a href="'.WEB_ROOT.APP_FOLDER_NAME.'/scripts/acme_user_accounts_table/acme_user_accounts_read.php"><i class="fas fa-user-md"></i> Users</a>
								  </div>
								</label>
							</div>
    	       </div>

            </nav>

';
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>