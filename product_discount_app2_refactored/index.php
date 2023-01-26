<?php
require_once('echoHTMLtext.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="productDiscount.js"></script>
</head>
    <body>
        <header>
            <h1>Product Discount Calculator</h1>
        </header>
        <main>
            <h2>Discount Information</h2>
            <img src="../Custom_Images/Logo_de_Enron.svg.png" height="40px" width="40px" /><br>
            <form action="display_discount.php" onsubmit="return validateProductData();" method="post">

                <div id="data">
                    <!-- <label>Product Description:</label>
                    <input type="text" name="product_description" id="product_description" required><br> -->
                    <label for="product_description">Choose a product:</label>

                    <select name="product_description" id="product_description">
                        <option value="Guitars">Guitars</option>
                        <option value="Pianos">Pianos</option>
                        <option value="Other">Other</option>
                    </select><br>

                    <label>List Price:</label>
                    <input type="number" name="list_price" id="list_price"  min="0" required><br>

                    <label>Discount Percent (0-100):</label>
                    <input type="number" name="discount_percent" id="discount_percent" min="0" max="100" required>
                    <span>%</span><br>
                </div>
                <div id="buttons">
                    <label>&nbsp;</label>
                    <input type="submit" value="Calculate Discount"><br>
                </div>
            </form>
        </main>
        <footer>

            &copy; Mason Davenport, <?php echo date('Y');?>. Please contact <a href="mailto:mad2026@utulsa.edu">Admin</a> for more information.
            <button onclick="history.back()">Go Back</button>   
        </footer>
    </body>
</html>