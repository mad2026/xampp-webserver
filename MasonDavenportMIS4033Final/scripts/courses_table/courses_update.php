<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the course id exists, for example //update.php?id=1 will get the course with the id //of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, //but instead we update a record and not //insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $c_name = isset($_POST['c_name']) ? $_POST['c_name'] : '';
        $num_credits = isset($_POST['num_credits']) ? $_POST['num_credits'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE courses SET c_name = ?, num_credits = ? WHERE c_id = ?');
        $stmt->execute([ $c_name, $num_credits, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the course from the courses table
    $stmt = $pdo->prepare('SELECT * FROM courses WHERE c_id = ?');
    $stmt->execute([$_GET['id']]);
    $course = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$course) {
        exit('Course doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

<div class="content update">
	<h2>Update Course #<?=$course['c_id']?></h2>
    <form action="courses_update.php?id=<?=$course['c_id']?>" method="post">
        <label for="c_id">Class Code</label>
        <input type="text" name="c_id" placeholder="CIS4033" value="<?=$course['c_id']?>" id="c_id" readonly>
        <label for="c_name">Course Name</label>
        <input type="text" name="c_name" placeholder="Bus Program Concept III" value="<?=$course['c_name']?>" id="name">
        <label for="num_credits">Number of Credits</label>
        <input type="text" name="num_credits" placeholder="3" value="<?=$course['num_credits']?>" id="name">
        <input type="submit" value="Update">
		<a class="back-btn" href=".\courses_read.php">Back</a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>


<?=template_footer()?>
