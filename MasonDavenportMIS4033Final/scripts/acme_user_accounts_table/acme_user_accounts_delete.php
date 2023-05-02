<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the customer ID exists
if (isset($_GET['user_id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM acme_user_accounts WHERE user_id = ?');
    $stmt->execute([$_GET['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        exit('User doesn\'t exist with that ID!');
    }
    // Make sure the user confirms before deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM acme_user_accounts WHERE user_id = ?');
            $stmt->execute([$_GET['user_id']]);
            $msg = 'You have deleted the user!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: acme_user_accounts_read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete User #<?=$user['user_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete user #<?=$user['user_id']?>?</p>
    <div class="yesno">
        <a href="acme_user_accounts_delete.php?user_id=<?=$user['user_id']?>&confirm=yes">Yes</a>
        <a href="acme_user_accounts_delete.php?user_id=<?=$user['user_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
