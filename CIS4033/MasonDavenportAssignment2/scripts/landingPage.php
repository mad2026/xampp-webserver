<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="../styles/CustomerRegistration.css">
</head>
echoHead("../clientScripts/customerRegistration.js", "../styles/CustomerRegistration.css")
<body>
    <header>
        <h1>Customer Registration</h1>
        <nav>
            <ul class="menu">
                <li>
                    <button>Home</button>
                </li>
                
                <li>
                    <button>Account</button>
                    <ul class="submenu">
                        <li><a href="http://www.barbie.com">Login</a></li>
                        <li>Register</li>
                        <li>Manage</li>
                    </ul>
                </li>

                <li>
                    <form action="mailto:mad2026@utulsa.edu">
                        <button type="submit">Email Us</button>
                    </form>
                </li>
                
                <li>
                    <button>Logout</button>
                </li>
            </ul>

            <br>
        </nav>
    </header>
echoHeader("Customer Registration");
    <main>
        <form action="monthlyPayment.php" onsubmit="return validateProductData();" method="post">

            <fieldset> 
                <legend>Registration Information</legend>
                <label>E-Mail:</label>
                <input type="email" name="email" id="email" required><br>

                <label>Password:</label>
                <input type="password" name="password" id="password" pattern="[a-zA-Z0-9]{6,}" placeholder="At least 6 letters or numbers"required><br>
                
                <label>Verify Password:</label>
                <input type="password" name="verify_password" id="verify_password" required><br>
            </fieldset>
            <br>
            <fieldset>
                <legend>Member Information</legend>
                <label>First Name:</label>
                <input type="text" name="first_name" id="first_name" required><br>

                <label>State:</label>
                <input type="text" name="state_code" id="state_code" maxlength="2" placeholder="2-character code" required><br>

                <label>ZIP Code:</label>
                <input type="number" name="zip_code" id="zip_code" placeholder="5 or 9 digits" pattern="^\d{5}(-\d{4})?$" required><br>
                
                <label>Phone Number:</label>
                <input type="number" name="phone_number" id="phone_number" placeholder="999-999-9999" pattern="\d{3}[\-]\d{3}[\-]\d{4}" required>
            </fieldset>
            <br>
            <fieldset>
                <legend>Membership Information</legend>
                <label>Membership Type:</label>
                <select name="membership_type" id="membership_type">
						<option value="gold">Gold</option>
						<option value="silver">Silver</option>
						<option value="bronze">Bronze</option>
                </select><br>

                <label>Starting Date:</label>
                <input type="date" name="starting_date" id="starting_date"  required><br>
            </fieldset>
            <br>
            <fieldset>
                <legend>Submit Your Membership</legend>
                <div id="buttons">
                    <label>&nbsp;</label>
                    <input type="submit" id="submit" value="Submit">
                    <input type="reset" id="reset"  value="Reset Fields"><br>
                </div>
            </fieldset>
        </form>
    </main>
</body>
</html>