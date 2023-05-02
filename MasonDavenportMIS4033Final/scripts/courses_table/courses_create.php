<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, //we must check if the POST variables exist if not we //can default them to blank
    $c_id = isset($_POST['c_id']) && !empty($_POST['c_id']) && $_POST['c_id'] != 'auto' ? $_POST['c_id'] : NULL;
    // Check if POST variable "name" exists, if not default //the value to blank, basically the same for all //variables
    $c_name = isset($_POST['c_name']) ? $_POST['c_name'] : '';
    $num_credits = isset($_POST['num_credits']) ? $_POST['num_credits'] : '';

    // Insert new record into the courses table
    $stmt = $pdo->prepare('INSERT INTO courses (c_id, c_name, num_credits) VALUES (?, ?, ?)');
    $stmt->execute([$c_id, $c_name, $num_credits]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Create Course</h2>
    <form action="courses_create.php" method="post">
        <label for="c_id">Class Code</label>
        <input type="text" name="c_id" placeholder="CIS4033" id="c_id">
        <label for="c_name">Course Name</label>
        <input type="text" name="c_name" placeholder="Bus Program Concept III" id="c_name">
        <label for="num_credits">Number of Credits</label>
        <input type="text" name="num_credits" placeholder="3" id="num_credits">
        <input type="submit" value="Create">
		<a class="back-btn" href=".\courses_read.php">Back</a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?> 
