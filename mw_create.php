<?php
include 'mw_function.php';
$pdo = pdo_connect_mysql();
$msg = '';

$id=$mw_id = $mw_name = $mw_address = $phone_number = $working_days = "";

// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nu_id = isset($_POST['mw_id']) ? $_POST['mw_id'] : '';
        $nu_name = isset($_POST['mw_name']) ? $_POST['mw_name'] : '';
        $nu_address = isset($_POST['mw_address']) ? $_POST['mw_address'] : '';
        $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
        $working_days = isset($_POST['working_days']) ? $_POST['working_days'] : ''; 
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO midwife VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $mw_id, $mw_name, $mw_address, $phone_number, $working_days]);
    // Output message
    $msg = 'Created Successfully!';
}
}
?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Create New Record</h2>
    <form action="mw_create.php" method="post">
        <label for="id">Index</label>
        <label for="mw_id">ID</label>
        <input type="text" name="id" placeholder="01" id="id">
        <input type="text" name="mw_id" placeholder="980910261" id="mw_id">
        <label for="mw_name">Name</label>
        <label for="mw_address">Address</label>
        <input type="text" name="mw_name" placeholder="Adheesha Munasinghe" id="mw_name">
        <input type="text" name="mw_address" placeholder="NO.104/C,Nugawela,Kahawatte" id="mw_address">
        <label for="phone_number">Phone number</label>
        <label for="working_days">Working Days</label>
        <input type="text" name="phone_number" placeholder="0702556977" id="phone_number">
        <input type="text" name="working_days" placeholder="sunday" id="working_days">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>