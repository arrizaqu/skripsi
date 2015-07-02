<html>
<head><title>MYSQL-ADMINISTRATOR</title>
<link rel="shorcut icon" href="img/icon003.png" />
<link rel="StyleSheet" href="index.css" type="text/css" />
<script type="text/javascript" src="./jquery/jquery.js"></script>
<script type="text/javascript" src="./jquery/jquery.corner.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
$('#header').corner('50px top');
$('#sidebar').corner("35px left");
$('#footer').corner('50px bottom');
$('table').corner("top");
$('#wrapper').corner('60px');
});
</script>

<head>
	
<body>
	<div id="wrapper"> <!-- pembungkus semua halaman-->
		<div id="header">
			<h1>
				<a href="home.php">SQL-Radmin</a>
			</h1>
		</div><!-- akhir header -->
		<div id="content">
		
		<h3>&nbsp;</h3>
		<table width="320" border="0" align="center">
          <tr>
            <th colspan="2" scope="col">Tentang Saya</th>
          </tr>
          <tr>
            <td width="121" bgcolor="#FFFFFF">Nama Mahasiswa</td>
            <td width="183" bgcolor="#FFFFFF">Masyda Arrizaqu </td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">NIM</td>
            <td bgcolor="#FFFFFF">075410033</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">Jurusan</td>
            <td bgcolor="#FFFFFF">Teknik Informatika </td>
          </tr>
		  <tr>
            <td bgcolor="#FFFFFF">Judul Skripsi</td>
            <td bgcolor="#FFFFFF">Administrasi MySQL dan Stored Procedure dengan PHP</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">Jenjang</td>
            <td bgcolor="#FFFFFF">S1 </td>
          </tr>
		  <tr>
            <td bgcolor="#FFFFFF">Nama Aplikasi</td>
            <td bgcolor="#FFFFFF">SQL-Radmin Versi 1.0</td>
          </tr>
		  <tr>
            <td bgcolor="#FFFFFF"><i>Requitment</i></td>
            <td bgcolor="#FFFFFF">berjalan baik pada Appserv 2.5.10</td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#FFFFFF"><p align="center">SEKOLAH TINGGI INFORMATIKA DAN KOMPUTER</br>
			AKAKOM YOGYAKARTA<br>
			2011
			</p>
			</td>
          </tr>
        </table><p/>
		<table bgcolor='silver'><td>
		aplikasi ini saya beri nama SQL-Radmin, yang merupakan aplikasi yang maksudkan untuk memudahkan 
		setiap pengguna dalam melakukan Administrasi MySQL server, guna melengkapi tugas akhir jenjang S-1, 
		dalam implementasinya masih banyak yang harus diperbaiki. selebihnya dapat hubungi email
		di email saya: arrizaqu@yahoo.com.
		</td></table>
		</div><!--akhir dari content-->
		<div id="sidebar">
			<h3 id="navigasi">MENU</h3>
			<ul id="navmenu">
				<li><a href="home.php"><i>Home</a></li>
				<li><a href="create_db.php">Buat Database</a></li>
				<?php echo "
				<li><a href='mysqlquery.php?var_database=$var_database'>Query</a></li>";?>
				<li><a href="add_user.php">Manajemen User</a></li>  
				<li><a href="sp.php">Stored Procedure</a></li>
				<li><a href="refresh.php">Flush Privilege</a></li>
				<li><a href="aboutme.php" class="selected">Tentang Saya</i></a></li> 
			</ul> 
			<?php
		$pesan_logout="<h5>Anda sudah Logout..</h5>";
		echo "<a href=\"logout.php?pesan_logout=$pesan_logout\"><h4>logout</h4></a>"
		?>
		</div><!--akhir dari sidebar-->
		<div id="footer">
		<h3>TOOL ADMINISTRASI MYSQL</h3>";
		</div><!--akhir dari footer-->
	</div><!-- akhir wrapper-->
<body>
</html>




















