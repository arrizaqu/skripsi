<?php
session_start();
error_reporting(0);
include ("fungsi.php");
?>
<html>
<head><title>MYSQL-ADMINISTRATOR</title>
<link rel="shorcut icon" href="img/icon003.png" />
<link rel="StyleSheet" href="index.css" type="text/css">
<script type='text/javascript'>
function confirmSubmit() {
var agree=confirm("Apakah anda yakin untuk ini?");
if (agree)
     return true;
else
     return false;
}
</script>
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
$var_database = $_GET['var_database'];
echo "<h3>Server:<i><a href='home.php'>".$_SESSION['sessi_host']."</a></i> <img src='./img/jr.png' /> Database:<i><a href='".$_PHP_SELF."'>".$_GET['var_database']."</a></i></h3>";
//mendapat table dalam database php
    mysql_select_db($var_database);
	$hasil_tabel = @mysql_list_tables($var_database,$koneksi);
	if(!$hasil_tabel){
	echo mysql_error();
	}
	echo '<center><h3>Daftar Tabel</h3></center>';
	echo "<table border='0' align='center'>
		<tr>
		<th>No</th>
		<th>Tabel</th>
		<th colspan='4' scope='col'>Data Record</th>
		</tr>";
$i = 0;
$no=0;
while ($row_tabel= @mysql_fetch_row($hasil_tabel))
	{
	
// query untuk mendapatkan jumlah record dari tabel
	$query_tabel = mysql_db_query("$var_database","select * from $row_tabel[0]",$koneksi);
	
	$jumlah_rekord = @mysql_num_rows($query_tabel);
	$no++;
	echo "	
			<tr bgcolor='white'>	
			<td>$no</td>
			<td>$row_tabel[0]</td>
			<td>
				<a href='empty_tabel.php?var_database=$var_database&tabel=$row_tabel[0]' onclick='return confirmSubmit()'>Kosongkan</a>
			</td>
			<td>
				<a href=\"daftar_record.php?var_database=$var_database&tabel=$row_tabel[0]\">Record</a>
			</td>
			<td>
				<a href=\"mysql_field.php?var_database=$var_database&tabel=$row_tabel[0]\">Struktur</a>
			</td>
			<td>
				<a href='drop_tabel.php?var_database=$var_database&tabel=$row_tabel[0]' onclick='return confirmSubmit()'>Hapus</a>
			</td>
		</tr>";
	}
	
	echo "</table>";
	$jum=@mysql_num_rows($hasil_tabel);
	echo "<center>ada $jum tabel</center>";	
	echo "<p>";
	echo "</br>";
	echo "</br>";
	echo "<center><h3>Tambah Tabel</h3></center>";
	echo "<form action='buat_table.php?var_database=$var_database' method='post'>";
	echo "
	<table align='center'>
	<td>Nama Table</td>
	<td>
		<input type='text' size='10' name='name_table'>
	</td>
	<td>Jumlah Field</td>
	<td>
		<input type='text' size='5' name='jum_field'>
	</td>
	<td>
	<input type='submit' name='submit' value='buat'><br/>
	</td>
	</form>";
	echo "</table>";
	if(!empty($_GET['pesan'])){
		echo '<p />';
		echo '<center>'.$_GET['pesan'].'</center>';
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























