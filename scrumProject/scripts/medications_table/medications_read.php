<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;
// Prepare the SQL statement and get records from our medications table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM medications ORDER BY medication_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$medications = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of medications, this is so we can determine whether there should be a next and previous button
$num_medications = $pdo->query('SELECT COUNT(*) FROM medications')->fetchColumn();
?>
<?=template_header('Read')?>

<div class="content read">
	<h2>Read Medications</h2>
	<a href="medications_create.php" class="create-contact">Create Medication</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($medications as $medication): ?>
            <tr>
                <td><?=$medication['medication_id']?></td>
                <td><?=$medication['medication_name']?></td>
                <td class="actions">
                    <a href="medications_update.php?id=<?=$medication['medication_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="medications_delete.php?id=<?=$medication['medication_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="medications_read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_medications): ?>
		<a href="medications_read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
	<a class="back-btn" href="..\landingPage.php">Back</a>


</div>


<?=template_footer()?>
