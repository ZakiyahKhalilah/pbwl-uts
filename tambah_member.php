<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $member_id = isset($_POST['member_id']) && !empty($_POST['member_id']) && $_POST['member_id'] != 'auto' ? $_POST['member_id'] :  NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $member_name = isset($_POST['member_name']) ? $_POST['member_name'] : '';
    $member_id_baju = isset($_POST['member_id_baju']) && !empty($_POST['member_id_baju']) && $_POST['member_id_baju'] != 'auto' ? $_POST['member_id_baju'] : '';
    $time = isset($_POST['time']) ? $_POST['time'] : NULL;

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO tb_member VALUES (?, ?, ?, ?)');
    $stmt->execute([$member_id, $member_name, $member_id_baju, $time]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Tambah Data</h2>
    <form action="tambah_member.php" method="post">
        <label for="member_id">ID Member</label>
        <label for="member_name">Nama Member</label>
        <input type="text" name="member_id" value="auto" id="member_id">
        <input type="text" name="member_name" id="member_name">
        <label for="member_id_baju">ID Pakaian</label>     
        <label for="time">Waktu</label>
        <input type="text" name="member_id_baju" id="member_id_baju">
        <input type="text" name="time" value="auto" id="time">
        
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>