<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $transaksi_id = isset($_POST['transaksi_id']) && !empty($_POST['transaksi_id']) && $_POST['transaksi_id'] != 'auto' ? $_POST['transaksi_id'] : NULL;
    $transaksi_id_member = isset($_POST['transaksi_id_member']) && !empty($_POST['transaksi_id_member']) && $_POST['transaksi_id_member'] != 'auto' ? $_POST['transaksi_id_member'] : '';
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $transaksi_total = isset($_POST['transaksi_total']) ? $_POST['transaksi_total']:'';
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO tb_transaksi VALUES (?, ?, ?)');
    $stmt->execute([$transaksi_id, $transaksi_id_member, $transaksi_total]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Tambah Data</h2>
    <form action="tambah_transaksi.php" method="post">
        <label for="transaksi_id">ID Transaksi</label>
        <label for="transaksi_id_member">ID Member</label>
        <input type="text" name="transaksi_id" value="auto" id="transaksi_id">
        <input type="text" name="transaksi_id_member" value="auto" id="transaksi_id_member">
        <label for="transaksi_total">Total</label>
        <input type="text" name="transaksi_total" value="auto" id="transaksi_total">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>