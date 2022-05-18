<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['laundry_id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM tb_laundry WHERE laundry_id = ?');
    $stmt->execute([$_GET['laundry_id']]);
    $tb_laundry = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tb_laundry) {
        exit('tb_laundry doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM tb_laundry WHERE laundry_id = ?');
            $stmt->execute([$_GET['laundry_id']]);
            $msg = 'You have deleted the tb_laundry!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read_laundry.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Hapus Data<?=$tb_laundry['laundry_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete data<?=$tb_laundry['laundry_id']?>?</p>
    <div class="yesno">
        <a href="hapus_laundry.php?laundry_id=<?=$tb_laundry['laundry_id']?>&confirm=yes">Yes</a>
        <a href="hapus_laundry.php?laundry_id=<?=$tb_laundry['laundry_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>