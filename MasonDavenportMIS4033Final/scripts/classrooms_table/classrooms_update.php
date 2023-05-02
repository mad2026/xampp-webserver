<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the classroom id exists, for example //update.php?id=1 will get the classroom with the id //of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, //but instead we update a record and not //insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $capacity = isset($_POST['capacity']) ? $_POST['capacity'] : '';
        $location = isset($_POST['location']) ? $_POST['location'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE classrooms SET capacity = ?, location = ? WHERE cl_id = ?');
        $stmt->execute([ $capacity, $location, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the classroom from the classrooms table
    $stmt = $pdo->prepare('SELECT * FROM classrooms WHERE cl_id = ?');
    $stmt->execute([$_GET['id']]);
    $classroom = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$classroom) {
        exit('Classroom doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

<div class="content update">
	<h2>Update Classroom #<?=$classroom['cl_id']?></h2>
    <form action="classrooms_update.php?id=<?=$classroom['cl_id']?>" method="post">
        <label for="cl_id">Room</label>
        <input type="text" name="cl_id" placeholder="HELM000" value="<?=$classroom['cl_id']?>" id="cl_id" readonly>
        <label for="capacity">Capacity</label>
        <input type="text" name="capacity" placeholder="30" value="<?=$classroom['capacity']?>" id="name">
        <label for="location">Building</label>
        <input type="text" name="location" placeholder="Helmrich" value="<?=$classroom['location']?>" id="name">
        <input type="submit" value="Update">
		<a class="back-btn" href=".\classrooms_read.php">Back</a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>


<?=template_footer()?>
