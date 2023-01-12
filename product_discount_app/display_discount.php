<?php
    // get the data from the form
    $product_description = $_POST['product_description'];
    $list_price = $_POST['list_price'];
    $discount_percent = $_POST['discount_percent'];
    
    // calculate the discount
    $discount = $list_price * $discount_percent * .01;
    $discount_price = $list_price - $discount;
    
    // apply currency formatting to the dollar and percent amounts
    $list_price_formatted = "$" . number_format($list_price, 2);
    $discount_percent_formatted = number_format($discount_percent, 1) . "%";
    
    // escape the unformatted input
    $product_description_escaped = htmlspecialchars($product_description);
?>