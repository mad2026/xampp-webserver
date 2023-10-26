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
$stmt = $pdo->prepare('SELECT * FROM sections ORDER BY s_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$sections = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of doctor_visit_fev1, this is so we can determine whether there should be a next and previous button
$num_sections = $pdo->query('SELECT COUNT(*) FROM sections')->fetchColumn();
        
    ?>
    <?=template_header('Read')?>

<div class      ="content read">
        <h2>Course Sections</h2>
        <a href="sections_create.php" class="create-contact">Create a Section</a>
        <table>
        <thead>
                    <tr>
                            <td>Course ID</td>
                    <td>Section ID</td>	
                    <td>Time of Class</td>
                     <td>Days of Week</td>
                    <td>Date Began</td>
                    <td>Date Ended</td>
                    <td>Classroom ID</td>
                        <td></td>
                    </tr>
               </thead>
            <tbody>
               <?php foreach ($sections as $sections): ?>
                <tr>

                <td><?=$sections['c_id']?></td>	
			        	<td><?=$sections['s_id']?></td>					
                <td><?=$sections['time_held']?></td>            
                         <td><?=$sections['week_days_held']?></td>
                <td><?=$sections['date_began']?></td>
                 <td><?=$sections['date_ended']?></td>
                <td><?=$sections['cl_id']?></td>
                
                <td class="actions">
                         <a href="sections_update.php?id=<?=$sections['s_id']?>+<?=$sections['c_id']?>+<?=$sections['cl_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
					
                    <a href="sections_delete.php?s_id=<?=$sections['s_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
			<a href="sections_read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_sections): ?>
			<a href="sections_read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>	
    <a class="back-btn" href="../landingPage.php">Back</a>


</div>


<?=template_footer()?>