<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, //we must check if the POST variables exist if not we //can default them to blank
    $st_id = isset($_POST['st_id']) && !empty($_POST['st_id']) && $_POST['st_id'] != 'auto' ? $_POST['st_id'] : NULL;
    // Check if POST variable "name" exists, if not default //the value to blank, basically the same for all //variables
    $st_name = isset($_POST['st_name']) ? $_POST['st_name'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $st_gpa = isset($_POST['st_gpa']) ? $_POST['st_gpa'] : '';
    
    // Insert new record into the students table
    $stmt = $pdo->prepare('INSERT INTO students (st_id, st_name, gender, st_gpa ) VALUES (?, ?, ?, ?)');
    $stmt->execute([$st_id, $st_name, $gender, $st_gpa]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Create Student</h2>
    <form action="students_create.php" method="post">
        <label for="st_id">Student ID</label>
        <input type="text" name="st_id" placeholder="A1" id="st_id">
        <label for="st_name">Name</label>
        <input type="text" name="st_name" placeholder="Aklesh Bajaj" id="st_name">
        <label for="gender">Gender</label>
        <input type="text" name="gender" placeholder="M" id="gender">
        <label for="st_gpa">GPA</label>
        <input type="number" name="st_gpa" placeholder="4.0" step="0.1" min="0" max="4" id="st_gpa">
        <input type="submit" value="Create">
		<a class="back-btn" href=".\students_read.php">Back</a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?> 
