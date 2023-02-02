<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="monthlyPayment.css">
</head>
<body>
    <main>
        <h1>Monthly Payment Calculator</h1>
        <form action="monthlyPayment.php" onsubmit="return validateProductData();" method="post">

            <div id="data">
                <label>Full Name:</label>
                <input type="text" name="user_name" id="user_name" required><br>

                <label>Initial Loan Amount:</label>
                <input type="number" name="loan_init" id="loan_init"  min="0" required><br>

                <label>Number of Months for Loan:</label>
                <input type="number" name="num_loan_months" id="num_loan_months" min="0" required><br>
                
                <label>Annual Interest:</label>
                <input type="number" name="annual_interest" id="annual_interest" min="0" max="100" required>
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