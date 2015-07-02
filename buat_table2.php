<?php
ob_start();
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

echo "<h3>Server:<i><a href='home.php'>".$_SESSION['sessi_host']."</a></i> <img src='./img/jr.png' /> Database:<i><a href='mysql_list_tables.php?var_database=".$_GET['var_database']."'>".$_GET['var_database']."</a></i> <img src='./img/jr.png' /> Tabel: <a href='#'><i>".$_GET['name_table']."</i></a> </h3>";

//=================== inisialisasi variable ====================
$name_table=$_GET['name_table'];
$var_database=$_GET['var_database'];
$jum_field=$_GET['jum_field'];
 $name_field=$_POST['name_field'];
 $type_data=$_POST['type_data'];
 $size_data=$_POST['size_data'];
 $key=$_POST['key'];
 $extra=$_POST['extra'];
 $null=$_POST['null'];
 
 //=============================================================
  $koneksi_db=@mysql_select_db("".$_GET['var_database']."");
  if(!$koneksi_db){
   echo mysql_error();
  }
  
  echo $_POST['name_field[0]'];
  $query_table="create table ".$_GET['name_table']." (";
  $r=-1;
  for($loop=0;$loop < $jum_field;$loop++){
  $r++;
	if ($r==0)
		 if(!empty($size_data[$r]))
		{
			$query_table .=" ".$name_field[$r]." ".$type_data[$r]." (".$size_data[$r].") ".$key[$r]." ".$extra[$r]." ".$null[$r]."";
		}
		else
		{
			$query_table .=" ".$name_field[$r]." ".$type_data[$r]." ".$key[$r]." ".$extra[$r]." ".$null[$r]."";

		}
	else
		 if(!empty($size_data[$r]))
		{
			$query_table .=", ".$name_field[$r]." ".$type_data[$r]." (".$size_data[$r].") ".$key[$r]." ".$extra[$r]." ".$null[$r]."";
		}
		else
		{
			$query_table .=", ".$name_field[$r]." ".$type_data[$r]." ".$key[$r]." ".$extra[$r]." ".$null[$r]."";

		}
  }
  $query_table .=");";
  
  $create_table=mysql_query($query_table);
  if(!$create_table){
	echo mysql_error();
  }
  else{
  $pesan='berhasil membuat tabel '.$name_table.'';

  header ("location:mysql_list_tables?var_database=".$var_database."&pesan=".$pesan."");
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




















