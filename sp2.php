<?php
ob_start();
session_start();
error_reporting(0);
include ("fungsi.php");
$var_database=$_POST['var_database'];

	if(empty($var_database)){
	echo mysql_error();
	}
 	$koneksi_db=mysql_select_db("".$_POST['var_database']."");
	if(!$koneksi_db){
	header("location:show_sp?var_database=".$_POST['var_database']."&pesan=gagal berkomunikasi dengan database");
	}
	$query = "CREATE PROCEDURE ".$_POST['nama']."";
	$query .="(".$_POST['parameter'].")";
	$query.= " BEGIN";
	$query.= " ".$_POST['sql_query']."";
	$query.= " END";
	$query=stripslashes($query);
	$show_sp_query=$query; 
	$sql_sp=mysql_query($query);
	if (!$sql_sp){
	$pesan='query tidak dapat dilakukan cek kembali kode sumber query';
	header("location:show_sp?var_database=$var_database&pesan=".$pesan."");
	}
	else{
	$pesan="Berhasil menciptakan procedure '".$_POST['nama']."'";
	header("location:show_sp?var_database=".$_POST['var_database']."&pesan=".$pesan."");
	}

	
?>




















