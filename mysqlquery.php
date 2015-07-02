<?php
ob_start();
session_start();

$link=mysqli_connect($_SESSION['sessi_host'],$_SESSION['sessi_user'],$_SESSION['sessi_password'],$_GET['var_database']);
if(!$link){
header ("location:logout.php");
}
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
<h2>MySQL QUERY</h2>
<form action="<?php $PHP_SELF?>" method="post">	
PIlIH DATABASE:<select name='var_database'>

<?php

	$tampil_db="show databases;";
	$query_tampil_db=mysqli_query($link,$tampil_db);
	while ($row_db=mysqli_fetch_row($query_tampil_db)){
	if($row_db[0]==$var_database){
		echo '<option selected>'.$row_db[0].'</option>';
		}
	else{
		echo '<option>'.$row_db[0].'</option>';
		}
	}
	
?>
</select>
<?php
	echo "<textarea cols=\"60\" rows=\"5\" name=\"perintah\">";
	$call_procedure=stripslashes(htmlspecialchars($call_procedure, ENT_QUOTES));
	echo $call_procedure;
	echo "</textarea><br/>";
	echo 'NB: Mendukung untuk melakukan Multi Query.';
	echo "</p>";
	?>
	</p>
	<p><input name="kirim" type="submit" value="Proses"></p>
	</form>
	
	<?php
	if ($kirim){
	$perintah=stripslashes($perintah);
	echo "<p>Perintah : <br/> ".nl2br(htmlentities($perintah))."</p>";
	
	$konek_db=mysqli_select_db($link,$var_database);
	
if ($asli=mysqli_multi_query($link, $perintah));
if($asli==true)
{
$y=0;
    do {
	$y++;
	if($asli){
	echo '<hr/>';
		echo '<table><tr><td>QUERY KE '.$y.'</td></tr></table>';
		echo '<i>query berhasil dilakukan</i>';
	}
        /* store first result set */
        if ($results = mysqli_store_result($link)) {
		?>
		<div style='overflow:auto;' align='center'>
		<table>
		<?php
			$nama_field=mysqli_fetch_fields($results);
			foreach ($nama_field as $val) {
			echo "<th>";
			echo $val->name;
			echo "</th>";
			}
		
            while ($rowss = mysqli_fetch_row($results)) {
				echo '<tr bgcolor="white">';
				$i=-1;
				foreach($rowss as $names){
				$i++;
                echo '<td>'.htmlentities($rowss[$i]).'</td>';
				}
				echo '</tr>';
            }
		?>
		</table>
		</div>
		<?php
           // mysqli_free_result($results);
			echo '<center>Hasil OUTPUT</center>';
			
        }
    } 
	while ($mantab=mysqli_next_result($link));
		echo '<hr />';
		echo mysqli_error($link);
}
else{
	echo mysqli_error($link);
	}
}
	?>
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




















