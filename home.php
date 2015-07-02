<?php
session_start();
error_reporting(0);
include ("fungsi.php");
?>
<html>
<head><title>MYSQL-ADMINISTRATOR</title>
<link rel="shorcut icon" href="img/icon003.png" />
<link rel="StyleSheet" href="index.css" type="text/css" />

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
</style>
<script language="JavaScript">
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


<head>
	
<body>
	<div id="wrapper"> <!-- pembungkus semua halaman-->
		<div id="header" class="bundar">
			<h1>
			<a href="home.php">SQL-Radmin</a>
			</h1>
		</div><!-- akhir header -->
		<div id="content">
		<center>
		<h4>SELAMAT DATANG DI SQL-Radmin</h4>
		<?php
		echo "<a>'".$_SESSION['sessi_user']."'@'".$_SESSION['sessi_host']."'</a>";
		?>
		<h3>Daftar Database</h3>		
		</center>
<p>
<?php
 $hasil=mysql_list_dbs($koneksi);
 if(!$hasil){
 echo mysql_error();
 }
 echo "<p>";
 echo 	"<table border='0' align='center'>
					<tr>
						<th>No</th>
						<th>Database</th>
					<tr>
		";
	$no==0;
	$j==0;
	$jum=0;
	
while ($row_db=mysql_fetch_row($hasil))
{
	$no++;
		echo "<tr bgcolor='white'>
				<td>$no</td>
				<td>
					$row_db[0]
				</td>
				<td>
					<a href='mysql_list_tables.php?var_database=$row_db[0]'>Tabel</a>
				</td>
				<td>
					<a href='show_sp.php?var_database=$row_db[0]'>Procedure</a>
				</td>
				<td>
					<a href='drop.php?var_database=$row_db[0]' onclick='return confirmSubmit()'>Hapus</a>
				</td>
		</tr>
		";
}
echo "</table>";
echo "</p>";
echo "<center>";
$pesan_drop_db=stripslashes("".$_GET['pesan_drop_db']."");
echo $pesan_drop_db;
echo "</center>";
$versi_mysql=mysql_query("select version();");
$versi=mysql_fetch_row($versi_mysql);
echo "<h3 align='center'>".$versi[0]."</h3>";
?>
		</div><!--akhir dari content-->
		
		<div id="sidebar">
			<h3 id="navigasi">MENU</h3>
			<ul id="navmenu">
				<li><a href="home.php" class="selected"><i>Home</a></li>
				<li><a href="create_db.php">Buat Database</a></li>
				<?php echo "
				<li><a href='mysqlquery.php?var_database=$var_database'>Query</a></li>";?>
				<li><a href="add_user.php">Manajemen User</a></li>  
				<li><a href="sp.php">Stored Procedure</a></li>
				<li><a href="refresh.php">flush Privilege</a></li>
				<li><a href="aboutme.php">Tentang Saya</i></a></li> 
			</ul> 
			<?php
		$pesan_logout="<h5>Anda sudah Logout..</h5>";
		echo "<a href=\"logout.php?pesan_logout=$pesan_logout\"><h4>Logout</h4></a>"
		?>
		</div><!--akhir dari sidebar-->
		<div id="footer">
		<h3>TOOL ADMINISTRASI MYSQL</h3>
		</div><!--akhir dari footer-->
	</div><!-- akhir wrapper-->
<body>
</html>




















