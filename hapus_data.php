<?php
session_start();
error_reporting(0);

include ("fungsi.php");
$tabel=$_GET['tabel'];
$query=$_GET['query'];

 $query=stripslashes($query);
 
 $koneksi_db=mysql_db_query($var_database, $query);
 if(!$koneksi_db){
  header("location:daftar_record.php?pesan=".mysql_error()."&var_database=".$var_database."&tabel=".$tabel."");
 }
 else{
 $sql_hapus_data=mysql_query("flush privileges");
 if(!$sql_hapus_data){
 header("location:daftar_record.php?pesan=".mysql_error()."&var_database=".$var_database."&tabel=".$tabel."");
 }
 $pesan="Data telah terhapus";
 header("location:daftar_record.php?pesan=".$pesan."&var_database=".$var_database."&tabel=".$tabel."");
 echo "<br>";

 }
?>










