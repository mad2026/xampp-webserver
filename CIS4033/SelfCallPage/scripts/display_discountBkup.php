<?php
// get the data from the form
$product_description = test_input($_POST['product_description']);
if ($product_description != "Guitars" && $product_description != "Pianos" && $product_description != "Other") {
	echo "Product Description not Correct";
	exit(1);
}//if
$list_price = test_input($_POST['list_price']);
$discount_percent = test_input($_POST['discount_percent']);

// calculate the discount
$discount = $list_price * $discount_percent * .01;
$discount_price = $list_price - $discount;

// apply currency formatting to the dollar and percent amounts
$list_price_formatted = "$" . number_format($list_price, 2);
$discount_percent_formatted = $discount_percent . "%";
$discount_formatted = "$" . number_format($discount, 2);
$discount_price_formatted = "$" . number_format($discount_price, 2);

// escape the unformatted input
$product_description_escaped = htmlspecialchars($product_description);

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}//test_input
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Product Discount Calculator</h1>

        <label>Product Description:</label>
        <span><?php echo $product_description_escaped; ?></span><br>

        <label>List Price:</label>
        <span><?php echo $list_price_formatted; ?></span><br>

        <label>Standard Discount:</label>
        <span><?php echo $discount_percent_formatted; ?></span><br>

        <label>Discount Amount:</label>
        <span><?php echo $discount_formatted; ?></span><br>

        <label>Discount Price:</label>
        <span><?php echo $discount_price_formatted; ?></span><br>
    </main>
</body>
</html>