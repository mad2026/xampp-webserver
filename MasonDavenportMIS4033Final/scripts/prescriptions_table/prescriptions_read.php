<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;
// Prepare the SQL statement and get records from our medication_prescribed table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT mp.*, p.first_name, p.last_name FROM medication_prescribed mp JOIN patient_information p ON mp.patient_id = p.patient_id ORDER BY mp.patient_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$prescriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of prescriptions, this is so we can determine whether there should be a next and previous button
$num_prescriptions = $pdo->query('SELECT COUNT(*) FROM medication_prescribed')->fetchColumn();
?>
<?=template_header('Read')?>
<div class="content read">
	<h2>Read Medication Prescriptions</h2>
	<a href="prescriptions_create.php" class="create-prescription">Create Prescription</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Patient Name</td>
                <td>Medication Type</td>
                <td>Notes/Dosage</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prescriptions as $prescription): ?>
            <tr>
                <td><?=$prescription['patient_id']?></td>
                <td><?=$prescription['first_name'].' '.$prescription['last_name']?></td>
                <td><?=$prescription['medication_type']?></td>
                <td><?=$prescription['notes_dosage']?></td>
                <td class="actions">
                    <a href="prescriptions_update.php?patient_id=<?=$prescription['patient_id']?>&medication_id=<?=$prescription['medication_id']?>&visit_id=<?=$prescription['visit_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="prescriptions_delete.php?patient_id=<?=$prescription['patient_id']?>&medication_id=<?=$prescription['medication_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="prescriptions_read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_prescriptions): ?>
		<a href="prescriptions_read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>
<?=template_footer()?>