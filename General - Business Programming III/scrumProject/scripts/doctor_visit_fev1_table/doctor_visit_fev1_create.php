<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, //we must check if the POST variables exist if not we //can default them to blank
    $visit_id = isset($_POST['visit_id']) && !empty($_POST['visit_id']) && $_POST['visit_id'] != 'auto' ? $_POST['visit_id'] : NULL;
    // Check if POST variable "name" exists, if not default //the value to blank, basically the same for all //variables
    $patient_id = isset($_POST['patient_id']) ? $_POST['patient_id'] : '';
    $doctor_user_id = isset($_POST['doctor_user_id']) ? $_POST['doctor_user_id'] : '';
    $date_time = isset($_POST['date_time']) ? $_POST['date_time'] : date('Y-m-d H:i:s');
    $fev1 = isset($_POST['fev1']) ? $_POST['fev1'] : '';
    
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO doctor_visit_fev1 VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$visit_id, $patient_id, $doctor_user_id, $date_time, $fev1]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Create Contact</h2>
    <form action="doctor_visit_fev1_create.php" method="post">
        <label for="visit_id">Visit ID</label>
        
        <input type="text" name="visit_id" placeholder="26" value="auto" id="visit_id">
        <label for="patient_id">Patient ID</label>
        <input type="text" name="patient_id" placeholder="100" id="patient_id">
        <label for="doctor_user_id">Doctor User ID</label>
        <input type="text" name="doctor_user_id" placeholder="idk" id="doctor_user_id">
        <label for="date_time">Date and Time</label>
        <input type="datetime-local" name="date_time" value="<?=date('Y-m-d\TH:i')?>" id="date_time">  
        <label for="fev1">FEV1</label>
        <input type="text" name="fev1" placeholder="fev" id="fev1">
      
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>