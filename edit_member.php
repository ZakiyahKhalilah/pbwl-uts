<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['member_id'])) {
    if (!empty($_POST)) {
        // This ptrc is similar to the create.php, but instead we update a record and not insert
        $member_id = isset($_POST['member_id']) ? $_POST['member_id'] : NULL;
        $member_name = isset($_POST['member_name']) ? $_POST['member_name'] : '';
        $member_id_baju = isset($_POST['member_id_baju']) ? $_POST['member_id_baju'] : '';
        $time = isset($_POST['time']) ? $_POST['time'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE tb_member SET member_id = ?, member_name = ? WHERE member_id = ?');
        $stmt->execute([$member_id, $member_name, $_GET['member_id']]);
        $msg = 'Updated Successfully!';

    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM tb_member WHERE member_id = ?');
    $stmt->execute([$_GET['member_id']]);
    $tb_member = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$tb_member) {
        exit('tb_member doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Edit Data<?=$tb_member['member_id']?></h2>
    <form action="edit_member.php?member_id=<?=$tb_member['member_id']?>" method="post">
        <label for="member_id">ID</label>
        <label for="member_name">Nama Member</label>
        <input type="text" name="member_id" value="<?=$tb_member['member_id']?>" id="member_id">
        <input type="text" name="member_name" value="<?=$tb_member['member_name']?>" id="member_name">
        
        <label for="member_id_baju">ID Pakaian</label>
        <label for="time">Waktu</label>
        <input type="text" name="member_id_baju" value="<?=$tb_member['member_id_baju']?>" id="member_id_baju">
        <input type="text" name="time" value="<?=$tb_member['time']?>" id="time">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>