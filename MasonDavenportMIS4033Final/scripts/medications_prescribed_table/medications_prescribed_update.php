<?php

    @include_once ('../../app_config.php');
    @include_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/functions.php');
    $pdo = pdo_connect_mysql();
    $msg = '';
    //Check if the visit id exists, for example //update.php?patient_id=1 will get the visit with the id //o  

    if (isset($_GET['id'])) {      
        // Check if the form has been submitted
        if (!empty($_POST)) {
            // This part is similar to create.php, but instead, we update a record and not insert

            $patient_id = isset($_POST['patient_id']) ? $_POST['patient_id'] : NULL;
            
			$visit_id = isset($_POST['visit_id']) ? $_POST['visit_id'] : NULL;

            $medication_id = isset($_POST['medication_id']) ? $_POST['medication_id'] : NULL;
            
			$medication_type = isset($_POST['medication_type']) ? $_POST['medication_type'] : NULL;
            
			$notes_dosage = isset($_POST['notes_dosage']) ? $_POST['notes_dosage'] : NULL;			
			
            $stmt = $pdo->prepare('UPDATE medication_prescribed SET medication_type = ?, notes_dosage = ? WHERE patient_id = ? AND visit_id = ? AND medication_id = ?');
			
            $stmt->execute([$medication_type, $notes_dosage, $patient_id, $visit_id, $medication_id]);
            $msg = 'Updated Successfully!';

        }
		
        // Get the visit from the medication_prescribed table
		$id_get = explode(' ', $_GET['id']);
		$patient_id_get = $id_get[0];
		$visit_id_get = $id_get[1];
		$medication_id_get = $id_get[2];
		
		
		//exit($id_get[0]);
        $stmt = $pdo->prepare('SELECT * FROM medication_prescribed WHERE patient_id = ? AND visit_id = ? AND medication_id = ?');
		//
        $stmt->execute([$patient_id_get, $visit_id_get, $medication_id_get]);
        $medication_prescribed = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$medication_prescribed) {
            exit('Doctor Visit FEV1 doesn\'t exist with that ID!');
        }
    } else {
        exit('No ID specified!');
    }
?>


<?=template_header('Update Prescribed Medications')?>

<div class="content update">
    <h2>Update Prescribed Medications #<?=$medication_prescribed['patient_id']?></h2>     <form action="medications_prescribed_update.php?id=<?=$medication_prescribed['patient_id']?>+<?=$medication_prescribed['visit_id']?>+<?=$medication_prescribed['medication_id']?>" method="post">
	
		<label for="patient_id">Patient ID</label>   
        <input type="text" name="patient_id" id="patient_id" value="<?=$medication_prescribed['patient_id']?>" readonly>        
		
		<label for="visit_id">Visit ID</label>
        <input type="text" name="visit_id" placeholder="3" id="visit_id" value="<?=$medication_prescribed['visit_id']?>" readonly>
		
        <label for="medication_id">Medication ID</label>
        <input type="text" name="medication_id" placeholder="idk" id="medication_id" value="<?=$medication_prescribed['medication_id']?>" readonly>	
		
        <label for="medication_type">Medication Type</label>
        <input type="text" name="medication_type" placeholder="fev" id="medication_type" value="<?=$medication_prescribed['medication_type']?>">				
        <label for= "notes_dosage">Notes/Dosage</label>
        <input type="text" name="notes_dosage" placeholder="100" id="notes_dosage" value="<?=$medication_prescribed['notes_dosage']?>">
		
        <input type="submit" value="Update">
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
