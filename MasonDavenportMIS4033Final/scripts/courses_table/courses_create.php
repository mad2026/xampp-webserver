<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, //we must check if the POST variables exist if not we //can default them to blank
    $cl_id = isset($_POST['cl_id']) && !empty($_POST['cl_id']) && $_POST['cl_id'] != 'auto' ? $_POST['cl_id'] : NULL;
    // Check if POST variable "name" exists, if not default //the value to blank, basically the same for all //variables
    $capacity = isset($_POST['capacity']) ? $_POST['capacity'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';

    // Insert new record into the classrooms table
    $stmt = $pdo->prepare('INSERT INTO classrooms (cl_id, capacity, location) VALUES (?, ?, ?)');
    $stmt->execute([$cl_id, $capacity, $location]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Create Classroom</h2>
    <form action="classrooms_create.php" method="post">
        <label for="cl_id">Room</label>
        <input type="text" name="cl_id" placeholder="HELM000" id="cl_id">
        <label for="capacity">Capacity</label>
        <input type="number" name="capacity" placeholder="30" id="capacity">
        <label for="location">Building</label>
        <input type="text" name="location" placeholder="Helmrich" id="location">
        <input type="submit" value="Create">
		<a class="back-btn" href=".\classrooms_read.php">Back</a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?> 
