<?php
session_start();
error_reporting(0);
include ("fungsi.php");
$tabel=$_GET['tabel'];
$query=$_GET['query'];
$var_user=$_GET['var_user'];
$host=$_GET['host'];
$level_user=$_GET['level_user'];

 $query=stripslashes($query);
 
 $koneksi_db=mysql_db_query($var_database, $query);
 
 if(!$koneksi_db){
  echo '<h4>Pesan Kesalahan:</h4>';
  echo mysql_error();
 }
 else{
 $sql_hapus_data=mysql_query("flush privileges");
  if(!empty($level_user)){
 mysql_query("delete from db where user='".$var_user."' and host='".$host."'");
 }
 header("location:useredit.php?pesan=".$pesan."&var_user=".$var_user."&host=".$host."");
 echo "<br>";

 }
?>





















