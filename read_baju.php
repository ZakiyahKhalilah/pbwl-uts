<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


// Prepare the SQL statement and get records from our tb_baju table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM tb_baju ORDER BY baju_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$tb_baju = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of tb_baju, this is so we can determine whether there should be a next and previous button
$num_tb_baju = $pdo->query('SELECT COUNT(*) FROM tb_baju')->fetchColumn();
?>


<?=template_header('Read')?>

<div class="content read">
	<h2>Tabel Pakaian</h2>
	<a href="tambah_baju.php" class="create-contact">Tambahkan</a>
	<table>
        <thead>
            <tr>
                <td>ID Pakaian</td>
                <td>Berat Pakaian</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tb_baju as $tb_baju): ?>
            <tr>
                <td><?=$tb_baju['baju_id']?></td>
                <td><?=$tb_baju['baju_berat']?></td>
             
                <td class="actions">
                    <a href="edit_baju.php?baju_id=<?=$tb_baju['baju_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="hapus_baju.php?baju_id=<?=$tb_baju['baju_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_tb_baju): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>