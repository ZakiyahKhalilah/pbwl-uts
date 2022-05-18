<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['baju_id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM tb_baju WHERE baju_id = ?');
    $stmt->execute([$_GET['baju_id']]);
    $tb_baju = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tb_baju) {
        exit('tb_baju doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM tb_baju WHERE baju_id = ?');
            $stmt->execute([$_GET['baju_id']]);
            $msg = 'You have deleted the tb_artis!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read_baju.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
    <h2>Hapus Data<?=$tb_baju['baju_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <p>Are you sure you want to delete data<?=$tb_baju['baju_id']?>?</p>
    <div class="yesno">
        <a href="hapus_baju.php?baju_id=<?=$tb_baju['baju_id']?>&confirm=yes">Yes</a>
        <a href="hapus_baju.php?baju_id=<?=$tb_baju['baju_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>