<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


// Prepare the SQL statement and get records from our tb_transaksi table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM tb_transaksi ORDER BY transaksi_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$tb_transaksi = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of tb_transaksi, this is so we can determine whether there should be a next and previous button
$num_tb_transaksi = $pdo->query('SELECT COUNT(*) FROM tb_transaksi')->fetchColumn();
?>


<?=template_header('Read')?>

<div class="content read">
	<h2>Tabel Transaksi</h2>
	<a href="tambah_transaksi.php" class="create-contact">Tambahkan</a>
	<table>
        <thead>
            <tr>
                <td>ID Transaksi</td>
                <td>ID Member</td>
                <td>Total</td>

                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tb_transaksi as $tb_transaksi): ?>
            <tr>
                <td><?=$tb_transaksi['transaksi_id']?></td>
                 <td><?=$tb_transaksi['transaksi_id_member']?></td>
                <td><?=$tb_transaksi['transaksi_total']?></td>
             
                <td class="actions">
                    <a href="edit_transaksi.php?transaksi_id=<?=$tb_transaksi['transaksi_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="hapus_transaksi.php?transaksi_id=<?=$tb_transaksi['transaksi_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_tb_transaksi): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>