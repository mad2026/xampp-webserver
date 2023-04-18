<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the medication id exists, for example //update.php?id=1 will get the medication with the id //of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, //but instead we update a record and not //insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE medications SET medication_name = ? WHERE medication_id = ?');
        $stmt->execute([$name, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the medication from the medications table
    $stmt = $pdo->prepare('SELECT * FROM medications WHERE medication_id = ?');
    $stmt->execute([$_GET['id']]);
    $medication = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$medication) {
        exit('Medication doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

<div class="content update">
	<h2>Update Medication #<?=$medication['medication_id']?></h2>
    <form action="medications_update.php?id=<?=$medication['medication_id']?>" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="1" value="<?=$medication['medication_id']?>" id="id" readonly>
        <input type="text" name="name" placeholder="Medication name" value="<?=$medication['medication_name']?>" id="name">
        <input type="submit" value="Update">
		<a class="back-btn" href=".\medications_read.php">Back</a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>


<?=template_footer()?>
