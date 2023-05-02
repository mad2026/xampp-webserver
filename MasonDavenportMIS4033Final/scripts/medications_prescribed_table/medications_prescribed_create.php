<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty

$stmt = $pdo->prepare('SELECT patient_id, CONCAT(first_name, " ", last_name) AS full_name FROM patient_information');
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT visit_id FROM doctor_visit_fev1');
$stmt->execute();
$visits = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT medication_id, medication_name FROM medications');
$stmt->execute();
$medications = $stmt->fetchAll(PDO::FETCH_ASSOC);



if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, //we must check if the POST variables exist if not we //can default them to blank
    // Check if POST variable "name" exists, if not default //the value to blank, basically the same for all //variables
/* 	print($_POST['patient_id']);
	print($_POST['visit_id']);
	print($_POST['medication_id']);
	print($_POST['medication_type']);
	exit($_POST['notes_dosage']); */
	
    $patient_id = isset($_POST['patient_id']) ? $_POST['patient_id'] : NULL;
    $visit_id = isset($_POST['visit_id']) ? $_POST['visit_id'] : NULL;	
    $medication_id = isset($_POST['medication_id']) ? $_POST['medication_id'] : NULL;
    $medication_type = isset($_POST['medication_type']) ? $_POST['medication_type'] : NULL;
    $notes_dosage = isset($_POST['notes_dosage']) ? $_POST['notes_dosage'] : NULL;
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO medication_prescribed VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$patient_id, $visit_id, $medication_id, $medication_type, $notes_dosage]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>
    
<div class="content update">
	<h2>Create Contact</h2>
    <form action="medications_prescribed_create.php" method="post">
        
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
         <a class="back-btn" href=".\medications_prescribed_read.php">Back</a>
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