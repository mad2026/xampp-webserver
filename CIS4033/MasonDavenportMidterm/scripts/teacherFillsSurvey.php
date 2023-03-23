<?php //teacherName, teacherComment, teacherEMail
require_once('echoHTMLtext.php');
require_once('errorDisplay.php');
require_once('dbConnection.php');
$teacherName = $_POST['teacherName'];
$teacherComment = $_POST['teacherComment'];
$teacherEMail = $_POST['teacherEMail'];

// error checking
if (empty($teacherName) || empty($teacherComment) || empty($teacherEMail)) {
	echoError("Empty fields were detected. Check all fields and try again.","../clientScripts/teacherSurvey.js", "../styles/teacherSurvey.css");
	exit();
}//check for empty fields
if (strlen($teacherName) <= 2){
	echoError("Teacher Name must be at least 2 characters. Please try again.","../clientScripts/teacherSurvey.js", "../styles/teacherSurvey.css");
	exit();
}//verify Teacher Name Length
if (strlen($teacherComment) <= 20){
	echoError("Teacher Comment must be at least 20 characters. Please try again.","../clientScripts/teacherSurvey.js", "../styles/teacherSurvey.css");
	exit();
}//verify Teacher Name Length
if (!preg_match("/^[_a-z0-9-+]+(\.[_a-z0-9-+]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $teacherEMail)) {
    echoError("EMail is of incorrect format. must be in the format example@example.com. Please try again.","../clientScripts/teacherSurvey.js", "../styles/teacherSurvey.css");
	exit();
}//verify Teacher Email

dbEstablish($teacherName, $teacherComment, $teacherEMail);
echoHead(APP_FOLDER_NAME . '/clientScripts/teacherSurvey.js', APP_FOLDER_NAME . '/styles/teacherSurvey.css');
echoHeader("Survey Complete!");
echo '<main>
            <fieldset>
                <legend>Survey Information That You Submitted</legend>
                    <label>E-Mail:</label>
                    '.$teacherName.'<br/>
                    <label>First Name:</label>
                    '.$teacherComment.'<br/>
                    <label>State:</label>
                    '.$teacherEMail.'<br/>
            </fieldset>
        </main>';
echoFooter();
?>

