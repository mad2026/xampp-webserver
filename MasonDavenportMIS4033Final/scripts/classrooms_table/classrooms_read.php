<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;
// Prepare the SQL statement and get records from our classrooms table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM classrooms ORDER BY cl_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$classrooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of classrooms, this is so we can determine whether there should be a next and previous button
$num_classrooms = $pdo->query('SELECT COUNT(*) FROM classrooms')->fetchColumn();
?>
<?=template_header('Read')?>

<div class="content read">
	<h2>Read Classrooms</h2>
	<a href="classrooms_create.php" class="create-contact">Create Classroom</a>
	<table>
        <thead>
            <tr>
                <td>Room</td>
                <td>Capacity</td>
                <td>Building</td>                
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($classrooms as $classroom): ?>
            <tr>
                <td><?=$classroom['cl_id']?></td>
                <td><?=$classroom['capacity']?></td>
                <td><?=$classroom['location']?></td>
                <td class="actions">
                    <a href="classrooms_update.php?id=<?=$classroom['cl_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="classrooms_delete.php?id=<?=$classroom['cl_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="classrooms_read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_classrooms): ?>
		<a href="classrooms_read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
	<a class="back-btn" href="..\landingPage.php">Back</a>


</div>


<?=template_footer()?>
