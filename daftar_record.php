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
<script type='text/javascript'>
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

echo "<h3>Server:<i><a href='home.php'>".$_SESSION['sessi_host']."</a></i> <img src='./img/jr.png' /> Database:<i><a href='mysql_list_tables.php?tabel=".$tabel."&var_database=".$var_database."'>".$_GET['var_database']."</a></i> <img src='./img/jr.png' /> Tabel:<a href='".$_SELF_PHP."'><i>".$_GET['tabel']."</i></a></h3>";
?>
<center>
<h3>Daftar Record</h3>
</center>
<?php
$koneksi_db=@mysql_select_db("".$_GET['var_database']."");
if(!$koneksi_db){
echo mysql_error();
} 
//mengidentifikasi tanda petik
$petiksatu="'";
$petikganda="''";

  //================================== seleksi tabel untuk sort data ==========================================
   $q=0;
$query_seleksidata=mysql_query("select * from ".$tabel."");
for ($i=0;$i<@mysql_num_fields($query_seleksidata);$i++)
{
	//menampilkan nama field untuk sort data
	$sort_table[]=mysql_field_name($query_seleksidata,$i);
	if($i==0)
	$sort_data .="".$sort_table[$i]."";
	else
	$sort_data .=",".$sort_table[$i]."";
	
}

if($_POST['submit_record']){
$sql_tabel=mysql_query("select * from ".$_GET['tabel']." order by ".$sort_data." asc limit ".$_POST['jum_baris_awal'].",".$_POST['jum_baris_akhir']."");
}
else{
$sql_tabel=mysql_query("select * from ".$_GET['tabel']." order by ".$sort_data." asc limit 0,30");
}
   //====================== mengambil nama primary dari table information_schema ===========================
  $row_kunci=mysql_query("select b.column_name as column_primarykey from information_schema.tables a, information_schema.key_column_usage b where a.table_schema='".$var_database."' and b.table_schema='".$var_database."' and b.table_name=a.table_name and (b.table_name='".$tabel."');",$koneksi);
  $r=-1;
  while($row_nama_kunci=mysql_fetch_row($row_kunci)){$r++;
  if($r==0)
  $nama_field_primary .="".$row_nama_kunci[0]."";
  else
  $nama_field_primary .=",".$row_nama_kunci[0]."";
  }
  //================================= mengambil nilai field dari tabel primary yang didapatkan ==========================
  $row_value_primary=mysql_query("select ".$nama_field_primary." from ".$tabel." order by ".$sort_data." asc;");
  $row_list_primary=mysql_list_fields("".$_GET['var_database']."","".$_GET['tabel']."");
  $jumlah_field_primary=@mysql_num_fields($row_value_primary);
  //mendapatkan nama field primary
  $e=0;
  while($baris_data_primary=@mysql_fetch_row($row_value_primary)){
  $e++;
   for ($u=0;$u<$jumlah_field_primary;$u++)
	{
	$baris_data_primary2[$u]=str_replace($petiksatu,$petikganda,$baris_data_primary[$u]); 
	$nama_field_name[]=mysql_field_name($row_value_primary,$u);
	if($u==0)
	$where_id_primary[$e].="$nama_field_name[$u]='$baris_data_primary2[$u]'";
	else
	$where_id_primary[$e].=" and $nama_field_name[$u]='$baris_data_primary2[$u]'";
	}
}

//menampilkan seluruh record
if(!$sql_tabel){
echo mysql_error();
}
// daftar seluruh field
$sql_field=@mysql_list_fields("".$_GET['var_database']."","".$_GET['tabel']."");
if(!$sql_field){
echo mysql_error();
}
//banyaknya field
$jumlah_field=@mysql_num_fields($sql_field);
if(!$jumlah_field){
echo mysql_error();
}
//menghitung banyaknya record
$jumlah_record=mysql_num_rows($sql_tabel);
echo '<div style="overflow: auto;">';
echo "<table border='0' align=center bgcolor='#ffffcc'><tr>";
for ($i=0;$i<mysql_num_fields($sql_tabel);$i++)
{
	//menampilkan nama field
	$nama[]=mysql_field_name($sql_tabel,$i);
	echo "<th>$nama[$i]</th>";
}
   //menampilkan nama record
   $j=0;
   $i=0;
   $t=-1;
