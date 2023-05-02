<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';

error_reporting(E_ALL);
ini_set('display_errors', 1);
    
// Check that the contact ID exists
if (isset($_GET['patient_id'])) {
    
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM medication_prescribed WHERE patient_id = ?');
    $stmt->execute([$_GET['patient_id']]);
    $medication_prescribed = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$medication_prescribed) {
        exit('Contact doesn\'t exist with that ID!');
    }
    
    // Make sure the user confirms before deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM medication_prescribed WHERE patient_id = ?');
            $stmt->execute([$_GET['patient_id']]);
            $msg = 'You have deleted the Prescribed Medication Record! <br /><a class="back-btn" href=".\medications_prescribed_read.php">Back</a>';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: medication_prescribed_read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete Contact #<?=$medication_prescribed['patient_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete contact #<?=$medication_prescribed['patient_id']?>?</p>
    <div class="yesno">
        <a href="medications_prescribed_delete.php?patient_id=<?=$medication_prescribed['patient_id']?>&confirm=yes">Yes</a>
        <a href="medications_prescribed_delete.php?patient_id=<?=$medication_prescribed['patient_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?> 
