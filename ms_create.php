<?php
include 'ms_function.php';
$pdo = pdo_connect_mysql();
$msg = '';

$id=$ms_id = $ms_name = $ms_address = $phone_number = $working_days = "";

// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nu_id = isset($_POST['ms_id']) ? $_POST['ms_id'] : '';
        $nu_name = isset($_POST['ms_name']) ? $_POST['ms_name'] : '';
        $nu_address = isset($_POST['ms_address']) ? $_POST['ms_address'] : '';
        $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
        $working_days = isset($_POST['working_days']) ? $_POST['working_days'] : ''; 
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO minorstaff VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $ms_id, $ms_name, $ms_address, $phone_number, $working_days]);
    // Output message
    $msg = 'Created Successfully!';
}
}
?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Create New Record</h2>
    <form action="ms_create.php" method="post">
        <label for="id">Index</label>
        <label for="ms_id">ID</label>
        <input type="text" name="id" placeholder="01" id="id">
        <input type="text" name="ms_id" placeholder="980910261" id="ms_id">
        <label for="ms_name">Name</label>
        <label for="ms_address">Address</label>
        <input type="text" name="ms_name" placeholder="Adheesha Munasinghe" id="ms_name">
        <input type="text" name="ms_address" placeholder="NO.104/C,Nugawela,Kahawatte" id="ms_address">
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