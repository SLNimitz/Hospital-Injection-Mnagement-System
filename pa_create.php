<?php
include 'pa_function.php';
$pdo = pdo_connect_mysql();
$msg = '';

$id=$pa_id = $baby_name = $baby_age = $gender = $pa_address =$pa_phone_number = $taken_injection = $pa_injection_batch_no = "";

// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $pa_id = isset($_POST['pa_id']) ? $_POST['pa_id'] : '';
        $baby_name = isset($_POST['baby_name']) ? $_POST['baby_name'] : '';
        $baby_age = isset($_POST['baby_age']) ? $_POST['baby_age'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $pa_address = isset($_POST['pa_address']) ? $_POST['pa_address'] : ''; 
        $pa_phone_number = isset($_POST['pa_phone_number']) ? $_POST['pa_phone_number'] : ''; 
        $taken_injection = isset($_POST['taken_injection']) ? $_POST['taken_injection'] : ''; 
        $pa_injection_batch_no = isset($_POST['pa_injection_batch_no']) ? $_POST['pa_injection_batch_no'] : ''; 
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO patient VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $pa_id, $baby_name, $baby_age, $gender, $pa_address, $pa_phone_number, $taken_injection, $pa_injection_batch_no]);
    // Output message
    $msg = 'Created Successfully!';
}
}
?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Create New Record</h2>
    <form action="pa_create.php" method="post">
        <label for="id">Index</label>
        <label for="pa_id">ID</label>
        <input type="text" name="id" placeholder="01" id="id">
        <input type="text" name="pa_id" placeholder="980910261" id="pa_id">
        <label for="baby_name">Baby Name</label>
        <label for="baby_age">Baby Age</label>
        <input type="text" name="baby_name" placeholder="Adheesha Munasinghe" id="baby_name">
        <input type="text" name="baby_age" placeholder="05" id="baby_age">
        <label for="gender">Gender</label>
        <label for="pa_address">Paternt Address</label>
        <input type="text" name="gender" placeholder="M" id="gender">
        <input type="text" name="pa_address" placeholder="No.104/C,Nugawela,Kahawatta" id="pa_address">
        <label for="pa_phone_number">Parent Phone Number</label>
        <label for="taken_injection">Taken Injection</label>
        <input type="text" name="pa_phone_number" placeholder="0714396501" id="pa_phone_number">
        <input type="text" name="taken_injection" placeholder="pizer" id="taken_injection">
        <label for="pa_injection_batch_no">Injection Batch No.</label>
        <input type="text" name="pa_injection_batch_no" placeholder="100110" id="pa_injection_batch_no">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>