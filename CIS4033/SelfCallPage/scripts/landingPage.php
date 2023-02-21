<?php
/*require_once ('../app_config.php');
 require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/echoHTMLText.php');
 echoHead(APP_FOLDER_NAME . '/clientScripts/productDiscount.js', APP_FOLDER_NAME . '/styles/main.css');
 echoHeader("Enter Sales Information");
 //Form portion below
 $selfForm = htmlspecialchars($_SERVER['PHP_SELF']);
 if (empty($_POST)) {
 echo '
 <form method="POST" action = ""  >

 <div id="data">
 <label>Product Description:</label>
 <input type="text" id="product_description" name="product_description" ><br>

 <label>List Price:</label>
 <input type="number"  name="list_price" required><br>

 <label>Discount Percent:</label>
 <input type="number" min="0" max="100" name="discount_percent" value = "0"><span>%</span><br>
 </div>

 <div id="buttons">
 <label>&nbsp;</label>
 <input type="submit" name = "submitBtn" id = "submitBtn" value="Calculate Discount"><br>
 </div>

 </form>
 ';
 echoFooter();
 }
 //handling portion below
 if (!empty($_POST)) {
 // echo 'POSTING';
 require_once ('../app_config.php');
 require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/echoHTMLText.php');
 require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/errorDisplay.php');
 require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/utilities.php');
 $myJSFile = APP_FOLDER_NAME . '/clientScripts/productDiscount.js';
 $myCSSFile = APP_FOLDER_NAME . '/styles/main.css';
 $product_description = "";
 $list_price = "";
 $discount_percent = "";
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
 echoError("Discount percent must be a number", $myJSFile, $myCSSFile);
 exit();
 }//if

 //Application specific checks below
 if ($product_description == "") {
 echo '<br>';
 echoError("Supply Product Description", $myJSFile, $myCSSFile);
 exit();
 }//if
 if ($product_description != "Guitars" && $product_description != "Pianos" && $product_description != "Other") {
 echo '<br>';
 echoError("Incorrect Product Description", $myJSFile, $myCSSFile);
 exit();
 }//if
 if ($list_price < 0)
 echo '<br>';
 echoError("List price must be positive", $myJSFile, $myCSSFile);
 if ($discount_percent < 0 || $discount_percent > 100)
 echo '<br>';
 echoError("Discount must be between 0 and 100", $myJSFile, $myCSSFile);

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

 //	echoHead($myJSFile, $myCSSFile);
 //	echoHeader("Discount Information");
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
 }//if POST
 * */
?>
<?php
require_once ('../app_config.php');
require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/echoHTMLText.php');
echoHead(APP_FOLDER_NAME . '/clientScripts/productDiscount.js', APP_FOLDER_NAME . '/styles/main.css');

if (!empty($_POST)) :
	require_once ('../app_config.php');
	require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/echoHTMLText.php');
	require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/errorDisplay.php');
	require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/utilities.php');
	$myJSFile = APP_FOLDER_NAME . '/clientScripts/productDiscount.js';
	$myCSSFile = APP_FOLDER_NAME . '/styles/main.css';
	echoHeader("Discount Details");
	$product_description = "";
	$list_price = "";
	$discount_percent = "";
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
		echoError("Discount percent must be a number", $myJSFile, $myCSSFile);
		exit();
	}//if

	//Application specific checks below
	if ($product_description == "") {
		echo '<br>';
		echoError("Supply Product Description", $myJSFile, $myCSSFile);
		exit();
	}//if
	if ($product_description != "Guitars" && $product_description != "Pianos" && $product_description != "Other") {
		echo '<br>';
		echoError("Incorrect Product Description", $myJSFile, $myCSSFile);
		exit();
	}//if
	
	if ($list_price < 0){
		echo '<br>';
	echoError("List price must be positive", $myJSFile, $myCSSFile);
	}//if listprice<0
	if ($discount_percent < 0 || $discount_percent > 100){
		echo '<br>';
	echoError("Discount must be between 0 and 100", $myJSFile, $myCSSFile);
	}//if discount <0
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

	//	echoHead($myJSFile, $myCSSFile);
	//	echoHeader("Discount Information");
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
endif;
if (empty($_POST)) :
    echoHeader("Enter Sales Information");
	echo '<form action = "' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' " method="post">';
	echo '  <div id="data">
<label>Product Description:</label>
<input type="text" id="product_description" name="product_description" ><br>

<label>List Price:</label>
<input type="number"  name="list_price" required><br>

<label>Discount Percent:</label>
<input type="number" min="0" max="100" name="discount_percent" value = "0"><span>%</span><br>
</div>

<div id="buttons">
<label>&nbsp;</label>
<input type="submit" name = "submitBtn" id = "submitBtn" value="Calculate Discount"><br>
</div>
</form>';
endif;
?>
