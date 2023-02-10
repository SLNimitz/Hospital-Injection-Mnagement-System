<?php
include 'nu_function.php';
$pdo = pdo_connect_mysql();
$msg = '';

$id=$nu_id = $nu_name = $nu_address = $phone_number = $working_days = "";

// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nu_id = isset($_POST['nu_id']) ? $_POST['nu_id'] : '';
        $nu_name = isset($_POST['nu_name']) ? $_POST['nu_name'] : '';
        $nu_address = isset($_POST['nu_address']) ? $_POST['nu_address'] : '';
        $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
        $working_days = isset($_POST['working_days']) ? $_POST['working_days'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE nurse SET id = ?, nu_id = ?, nu_id = ?, nu_address = ?, phone_number = ?, working_days = ? WHERE id = ?');
        $stmt->execute([$id, $nu_id, $nu_name, $nu_address, $phone_number, $working_days, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM nurse WHERE id = ?');
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
    <form action="nu_update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">Index</label>
        <label for="nu_id">ID</label>
        <input type="text" name="id" placeholder="01" id="id">
        <input type="text" name="nu_id" placeholder="980910261" id="nu_id">
        <label for="nu_name">Name</label>
        <label for="nu_address">Address</label>
        <input type="text" name="nu_name" placeholder="Adheesha Munasinghe" id="nu_name">
        <input type="text" name="nu_address" placeholder="NO.104/C,Nugawela,Kahawatte" id="nu_address">
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