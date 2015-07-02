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
<script type="text/javascript">

function check_radio(form){
  var i;
  for(i=0;i<document.forms[form].r.length;i++){
    if(document.forms[form].r[i].checked){
      return(true);
    }
	else if(document.forms[form].p[i].checked){
      return(true);
    }
  }
  return(false);
}

function SelectDB() {
 document.getElementById('tableDB').style.display = 'block';
}
function selectAll() {
 document.getElementById('tableDB').style.display = 'none';
}
function selectPriv() {
 document.getElementById('tablePriv').style.display = 'block';
}
function AllPriv() {
 document.getElementById('tablePriv').style.display = 'none';
}

function confirmSubmit() {
var agree=confirm("Apakah anda yakin untuk ini?");
if (agree)
     return true;
else
     return false;
}

</script>
<head>
	
<body>
<?php

?>
	<div id="wrapper"> <!-- pembungkus semua halaman-->
		<div id="header">
			<h1>
			<a href="home.php">SQL-Radmin</a>
			</h1>
		</div><!-- akhir header -->
		<div id="content">
		<h3>Manajemen User</h3>		
<p>
<?php
	$db_mysql=mysql_select_db("mysql");
	if(!$db_mysql){
	echo mysql_error();
	}
	else{
	$hasil=mysql_query("select user from user order by user, host, password asc");
	$hasil_host=mysql_query("select host from user order by user, host, password asc");
	$hasil_password=mysql_query("select password from user order by user, host, password asc");
	$sql_db=mysql_query("show databases;");
	if ($db_mysql)
	{	
		echo "<table border='0'>
					<tr>
						<th>No</th>
						<th>Host</th>
						<th>User</th>
						
					</tr>";
	$no==0;
	$jum=0;
	
	while (($row_user=mysql_fetch_array($hasil))&&($row_host=mysql_fetch_array($hasil_host))){
	echo "<tr bgcolor='white'>";
		$jum=$jum+1;
		$no++;
		
		echo "
			<td>$no</td>
			<td>
			$row_host[0]
			</td>
			<th>$row_user[0]</th>
			<td>
				<a href=\"useredit.php?var_user=$row_user[0]&host=$row_host[0]\">Edit</a>
			</td>
			<td>
				<a href=\"drop_user.php?var_user=$row_user[0]&host=$row_host[0]\" onclick='return confirmSubmit()'>Hapus</a>
			</td>
		</tr>";
		
	}
	echo "</table>";
		
	}
?>
<form action="add_user2.php?" method="post">
		<h3>Tambah User</h3>
		<table bgcolor='#ffffcc'>
		<tr>
		<td>Host</td>
		<td>:</td>
		<td><input type="text" name="user_host" value="localhost"/></td>
		</tr>
		<tr>
		<td>Nama</td>
		<td>:</td>
		<td><input type="text" name="user_name"/></td>
		</tr>
		<tr>
		<td>Password</td>
		<td>:</td>
		<td><input type="password" name="user_pass"></td>
		</tr>
		</table><p>
		
		<?php
		echo "<h2>Akses Database:</h2>";
		echo "<h3>
		<input type='radio' checked name='r' value='1' onclick='selectAll()' />Semua Database<br/>
		<input type='radio' name='r' value='2' onclick='SelectDB()' />Pilih Database<br/></h3>";
		
		echo "<table id='tableDB' style='display:none;'>";
		$i=0;
		
		while ($row_db=mysql_fetch_row($sql_db)) 
		{
		$i++;
		 echo "<tr>";
		 echo "<td>";
		 echo "<input type='checkbox' value='$row_db[0]' name='var_database[$i]'>$row_db[0]";
		 echo "</td>";
		 echo "</tr>";
		}
		echo "</table>";
	 echo "<h2>Hak Akses User:</h2>";
	 echo "<h3>
		<input type='radio' name='p' checked value='3' onclick='AllPriv()' />Semua <i>Privelege</i><br/>
		<input type='radio' name='p' value='4' onclick='selectPriv()' />Pilih <i>Privelege</i><br/> </h3>";
	echo "<table id='tablePriv' style='display:none;'>";
	echo "
				<tr>
					<td>
					<label><input type='checkbox' value='SELECT' name='priv[0]'>Select</label>
					</td>
					<td>
					<label><input type='checkbox' value='INSERT' name='priv[1]'>Insert</label>
					</td>
				</tr>
				<tr>
					<td>
					<label><input type='checkbox' value='UPDATE' name='priv[2]'>Update</label>
					</td>
					<td>
					<label><input type='checkbox' value='DELETE' name='priv[3]'>Delete</label>
					</td>
				</tr>
				<tr>
					<td>
					<label><input type='checkbox' value='INDEX' name='priv[4]'>Index</label>
					</td>
					<td>
					<label><input type='checkbox' value='ALTER' name='priv[5]'>Alter</label>
					</td>
				</tr>
				<tr>
					<td>
					<label><input type='checkbox' value='CREATE' name='priv[6]'>Create</label>
					</td>
					<td>
					<label><input type='checkbox' value='DROP' name='priv[7]'>Drop</label>
					</td>
				</tr>

		</table>";
echo "
  <input type='submit' value='Simpan'/ name='submit'></form>";
  echo $_GET['pesan'];
  echo $_GET['query_priveleges'];
   echo "".$_GET['pesan_1']."";
  echo "".$_GET['pesan_2']."";
  echo "".$_GET['pesan_3']."";
  echo "".$_GET['pesan_4']."";
  echo "".$_GET['pesan_5']."";
  echo "".$_GET['pesan_6']."";
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
				<li><a href="add_user.php" class="selected">Manajemen User</a></li>  
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




















