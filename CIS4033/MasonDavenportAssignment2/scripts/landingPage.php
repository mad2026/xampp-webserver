<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="../styles/CustomerRegistration.css">
</head>
<body>
    <main>
        <h1>Monthly Payment Calculator</h1>
        <form action="monthlyPayment.php" onsubmit="return validateProductData();" method="post">

            <fieldset>
                <legend>Registration Information</legend>
                <label>E-Mail:</label>
                <input type="email" name="email" id="email" required><br>

                <label>Password:</label>
                <input type="password" name="password" id="password" required><br>

                <label>Verify Password:</label>
                <input type="password" name="verify_password" id="verify_password" required><br>
            </fieldset>
            <br>
            <fieldset>
                <legend>Member Information</legend>
                <label>First Name:</label>
                <input type="text" name="first_name" id="first_name" required><br>

                <label>State:</label>
                <input type="text" name="state_code" id="state_code" required><br>

                <label>ZIP Code:</label>
                <input type="number" name="zip_code" id="zip_code"required><br>
                
                <label>Phone Number:</label>
                <input type="number" name="annual_interest" id="annual_interest"required>
                <span>%</span><br>
            </fieldset>
            <br>
            <fieldset>
                <legend>Registration Information</legend>
                <label>Full Name:</label>
                <input type="text" name="user_name" id="user_name" required><br>

                <label>Initial Loan Amount:</label>
                <input type="number" name="loan_init" id="loan_init"  min="0" required><br>

                <label>Number of Months for Loan:</label>
                <input type="number" name="num_loan_months" id="num_loan_months" min="0" required><br>
                
                <label>Annual Interest:</label>
                <input type="number" name="annual_interest" id="annual_interest" min="0" max="100" required>
                <span>%</span><br>
            </fieldset>
            <div id="buttons">
                <label>&nbsp;</label>
                <input type="submit" value="Calculate Discount"><br>
            </div>
        </form>
    </main>
</body>
</html>