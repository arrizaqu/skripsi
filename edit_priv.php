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
</script><script language="JavaScript">
function confirmSubmit() {
var agree=confirm("Apakah anda yakin untuk melakukan perubahan?");
if (agree)
     return true;
else
     return false;
}
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
$pengenal=$_GET['pengenal'];
$db=$_GET['db'];
$pengenal=stripslashes($pengenal);
$data_edit=$_GET['data_edit'];
$data_edit=stripslashes($data_edit);
$var_user=$_GET['var_user'];
$host=$_GET['host'];

 mysql_select_db("".$_GET['var_database'].""); 
//menampilkan seluruh record
$sql_tabel=mysql_query("select * from $tabel where $data_edit limit 1");
if(!$sql_tabel){
echo mysql_error();
}
else{
// daftar seluruh field
$sql_field=mysql_list_fields("".$_GET['var_database']."","".$_GET['tabel']."");
//banyaknya field
$jumlah_field=mysql_num_fields($sql_field);
//menghitung banyaknya record
$jumlah_record=mysql_num_rows($sql_tabel);
$field=mysql_list_fields("".$_GET['var_database']."","".$_GET['tabel']."");
$jumlah=mysql_num_fields($field);
echo "<H3>Ubah <i>Privilege</i> <img src=./img/jr.png /> USER : <a href='".$_SELF_PHP."'>'$var_user'@'$host'</a></H3>";
echo "<form action=\"edit_priv2.php?var_database=$var_database&tabel=$tabel&data_edit=".htmlentities($data_edit)."\" method='post'>";
?>
<input type='hidden' name='var_user' value='<?php echo "".$var_user.""?>'>
<input type='hidden' name='host' value='<?php echo "".$host.""?>'>
<?php

echo " <table border='0' bgcolor='#ffffcc'>
		
		<tr>
			<th>NO</th>
			<th>Field</th>
			<th>Edit Value</th>
		</tr>";
while ($row=mysql_fetch_row($sql_tabel))
{
	for ($i=0;$i<$jumlah;$i++)
	{	
	echo "<tr bgcolor='white'>";
		//menghasilkan nama field
		/*
		1. Record['nama'] untuk mengambil nilai yang akan dikirim sebagai nilai value
		   nama field yang akan dijadikan nama variable yang akan dikirim ke page edit_data2.php
		2. adanya penting untuk memberikan nilai asal untuk identifikasi where data field yang akan diedit yaitu name='value_asal[$i]'
		*/
		$nama=mysql_field_name($field,$i);
		$no = $i +1;
		echo "	<td>$no</td>
				<td>$nama</td>
				<td><input type='text' value=\"".htmlentities($row[$i])."\" name='record[".$nama."]'></td>
				<input type='hidden' value=\"".htmlentities($row[$i])."\" name='value_asal[$i]'>
				
		</tr>";
	}
}
	echo "</table>";

	echo "<p>";
	$user_priv="User_Privileges";
	echo "<input type='hidden' value=".$_GET['var_user']." name='var_user'>";
	echo "<input type='hidden' value=".$_GET['host']." name='host'>";
	echo "<input type='hidden' value=$user_priv name='pengenal'>";
	echo "<input type='submit' name='submit' value='Simpan' onclick='return confirmSubmit()'>";
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




















