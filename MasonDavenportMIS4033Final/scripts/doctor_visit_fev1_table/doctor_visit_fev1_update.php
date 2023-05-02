<?php

    @include_once ('../../app_config.php');
    @include_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/functions.php');
    $pdo = pdo_connect_mysql();
    $msg = '';
    //Check if the visit id exists, for example //update.php?visit_id=1 will get the visit with the id //o  

    if (isset($_GET['visit_id'])) {
        $stmt = $pdo->prepare('SELECT patient_id, CONCAT(first_name, " ", last_name) AS full_name FROM patient_information');
        $stmt->execute();
        $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $stmt = $pdo->prepare('SELECT user_id, CONCAT(job_title, " ", first_name, " ", last_name) AS full_name FROM acme_user_accounts');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
        // Check if the form has been submitted
        if (!empty($_POST)) {
            // This part is similar to create.php, but instead, we update a record and not insert
            $visit_id = isset($_POST['visit_id']) ? $_POST['visit_id'] : NULL;
            $patient_id = isset($_POST['patient_id']) ? $_POST['patient_id'] : '';
            $doctor_user_id = isset($_POST['doctor_user_id']) ? $_POST['doctor_user_id'] : '';
            $date_time = isset($_POST['date_time']) ? $_POST['date_time'] : date('Y-m-d H:i:s');
            $fev1 = isset($_POST['fev1']) ? $_POST['fev1'] : '';
            // Update the record
            $stmt = $pdo->prepare('UPDATE doctor_visit_fev1 SET visit_id = ?, patient_id = ?, doctor_user_id = ?, date_time = ?, fev1 = ? WHERE visit_id = ?');
            $stmt->execute([$visit_id, $patient_id, $doctor_user_id, $date_time, $fev1, $_GET['visit_id']]);
            $msg = 'Updated Successfully!';
        }
        // Get the visit from the doctor_visit_fev1 table
        $stmt = $pdo->prepare('SELECT * FROM doctor_visit_fev1 WHERE visit_id = ?');
        $stmt->execute([$_GET['visit_id']]);
        $doctor_visit_fev1 = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$doctor_visit_fev1) {
            exit('Doctor Visit FEV1 doesn\'t exist with that ID!');
        }
    } else {
        exit('No ID specified!');
    }
?>

<?=template_header('Create')?>

<div class="content update">
    <h2>Update Fev1 Exam <?=$doctor_visit_fev1['visit_id']?> </h2>
    <form action="doctor_visit_fev1_update.php?visit_id=<?=$doctor_visit_fev1['visit_id']?>" method="post">
        <div class="form-group">
            <label for="visit_id">Visit ID</label>
            <input type="text" name="visit_id" placeholder="26" value="<?=$doctor_visit_fev1['visit_id']?>" id="visit_id" readonly>
        </div>

        <div class="form-group">
            <label for="patient_id">Patient Name</label>
            <select name="patient_id" id="patient_id">
                <?php foreach ($patients as $patient): ?>
                <option value="<?=$patient['patient_id']?>"><?=$patient['full_name']?></option>
                <?php endforeach; ?>
            </select>
        </div>

      <div class="form-group">
            <label for="doctor_user_id">Doctor User ID</label>
            <select name="doctor_user_id" id="doctor_user_id">
             <?php foreach ($users as $user): ?>
                <option value="<?=$user['user_id']?>"><?=$user['full_name']?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="date_time">Date and Time</label>
            <input type="datetime-local" name="date_time" value="<?=date('Y-m-d\TH:i')?>" id="date_time">
        </div>

        <div class="form-group">
            <label for="fev1">FEV1</label>
            <input type="text" name="fev1" placeholder="fev" id="fev1">
        </div>

        <input type="submit" value="Update">
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