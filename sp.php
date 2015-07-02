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
<?php
 $hasil=mysql_list_dbs($koneksi);
?>
	<div id="wrapper"> <!-- pembungkus semua halaman-->
		<div id="header">
			<h1>
			<a href="home.php">SQL-Radmin</a>
			</h1>
		</div><!-- akhir header -->
		<div id="content">		
<p>
<h3>Buat Store Procedure</h3>
<center>
<?php
echo "".$_GET['pesan']."";
?>
<form action="sp2.php" method="post">
    <TABLE BORDER='0' CELLPADDING=3 CELLSPACING=5 BGCOLOR="#FFFFCC">  
    <TR>  
         <TD>Nama: <br />
		 <INPUT type="text" NAME="nama"></TD>  
         <TD ROWSPAN=3>SQL<BR />  
         <TEXTAREA COLS=25 ROWS=15 name="sql_query"></TEXTAREA><br/>
		  <input type="submit" name="submit" value="simpan">
		 </TD>
		
		 </TR>  
    <TR> <TD>Parameter: <br />
		 <INPUT type="text" name="parameter"></TD></TR>  
    <TR> <TD>Database: <br />
		<?php
		 echo "<SELECT name='var_database'>";
		 while ($row_db=mysql_fetch_array($hasil))
		{
		if(!empty($_GET['var_database']))
		{
			if($row_db[0]==$_GET['var_database']){
			echo '<option selected>'.$row_db[0].'</option>';
			}
			else{
			echo '<option>'.$row_db[0].'</option>';
			}
		}
		else{
        echo "<OPTION VALUE='$row_db[0]'>$row_db[0]</option>";
		}
		}
		echo "</select>";
		
		?>
		
		</TD></TR>  
   </TABLE>  
   </form>
</center>   
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
				<li><a href="sp.php" class="selected">Stored Procedure</a></li>
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




















