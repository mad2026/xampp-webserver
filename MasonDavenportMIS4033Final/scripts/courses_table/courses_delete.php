<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the classroom ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM classrooms WHERE cl_id = ?');
    $stmt->execute([$_GET['id']]);
    $classroom = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$classroom) {
        exit('Classroom doesn\'t exist with that ID!');
    }
    // Make sure the user confirms before deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM classrooms WHERE cl_id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the classroom!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: classrooms_read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete Classroom #<?=$classroom['cl_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete classroom #<?=$classroom['cl_id']?>?</p>
    <div class="yesno">
        <a href="classrooms_delete.php?id=<?=$classroom['cl_id']?>&confirm=yes">Yes</a>
        <a href="classrooms_delete.php?id=<?=$classroom['cl_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
