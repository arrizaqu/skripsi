<?php
session_start();
error_reporting(0);
include ("fungsi.php");
?>
<html>
<head><title>MYSQL-ADMINISTRATOR</title>
<link rel="shorcut icon" href="img/icon003.png" />
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
<p>

<?php
$collation_name=mysql_query("select collation_name from information_schema.collations"); 
?>

	<form action="create_db2.php" method="post">
		<h3>Buat Database</h3>
		Nama Database : <input type="text" name="var_database"></input>
		<select name='nama_collation' >
		<option value=''>Collation</option>
		<?php
		while ($row_collation_name=mysql_fetch_row($collation_name)){
		echo    "<option value='$row_collation_name[0]'>$row_collation_name[0]</option>";
		}
		?>
		</select>
		<input type="submit" name="submit"value="Proses" >
	</form>
</p>

		</div><!--akhir dari content-->
	
		<div id="sidebar">
			<h3 id="navigasi">MENU</h3>
			<ul id="navmenu">
				<li><a href="home.php"><i>Home</a></li>
				<li><a href="create_db.php" class="selected">Buat Database</a></li>
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




















