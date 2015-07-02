<?php
session_start();
error_reporting(0);
include ("fungsi.php");

$tabel=$_POST['tabel'];
$add_field=$_POST['add_field'];
$type_field=$_POST['type_field'];
$size_type=$_POST['size_type'];
$posisi=$_POST['posisi'];
$name_field=$_POST['name_field'];
$var_database=$_POST['var_databae'];

mysql_select_db($_POST['var_database']);
//contoh : ALTER TABLE pasien ADD alamat VARCHAR (50) AFTER tglahir;
if(!empty($size_type)){
$sql_add_field=mysql_query("alter table ".$_POST['tabel']." ADD ".$add_field." ".$type_field." (".$size_type.") ".$posisi." ".$name_field." ");
}
else{
$sql_add_field=mysql_query("alter table ".$_POST['tabel']." ADD ".$add_field." ".$type_field." ".$posisi." ".$name_field." ");
}
if (!$sql_add_field){
header("location:mysql_field.php?var_database=".$_POST['var_database']."&tabel=".$_POST['tabel']."&pesan=".mysql_error()."");
echo mysql_error();
}
else{
header("location:mysql_field.php?var_database=".$_POST['var_database']."&tabel=".$_POST['tabel']."");
}
?>