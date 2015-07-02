<?php
session_start();
error_reporting(0);
include ("fungsi.php");
$_GET['var_database'];
 $sql=mysql_query("drop database ".$_GET['var_database']."");
if (!$sql)
{
	header("location:home.php?pesan_drop_db=".mysql_error()."");
}
else
{
  $pesan_drop_db="Database ".$var_database." telah Terhapus";
  header("location:home.php?pesan_drop_db=$pesan_drop_db");
}
?>































