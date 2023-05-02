<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;
// Prepare the SQL statement and get records from our patients table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM patient_information ORDER BY patient_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of patients, this is so we can determine whether there should be a next and previous button
$num_patients = $pdo->query('SELECT COUNT(*) FROM patient_information')->fetchColumn();
?>
<?=template_header('Read')?>

<div class="content read">
	<h2>Read Patients</h2>
	<a href="patients_create.php" class="create-contact">Create Patient</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Gender</td>
                <td>Birth Day</td>
                <td>Genetics</td>
                <td>Diabetes?</td>
                <td>Other Conditions</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient): ?>
            <tr>
                <td><?=$patient['patient_id']?></td>
                <td><?=$patient['first_name']?></td>
                <td><?=$patient['last_name']?></td>
                <td><?=$patient['gender']?></td>
                <td><?=$patient['birth_date']?></td>
                <td><?=$patient['genetics']?></td>
                <td><?=$patient['diabetes']?></td>
                <td><?=$patient['other_conditions']?></td>
                <td class="actions">
                    <a href="patients_update.php?patient_id=<?=$patient['patient_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="patients_delete.php?patient_id=<?=$patient['patient_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="patients_read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_patients): ?>
		<a href="patients_read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
    <a class="back-btn" href="..\landingPage.php">Back</a>
</div>

<?=template_footer()?>