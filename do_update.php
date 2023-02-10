<?php
include 'do_function.php';
$pdo = pdo_connect_mysql();
$msg = '';

$id=$do_id = $do_name = $do_address = $phone_number = $working_days = "";

// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $do_id = isset($_POST['do_id']) ? $_POST['do_id'] : '';
        $do_name = isset($_POST['do_name']) ? $_POST['do_name'] : '';
        $do_address = isset($_POST['do_address']) ? $_POST['do_address'] : '';
        $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
        $working_days = isset($_POST['working_days']) ? $_POST['working_days'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE doctor SET id = ?, do_id = ?, do_name = ?, do_address = ?, phone_number = ?, working_days = ? WHERE id = ?');
        $stmt->execute([$id, $do_id, $do_name, $do_address, $phone_number, $working_days, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM doctor WHERE id = ?');
    $stmt->execute([$_GET['id']]);
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
	<h2>Update Record #<?=$contact['id']?></h2>
    <form action="do_update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">Index</label>
        <label for="do_id">ID</label>
        <input type="text" name="id" placeholder="01" id="id">
        <input type="text" name="do_id" placeholder="980910261" id="do_id">
        <label for="do_name">Name</label>
        <label for="do_address">Address</label>
        <input type="text" name="do_name" placeholder="Adheesha Munasinghe" id="do_name">
        <input type="text" name="do_address" placeholder="NO.104/C,Nugawela,Kahawatte" id="do_address">
        <label for="phone_number">Phone number</label>
        <label for="working_days">Working Days</label>
        <input type="text" name="phone_number" placeholder="0702556977" id="phone_number">
        <input type="text" name="working_days" placeholder="sunday" id="working_days">
        <input type="submit" value="update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>