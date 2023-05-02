<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact user_id exists, for example //update.php?user_id=1 will get the contact with the user_id //of 1
if (isset($_GET['user_id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, //but instead we update a record and not //insert
        $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : NULL;
        $job_title = isset($_POST['job_title']) ? $_POST['job_title'] : '';
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $creation_date = isset($_POST['creation_date']) ? $_POST['creation_date'] : '';
        $encrypted_password = isset($_POST['encrypted_password']) ? $_POST['encrypted_password'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE acme_user_accounts SET user_id = ?, job_title = ?, first_name = ?, last_name = ?, creation_date = ?, encrypted_password = ? WHERE user_id = ?');
        $stmt->execute([$user_id, $job_title, $first_name, $last_name, $creation_date, "NULL", $_GET['user_id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM acme_user_accounts WHERE user_id = ?');
    $stmt->execute([$_GET['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        exit('Contact doesn\'t exist with that user_id!');
    }
} else {
    exit('No user_id specified!');
}
?>
<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$user['user_id']?></h2>
    <form action="acme_user_accounts_update.php?user_id=<?=$user['user_id']?>" method="post">
        <label for="user_id">User ID</label>
        <label for="job_title">Job Title</label>
        <input type="text" name="user_id" placeholder="1" value="<?=$user['user_id']?>" user_id="user_id">
        <input type="text" name="job_title" placeholder="Analyst" value="<?=$user['job_title']?>" user_id="job_title">
        <label for="first_name">First Name</label>
        <label for="last_name">Last Name</label>
        <input type="text" name="first_name" placeholder="John" value="<?=$user['first_name']?>" user_id="first_name">
        <input type="text" name="last_name" placeholder="Doe" value="<?=$user['last_name']?>" user_id="last_name">
        <label for="creation_date">Creation Date</label>
        <input type="date" name="creation_date" placeholder="MM/DD/YYYY" value="<?=$user['creation_date']?>" user_id="creation_date">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
