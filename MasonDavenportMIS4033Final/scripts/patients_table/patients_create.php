<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, //we must check if the POST variables exist if not we //can default them to blank
    $patient_id = isset($_POST['patient_id']) && !empty($_POST['patient_id']) && $_POST['patient_id'] != 'auto' ? $_POST['patient_id'] : NULL;
    // Check if POST variable "first_name" exists, if not default //the value to blank, basically the same for all //variables
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $birth_date = isset($_POST['birth_date']) ? $_POST['birth_date'] : '';
    $genetics = isset($_POST['genetics']) ? $_POST['genetics'] : '';
    $diabetes = isset($_POST['diabetes']) ? $_POST['diabetes'] : '';
    $other_conditions = isset($_POST['other_conditions']) ? $_POST['other_conditions'] : '';
    // Insert new record into the patients table
    $stmt = $pdo->prepare('INSERT INTO patient_information VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$patient_id, $first_name, $last_name, $gender, $birth_date, $genetics, $diabetes, $other_conditions]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Create Patient</h2>
    <form action="patients_create.php" method="post">
        <label for="patient_id">Patient ID</label>
		<label></label>

        <input type="text" name="patient_id" placeholder="26" value="auto" required id="patient_id">
		<label></label>

        <label for="first_name">First Name</label>
        <label for="last_name">Last Name</label>
		
        <input type="text" name="first_name" placeholder="John" required id="first_name">
        <input type="text" name="last_name" placeholder="Doe" required id="last_name">
			
        <label for="birth_date">Date of Birth</label>
        <label for="gender">Gender</label>
		
        <input type="date" name="birth_date"  required id="birth_date">
            <select name="gender" required id="gender">
                <option value="" disabled hidden selected>Specify your gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
		
        <label for="genetics">Genetics</label>
        <label for="diabetes">Diabetes</label>
		
        <input type="text" name="genetics" placeholder="Please enter relevant genetic information here" maxlength=500 id="genetics">
        <select name="diabetes" required id="diabetes">
            <option value="" disabled hidden selected>Select Yes or No</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
		
		
        <label for="other_conditions">Other Conditions</label>
		<label></label>
		
        <input type="text" name="other_conditions" placeholder="Please list any other conditions here" maxlength=500 id="other_conditions">
		
		<label></label>
        <input type="submit" value="Create">
		<a class="back-btn" href=".\patients_read.php">Back</a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>