<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the professor ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM professors WHERE f_id = ?');
    $stmt->execute([$_GET['id']]);
    $professor = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$professor) {
        exit('Professor doesn\'t exist with that ID!');
    }
    // Make sure the user confirms before deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM professors WHERE f_id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the professor!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: professors_read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete Professor #<?=$professor['f_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete professor #<?=$professor['f_id']?>?</p>
    <div class="yesno">
        <a href="professors_delete.php?id=<?=$professor['f_id']?>&confirm=yes">Yes</a>
        <a href="professors_delete.php?id=<?=$professor['f_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
