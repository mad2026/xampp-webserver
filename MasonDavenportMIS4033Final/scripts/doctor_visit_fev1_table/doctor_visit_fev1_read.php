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

$stmt = $pdo->prepare('SELECT dv.visit_id, pi.patient_id, pi.first_name, pi.last_name, dv.doctor_user_id, dv.date_time, dv.fev1
                        FROM doctor_visit_fev1 dv
                        JOIN patient_information pi ON dv.patient_id = pi.patient_id
                        ORDER BY dv.visit_id
                        LIMIT :current_page, :record_per_page');

$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$doctor_visit_fev1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of doctor_visit_fev1, this is so we can determine whether there should be a next and previous button
$num_doctor_visit_fev1 = $pdo->query('SELECT COUNT(*) FROM doctor_visit_fev1')->fetchColumn();


// assuming your database connection is established and stored in $conn variable

// retrieve the patient information from the database



?>
<?=template_header('Read')?>

<div class="content read">
	<h2>View All FEV1 Exams</h2>
	<a href="doctor_visit_fev1_create.php" class="create-contact">Create Doctor Visit</a>
	<table>
        <thead>
            <tr>
                <td>Visit ID</td>
                <td>Patient ID</td>
                <td>Doctor User ID</td>
                <td>Full Name</td>
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
                <td><?=$doctor_visit_fev1['first_name'].' '.$doctor_visit_fev1['last_name']?></td>
                <td><?=$doctor_visit_fev1['date_time']?></td>
                <td><?=$doctor_visit_fev1['fev1']?></td>
                <form>
  

</form>
                
                <td class="actions">
                    <a href="doctor_visit_fev1_update.php?visit_id=<?=$doctor_visit_fev1['visit_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="doctor_visit_fev1_delete.php?visit_id=<?=$doctor_visit_fev1['visit_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
           
            <?php endforeach; ?>
            
        </tbody>
         
    </table>
    <a class="back-btn" href="../landingPage.php">Back</a>
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