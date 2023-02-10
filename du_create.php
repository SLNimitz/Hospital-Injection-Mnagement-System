<?php
include 'du_function.php';
$pdo = pdo_connect_mysql();
$msg = '';

$id=$babyname = $babyage = $gender = $inname = $injection_batch_no = $did = $nid = $mdid = $mnid = $patrent_no = $issuedate ="";

// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $babyname = isset($_POST['babyname']) ? $_POST['babyname'] : '';
        $babyage = isset($_POST['babyage']) ? $_POST['babyage'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $inname = isset($_POST['inname']) ? $_POST['inname'] : '';
        $injection_batch_no = isset($_POST['injection_batch_no']) ? $_POST['injection_batch_no'] : '';
        $did = isset($_POST['did']) ? $_POST['did'] : '';
        $nid = isset($_POST['nid']) ? $_POST['nid'] : '';
        $mdid = isset($_POST['mdid']) ? $_POST['mdid'] : '';
        $mnid = isset($_POST['mnid']) ? $_POST['mnid'] : '';
        $patrent_no = isset($_POST['patrent_no']) ? $_POST['patrent_no'] : '';
        $issuedate = isset($_POST['issuedate']) ? $_POST['issuedate'] : '';
    // Insert new record into the daily update table
    $stmt = $pdo->prepare('INSERT INTO Daily_update VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $babyname, $babyage, $gender, $inname, $injection_batch_no, $did, $nid, $mdid, $mnid, $patrent_no, $issuedate]);
    // Output message
    $msg = 'Created Successfully!';
}
}
?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Create New Record</h2>
    <form action="du_create.php" method="post">
        <label for="id">Index</label>
        <label for="babyname">Baby Name</label>
        <input type="text" name="id" placeholder="01" id="id">
        <input type="text" name="babyname" placeholder="M.H.A.Munasinghe" id="babyname">
        <label for="babyage">Baby Age</label>
        <label for="gender">Gender</label>
        <input type="text" name="babyage" placeholder="01" id="babyage">
        <input type="text" name="gender" placeholder="Male" id="gender">
        <label for="inname">Injection Name</label>
        <label for="injection_batch_no">Injection Batch No.</label>
        <input type="text" name="inname" placeholder="Pizer" id="inname">
        <input type="text" name="injection_batch_no" placeholder="100110" id="injection_batch_no">
        <label for="did">Doctor NIC</label>
        <label for="nid">Nurse NIC</label>
        <input type="text" name="did" placeholder="980910261V" id="did">
        <input type="text" name="nid" placeholder="980910261V" id="nid">
        <label for="mdid">Midewife NIC</label>
        <label for="mnid">MinorStaff NIC</label>
        <input type="text" name="mdid" placeholder="980910261V" id="mdid">
        <input type="text" name="mnid" placeholder="980910261V" id="mnid">
        <label for="patrent_no">Parent Phone No.</label>
        <label for="issuedate">Issue Date</label>
        <input type="text" name="patrent_no" placeholder="0714396501" id="patrent_no">
        <input type="text" name="issuedate" placeholder="2022-01-16 " id="issuedate">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>