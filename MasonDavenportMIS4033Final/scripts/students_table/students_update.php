<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the student id exists, for example //update.php?id=1 will get the student with the id //of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, //but instead we update a record and not //insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $st_name = isset($_POST['st_name']) ? $_POST['st_name'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $st_gpa = isset($_POST['st_gpa']) ? $_POST['st_gpa'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE students SET st_name = ?, gender = ?, st_gpa = ? WHERE st_id = ?');
        $stmt->execute([ $st_name, $gender, $st_gpa, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the student from the students table
    $stmt = $pdo->prepare('SELECT * FROM students WHERE st_id = ?');
    $stmt->execute([$_GET['id']]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$student) {
        exit('Student doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}

?>
<?=template_header('Read')?>
<div class="content update">
	<h2>Update Student #<?=$student['st_id']?></h2>
    <form action="students_update.php?id=<?=$student['st_id']?>" method="post">
        <label for="st_id">Student ID</label>
        <input type="text" name="st_id" placeholder="A1" value="<?=$student['st_id']?>" id="st_id" readonly>
        <label for="st_name">Name</label>
        <input type="text" name="st_name" placeholder="Aklesh Bajaj" value="<?=$student['st_name']?>" id="name">
        <label for="gender">Gender</label>
        <input type="text" name="gender" placeholder="M" value="<?=$student['gender']?>" id="name">
        <label for="st_gpa">GPA</label>
        <input type="number" name="st_gpa" placeholder="4.0" step="0.1" min="0" max="4" value="<?=$student['st_gpa']?>" id="st_gpa">
        <input type="submit" value="Update">
		<a class="back-btn" href=".\students_read.php">Back</a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>


<?=template_footer()?>
