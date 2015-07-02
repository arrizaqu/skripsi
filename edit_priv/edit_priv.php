<?php
session_start();
error_reporting(0);
include ("fungsi.php");
?>
<html>
<head><title>MYSQL-ADMINISTRATOR</title>
<link rel="StyleSheet" href="index.css" type="text/css">
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
 mysql_select_db("".$_GET['var_database']."") ; 
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
echo "<a href='mysql_list_tables.php?var_database=".$_GET['var_database']." '><h2>".$_GET['var_database']."</a>";
echo " ".$_GET['tabel']."</h2>";


echo "<form action=\"edit_priv2.php?var_database=$var_database&tabel=$tabel&data_edit=".htmlentities($data_edit)."\" method='post'>";

echo "<a href='useredit.php?var_user=$var_user&host=$host'>$pengenal</a>";
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
		$nama=mysql_field_name($field,$i);
		$no = $i +1;
		echo "	<td>$no</td>
				<td>$nama</td>
				<td><input type='text' value=\"".htmlentities($row[$i])."\" name='record[".$nama."]'></td>
				<td><input type='hidden' value=\"".htmlentities($row[$i])."\" name='value_asal[$i]'></td>
				
		</tr>";
	}
}
	echo "</table>";

	echo "<p>";
	$user_priv="User_Privileges";
	echo "<input type='hidden' value=".$_GET['var_user']." name='var_user'>";
	echo "<input type='hidden' value=".$_GET['host']." name='host'>";
	echo "<input type='hidden' value=$user_priv name='pengenal'>";
	echo "<input type='submit' name='submit' value='Simpan'>";
	echo "</form>";
}
echo $data_edit;
?>
</p>
		</div><!--akhir dari content-->
	
		<div id="sidebar">
			<h3 id="navigasi">MENU</h3>
			<ul id="navmenu">
				<li><a href="home.php">Home</a></li>
				<li><a href="create_db.php">Buat Database</a></li>
				<li><a href="add_user.php">Management User</a></li>  
				<li><a href="sp.php">Stored Procedure</a></li>
				<li><a href="refresh.php">Segarkan Privilege</a></li>
				<li><a href="aboutme.php">About Me</a></li> 
			</ul> 
			<?php
		$pesan_logout="<h5>Anda sudah Logout..</h5>";
		echo "<a href=\"logout.php?pesan_logout=$pesan_logout\"><h4>Keluar</h4></a>"
		?>
		</div><!--akhir dari sidebar-->
		<div id="footer">
		<h3>TOOL ADMINISTRASI MYSQL</h3>";
		</div><!--akhir dari footer-->
	</div><!-- akhir wrapper-->
<body>
</html>




