while ($rows=mysql_fetch_row($sql_tabel))
   {$i++;
   $t++;
   $j++;
    echo "<tr bgcolor='white'>";
	$no=0;
	for ($k=0;$k<$jumlah_field;$k++)
	{
		$no++;
		$sql_field=mysql_list_fields("".$_GET['var_database']."","".$_GET['tabel']."");
		$var_row[$k]=str_replace($petiksatu,$petikganda,$rows[$k]); 
		echo "<td>".htmlentities(nl2br($rows[$k]))."</td>";
		if($nama[$k]==$nama[0]) 
			if(is_null($rows[$k])){
			$queryx[$i] .=" $nama[$k] is null ";
			}
			else{
			$queryx[$i] .=" $nama[$k] = '$var_row[$k]' ";
			}
		else 
			if(is_null($rows[$k])){
			$queryx[$i] .="and $nama[$k] is null ";
			}
			else{
			$queryx[$i] .="and $nama[$k] = '$var_row[$k]' ";
			}
	}
	$apakah_kosong=$jumlah_field_primary;
	if(!empty($apakah_kosong)){
	$query[$i]="$where_id_primary[$i]";
	}
	else{
	$query[$i]="$queryx[$i]";
	}
	 echo "<td><a href=\"hapus_data.php?var_database=$var_database&tabel=$tabel&query=delete from $tabel where ".htmlentities(urlencode($query[$i]))." limit 1\" onclick='return confirmSubmit()'>hapus</a></td>";
	 echo "<td><a href=\"edit_data.php?var_database=$var_database&tabel=$tabel&data_edit=".htmlentities(urlencode($query[$i]))."\">Edit</a></td>";
	echo "</tr>";
   }
   echo "</table>";
   echo '</div>';
?>
<?php 
if($sql_field){
if($_POST['submit_record']){
$baris_awal=$_POST['jum_baris_awal'];
$baris_akhir=$_POST['jum_baris_akhir'];
}
else{
$baris_awal='0';
$baris_akhir='30';}
?> 
</p>
<form action='<?php $_PHP_SELF?>' method='post'>
<table>
<br/>
<tr><td>Mulai record ke</td><td><input size='5' type='text' value='<?php echo $baris_awal?>' name='jum_baris_awal'></td></tr>
<tr><td>Banyaknya Record</td><td><input type='text' size='5' value='<?php echo $baris_akhir?>' name='jum_baris_akhir'></td></tr>
</table>
<input type='submit' size='5' value='Tampilkan Record kembali' name='submit_record'>
</center>
<?php

echo "<p></p><a href='insert.php?var_database=".$_GET['var_database']."&tabel=".$_GET['tabel']."'>Tambah Data</a></br>";
}
   if(!empty($pesan)){
   echo "<center>";
   echo $_GET['pesan'].'...!';
   echo "</center>";
   }
?>
</p>
<?php
if($query_seleksidata){
echo "record: $jumlah_record</br>";
echo "<h3>Buat Index</h3>";
echo "<form action='index_data.php?var_database=$var_database&tabel=$tabel' method='post'>";
echo "<td>Nama index : </td><br/>";
echo "<td><input type='text' name='nama_index'></td><br/><br/>";
echo "Field : </td><br/>";
echo "<select name='field_4index'>";
for ($i=0;$i<mysql_num_fields($sql_tabel);$i++)
{
	//menampilkan nama field
	echo "<option><th>$nama[$i]</th></option>";
}
echo "</select>";
echo "<br/><br/>";
echo "<input type='submit' name='submit' value='Buat'/>";
echo "</form>";
echo "<p></p>";
}
?>
<center>
<h3>Daftar Index</h3>
</center>
<?php
$tabel_index=mysql_query("show index from ".$tabel."",$koneksi);
if(!$tabel_index){
echo mysql_error();
}
?>
<div style="overflow: auto;">
<table border='0'>
<?php
echo "<tr>";
for ($i=0;$i<mysql_num_fields($tabel_index);$i++)
{
	//menampilkan nama field
	$nama_index[]=mysql_field_name($tabel_index,$i);
	echo "<th>$nama_index[$i]</th>";
}
echo "</tr>";

//menampilkan record index
while ($row_index=mysql_fetch_row($tabel_index)){
echo "<tr bgcolor='white'>";
foreach($row_index as $key => $value_index){
echo "<td>".$value_index."</td>";
}
echo "</tr>";
}


echo '</table>';
?>
</div>
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




















