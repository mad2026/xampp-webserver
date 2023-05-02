<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, //we must check if the POST variables exist if not we //can default them to blank
    $user_id = isset($_POST['user_id']) && !empty($_POST['user_id']) && $_POST['user_id'] != 'auto' ? $_POST['user_id'] : NULL;
    // Check if POST variable "name" exists, if not default //the value to blank, basically the same for all //variables
    $job_title = isset($_POST['job_title']) ? $_POST['job_title'] : '';
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $creation_date = isset($_POST['creation_date']) ? $_POST['creation_date'] : '';
    $encrypted_password = isset($_POST['encrypted_password']) ? $_POST['encrypted_password'] : '';
    // Insert new record into the customers table
    $stmt = $pdo->prepare('INSERT INTO acme_user_accounts VALUES (?, ?, ?, ?, ?, ? )');
    $stmt->execute([$user_id, $job_title, $first_name, $last_name, $creation_date, "NULL"]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Create Contact</h2>
    <form action="acme_user_accounts_create.php" method="post">
        <label for="user_id">User ID</label>
        <label for="job_title">Job Title</label>
        <input type="text" name="user_id" placeholder="26" value="auto" id="user_id">
        <input type="text" name="job_title" placeholder="Doctor, Nurse, etc." id="job_title">
        <label for="first_name">First Name</label>
        <label for="last_name">Last Name</label>
        <input type="text" name="first_name" placeholder="John" id="first_name">
        <input type="text" name="last_name" placeholder="Doe" id="last_name">
        <label for="creation_date">Creation Date</label>
        <input type="date" name="creation_date" placeholder="MM/DD/YYYY" id="creation_date">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>