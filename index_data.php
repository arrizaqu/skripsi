<?php
session_start();
error_reporting(0);
include ("fungsi.php");

$var_database=$_GET['var_database'];
$tabel=$_GET['tabel'];
$nama_index=$_POST['nama_index'];

$koneksi_db=mysql_select_db("".$_GET['var_database']."");
if(!$koneksi_db){
echo mysql_error();
}
$sql_index_data=@mysql_query("create index ".$_POST['nama_index']." on ".$_GET['tabel']."(".$_POST['field_4index'].")");
if($sql_index_data)
{
$pesan="Index $nama_index berhasil diciptakan";
 header("location:daftar_record.php?var_database=".$var_database."&tabel=".$tabel."&pesan=".$pesan."");
}
else{
 header("location:daftar_record.php?var_database=".$var_database."&tabel=".$tabel."&pesan=".mysql_error()."");

}
?>





















