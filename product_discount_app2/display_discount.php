<?php
    // get the data from the form
    if (isset($_POST['product_description'])){
        $product_description = cleanIO($_POST['product_description']);
        //DEBUG var_dump($product_description);
        //DEBUG exit();
    }//if
    if (isset($_POST['list_price'])){
        $list_price = cleanIO($_POST['list_price']);
    }//if
    if (isset($_POST['discount_percent'])){
        $discount_percent = cleanIO($_POST['discount_percent']);
    }//if
    if (!filter_var($list_price, FILTER_VALIDATE_FLOAT)) {
        var_dump($list_price);
        echo '<br>';
        exit ("Need number for list_price");
    }//if
    if (!filter_var($discount_percent, FILTER_VALIDATE_FLOAT)) {
        var_dump($discount_percent);
        echo '<br>';
        exit ("Need number for discount_percent");
    }//if

    //Application specific checks below
    if ($product_description == "")
        exit("Supply product description");
        
    if ($product_description != "Guitars" && $product_description != "Pianos" && $product_description != "Other") 
        exit("Incorrect Product Description");
    if ($discount_percent <0 || $discount_percent >100)
        exit("Discount percent must be positive and less than 100");

    // calculate the discount
    $discount = $list_price * $discount_percent * .01;
    $discount_price = $list_price - $discount;
    
    // apply currency formatting to the dollar and percent amounts
    $list_price_formatted = "$" . number_format($list_price, 2);
    $discount_percent_formatted = number_format($discount_percent, 1) . "%";
    $discount_formatted = "$" . number_format($discount, 2);
    $discount_price_formatted = "$" . number_format($discount_price, 2);
    
    // escape the unformatted input
    $product_description_escaped = cleanIO($product_description);

    function cleanIO($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }//cleanIO

    
    echo '
    <!DOCTYPE html>
        <html>
            <button onclick="history.back()">Back</button>

            <head>
                <title>Product Discount Calculator</title>
                <link rel="stylesheet" type="text/css" href="main.css">
            </head>
    
            <body>
                <main>
                    <h1>Product Discount Calculator</h1>
                
                    <label>Product Description:</label>
                    <span>'.$product_description_escaped.'</span><br>
                
                    <label>List Price:</label>
                    <span>'.$list_price_formatted.'</span><br>
                
                    <label>Standard Discount:</label>
                    <span>'.$discount_percent_formatted.'</span><br>
                    
                    <label>Discount Amount:</label>
                    <span>'.$discount_formatted.'</span><br>
                
                    <label>Discount Price:</label>
                    <span>'.$discount_price_formatted.'</span><br>

                </main>
            </body>
        </html>
    ';
?>