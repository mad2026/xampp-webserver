<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the patient id exists, for example //update.php?id=1 will get the patient with the id //of 1
if (isset($_GET['patient_id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, //but instead we update a record and not //insert
        $patient_id = isset($_POST['patient_id']) ? $_POST['patient_id'] : NULL;
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $birth_date = isset($_POST['birth_date']) ? $_POST['birth_date'] : '';
        $genetics = isset($_POST['genetics']) ? $_POST['genetics'] : '';
        $diabetes = isset($_POST['diabetes']) ? $_POST['diabetes'] : '';
        $other_conditions = isset($_POST['other_conditions']) ? $_POST['other_conditions'] : '';
       // Update the record
        $stmt = $pdo->prepare('UPDATE patient_information SET patient_id = ?, first_name = ?, last_name = ?, gender = ?, birth_date = ?, genetics = ?, diabetes = ?, other_conditions = ? WHERE patient_id = ?');
        $stmt->execute([$patient_id, $first_name, $last_name, $gender, $birth_date, $genetics, $diabetes, $other_conditions, $_GET['patient_id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the patient from the patient_information table
    $stmt = $pdo->prepare('SELECT * FROM patient_information WHERE patient_id = ?');
    $stmt->execute([$_GET['patient_id']]);
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$patient) {
        exit('Patient doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

<div class="content update">
	<h2>Update Patient #<?=$patient['patient_id']?></h2>
    <form action="patients_update.php?patient_id=<?=$patient['patient_id']?>" method="post">
    <label for="patient_id">Patient ID</label>
        <input type="text" name="patient_id" placeholder="26" value="<?=$patient['patient_id']?>" required id="patient_id">
        <label for="first_name">First Name</label>
        <label for="last_name">Last Name</label>
        <input type="text" name="first_name" placeholder="John" value="<?=$patient['first_name']?>" required id="first_name">
        <input type="text" name="last_name" placeholder="Doe" value="<?=$patient['last_name']?>"required id="last_name">
        <label for="birth_date">Date of Birth</label>
        <input type="date" name="birth_date" value="<?=$patient['birth_date']?>" required id="birth_date">
        <label for=""></label>
        <label for=""></label>
        <label for="gender">Gender</label>
            <select name="gender" required id="gender">
                <option value='<?php echo $patient['gender']?>' hidden selected='selected'><?php echo $patient['gender']?></option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select> 
        <label for=""></label>
        <label for="genetics">Genetics</label>
        <input type="text" name="genetics" placeholder="Please enter relevant genetic information here" maxlength=500 value="<?=$patient['genetics']?>" id="genetics">
        <label for="diabetes">Diabetes</label>
        <select name="diabetes" required id="diabetes">
            <option value='<?php echo $patient['diabetes']?>' hidden selected='selected'><?php echo $patient['diabetes']?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
        <label for=""></label>
        <label for="other_conditions">Other Conditions</label>
        <input type="text" name="other_conditions" placeholder="Please list any other conditions here" maxlength=500 value="<?=$patient['other_conditions']?>" id="other_conditions">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
