<?php
include 'du_function.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 20;

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM Daily_update ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM Daily_update')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Current Records</h2>
	<a href="du_create.php" class="create-contact">Add New Record</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Baby Name</td>
                <td>Baby Age</td>
                <td>Gender</td>
                <td>Injection Name</td>
                <td>Batch Number</td>
                <td>Doctor NIC</td>
                <td>Nurse NIC</td>
                <td>Midewife NIC</td>
                <td>MinorStaff NIC</td>
                <td>Parent Phone No.</td>
                <td>Issuing Date</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['id']?></td>
                <td><?=$contact['babyname']?></td>
                <td><?=$contact['babyage']?></td>
                <td><?=$contact['gender']?></td>
                <td><?=$contact['inname']?></td>
                <td><?=$contact['injection_batch_no']?></td>
                <td><?=$contact['did']?></td>
                <td><?=$contact['nid']?></td>
                <td><?=$contact['mdid']?></td>
                <td><?=$contact['mnid']?></td>
                <td><?=$contact['patrent_no']?></td>
                <td><?=$contact['issuedate']?></td>
                <td></td>
                <td class="actions">
                    <a href="du_update.php?id=<?=$contact['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="du_delete.php?id=<?=$contact['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="du_read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_contacts): ?>
		<a href="du_read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>