<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
// Connect to MySQL database
$pdo = pdo_connect_mysql();

// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;
// Prepare the SQL statement and get records from our doctor_visit_fev1 table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM medication_prescribed ORDER BY patient_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$medication_prescribed = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of doctor_visit_fev1, this is so we can determine whether there should be a next and previous button
$num_medications_prescribed = $pdo->query('SELECT COUNT(*) FROM medication_prescribed')->fetchColumn();


?>
<?=template_header('Read')?>

<div class="content read">
	<h2>Medications Prescribed</h2>
	<a href="medications_prescribed_create.php" class="create-contact">Prescribe a Medication</a>
	<table>
        <thead>
            <tr>
                <td>Patient ID</td>
				<td>Visit ID</td>	
                <td>Medication ID</td>
                <td>Medication Type</td>
                <td>Notes Dosage</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($medication_prescribed as $medication_prescribed): ?>
            <tr>
                <td><?=$medication_prescribed['patient_id']?></td>	
				<td><?=$medication_prescribed['visit_id']?></td>					
                <td><?=$medication_prescribed['medication_id']?></td>            
                <td><?=$medication_prescribed['medication_type']?></td>
                <td><?=$medication_prescribed['notes_dosage']?></td>
                
                <td class="actions">
                    <a href="medications_prescribed_update.php?id=<?=$medication_prescribed['patient_id']?>+<?=$medication_prescribed['visit_id']?>+<?=$medication_prescribed['medication_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
					
                    <a href="medications_prescribed_delete.php?patient_id=<?=$medication_prescribed['patient_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
			<a href="medications_prescribed_read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_medications_prescribed): ?>
			<a href="medications_prescribed_read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>	
    <a class="back-btn" href="../landingPage.php">Back</a>


</div>


<?=template_footer()?>