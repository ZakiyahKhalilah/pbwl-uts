<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['laundry_id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $laundry_id = isset($_POST['laundry_id']) ? $_POST['laundry_id'] : NULL;
        $laundry_jenis = isset($_POST['laundry_jenis']) ? $_POST['laundry_jenis'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE tb_laundry SET laundry_id = ?, laundry_jenis = ? WHERE laundry_id = ?');
        $stmt->execute([$laundry_id, $laundry_jenis, $_GET['laundry_id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM tb_laundry WHERE laundry_id = ?');
    $stmt->execute([$_GET['laundry_id']]);
    $tb_laundry = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tb_laundry) {
        exit('tb_laundry doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specifieds!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Edit Data<?=$tb_laundry['laundry_id']?></h2>
    <form action="update_laundry.php?laundry_id=<?=$tb_laundry['laundry_id']?>" method="post">
        <label for="laundry_id">ID Laundry</label>
        <label for="laundry_jenis">Jenis Laundry</label>
        <input type="text" name="laundry_id" value="<?=$tb_laundry['laundry_id']?>" id="laundry_id">
        <input type="text" name="laundry_jenis" value="<?=$tb_laundry['laundry_jenis']?>" id="laundry_jenis">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>