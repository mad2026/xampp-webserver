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
$stmt = $pdo->prepare('SELECT * FROM doctor_visit_fev1 ORDER BY visit_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$doctor_visit_fev1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of doctor_visit_fev1, this is so we can determine whether there should be a next and previous button
$num_doctor_visit_fev1 = $pdo->query('SELECT COUNT(*) FROM doctor_visit_fev1')->fetchColumn();


?>
<?=template_header('Read')?>

<div class="content read">
	<h2>Read doctor_visit_fev1</h2>
	<a href="doctor_visit_fev1_create.php" class="create-doctor_visit_fev1">Create doctor_visit_fev1</a>
	<table>
        <thead>
            <tr>
                <td>Visit ID</td>
                <td>Patient ID</td>
                <td>Doctor User ID</td>
                <td>Date and Time</td>
                <td>Fev1</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($doctor_visit_fev1 as $doctor_visit_fev1): ?>
            <tr>
                <td><?=$doctor_visit_fev1['visit_id']?></td>
                <td><?=$doctor_visit_fev1['patient_id']?></td>
                <td><?=$doctor_visit_fev1['doctor_user_id']?></td>
                <td><?=$doctor_visit_fev1['date_time']?></td>
                <td><?=$doctor_visit_fev1['fev1']?></td>
                
                <td class="actions">
                    <a href="doctor_visit_fev1_update.php?id=<?=$doctor_visit_fev1['visit_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="doctor_visit_fev1_delete.php?id=<?=$doctor_visit_fev1['visit_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="doctor_visit_fev1_read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_doctor_visit_fev1): ?>
		<a href="doctor_visit_fev1_read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>

</div>


<?=template_footer()?>