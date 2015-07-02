<?php
session_start();
error_reporting(0);
include ("fungsi.php");
?>
<html>
<head><title>MYSQL-ADMINISTRATOR</title>
<link rel="shorcut icon" href="img/icon003.png" />
<link rel="StyleSheet" href="index.css" type="text/css">
<script type="text/javascript" src="./jquery/jquery.js"></script>
<script type="text/javascript" src="./jquery/jquery.corner.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
$('#header').corner('50px top');
$('#sidebar').corner("35px left");
$('#footer').corner('50px bottom');
$('table').corner("top");
$('#wrapper').corner('60px');
});
</script>
<head>
	
<body>
	<div id="wrapper"> <!-- pembungkus semua halaman-->
		<div id="header">
			<h1>
				<a href="home.php">SQL-Radmin</a>
			</h1>
		</div><!-- akhir header -->
		<div id="content">
<p>
<?php
echo "<h3>Server:<i><a href='home.php'>".$_SESSION['sessi_host']."</a></i></h3>";
$var_database=$_POST['var_database'];
$name_collation=$_POST['nama_collation'];

if(!empty($name_collation)){
$sql_create_db="create database ".$var_database." default collate ".$name_collation."";
}
else{
$sql_create_db="create database ".$var_database."";
}
$sql=mysql_query($sql_create_db);
    if(!$sql){
	echo '<h4>Pesan Kesalahan:</h4>';
	echo mysql_error();
	}
	else{
	echo "membuat database ".$_POST['var_database']." berhasil dilakukan";
	echo "<h3>Buat Tabel</h3>";
	echo "<form action='buat_table.php?var_database=$var_database' method='post'>";
	echo "
	<table>
	<td>Nama Tabel:</td>
	<td>
		<input type='text' size='10' name='name_table'>
	</td>
	<td>Jumlah Column:</td>
	<td>
		<input type='text' size='5' name='jum_field'>
	</td>
	<td>
	<input type='submit' name='submit' value='buat'><br/>
	</td>
	</form>";
	echo "</table>";
	}
?>
</p>
		</div><!--akhir dari content-->
	
		<div id="sidebar">
			<h3 id="navigasi">MENU</h3>
			<ul id="navmenu">
				<li><a href="home.php"><i>Home</a></li>
				<li><a href="create_db.php">Buat Database</a></li>
				<?php echo "
				<li><a href='mysqlquery.php?var_database=$var_database'>Query</a></li>";?>
				<li><a href="add_user.php">Manajemen User</a></li>  
				<li><a href="sp.php">Stored Procedure</a></li>
				<li><a href="refresh.php">Flush Privilege</a></li>
				<li><a href="aboutme.php">Tentang Saya</i></a></li> 
			</ul> 
			<?php
		$pesan_logout="<h5>Anda sudah Logout..</h5>";
		echo "<a href=\"logout.php?pesan_logout=$pesan_logout\"><h4>logout</h4></a>"
		?>
		</div><!--akhir dari sidebar-->
		<div id="footer">
		<h3>TOOL ADMINISTRASI MYSQL</h3>";
		</div><!--akhir dari footer-->
	</div><!-- akhir wrapper-->
<body>
</html>




















