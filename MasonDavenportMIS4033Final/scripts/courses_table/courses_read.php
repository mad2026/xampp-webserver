<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;
// Prepare the SQL statement and get records from our courses table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM courses ORDER BY c_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of courses, this is so we can determine whether there should be a next and previous button
$num_courses = $pdo->query('SELECT COUNT(*) FROM courses')->fetchColumn();
?>
<?=template_header('Read')?>

<div class="content read">
	<h2>Read Courses</h2>
	<a href="courses_create.php" class="create-contact">Create Course</a>
	<table>
        <thead>
            <tr>
                <td>Class Code</td>
                <td>Course Name</td>
                <td>Number of Credits</td>                
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $course): ?>
            <tr>
                <td><?=$course['c_id']?></td>
                <td><?=$course['c_name']?></td>
                <td><?=$course['num_credits']?></td>
                <td class="actions">
                    <a href="courses_update.php?id=<?=$course['c_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="courses_delete.php?id=<?=$course['c_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="courses_read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_courses): ?>
		<a href="courses_read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
	<a class="back-btn" href="..\landingPage.php">Back</a>


</div>


<?=template_footer()?>
