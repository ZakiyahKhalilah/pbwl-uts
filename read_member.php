<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


// Prepare the SQL statement and get records from our tb_member table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM tb_member ORDER BY member_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$tb_member = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of tb_member, this is so we can determine whether there should be a next and previous button
$num_tb_member = $pdo->query('SELECT COUNT(*) FROM tb_member')->fetchColumn();
?>


<?=template_header('Read')?>

<div class="content read">
	<h2>Tabel Member</h2>
	<a href="tambah_member.php" class="create-contact">Tambahkan</a>
	<table>
        <thead>
            <tr>
                <td>ID Member</td>
                <td>Nama Member</td>
                <td>ID Pakaian</td>
                <td>Waktu</td>

                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tb_member as $tb_member): ?>
            <tr>
                <td><?=$tb_member['member_id']?></td>
                 <td><?=$tb_member['member_name']?></td>
                <td><?=$tb_member['member_id_baju']?></td>
                <td><?=$tb_member['time']?></td>
             
                <td class="actions">
                    <a href="edit_member.php?member_id=<?=$tb_member['member_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="hapus_member.php?member_id=<?=$tb_member['member_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_tb_member): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>