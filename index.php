
 <?php
include 'functions.php';

// Your PHP code here.

// Home Page template below.
?>
<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html>
<img src="img/image.jpg" alt="">
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     
</body>
</html>

<?php 
}else{
     header("Location: index_login.html");
     exit();
}
 ?>
<?=template_header('Home')?>

<div class="content">
	<h2>Beranda</h2>
     <a href="read_laundry.php"><img src="img/laundry.jpg" alt=""></a>
     <a href="read_baju.php"> <img src="img/baju.jpg" alt=""></a>
     <a href="read_member.php"><img src="img/member.jpg" alt=""></a>
     <a href="read_transaksi.php"><img src="img/tra.jpg" alt=""></a>
</div>

<?=template_footer()?>
