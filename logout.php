<?php
session_start();
session_destroy();
$gagal_koneksi=$_GET['gagal_koneksi'];
$pesan_logout=$_GET['pesan_logout'];
header("location:index.php?gagal_koneksi=$gagal_koneksi&pesan_logout=$pesan_logout");
?>