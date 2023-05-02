<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';

// Retrieve all patients from the database
$stmt = $pdo->prepare('SELECT patient_id, CONCAT(first_name, " ", last_name) AS full_name FROM patient_information');
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT user_id, CONCAT(job_title, " ", first_name, " ", last_name) AS full_name FROM acme_user_accounts');
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <h2>Create New Fev 1 Exam</h2>
    <form action="doctor_visit_fev1_create.php" method="post">
        <div class="form-group">
            <label for="visit_id">Visit ID</label>
            <input type="text" name="visit_id" placeholder="26" value="auto" id="visit_id" readonly>
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

        <input type="submit" value="Create">
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