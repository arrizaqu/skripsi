<?php
//fungsi.php
session_start();

$sessi_host =  $_SESSION['sessi_host'];
$sessi_user =	$_SESSION['sessi_user'];
$sessi_password =  $_SESSION['sessi_password']; 
$sessi_port = $_SESSION['sessi_port'];

$gagal_koneksi="Silahkan Login kembali,..!!";
$koneksi=@mysql_connect("$sessi_host: $sessi_port","$sessi_user","$sessi_password") or die (header("location:logout.php?gagal_koneksi=$gagal_koneksi"));
?>