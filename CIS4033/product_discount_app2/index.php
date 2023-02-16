<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <script src="productDiscount.js"></script>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
<?php
        echo date('Y');
        ?>
        <h1>Product Discount Calculator</h1>
        <form action="display_discount.php" onsubmit="return validateProductData();" method="post">

            <div id="data">
                <label>Product Description:</label>
                <input type="text" name="product_description" id="product_description" required><br>

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
</body>
</html>