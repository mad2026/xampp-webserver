<?php
    // get the data from the form
    if (isset($_POST['user_name'])){
        $user_name = cleanIO($_POST['user_name']);
        //DEBUG var_dump($user_name);
        //DEBUG exit();
    }//if
    if (isset($_POST['loan_init'])){
        $loan_init = cleanIO($_POST['loan_init']);
    }//if
    if (isset($_POST['num_loan_months'])){
        $num_loan_months = cleanIO($_POST['num_loan_months']);
    }//if
    if (isset($_POST['annual_interest'])){
        $annual_interest = cleanIO($_POST['annual_interest']);
    }//if
    if (!filter_var($loan_init, FILTER_VALIDATE_FLOAT)) {
        var_dump($loan_init);
        echo '<br>';
        exit ("Need number for loan_init");
    }//if
    if (!filter_var($num_loan_months, FILTER_VALIDATE_FLOAT)) {
        var_dump($num_loan_months);
        echo '<br>';
        exit ("Need number for num_loan_months");
    }//if
    if (!filter_var($annual_interest, FILTER_VALIDATE_FLOAT)) {
        var_dump($annual_interest);
        echo '<br>';
        exit ("Need number for annual_interest");
    }//if

    //Application specific checks below
    if ($user_name == "")
        exit("Supply Full User Name");
    if ($annual_interest <0 || $annual_interest >100)
        exit("Annual Interest rate must be positive and less than 100");

    // calculate the discount
    $monthly_interest_as_percentage = $annual_interest / 12;
    $monthly_interest = ($annual_interest / 12)/100;
    $monthly_payment = ($loan_init * ($monthly_interest/(1 - pow((1 + $monthly_interest),(-1 * $num_loan_months)))));


    ///DEBUGGING CODE
    // $monthly_interest_plus1 = 1 + $monthly_interest;
    // $monthly_interest_exponentiated = pow($monthly_interest_plus1,(-1 * $num_loan_months));
    
    // $multiplicative_for_intial_amount = $monthly_interest/(1-$monthly_interest_exponentiated);

    // $monthly_payment = $loan_init * $multiplicative_for_intial_amount;
    // <label>Debug Values:</label>
    // <span>'.$monthly_interest_plus1.'monthly_interest_plus1'.
    // $monthly_interest_exponentiated.'monthly_interest_exponentiated'.
    // $multiplicative_for_intial_amount.'multiplicative_for_intial_amount'.
    // $monthly_payment.'</span><br>


    // apply currency formatting to the dollar and percent amounts
    $loan_init_formatted = "$" . number_format($loan_init, 2);
    $annual_interest_formatted = number_format($annual_interest, 1) . "%";
    $monthly_interest_formatted = number_format($monthly_interest_as_percentage, 1) . "%";
    $monthly_payment_formatted = "$" . number_format($monthly_payment, 2);
    
    // escape the unformatted input
    $user_name_escaped = cleanIO($user_name);

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
                <link rel="stylesheet" type="text/css" href="monthlyPayment.css">
            </head>
    
            <body>
                <main>
                    <h1>Product Discount Calculator</h1>
                
                    <label>User Name:</label>
                    <span>'.$user_name_escaped.'</span><br>
                
                    <label>Initial Loan Amount:</label>
                    <span>'.$loan_init_formatted.'</span><br>

                    <label>Number of Loan Months:</label>
                    <span>'.$num_loan_months.'</span><br>
                
                    <label>Annual Interest:</label>
                    <span>'.$annual_interest_formatted.'</span><br>
                    
                    <label>Monthly Interest:</label>
                    <span>'.$monthly_interest_formatted.'</span><br>

                    <label>Monthly Payment:</label>
                    <span><b><u>'.$monthly_payment_formatted.'</u></b></span><br>

                </main>
            </body>
        </html>
    ';
?>