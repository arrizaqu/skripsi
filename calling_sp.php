<?php
ob_start();
session_start();
error_reporting(0);

$sessi_host =  $_SESSION['sessi_host'];
$sessi_user =	$_SESSION['sessi_user'];
$sessi_password =  $_SESSION['sessi_password']; 

$var_database=$_GET['var_database'];
$call_procedure="call ".$_GET['procedure']."()";
$link=mysqli_connect("$sessi_host","$sessi_user","$sessi_password",$var_database) or die (header("location:logout.php"));
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
<p>
<?php
echo "<h3>Server:<i><a href='home.php'>".$_SESSION['sessi_host']."</a></i> <img src='./img/jr.png' /> Database:<i><a href='show_sp?var_database=".$var_database."'>".$_GET['var_database']."</a></i></h3>";
$tampil_sp="select specific_name, routine_definition from information_schema.routines where routine_type='procedure' and routine_name='".$_GET['procedure']."' and routine_schema='".$_GET['var_database']."'";
$result_sp=mysqli_query($link,$tampil_sp);
echo "<h3 align='center'>Procedure: ".$_GET['procedure']."</h3>";
		echo '<div style="overflow:auto;">';
		echo "<table border='0'>";
		echo "<tr>";
		//menampilkan nama field
		$nama_field_sp=mysqli_fetch_fields($result_sp);
		foreach ($nama_field_sp as $val_sp) {
		echo "<th>";
        echo $val_sp->name;
		echo "</th>";
    }
		
		echo "</tr>";
		//menampilkan record
		while ($row=mysqli_fetch_row($result_sp)){
		echo "<tr bgcolor='white'>";
		 for($i=0;$i<mysqli_num_fields($result_sp);$i++) {
		 echo "<td>".htmlentities($row[$i])."</td>";
		 }
		 echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
?>
<form action="<?php $PHP_SELF?>" method="post">
	
	<?php
	echo "<p><h3>Query:<br/></h3>";
	echo "<textarea cols=\"60\" rows=\"5\" name=\"perintah\">";
	$call_procedure=stripslashes(htmlspecialchars($call_procedure));
	echo $call_procedure;
	echo "</textarea></p>";
	?>
	</p>
	<p><input name="kirim" type="submit" value="Proses"></p>
	</form>
	
	<?php
	if ($kirim){
	$perintah=stripslashes($perintah);
	echo "<p>Perintah : ".nl2br(htmlentities($perintah))."</p>";
	
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
			echo '<i>Query berhasil dilakukan</i>';
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
                echo '<td>'.$rowss[$i].'</td>';
				}
				echo '</tr>';
            }
		?>
		</table>
		</div>
		<?php
           // mysqli_free_result($results);
        }
    } 
	while ($mantab=mysqli_next_result($link));
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




















