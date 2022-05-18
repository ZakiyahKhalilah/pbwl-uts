<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $baju_id = isset($_POST['baju_id']) && !empty($_POST['baju_id']) && $_POST['baju_id'] != 'auto' ? $_POST['baju_id'] : NULL;
    $baju_id_laundry = isset($_POST['baju_id_laundry']) && !empty($_POST['baju_id_laundry']) && $_POST['baju_id_laundry'] != 'auto' ? $_POST['baju_id_laundry_id'] : '';
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $baju_berat = isset($_POST['baju_berat']) ? $_POST['baju_berat'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO tb_baju VALUES (?, ?, ?)');
    $stmt->execute([$baju_id, $baju_id_laundry, $baju_berat]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Tambah Data</h2>
    <form action="Tambah_baju.php" method="post">
        <label for="baju_id">ID Pakaian</label>
        <label for="baju_id_laundry">ID Laundry</label>
        <input type="text" name="baju_id" value="auto" id="baju_id">
        <input type="text" name="baju_id_laundry" value="auto" id="baju_id_laundry">
        <label for="baju_berat">Berat Pakaian</label>
        <input type="text" name="baju_berat" id="baju_berat">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>