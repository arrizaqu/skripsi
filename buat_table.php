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

//inisialisasi kiriman variable input nama tabel dan jumlah field
$jum_field=$_POST['jum_field'];
$name_table=$_POST['name_table'];
$var_database=$_GET['var_database'];

 if (empty($jum_field)||empty($name_table)){
 echo "form inputan 'nama field' dan 'jumlah field' harus diisi</br>";
 echo "<a href='mysql_list_tables?var_database=$var_database'>kembali</a>";
 }
 
 else {
 echo "<form action='buat_table2.php?var_database=$var_database&jum_field=$jum_field&name_table=$name_table' 
		method='post'>";
$t=-1;
 for ($i=1; $i <= $jum_field; $i++)
 {
 $t++;
 echo "
	<table bgcolor='#CCCCCC'>
	<td>
	Field $i
	</td>
	</table>
	<table border=0 bgcolor='#ffffcc'>
	<tr><td>Field</td><td>type</td><td>Size</td><td>extra</td><td>Key</td><td>Not Null</td>
	</tr>
	<tr>
	<td>
		<input type='text' size='10' name='name_field[".$t."]'>
	</td>
	<td>
		<select name='type_data[".$t."]'>
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
		</select>
	<td>
		<input type='text' size='5' name='size_data[".$t."]'>
	</td>
	</td>
	<td>
	<select name='extra[".$t."]'>
		<option value=''>-----</option>
		<option value='auto_increment'>Auto Increment</option>
		</select>
	</td>
	<td>
	<select name='key[".$t."]'>
		<option value=''> - - - - </option>
		<option value='primary key'>primary</option>
		<option value='unique'>unique</option>
		<option value='index'>index</option>
		</select>
	</td>
	<td><input type='checkbox' name='null[".$t."]' value='not null' checked></td>
	</tr>
	</table>
	<table>
	</table>
	<p>
";
	}
echo "	<input type='submit' name='submint' value='Simpan'>
	</form>";
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




















