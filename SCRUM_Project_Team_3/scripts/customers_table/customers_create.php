<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, //we must check if the POST variables exist if not we //can default them to blank
    $custId = isset($_POST['custId']) && !empty($_POST['custId']) && $_POST['custId'] != 'auto' ? $_POST['custId'] : NULL;
    // Check if POST variable "custName" exists, if not default //the value to blank, basically the same for all //variables
    $custName = isset($_POST['custName']) ? $_POST['custName'] : '';
    $custEmail = isset($_POST['custEmail']) ? $_POST['custEmail'] : '';
    $custPassword = isset($_POST['custPassword']) ? $_POST['custPassword'] : '';
    // Insert new record into the customers table
    $stmt = $pdo->prepare('INSERT INTO customers VALUES (?, ?, ?, ?)');
    $stmt->execute([$custId, $custName, $custEmail, $custPassword]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Create Contact</h2>
    <form action="customers_create.php" method="post">
        <label for="custId">ID</label>
        <label for="custName">Name</label>
        <input type="text" name="custId" placeholder="26" value="auto" id="custId">
        <input type="text" name="custName" placeholder="John Doe" id="custName">
        <label for="custEmail">Email</label>
        <label for="custPassword">Password</label>
        <input type="text" name="custEmail" placeholder="johndoe@example.com" id="custEmail">
        <input type="password" name="custPassword" placeholder="Password" id="custPassword">

        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>