<?php
@include_once ('../../app_config.php');
@include_once (APP_ROOT.APP_FOLDER_NAME . '/scripts/functions.php');
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
//ternery operator
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;
// Prepare the SQL statement and get records from our customers table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM acme_user_accounts ORDER BY user_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of acme_user_accounts, this is so we can determine whether there should be a next and previous button
$num_users = $pdo->query('SELECT COUNT(*) FROM acme_user_accounts')->fetchColumn();
?>
<?=template_header('Read')?>

<div class="content read">
	<h2>Read Users</h2>
	<a href="acme_user_accounts_create.php" class="create-contact">Create Users</a>
	<table>
        <thead>
            <tr>
                <td>User ID</td>
                <td>Job Title</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Creation Date</td>
                <td>Update/Delete</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?=$user['user_id']?></td>
                <td><?=$user['job_title']?></td>
                <td><?=$user['first_name']?></td>
                <td><?=$user['last_name']?></td>
                <td><?=$user['creation_date']?></td>
                <td class="actions">
                    <a href="acme_user_accounts_update.php?user_id=<?=$user['user_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="acme_user_accounts_delete.php?user_id=<?=$user['user_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="acme_user_accounts_read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_users): ?>
		<a href="acme_user_accounts_read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
    <a class="back-btn" href="..\landingPage.php">Back</a>
</div>

<?=template_footer()?>