<?php

    @include_once ('../../app_config.php');
    @include_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/functions.php');
    $pdo = pdo_connect_mysql();
    $msg = '';
    //Check if the visit id exists, for example //update.php?visit_id=1 will get the visit with the id //o  

    if (isset($_GET['visit_id'])) {
        
      
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


<?=template_header('Update Doctor Visit FEV1')?>

<div class="content update">
    <h2>Update Doctor Visit FEV1 #<?=$doctor_visit_fev1['visit_id']?></h2>         <form action="doctor_visit_fev1_update.php?visit_id=<?=$doctor_visit_fev1['visit_id']?>" method="post">




        <label for="visit_id">Visit ID</label>
        <input type="text" name="visit_id" placeholder="26" value="<?=$doctor_visit_fev1['visit_id']?>" id="visit_id">
        <label for="patient_id">Patient ID</label>
        <input type="text" name="patient_id" placeholder="100" value="<?=$doctor_visit_fev1['patient_id']?>" id="patient_id">
        <label for="doctor_user_id">Doctor User ID</label>
        <input type="text" name="doctor_user_id" placeholder="idk" value="<?=$doctor_visit_fev1['doctor_user_id']?>" id="doctor_user_id">
        <label for="date_time">Date and Time</label>
        <input type="datetime-local" name="date_time" value="<?=date('Y-m-d\TH:i', strtotime($doctor_visit_fev1['date_time']))?>" id="date_time">
        <label for="fev1">FEV1</label>
        <input type="text" name="fev1" placeholder="fev" value="<?=$doctor_visit_fev1['fev1']?>">
      
        <input type="submit" value="update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
