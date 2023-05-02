<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the professor id exists, for example //update.php?id=1 will get the professor with the id //of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, //but instead we update a record and not //insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $f_name = isset($_POST['f_name']) ? $_POST['f_name'] : '';
        $f_address = isset($_POST['f_address']) ? $_POST['f_address'] : '';
        $f_specialty = isset($_POST['f_specialty']) ? $_POST['f_specialty'] : '';
        $highest_degree = isset($_POST['highest_degree']) ? $_POST['highest_degree'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE professors SET f_name = ?, f_address = ?, f_specialty = ?, highest_degree = ? WHERE f_id = ?');
        $stmt->execute([ $f_name, $f_address, $f_specialty, $highest_degree, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the professor from the professors table
    $stmt = $pdo->prepare('SELECT * FROM professors WHERE f_id = ?');
    $stmt->execute([$_GET['id']]);
    $professor = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$professor) {
        exit('Professor doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}

?>
<?=template_header('Read')?>
<div class="content update">
	<h2>Update Professor #<?=$professor['f_id']?></h2>
    <form action="professors_update.php?id=<?=$professor['f_id']?>" method="post">
        <label for="f_id">Facuilty ID</label>
        <input type="text" name="f_id" placeholder="A1" value="<?=$professor['f_id']?>" id="f_id" readonly>
        <label for="f_name">Name</label>
        <input type="text" name="f_name" placeholder="Aklesh Bajaj" value="<?=$professor['f_name']?>" id="name">
        <label for="f_address">Address</label>
        <input type="text" name="f_address" placeholder="800 S Tucker Dr, Tulsa, OK 74104" value="<?=$professor['f_address']?>" id="name">
        <label for="f_specialty">Specialty</label>
        <input type="text" name="f_specialty" placeholder="Information Systems" value="<?=$professor['f_specialty']?>" id="f_specialty">
        <label for="highest_degree">Highest Degree</label>
        <input type="text" name="highest_degree" placeholder="Ph.D" value="<?=$professor['highest_degree']?>" id="highest_degree">
        <input type="submit" value="Update">
		<a class="back-btn" href=".\professors_read.php">Back</a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>


<?=template_footer()?>
