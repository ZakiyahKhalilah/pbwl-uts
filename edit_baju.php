<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['baju_id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $baju_id = isset($_POST['baju_id']) ? $_POST['baju_id'] : NULL;
        $baju_berat = isset($_POST['baju_berat']) ? $_POST['baju_berat'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE tb_baju SET baju_id = ?, baju_berat = ? WHERE baju_id = ?');
        $stmt->execute([$baju_id, $baju_berat, $_GET['baju_id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM tb_baju WHERE baju_id = ?');
    $stmt->execute([$_GET['baju_id']]);
    $tb_baju = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tb_baju) {
        exit('tb_baju doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specifieds!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Edit Data<?=$tb_baju['baju_id']?></h2>
    <form action="edit_baju.php?baju_id=<?=$tb_baju['baju_id']?>" method="post">
        <label for="baju_id">ID Pakaian</label>
        <label for="baju_berat">Berat Pakaian</label>
        <input type="text" name="baju_id" value="<?=$tb_baju['baju_id']?>" id="baju_id">
        <input type="text" name="baju_berat" value="<?=$tb_baju['baju_berat']?>" id="baju_berat">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>