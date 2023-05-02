<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';

// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, //we must check if the POST variables exist if not we //can default them to blank
    $f_id = isset($_POST['f_id']) && !empty($_POST['f_id']) && $_POST['f_id'] != 'auto' ? $_POST['f_id'] : NULL;
    // Check if POST variable "name" exists, if not default //the value to blank, basically the same for all //variables
    $f_name = isset($_POST['f_name']) ? $_POST['f_name'] : '';
    $f_address = isset($_POST['f_address']) ? $_POST['f_address'] : '';
    $f_specialty = isset($_POST['f_specialty']) ? $_POST['f_specialty'] : '';
    $highest_degree = isset($_POST['highest_degree']) ? $_POST['highest_degree'] : '';
    
    // Insert new record into the professors table
    $stmt = $pdo->prepare('INSERT INTO professors (f_id, f_name, f_address, f_specialty, highest_degree) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$f_id, $f_name, $f_address, $f_specialty, $highest_degree]);
    // Output message
    $msg = 'Created Successfully!';
}

?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Create Professor</h2>
    <form action="professors_create.php" method="post">
        <label for="f_id">Facuilty ID</label>
        <input type="text" name="f_id" placeholder="A1" id="f_id">
        <label for="f_name">Name</label>
        <input type="text" name="f_name" placeholder="Aklesh Bajaj" id="f_name">
        <label for="f_address">Address</label>
        <input type="text" name="f_address" placeholder="800 S Tucker Dr, Tulsa, OK 74104" id="f_address">
        <label for="f_specialty">Specialty</label>
        <input type="text" name="f_specialty" placeholder="Information Systems" id="f_specialty">
        <label for="highest_degree">Highest Degree</label>
        <input type="text" name="highest_degree" placeholder="Ph.D" id="highest_degree">
        <input type="submit" value="Create">
		<a class="back-btn" href=".\professors_read.php">Back</a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?> 
