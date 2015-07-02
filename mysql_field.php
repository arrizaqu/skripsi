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
$var_database=$_GET['var_database'];
$tabel=$_GET['tabel'];
echo "<h3>Server:<i><a href='home.php'>".$_SESSION['sessi_host']."</a></i> <img src='./img/jr.png' /> Database:<i><a href='".$_PHP_SELF."'>".$_GET['var_database']."</a></i></h3>";
$field=@mysql_list_fields("".$_GET['var_database']."","".$_GET['tabel']."");
if(!$field){
echo mysql_error();
}
else{
$jumlah=mysql_num_fields($field);
echo "<table><tr><td><a href='insert.php?var_database=$var_database&tabel=$tabel'>Insert</a></td>
	<td><a href='replace.php?var_database=$var_database&tabel=$tabel'>Replace</a></td>
	</tr></table>"; 
echo " <table border='0'>
		
		<tr>
			<th>NO</th>
			<th>Kolom</th>
			<th>Tipe</th>
			<th>Panjang</th>
			<th>Atribut</th>
		</tr>";
	$no=0;	
	for ($i=0;$i<$jumlah;$i++)
	{
	echo "<tr bgcolor='white'>";
		//menghasilkan nama field
		$nama=mysql_field_name($field,$i);
		//menghasilkan tipe field
		$tipe=mysql_field_type($field,$i);
		//menghasilkan panjang field
		$panjang=mysql_field_len($field,$i);
		//menghasilka atribut field
		$flag=mysql_field_flags($field,$i);
		$no++;
		echo "	<td>$no</td>
				<td>$nama</td>
				<td>$tipe</td>
				<td>$panjang</td>
				<td>$flag</td>
				<td><a href='drop_column.php?var_database=".$var_database."&tabel=".$tabel."&query_drop_column=alter table ".$tabel." drop column ".$nama.";' onclick='return confirmSubmit()'>Hapus</a></td>";
	}
	echo "</table>";
$pesan=$_GET['pesan'];
$pesan=stripslashes($pesan);
if(!empty($pesan)){
echo "<p><textarea cols='60' rows='5'>";
echo $pesan;
echo "</textarea></p>";
}
?>
<p>
<table>
<tr>
	<td>Tambah Field</td>
</tr>
</table>
<form action='add_field.php' method='post'>
<input type="hidden" name="var_database" value="<?php echo $_GET['var_database']?>">
<input type="hidden" name="tabel" value="<?php echo $_GET['tabel']?>">
<table>
<tr>
<th>Nama Field</th>
<th>Tipe</th>
<th>Ukuran</th>
<th>Posisi</th>
<th>Field</th>
</tr>
<tr bgcolor='white'>
<td><input type='text' size='10' name='add_field'></td>
	<td><select name='type_field'>
		<option value='varchar'>varchar</option>
		<option value='char'>char</option>
		<option value='text'>text</option>
		<option value='tinytext'>tinytext</option>
		<option value='mediumtext'>mediumtext</option>
		<option value='longtext'>longtext</option>
		<option value='tinyint'>tinyint</option>
		<option value='smallint'>smallint</option>
		<option value='mediumint'>mediumint</option>
		<option value='int'>int</option>
		<option value='bigint'>bigint</option>
		<option value='real'>real</option>
		<option value='double'>double</option>
		<option value='float'>float</option>
		<option value='decimal'>decimal</option>
		<option value='numeric'>numeric</option>
		<option value='date'>date</option>
		<option value='time'>time</option>
		<option value='datetime'>datetime</option>
		<option value='timestamp'>timestamp</option>
		<option value='tinyblob'>tinyblob</option>
		<option value='blob'>blob</option>
		<option value='mediumblob'>mediumblob</option>
		<option value='longblob'>longblob</option>
		<option value='binary'>binary</option>
		<option value='varbinary'>varbinary</option>
		<option value='bit'>bit</option>
		<option value='enum'>enum</option>
		<option value='set'>set</option>
		</select></td>
	<td><input type='text' size='5' name='size_type'></td>
	<td><select name='posisi'>
	<option>FIRST</option>
	<option>AFTER</option>
	</select></td>
	<td>
		<?php
		$nama2_field=mysql_query("select * from ".$_GET['tabel']."");
		for ($i=0;$i<mysql_num_fields($nama2_field);$i++)
		{
		//menampilkan nama field
		$nama_field[]=mysql_field_name($nama2_field,$i);
		}
		echo "<select name='name_field'>";
		?><option></option>
		<?php
		foreach($nama_field as $key => $nama_fields){
		echo "<option>$nama_fields</option>";
		}
		echo "</select>";
		?>
		</td>
</tr>
<tr>
<td><input type='submit' name='submit' value='Tambahkan'></td></tr>
</table>
</form>
NB: Jika memilih posisi <b>'First'</b> field dikosongkan
<?php 
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




















