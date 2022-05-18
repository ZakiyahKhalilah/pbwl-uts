<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'dblaundry';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <div>
    <header>
   
    </header>

    <nav class="navtop">
    	<div>
         
            <a href="index.php"><i class="fas fa-home"></i>BERANDA</a>
    		<a href="read_laundry.php"><i class="fas fa-address-book"></i>LAUNDRY</a>
            <a href="read_baju.php"><i class="fas fa-address-book"></i>PAKAIAN</a>
            <a href="read_member.php"><i class="fas fa-address-book"></i>MEMBER</a>
            <a href="read_transaksi.php"><i class="fas fa-address-book"></i>TRANSAKSI</a>
            <a href="logout.php">LOGOUT</a>
        
    	</div>
    </nav>

EOT;
}
function template_footer() {
echo <<<EOT
<div>
    <footer>
    <p>Created by Zakiyah Khalilah Daulay</p>
    </footer>
    </div>
    </body>
</html>
EOT;
}
?>