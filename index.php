<?php
session_start();
error_reporting(0);
 $host = $_SESSION['sessi_host'];
 $user = $_SESSION['sessi_user'];
 
 if ( !empty($host) && !empty($user) ) {
	header("location: home.php"); 
 }

?>
<html>
<head><title>MYSQL-ADMINISTRATOR</title>
<link rel="shorcut icon" href="img/icon003.png" />
<script type="text/javascript" src="./jquery/jquery.js"></script>
<script type="text/javascript" src="./jquery/jquery.corner.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
$('#header').corner('50px top');
$('#footer').corner('50px bottom');
$('table').corner();
$('#wrapper').corner('60px');
});
</script>

<style type="text/css">
body
{
 margin:150;
 font: 100% 'lucida grade', 'trebuchet ms', 'helvetica', 'arial', 'sans-serif'; 
 background-color:#000017;
}
/*pengaturan untuk link*/
a 
{
color: #999900;
}

a:hover, a:focus, a:active
{
 color: #000;
 text-decoration: none;
}

a:focus, a:active
{
 color: #fff;
 background-color: #000000;
}


#wrapper
{
 font-size:0.8em;
 width:300px;
 margin:auto;
 border:1px solid #000033;
 background-color:#9D9D00;
}



 /*layout untuk sidebar*/
#sidebar 
{
	margin: auto;
	padding: 5px;
	width:110px;
	float:center;
	display:inline;
	background-color:#0F1709;
	height:auto;
	color:#750000;
 }
 #sidebar a
{
 color: #ccc;
}
#sidebar a:hover, #sidebar a:focus, #sidebar a:active
{
 color:#eeccll;
}
#sidebar a:focus, #sidebar a:active
{
 background-color:#330099;
}
#sidebar h3
{
 color: #eeccll;
}
 
 /*layout untuk footer*/
#footer 
{
	clear: both;
	padding: 10px;
	margin-bottom: -10px;
	text-align: left;
	font-size:0.9em;
	width:auto;
	height:40px;
	background-image: url(img/footeran.jpeg);
}
#header 
{
	width: auto;
	height: 60px;
	margin-top: -5px;
	border-top: 1px solid #000017;
	background-color:#330000;
	background-image: url(img/header.jpeg);
}

#header h1
{
padding: 0;
margin:0;
}

#header h1 a
{
 display:block;
 width:auto;
 height:auto;
 padding:10px;
 color:#eeccll;
 font-family:'trebuchet ms', helvetica, arial, sans-serif;
 text-decoration:none;
}

#header h1 a:hover, #header h1 a:focus, #header a:active
{
 color:#fff;
 background:transparent;
}

#header h1 a:focus, #header h1 a:active
{
 text-decoration:underline;
}

/*Menu*/
ul#navmenu
{
 margin:0;
 padding:0;
 list-style-type:none;
}

ul#navmenu li
{
 margin-bottom: 5px;
}

ul#navmenu a 
{
	display: block;
	width: 100px;
	height: auto;
	padding: 5px 5px 3px;
	text-align:right;
	text-decoration: none;
	color: #666666;
	cursor: pointer;
	background-color: #1D2004;
}

ul#navmenu a:hover, ul#navmenu a:focus, ul#navmenu a:active,
ul#navmenu a.selected, ul#navmenu a.selected:hover, ul#navmenu a.selected:focus, ul#navmenu a.selected:active
{
 background-color:#2E3506;
 color:#FFFFFF;
}

ul#navmenu a.selected
{
 text-align:left;
 cursor:default;
}

ul#navmenu a:hover, ul#navmenu a:focus, ul#navmenu a:active
{
 background-color: #263717;
 color:#CCCCCC;
}

/*pengaturan untuk link*/
a 
{
color: #996600;
}

a:hover, a:focus, a:active
{
 color: #000;
 text-decoration: none;
}

a:focus, a:active
{
 color: #fff;
 background-color: #000033;
}
h2, h3
{
 color:#3C5C1B;
}
textarea 
{
	background-color:#ffffcc;
    overflow: visible;
}
table
{
    font-size:0.7em;
	background-color:#242400;
}
.style2 {
	color: #99CC00;
	font-weight: bold;
}
.style3 {
	color: #999900;
	font-weight: bold;
}
.style4 {color: #242400; font-weight: bold; }
</style>

<head>
	
<body>
	<div id="wrapper"> <!-- pembungkus semua halaman-->
		<div id="header">
			<h1 align='center'>
			<a href="home.php">SQL-Radmin</a>
			</h1>
		</div><!-- akhir header -->
		<div id="content">
		<center>
<form action='login.php' method='post'>
<table bgcolor="#ffffcc">
<?php
echo "<tr><center><h5>".$_GET['gagal_koneksi']."</h5>".$_GET['pesan_logout']."<center></tr>";
?>
<tr>
<td><span class="style2">HOST</span></td>
<td>:</td>
	<td><input type="text" size='10' name="host_mysql" value="localhost"></td>
</tr>
<tr>
<td><span class="style3">USER</span></td>
<td>:</td>	
	<td><input type="text" size='10' name="user_mysql"></td>
</tr>
<tr>	
<td><span class="style3">PASSWORD</span></td>
<td>:</td>	
	<td><input type="password" size='10' name="password_mysql"></td>
</tr>
<tr>
<td><span class="style3">PORT</span></td>
  <td>:</td>
<td><input type="text" size='5' name="port_db" value="3306"></td>
</tr>
<tr></tr>
<tr>
<td><input type="submit" name="login" value="Login"></td>
</tr>
</table>
	</form>
</center>
		</div>
		<!--akhir dari content-->
		<div id="footer">
		<h3 align='center'>TOOL ADMINISTRASI MYSQL</h3>";
		</div><!--akhir dari footer-->
	</div><!-- akhir wrapper-->
<body>
</html>




















