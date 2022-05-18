<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['member_id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM tb_member WHERE member_id = ?');
    $stmt->execute([$_GET['member_id']]);
    $tb_member = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tb_member) {
        exit('tb_member doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM tb_member WHERE member_id = ?');
            $stmt->execute([$_GET['member_id']]);
            $msg = 'You have deleted the tb_member!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read_member.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Hapus Data<?=$tb_member['member_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete data<?=$tb_member['member_id']?>?</p>
    <div class="yesno">
        <a href="hapus_member.php?member_id=<?=$tb_member['member_id']?>&confirm=yes">Yes</a>
        <a href="hapus_member.php?member_id=<?=$tb_member['member_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>