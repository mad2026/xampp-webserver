<?php
//access other files
require_once ('../app_config.php');
require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/echoHTMLText.php');
require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/errorDisplay.php');
require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/utilities.php');
$myJSFile = APP_FOLDER_NAME . '/clientScripts/productDiscount.js';
$myCSSFile = APP_FOLDER_NAME . '/styles/main.css';
// get the data from the form
if (isset($_POST['product_description']))
	$product_description = cleanIO($_POST['product_description']);
if (isset($_POST['list_price']))
	$list_price = cleanIO($_POST['list_price']);
if (isset($_POST['discount_percent']))
	$discount_percent = cleanIO($_POST['discount_percent']);
if (!filter_var($list_price, FILTER_VALIDATE_FLOAT)) {
	var_dump($list_price);
	echo '<br>';
	echoError("List Price must be a number", $myJSFile, $myCSSFile);
	exit();
}//if
if (!filter_var($discount_percent, FILTER_VALIDATE_FLOAT)) {
	var_dump($discount_percent);
	echo '<br>';
	exit("Need number for discount_percent");
}//if

//Application specific checks below
if ($product_description == "") {
	echoError("Supply Product Description", $myJSFile, $myCSSFile);
	exit();
}//if
if ($product_description != "Guitars" && $product_description != "Pianos" && $product_description != "Other") {
	echoError("Incorrect Product Description", $myJSFile, $myCSSFile);
	exit();
}//if
if ($list_price < 0)
	exit("List price must be positive");
if ($discount_percent < 0 || $discount_percent > 100)
	exit("Discount must be positive and up to 100");

// calculate the discount

$discount = calculateProductDiscount($list_price, $discount_percent);
$discount_price = $list_price - $discount;

// apply currency formatting to the dollar and percent amounts
$list_price_formatted = "$" . number_format($list_price, 2);
$discount_percent_formatted = $discount_percent . "%";
$discount_formatted = "$" . number_format($discount, 2);
$discount_price_formatted = "$" . number_format($discount_price, 2);

// escape the unformatted input
$product_description_escaped = cleanIO($product_description);

// echo"String Interpolation should be : $product_description_escaped ";
//define('PI', '3.1416');
//echo PI;
//echo'Today is '. date('m/d/y');

echoHead($myJSFile, $myCSSFile);
echoHeader("Discount Information");
echo '
 
    <main>

        <label>Product Description:</label>
        <span>' . $product_description_escaped . '</span><br>

        <label>List Price:</label>
        <span>' . $list_price_formatted . '</span><br>

        <label>Standard Discount:</label>
        <span>' . $discount_percent_formatted . '</span><br>

        <label>Discount Amount:</label>
        <span>' . $discount_formatted . '</span><br>

        <label>Discount Price:</label>
        <span>' . $discount_price_formatted . '</span><br>
    </main>
    ';
echoFooter();
?>