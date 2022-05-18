<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['transaksi_id'])) {
    if (!empty($_POST)) {
        // This pply is similar to the create.php, but instead we update a record and not insert
        $transaksi_id = isset($_POST['transaksi_id']) ? $_POST['transaksi_id'] : NULL;
        $transaksi_id_member = isset($_POST['transaksi_id_member']) ? $_POST['transaksi_id_member'] :'';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE tb_transaksi SET transaksi_id = ?, transaksi_id_member = ? WHERE transaksi_id = ?');
        $stmt->execute([$transaksi_id, $transaksi_id_member, $_GET['transaksi_id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM tb_transaksi WHERE transaksi_id = ?');
    $stmt->execute([$_GET['transaksi_id']]);
    $tb_transaksi = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tb_transaksi) {
        exit('tb_transaksi doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specifieds!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Edit Data<?=$tb_transaksi['transaksi_id']?></h2>
    <form action="edit_transaksi.php?transaksi_id=<?=$tb_transaksi['transaksi_id']?>" method="post">
        <label for="transaksi_id">ID Transaksi</label>
        <label for="transaksi_id_member">ID Member</label>
        <input type="text" name="transaksi_id" value="<?=$tb_transaksi['transaksi_id']?>" id="transaksi_id">
        <input type="text" name="transaksi_id_member" value="<?=$tb_transaksi['transaksi_id_member']?>" id="transaksi_id_member">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>