<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $laundry_id = isset($_POST['laundry_id']) && !empty($_POST['laundry_id']) && $_POST['laundry_id'] != 'auto' ? $_POST['laundry_id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $laundry_jenis = isset($_POST['laundry_jenis']) ? $_POST['laundry_jenis'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO tb_laundry VALUES (?, ?)');
    $stmt->execute([$laundry_id, $laundry_jenis]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Tambah Data</h2>
    <form action="tambah_laundry.php" method="post">
        <label for="laundry_id">ID Lundry</label>
        <label for="laundry_jenis">Jenis Laundry</label>
        <input type="text" name="laundry_id" value="auto" id="laundry_id">
        <input type="text" name="laundry_jenis" id="laundry_jenis">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>