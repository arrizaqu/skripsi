<?php
ob_start();
session_start();

include ("fungsi.php");
?>
<html>
<head><title>MYSQL-ADMINISTRATOR</title>
<link rel="StyleSheet" href="index.css" type="text/css">
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
		<h3>Menghapus User</h3>		
<p>
<?php
  $db_mysql=mysql_select_db("mysql");
  $hasil=@mysql_query("delete from user where user = '".$_GET['var_user']."' and host = '".$_GET['host']."'");
  $hasil2=mysql_query("delete from db where user = '".$_GET['var_user']."' and host = '".$_GET['host']."'");
  if(!$hasil){
  echo '<h4>Pesan Kesalahan:</h4>';
  echo mysql_error();
  }
  else
	{	
		echo 'Berhasil menghapus User: '.$_GET['var_user'];
		mysql_query("flush privileges");
		header("location:add_user.php");
	}
?>
<p>		<form action="add_user.php">
			<input type="submit" value="Lanjutkan"/>
		</form>
</p>
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
				<li><a href="aboutme.php">Tentang Saya</i></a></li> 
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




















