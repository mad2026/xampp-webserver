<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();


$msg = '';
// Check if POST data is not empty

$stmt = $pdo->prepare('SELECT c_id, c_name AS c_name FROM courses');
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT cl_id FROM classrooms');
$stmt->execute();
$classrooms = $stmt->fetchAll(PDO::FETCH_ASSOC);




if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, //we must check if the POST variables exist if not we //can default them to blank
    // Check if POST variable "name" exists, if not default //the value to blank, basically the same for all //variables
    /* 	print($_POST['patient_id']);
	print($_POST['visit_id']);
	print($_POST['medication_id']);
	print($_POST['medication_type']);
	exit($_POST['notes_dosage']); */
	
    /*
                      `c_id` varchar(8) NOT NULL,
                      `s_id` varchar(11) NOT NULL,
                      `time_held` time DEFAULT NULL,
                      `week_days_held` varchar(6) DEFAULT NULL,
                      `date_began` date DEFAULT NULL,
                      `date_ended` date DEFAULT NULL,
                      `cl_id` varchar(10) DEFAULT NULL,
                    */
    $c_id = isset($_POST['c_id']) ? $_POST['c_id'] : NULL;
    $s_id = isset($_POST['s_id']) ? $_POST['s_id'] : NULL;	
    $time_held = isset($_POST['time_held']) ? $_POST['time_held'] : NULL;
    $week_days_held = isset($_POST['week_days_held']) ? $_POST['week_days_held'] : NULL;
    $date_began = isset($_POST['date_began']) ? $_POST['date_began'] : NULL;
    $date_ended = isset($_POST['date_ended']) ? $_POST['date_ended'] : NULL;
    $cl_id = isset($_POST['cl_id']) ? $_POST['cl_id'] : NULL;
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO sections VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$c_id, $s_id, $time_held, $week_days_held, $date_began, $date_ended, $cl_id]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>
    
<div class="content update">
	<h2>Create Section</h2>
    <form action="sections_create.php" method="post">
        
		<div class="form-group">
			<label for="patient_id">Patient Name</label>
            <select name="patient_id" id="patient_id">
                <?php foreach ($patients as $patient): ?>
                <option value="<?=$patient['patient_id']?>"><?=$patient['full_name']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
		<div class="form-group">
			<label for="visit_id">Visit ID</label>
			<select name="visit_id" id="visit_id">
					<?php foreach ($visits as $visit): ?>
					<option value="<?=$visit['visit_id']?>"><?=$visit['visit_id']?></option>
					<?php endforeach; ?>
			</select>
        </div>
		
        <div class="form-group">
        <label for="medication_id">Medication Name</label>
            <select name="medication_id" id="medication_id">
                <?php foreach ($medications as $medication): ?>
                <option value="<?=$medication['medication_id']?>"><?=$medication['medication_name']?></option>
                <?php endforeach; ?>
            </select>
        </div>
		   
		<div class="form-group">
        <label for="medication_type">Medication Type</label>
        <input type="text" name="medication_type" placeholder="fev" id="medication_type">
        </div>

        <div class="form-group">
        <label for= "notes_dosage">Notes Dosage</label>
        <input type="text" name="notes_dosage" placeholder="100" id="notes_dosage">
        </div>    
		

        
        <input type="submit" value="Create">
         <a class="back-btn" href=".\sections_read.php">Back</a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
<style>
.form-group {
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-bottom: 1rem;
}

.form-group label {
    width: 25%;
    text-align: right;
    margin-right: 1rem;
}
</style>
<?=template_footer()?>