<?php
require_once('echoHTMLtext.php');
require_once('errorDisplay.php');
$email = $_POST['email'];
$password = $_POST['password'];
$verify_password = $_POST['verify_password'];
$first_name = $_POST['first_name'];
$state_code = $_POST['state_code'];
$zip_code = $_POST['zip_code'];
$phone_number = $_POST['phone_number'];
$membership_type = $_POST['membership_type'];
$starting_date = $_POST['starting_date'];

// error checking
if (empty($email) || empty($password) || empty($first_name) || empty($state_code)) {
	echoError("Empty fields were detected. Check all fields and try again.","../clientScripts/customerRegistration.js", "../styles/CustomerRegistration.css");
	exit();
}//check for empty fields
if ($password != $verify_password){
	echoError("Passwords do not match. Please try again.","../clientScripts/customerRegistration.js", "../styles/CustomerRegistration.css");
	exit();
}//verify password
if (strlen($state_code) != 2){
	echoError("State code is of incorrect length. must only be 2 characters. Please try again.","../clientScripts/customerRegistration.js", "../styles/CustomerRegistration.css");
	exit();
}//verify state code
if (!preg_match('/^\d{5}(-\d{4})?$/', $zip_code)) {
    echoError("Zip code is of incorrect format. must be in the format 12345 or 12345-1234. Please try again.","../clientScripts/customerRegistration.js", "../styles/CustomerRegistration.css");
	exit();
}//verify zipcode
if (!preg_match('/\d{3}[\-]\d{3}[\-]\d{4}/', $phone_number)) {
    echoError("Phone number is of incorrect format. must be in the format 999-999-9999. Please try again.","../clientScripts/customerRegistration.js", "../styles/CustomerRegistration.css");
	exit();
}//verify phone number
if ($membership_type != "gold" && $membership_type != "silver" && $membership_type != "bronze"){
	echoError("Membership is not of type: gold, silver, or bronze. Please try again.","../clientScripts/customerRegistration.js", "../styles/CustomerRegistration.css");
	exit();
}//verify membership type


echoHead("../clientScripts/customerRegistration.js", "../styles/CustomerRegistration.css");
echoHeader("Registration Complete!");
echo '<main>
            <fieldset>
                <legend>Registration Information That You Submitted</legend>
                    <label>E-Mail:</label>
                    '.$email.'<br/>
                    <label>First Name:</label>
                    '.$first_name.'<br/>
                    <label>State:</label>
                    '.$state_code.'<br/>
                    <label>Zip:</label>
                    '.$zip_code.'<br/>
                    <label>Phone:</label>
                    '.$phone_number.'<br/>
                    <label>Membership Type:</label>
                    '.$membership_type.'<br/>
                    <label>Starting Date:</label>
                    '.$starting_date.'<br/>
            </fieldset>
        </main>';
echoFooter();
