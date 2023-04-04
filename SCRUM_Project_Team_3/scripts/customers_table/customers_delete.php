<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the customer ID exists
if (isset($_GET['custId'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM customers WHERE custId = ?');
    $stmt->execute([$_GET['custId']]);
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$customer) {
        exit('Customer doesn\'t exist with that ID!');
    }
    // Make sure the user confirms before deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM customers WHERE custId = ?');
            $stmt->execute([$_GET['custId']]);
            $msg = 'You have deleted the customer!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: customers_read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete Customer #<?=$customer['custId']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete customer #<?=$customer['custId']?>?</p>
    <div class="yesno">
        <a href="customers_delete.php?custId=<?=$customer['custId']?>&confirm=yes">Yes</a>
        <a href="customers_delete.php?custId=<?=$customer['custId']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
