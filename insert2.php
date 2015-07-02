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

function teks_post($datap){
	$filter = stripslashes(strip_tags(htmlspecialchars($datap,ENT_QUOTES)));
return $filter;
}
$petiksatu="'";
$petikganda="''";

$data=$_POST['data'];
echo "<a href='mysql_list_tables.php?var_database=".$_GET['var_database']." '><h2>".$_GET['var_database']."</a>";
echo " ".$_GET['tabel']."</h2>";
 	 mysql_select_db("$var_database");
	 $field=mysql_list_fields("".$_GET['var_database']."","".$_GET['tabel']."");
	 $jumlah_field=mysql_num_fields($field);
	 $sql_tabel=mysql_query("select * from ".$_GET['tabel']."",$koneksi);

	 $query='insert into '.$_GET['tabel'].' values(';
	 $i = 1;	
	 $k=0;
	 $l=-1;
	foreach($data as $key => $value) 
	{
	$k++;$l++;
	//$data[$k]= nl2br(teks_post($value));
	$data_query[$l]=str_replace($petiksatu,$petikganda,$data[$l]);
		if($l == 0)
			$query .= "'".$data_query[$l]."'";
		else
			$query .= ", '".$data_query[$l]."'";
		$i++;
	}
	
	$query .= ')';
	$sql_insert_data=stripslashes($query);
	$sql_insert_data=mysql_query($sql_insert_data);
	if(!$sql_insert_data){
	echo $sql_insert_data;
	echo mysql_error();
	echo "<a href='daftar_record.php?var_database=$var_database&tabel=$tabel'>Kembali</a>";
	}
	else{
	echo "Query:";
	echo "</br>";
	echo "<textarea cols='50' rows='8'>".stripslashes(htmlentities($query))."</textarea><br/>";
	 echo "Query OK, data tabel ".$_GET['tabel']." berhasil ditambahkan";
	echo "</br>";
	echo "</br>";
	echo "<a href='daftar_record.php?var_database=$var_database&tabel=$tabel'>Kembali</a>";
	}
?>
</p>
		</div><!--akhir dari content-->
	
		<div id="sidebar">
			<h3 id="navigasi">MENU</h3>
			<ul id="navmenu">
				<li><a href="home.php"><i>Home</a></li>
				<li><a href="create_db.php">Buat Database</a></li><?php echo "
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




















