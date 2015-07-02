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
<script>
function confirmSubmit() {
var agree=confirm("Apakah anda yakin untuk ini?");
if (agree)
     return true;
else
     return false;
}
</script>
<head>
<body>
<?php

?>
	<div id="wrapper"> <!-- pembungkus semua halaman-->
		<div id="header">
			<h1>
			<a href="home.php">SQL-Radmin</a>
			</h1>
		</div><!-- akhir header -->
		<div id="content">		
<?php
  mysql_select_db("".$_GET['var_database'].""); 
  echo "<h3>Server:<i><a href='home.php'>".$_SESSION['sessi_host']."</a></i> <img src='./img/jr.png' /> Database:<i><a href='".$_PHP_SELF."'>".$_GET['var_database']."</a></i></h3>";
  echo "<h3 align='center'>Daftar <i>Stored Procedure</i></h3>";
$sql_show_sp=mysql_query("select routine_name from information_schema.routines where routine_type='procedure' and routine_schema='".$_GET['var_database']."'",$koneksi);
$sql_def_sp=mysql_query("select routine_definition from information_schema.routines where routine_type='procedure' and routine_schema='".$_GET['var_database']."'",$koneksi); 
$pesan=$_GET['pesan'];
$pesan=stripslashes($pesan);
if(!empty($pesan)){

echo $show_sp_query;
echo '<center>'.$pesan.'<br/></center>';

}
	 echo "<table border='0' align='center'>";
echo "<tr>
		<td>No</td>
		<td>Nama_Procedure</td>
	</tr>";
	$no=0;
while (($row=mysql_fetch_row($sql_show_sp)) && ($row_def_sp=mysql_fetch_row($sql_def_sp)))
{
		
$no++;
 echo "<tr bgcolor='white'>
		<td>$no</td>
		<td>$row[0]</td>
		<td><a href=\"calling_sp.php?var_database=$var_database&def_sp=".htmlentities($row_def_sp[0])."&procedure=$row[0]\" >call</a></td>
		<td><a href=\"hapus_sp.php?var_database=$var_database&nama_sp=$row[0]\" onclick='return confirmSubmit()'>Hapus</a></td>
	</tr>";
}
echo "</table>";
echo "<p>";
echo "<a href='sp.php?var_database=".$var_database."'>Tambah Stored Procedure</a>";
echo "</p>";
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
		<h3>MYSQL ADMINISTRASI TOOL</h3>";
		</div><!--akhir dari footer-->
	</div><!-- akhir wrapper-->
<body>
</html>




















