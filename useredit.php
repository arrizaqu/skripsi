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
<script language="JavaScript">
<!--
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
  alert('Anda belum memilih satupun.');
  return(false);
}

function confirmSubmit() {
var agree=confirm("Apakah anda yakin untuk ini?");
if (agree)
     return true;
else
     return false;
}
// -->
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

echo "<H3>Ubah <i>Privilege</i> <img src=./img/jr.png /> USER : <a href='".$_SELF_PHP."'>'$var_user'@'$host'</a></H3>";


?>
<form action='useredit.php' method="post">
<input type="hidden" name="var_user" value="<?php echo $_GET['var_user'];?>">
<input type="hidden" name="host" value="<?php echo $_GET['host'];?>">
		<h5>Ganti Password</h5>
		<table>
		
		<tr>
		<td>Password baru</td>
		<td>:</td>
		<td><input type="password" name="userpass_baru"></td>
		</tr>
		<tr>
		<td>Konfirmasi Password</td>
		<td>:</td>
		<td><input type="password" name="userpass_confirmasi"></td>
		</tr>

		</table><?php echo "<input type='hidden' value='$var_user' name='var_user'>";
					  echo "<input type='hidden' value='$host' name='host'>";
				?>
				<input type="submit" name="submit" value="Ubah Password" onclick='return confirmSubmit()' >
				
		</form>
<?php
if ($_POST['submit']){
$userpass_baru=$_POST['userpass_baru'];
$userpass_confirmasi=$_POST['userpass_confirmasi'];


	$db_mysql=@mysql_select_db("mysql");
	if (!$db_mysql){
	echo mysql_error();
	}
	if(($userpass_baru!==$userpass_confirmasi)){
	echo 'Password tidak cocok dengan konfirmasi password..';
	}
	else {
	$query =@mysql_query("update user set password = password('".$_POST['userpass_baru']."') where user ='".$_POST['var_user']."'");	
	if ($query){
	$query=mysql_query("flush privileges");
	if($sessi_user==$_POST['var_user']){
	$sessi_password=$userpass_baru;}
	echo 'PASSWORD USER '.$_POST['var_user'];
	echo ' berhasil terganti';
	$pesan="password berhasil diganti";
	}
	else{
	echo mysql_error();
	}
}
}	
echo "<center>".$_GET['pesan']."</center>";
echo "<h3>Tingkat Privilege: DATABASE</h3>";
 mysql_select_db("mysql"); 
//menampilkan seluruh record
$sql_tabel=@mysql_query("select * from db where user='$var_user' and host='$host'",$koneksi);
if(!$sql_tabel){
echo mysql_error();
}
// daftar seluruh field
$sql_field=@mysql_list_fields("mysql","db");
if(!$sql_field){
echo mysql_error();
}
//banyaknya field
$jumlah_field=@mysql_num_fields($sql_field);
if(!$jumlah_field){
echo mysql_error();
}
//menghitung banyaknya record
$jumlah_record=mysql_num_rows($sql_tabel);
if(!$jumlah_record){
echo mysql_error();
}
echo "jumlah record $jumlah_record";

echo '<div style="overflow: auto;">';

echo "<table border='0' align=center bgcolor='#ffffcc'><tr>";
for ($i=0;$i<mysql_num_fields($sql_tabel);$i++)
{
	//menampilkan nama field
	$nama[]=mysql_field_name($sql_tabel,$i);
	echo "<th>$nama[$i]</th>";
}
   //menampilkan nama record
   $j=0;
   $i=0;
while ($row=mysql_fetch_row($sql_tabel))
   {$i++;
   $j++;
    echo "<tr bgcolor='white'>";
	$no=0;
	for ($k=0;$k<$jumlah_field;$k++)
	{$no++;
	$sql_field=@mysql_list_fields("mysql","db");
	 echo "<td>$row[$k]</td>";
	 /*
	 $nama[$k] dijadikan sebagai wadah variable dari value seluruh nama field yang ada tabel
	 $nama[0] akan mencek dari jumlah record dari nama field yang ada dari jumlah record yang pertama
	 */ 
	 if($nama[$k]==$nama[0])
	 /*$queryx[$i] berfungsi sebagai wadah untuk menampung dari seluruh nama field yang dicocokkan dengan
	 jumlah value pada record yang ada didalam array $nama
	*/ 
	  $queryx[$i] .=" $nama[$k] = '$row[$k]' ";
	 else
	 $queryx[$i] .="and $nama[$k] = '$row[$k]' ";
	}
	$query[$i]="$queryx[$i]";
	$pengenal="
	<h3>USER: '".$_GET['var_user']."'@'".$_GET['host']."'</h3>";
	 echo "<td><a href=\"hapus_priv.php?var_user=$var_user&host=$host&var_database=mysql&tabel=db&query=delete from db where $query[$i]\" onclick='return confirmSubmit()'>hapus</a></td>";
	 echo "<td><a href=\"edit_priv.php?var_user=$var_user&host=$host&pengenal=$pengenal&var_database=mysql&tabel=db&data_edit=$query[$i]\">Edit</a></td>";
	echo "</tr>";
   }
   echo "</table>";
   echo '</div>';
   
   //============================================================

   echo "<h3>Tingkat Privilege: USER (Global Privilege)</h3>";
   //menampilkan seluruh record
$sql_tabel=@mysql_query("select * from user where user='$var_user' and host='$host'",$koneksi);

// daftar seluruh field
$sql_field=@mysql_list_fields("mysql","user");
if(!$sql_field){
echo mysql_error();
}
//banyaknya field
$jumlah_field=@mysql_num_fields($sql_field);
if(!$jumlah_field){
echo mysql_error();
}
//menghitung banyaknya record
$jumlah_record=mysql_num_rows($sql_tabel);
if(!$jumlah_record){
echo mysql_error();
}
echo "jumlah record $jumlah_record";

echo '<div style="overflow: auto;">';

echo "<table border='0' align=center bgcolor='#ffffcc'><tr>";
for ($i=0;$i<mysql_num_fields($sql_tabel);$i++)
{
	//menampilkan nama field
	$nama_user_id[]=mysql_field_name($sql_tabel,$i);
	echo "<th>$nama_user_id[$i]</th>";
}
   //menampilkan nama record
   $j=0;
   $i=0;
while ($row=mysql_fetch_row($sql_tabel))
   {$i++;
   $j++;
    echo "<tr bgcolor='white'>";
	$no=0;
	for ($k=0;$k<$jumlah_field;$k++)
	{$no++;
	$sql_field=mysql_list_fields("mysql","user");
	 echo "<td>$row[$k]</td>";
	}
	
	$id_user="host='".$host."' and user='".$var_user."'";
	$pengenal="<h3>USER: '".$_GET['var_user']."'@'".$_GET['host']."'</h3>";
	 echo "<td><a href=\"hapus_priv.php?var_user=$var_user&level_user=ada&host=$host&var_database=mysql&tabel=user&query=delete from user where $id_user\" onclick='return confirmSubmit()'>hapus</a></td>";
	 echo "<td><a href=\"edit_priv.php?var_user=$var_user&host=$host&pengenal=$pengenal&var_database=mysql&tabel=user&data_edit=$id_user\">Edit</a></td>";
	echo "</tr>";
   }
   echo "</table>";
   
?>	
	</div><!--akhir div style overflow-->

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
				<li><a href="refresh.php">Tentang Saya</a></li>
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




















