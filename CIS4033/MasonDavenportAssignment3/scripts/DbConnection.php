<?php
require_once ('../app_config.php');
require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/echoHTMLText.php'); 
require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/errorDisplay.php');

function dbEstablish($first_name, $email, $password)
{
    try {
        $myDB = new PDO(DSN1, USER1, PASSWD1);
        $myDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echoError("Connection failed: " . $e->getMessage(), APP_FOLDER_NAME . '/clientScripts/customerRegistration.js', APP_FOLDER_NAME . '/styles/CustomerRegistration.css');
    }
    
    $selectStmt = "SELECT C.custId, C.custName, C.custEmail FROM customers AS C";
    try {
        $stmt = $myDB -> prepare ($selectStmt);
        $stmt ->execute();
        $allCustomers = $stmt->fetchAll();
        $stmt -> closeCursor();
        //DEBUG print_r($allCustomers); exit(1);
    } catch (Exception $e) {
        echoError ($e-> getMessage(), APP_FOLDER_NAME . '/clientScripts/customerRegistration.js', APP_FOLDER_NAME . '/styles/CustomerRegistration.css');
        exit(1);
    }//catch 

    try {
        $pdo = new PDO(DSN1, USER1, PASSWD1);
        $stmt = $pdo->prepare("INSERT INTO customers (custName, custEmail, CustPassword) VALUES (?, ?, ?)");
        $stmt->execute([$first_name, $email, md5($password)]);
        echo "Record inserted successfully";
    } catch(PDOException $e) {
        echoError("Insert failed: " . $e->getMessage(), APP_FOLDER_NAME . '/clientScripts/customerRegistration.js', APP_FOLDER_NAME . '/styles/customerRegistration.css');
        exit(1);
    }

    return $pdo;
}

#echo "hi";
#dbEstablish("bob","job@example.example","password");
?>
