<?php //////////FINISH CHANGING VARIABLE NAMEDS PLEASE 
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example //update.php?id=1 will get the contact with the id //of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, //but instead we update a record and not //insert
        $custId = isset($_POST['custId']) ? $_POST['id'] : NULL;
        $custName = isset($_POST['custName']) ? $_POST['custName'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE contacts SET custId = ?, custName = ?, email = ? WHERE custId = ?');
        $stmt->execute([$custId, $custName, $email, $phone, $title, $created, $_GET['custId']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE custId = ?');
    $stmt->execute([$_GET['custId']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$contact['custId']?></h2>
    <form action="contacts_update.php?id=<?=$contact['id']?>" method="post">
        <label for="custId">ID</label>
        <label for="custName">Name</label>
        <input type="text" name="custId" placeholder="1" value="<?=$contact['custId']?>" custId="custId">
        <input type="text" name="custName" placeholder="John Doe" value="<?=$contact['custName']?>" id="custName">
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="johndoe@example.com" value="<?=$contact['email']?>" id="email">
        <label for="title">Title</label>
        <label for="created">Created</label>
        <input type="text" name="title" placeholder="Employee" value="<?=$contact['title']?>" id="title">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
