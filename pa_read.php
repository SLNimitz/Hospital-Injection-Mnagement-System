<?php
include 'pa_function.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 20;

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM patient ORDER BY pa_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM patient')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Current Records</h2>
	<a href="pa_create.php" class="create-contact">Add New Record</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>ID</td>
                <td>Baby Name</td>
                <td>Baby Age</td>
                <td>Gender</td>
                <td>Parent Address</td>
                <td>Parent Phone Number</td>
                <td>Taken Injection</td>
                <td>Batch No.</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['id']?></td>
                <td><?=$contact['pa_id']?></td>
                <td><?=$contact['baby_name']?></td>
                <td><?=$contact['baby_age']?></td>
                <td><?=$contact['gender']?></td>
                <td><?=$contact['pa_address']?></td>
                <td><?=$contact['pa_phone_number']?></td>
                <td><?=$contact['taken_injection']?></td>
                <td><?=$contact['pa_injection_batch_no']?></td>
                <td class="actions">
                    <a href="pa_update.php?id=<?=$contact['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="pa_delete.php?id=<?=$contact['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="pa_read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_contacts): ?>
		<a href="pa_read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>