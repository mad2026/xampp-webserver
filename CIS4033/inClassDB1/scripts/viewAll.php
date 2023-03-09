<?php
require_once ('../app_config.php');
require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/echoHTMLText.php'); 
require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/errorDisplay.php');
require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/utilities.php');

require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/db.php');
//require_once (APP_ROOT APP FOLDER_NAME. /scripts/Database.php'); 
$myDB getDB (DSN1, USER1, PASSWD1);
//$myDataBase= new Database (DSN1, USER1, PASSWD1); 
//$myDB = $myDataBase->getDB ();
$selectStmt = "SELECT C.custId, C.custName, C.custEmail FROM customers AS C";
try {
    $stmt = $myDB -> prepare ($selectStmt);
    $stmt ->execute();
    $allCustomers = $stmt->fetchAll();
    $stmt -> closeCursor();
    //DEBUG print_r($allCustomers); exit(1);
} catch (Exception $e) {
    echoError ($e-> getMessage());
    exit(1);
}//catch 
// Echo information
echoHead (APP_FOLDER_NAME . '/clientScripts/validateForm.js', APP_FOLDER_NAME . '/styles/main.css', "View All"); 
echoHeader ("All Customers");

echo '
    <!-- <h2>All Customers</h2> -->
<table>
    <tr>
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Customer Email</th>
    </tr>
    ';
foreach ($allCustomers as $nextCustomer) {
    echo '<tr><td>' . $nextCustomer ['custId'] . '</td>'; 
    echo '<td>' . $nextCustomer['custName'] . '</td>';
    echo '<td>' . $nextCustomer ['custEmail'] . '</td></tr>';
}//foreach

echo '
</table>
';
echoFooter ();
?>