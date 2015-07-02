<?php
session_start();
 
  $_SESSION['sessi_host'] = $_POST['host_mysql'];
  $_SESSION['sessi_user'] = $_POST['user_mysql']; 
  $_SESSION['sessi_password'] = $_POST['password_mysql'];
  $_SESSION['sessi_port'] = $_POST['port_db'];
  
  
$gagal_koneksi="Akun invalid,..!!";
include 'fungsi.php';
  if ($koneksi){
	header('location:home.php');}
  else {
  header ("location:logout.php?gagal_koneksi=$gagal_koneksi");
  }

?> 
