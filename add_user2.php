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
<script type='text/javascript'>
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
	<div id="wrapper"> <!-- pembungkus semua halaman-->
		<div id="header">
			<h1>
			<a href="home.php">SQL-Radmin</a>
			</h1>
		</div><!-- akhir header -->
		<div id="content">	
<p>

<?php
$user_name=$_POST['user_name'];
$user_host=$_POST['user_host'];
$user_pass=$_POST['user_pass'];
$var_database=$_POST['var_database'];
//============= untuk men-loop hasil priv yang akan dijadikan sebagai hak akses dalam setiap database ===================//
   $q=0;
			foreach($_POST['priv'] as $key => $value_priv){
			if($q==0)
			 $result_priv .="".$value_priv."";
			else
			$result_priv .=",".$value_priv."";
			$q++;
			 }
	// hasilnya ditampung pada variable $result_priv

  $db_mysql=mysql_select_db("mysql");
  $create_user="create user '".$_POST['user_name']."'@'".$_POST['user_host']."' identified by '".$_POST['user_pass']."'";
	$query =mysql_query ($create_user, $koneksi);
	if (!$query){
	echo mysql_error();
	}
	else{
	echo '<h3>Operasi <i>Menciptakan User</i></h3>';
	echo '<b>Query:</b><br />';
	echo '<textarea cols="60">';
	echo $create_user;
	echo '</textarea>';
	echo '<br /> Berhasil Menciptakan User '.$user_name.'<br />';
	}
	//seleksi Radio Box
	
	if($query){
	echo '<hr></hr>';
	echo '<h3>Operasi <i>Grant Privileges</i></h3>';
if (($r==1)&&($p==3)){
   $query_priveleges="grant all privileges on *.* to '$user_name'@'$user_host' identified by '$user_pass';"; 
   $sql=mysql_query($query_priveleges);
   if($sql){
   echo '<b>Query:</b><br />';
   echo '<textarea cols="60">';
   echo $query_priveleges;
   echo '</textarea>';
   echo '<br>pemberian Grant user '.$user_name.' berhasil dilakukan<br/>';
   }
   else{
    echo $query_priveleges;
    echo '<br>
	<b>pesan error:</b>
	<br />';
	echo mysql_error();
   }
   }

else if (($r==2)&&($p==3)){
    if(!empty($_POST['var_database'])){
		foreach($_POST['var_database'] as $key => $value_db){
		 $query_priveleges="grant all on  ".$value_db.".* to '".$_POST['user_name']."'@'".$_POST['user_host']."' identified by '".$_POST['user_pass']."';";
		 $sql=mysql_query($query_priveleges);
		  if(!$sql)
		  { 
			echo $query_priveleges;
			echo '<br>
			<b>pesan error:</b>
			<br />';
			echo mysql_error();		  }
		   else{
		   echo '<br /><b>Query:</b><br />';
			echo '<textarea cols="60">';
			echo $query_priveleges;
			echo '</textarea>';
			echo '<br/>pemberian Grant user '.$user_name.' berhasil dilakukan';
			mysql_query("flush privileges;");
		   }
		 }
		}
		else {
		$pesan_3="Daftar database belum ada yang ter-cek, Privileges tidak dapat diproses";
		echo $pesan_3;}
   }
  
   else if($r==1){
	if (!empty($_POST['priv'])){
			$query_priveleges="grant ".$result_priv." on  *.* to '".$_POST['user_name']."'@'".$_POST['user_host']."' identified by '".$_POST['user_pass']."';";
			$sql=mysql_query($query_priveleges);
			 if(!$sql)
			{
				echo '<br>
				<b>pesan error:</b>
				<br />';
				echo mysql_error();
			}
			else{
			mysql_query("flush privileges;");
			echo '<br /><b>Query:</b><br />';
			echo '<textarea cols="60">';
			echo $query_priveleges;
			echo '</textarea><br />';
			echo 'Pembuatan User '.$user_name.' berhasil dilakkan';
			}
			
			}
			else
			{
			 $privilege_kosong="Seleksi Privelege Kosong, Privelege GAGAL";
			 echo $privilege_kosong;
			}
   }
   else if($r==2){
	
   if(!empty($_POST['var_database'])){
		foreach($_POST['var_database'] as $key => $value_db){
			if (!empty($_POST['priv'])){
			  $query_priveleges="grant ".$result_priv." on  ".$value_db.".* to '".$_POST['user_name']."'@'".$_POST['user_host']."' identified by '".$_POST['user_pass']."';";
			  $sql_priv=mysql_query($query_priveleges);
			  if(!$sql_priv){
				echo $query_priveleges;
				echo '<br>
				<b>pesan error:</b>
				<br />';
				echo mysql_error();
			  }
			  else{
			  echo '<br /><b>Query:</b><br />';
			  echo '<textarea cols="60">';
			echo $query_priveleges;
			echo '</textarea>';
			echo '</br>';
			echo 'Pembuatan grant privileges User '.$user_name.' berhasil dilakukan';
			  }		 
			}
			else {
			echo "Seleksi Privelege belum Ter-Chek untuk database ".$value_db.", Privliges tidak dapat di Proses";
			echo "<br/>";
			}
		}
		}
	}
	}
	else if(empty($r)&&empty($p))
	{
	 $pesan_6="Maaf Anda belum Men-Set Akses dan Priveleges pada user ".$_POST['user_name']."";
	 echo $pesan_6;
	}
	echo '<p />';
	echo '<a href="add_user.php">KEMBALI</a>';
?>
</div><!--akhir dari content-->
	
		<div id="sidebar">
			<h3 id="navigasi">MENU</h3>
			<ul id="navmenu">
				<li><a href="home.php"><i>Home</a></li>
				<li><a href="create_db.php">Buat Database</a></li>
				<?php echo "
				<li><a href='mysqlquery.php?var_database=$var_database' class='selected'>Query</a></li>";?>
				<li><a href="add_user.php">Manajemen User</a></li>  
				<li><a href="sp.php">Stored Procedure</a></li>
				<li><a href="refresh.php">Flush Privilege</a></li>
				<li><a href="aboutme.php">Tentang Saya</i></a></li> 
			</ul> 
			<?php
		$pesan_logout="<h5>Anda sudah Logout..</h5>";
		echo "<a href=\"logout.php?pesan_logout=$pesan_logout\"><h4>Keluar</h4></a>"
		?>
		</div><!--akhir dari sidebar-->
		<div id="footer">
		<h3>TOOL ADMINISTRASI MYSQL</h3>";
		</div><!--akhir dari footer-->
	</div><!-- akhir wrapper-->
<body>
</html>






















