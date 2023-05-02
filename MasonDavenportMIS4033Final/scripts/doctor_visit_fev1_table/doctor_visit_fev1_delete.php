<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';

error_reporting(E_ALL);
ini_set('display_errors', 1);
    
// Check that the contact ID exists
if (isset($_GET['visit_id'])) {
    
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM doctor_visit_fev1 WHERE visit_id = ?');
    $stmt->execute([$_GET['visit_id']]);
    $doctor_visit_fev1 = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$doctor_visit_fev1) {
        exit('Contact doesn\'t exist with that ID!');
    }
    
    // Make sure the user confirms before deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM doctor_visit_fev1 WHERE visit_id = ?');
            $stmt->execute([$_GET['visit_id']]);
            $msg = 'You have deleted the Fev1 Visit!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: doctor_visit_fev1_read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete Visit #<?=$doctor_visit_fev1['visit_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete visit #<?=$doctor_visit_fev1['visit_id']?>?</p>
    <div class="yesno">
        <a href="doctor_visit_fev1_delete.php?visit_id=<?=$doctor_visit_fev1['visit_id']?>&confirm=yes">Yes</a>
        <a href="doctor_visit_fev1_delete.php?visit_id=<?=$doctor_visit_fev1['visit_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?> 
