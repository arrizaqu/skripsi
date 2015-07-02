<?php
session_start();
error_reporting(0);
include ("fungsi.php");
?>
<html>
<head><title>MYSQL-ADMINISTRATOR</title>
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
<?php

?>
	<div id="wrapper"> <!-- pembungkus semua halaman-->
		<div id="header">
			<h1>
			<a href="home.php">SQL-Radmin</a>
			</h1>
		</div><!-- akhir header -->
		<div id="content">		
<p>
<?php
echo "<h3>Server:<i><a href='home.php'>".$_SESSION['sessi_host']."</a></i> <img src='./img/jr.png' /> Database:<i><a href='mysql_list_tables.php?tabel=".$tabel."&var_database=".$var_database."'>".$_GET['var_database']."</a></i> <img src='./img/jr.png' /> Tabel:<a href='".$_SELF_PHP."'><i>".$_GET['tabel']."</i></a></h3>";
echo " ".$_GET['tabel']."</h2>";
$field=@mysql_list_fields("".$_GET['var_database']."","".$_GET['tabel']."");
if(!$field){
echo mysql_error();
}
$jumlah=@mysql_num_fields($field);

if($field==true){
echo "<form action='insert2.php?var_database=$var_database&tabel=$tabel' method='post'>";
echo " <table border=0 bgcolor='#ffffcc'>
		
		<tr>
			<td>NO</td>
			<td>Field</td>
			<td>Type</td>
			<td>Panjang</td>
			<td>Value</td>
		</tr>";
	
	for ($i=0;$i<$jumlah;$i++)
	{	
		//menghasilkan nama field
		$nama=mysql_field_name($field,$i);
		//menghasilkan tipe field
		$tipe=mysql_field_type($field,$i);
		//menghasilkan panjang field
		$panjang=mysql_field_len($field,$i);
		//menghasilka atribut field
		$flag=mysql_field_flags($field,$i);
		$no = $i +1;
		echo "	
		<tr bgcolor='white'>
				<td>$no</td>
				<td>$nama</td>
				<td>$tipe</td>
				<td>$panjang</td>
				<td><input type='text' name='data[".$i."]'></td>
		</tr>";
	}
	
	echo "</table>";
	echo "<p>";
	echo "<input type='submit' name='submit' value='Simpan'>";
	echo "<input type='button' name='batal' value='batal' onclick='javascript:history.go(-1)'>";
	echo "</form>";
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




















