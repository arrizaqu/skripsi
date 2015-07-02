<?php
session_start();
//error_reporting(0);

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
$var_database=$_GET['var_database'];
$tabel=$_GET['tabel'];
echo "<h3>Server:<i><a href='home.php'>".$_SESSION['sessi_host']."</a></i> <img src='./img/jr.png' /> Database:<i><a href='mysql_list_tables.php?tabel=".$tabel."&var_database=".$var_database."'>".$_GET['var_database']."</a></i> <img src='./img/jr.png' /> Tabel:<a href='daftar_record?tabel=".$tabel."&var_database=".$var_database."'><i>".$_GET['tabel']."</i></a></h3>";
//buat menambah satu petik ketika ada field yang bertanda petik satu atau dua
$petiksatu="'";
$petikganda="''";

$data_edit=htmlentities(stripslashes($_POST['data_edit']));

  $koneksi_db=mysql_select_db("".$_GET['var_database']."");
if(!$koneksi_db){
echo mysql_error();
}  
//menampilkan seluruh record
$sql_table="select * from $tabel where $data_edit";
$sql_tabel=@mysql_query($sql_table);
if(!$sql_tabel){
echo "<textarea cols='60' rows='8'>";
echo $sql_table;
echo "</textarea>";
echo "<textarea cols='60' rows='8'>";
echo $data_edit;
echo "</textarea>";
echo mysql_error();
}
// daftar seluruh field
$sql_field=mysql_list_fields("".$_GET['var_database']."","".$_GET['tabel']."");
//banyaknya field
$jumlah_field=mysql_num_fields($sql_field);
if(!$jumlah_field){
echo mysql_error();
}
//menghitung banyaknya record
$jumlah_record=mysql_num_rows($sql_tabel);
$field=mysql_list_fields("".$_GET['var_database']."","".$_GET['tabel']."");
$jumlah=@mysql_num_fields($field);
if(!$jumlah){
echo mysql_error();
}
while ($row=mysql_fetch_row($sql_tabel))
   {
	for ($i=0;$i<($jumlah_field);$i++)
	{
	$nama=mysql_field_name($sql_tabel,0);
    }
   }
$sql_editdata=" update $tabel set ";
$i=0;

//Mengambil nilai record (isi dari record nama field)

foreach($_POST['record'] as $key=> $value)
 {
 $value=str_replace($petiksatu,$petikganda,$value);

	$nama=mysql_field_name($sql_tabel,$i);
	if ($i == 0)
	 $sql_editdata .="$nama='".$value."'";
	else 
	 $sql_editdata .=",$nama='".$value."'";
	 $i++;
	 
 }
 /*
 mendapatkan nilai asal sebagai where indentifikasi penemuan isi field lama sebagai seleksi record yang akan dipilih
 $p=0;
 $value_asal=htmlentities($_POST['value_asal']);
 */
 
 foreach($value_asal as $key=> $value2)
 {
 $value_pusing=str_replace($petiksatu,$petikganda,$value2);
 
	$nama=mysql_field_name($sql_tabel,$p);
	if ($p == 0)
	 $sambung_editdata .=" $nama='".$value_pusing."'";
	else 
	  $sambung_editdata .=" and $nama='".$value_pusing."'";
	 $p++;
	 
 }
 $sql_editdata .=" where ".$sambung_editdata." limit 1;";
 $sql_editdata=stripslashes($sql_editdata);
$sql=mysql_query($sql_editdata);
if ($sql)
{
 echo "<textarea cols='70' rows='10'>";
 echo $sql_editdata;
 echo "</textarea>";
 echo "Perubahan berhasil dilakukan";
 echo "<p><a href='daftar_record.php?var_database=".$var_database."&tabel=".$tabel."'>Kembali</a></p>";

 }
 
else{
 echo mysql_error();
 echo '<br/><br/><br/>';
 echo $sql_editdata;
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
				<li><a href="aboutme.php"></a>Tentang Saya</i></li> 
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




















