<?php
session_start();

$host=$sessi_host;
$user=$sessi_user;
$password=$sessi_password;

include ("fungsi.php");
mysql_select_db("".$_GET['var_database']."");

$sql_hapus_sp=mysql_query("drop Procedure ".$_GET['nama_sp']."");
if (!$sql_hapus_sp){
header("location:show_sp.php?var_database=".$_GET['var_database']."&pesan=".mysql_error()."");
}
else
{
 $pesan="Procedure '".$_GET['nama_sp']."' Telah terhapus";
 $pesan=stripslashes($pesan);
header("location:show_sp.php?var_database=".$_GET['var_database']."&pesan=".$pesan."");

}
?>





















