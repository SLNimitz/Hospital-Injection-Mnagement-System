<?php
include 'sm_function.php';
$pdo = pdo_connect_mysql();
$msg = '';

$id=$batch_number = $injection_index = $quantity = $injection_name = "";

// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $batch_number = isset($_POST['batch_number']) ? $_POST['batch_number'] : '';
        $injection_index = isset($_POST['injection_index']) ? $_POST['injection_index'] : '';
        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
        $injection_name = isset($_POST['injection_name']) ? $_POST['injection_name'] : '';
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO hospital_store VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $batch_number, $injection_index, $quantity, $injection_name]);
    // Output message
    $msg = 'Created Successfully!';
}
}
?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Create New Record</h2>
    <form action="sm_create.php" method="post">
        <label for="id">Index</label>
        <label for="injection_index">Injection Index</label>
        <input type="text" name="id" placeholder="01" id="id">
        <input type="text" name="injection_index" placeholder="002500" id="injection_index">
        <label for="batch_number">Batch Number</label>
        <label for="injection_name">Injection Name</label>
        <input type="text" name="batch_number" placeholder="100" id="batch_number">
        <input type="text" name="injection_name" placeholder="pizer" id="injection_name">
        <label for="quantity">Quantity</label>
        <input type="text" name="quantity" placeholder="1500" id="quantity">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>