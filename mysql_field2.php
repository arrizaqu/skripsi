<?php
session_start();
error_reporting(0);
include ("fungsi.php");
?>
<html>
<head><title>Manupulasi record</title></head>
<body>
<?php

mysql_select_db("$var_database", $koneksi);
$result=mysql_query("select * from $tabel");
if(!$result){
echo mysql_error();
}
$hasil=mysql_num_rows($result);

//menampilkan nama field
echo "<table>";
 for ($i;$i<mysql_num_fields($result);$i++)
	{
	 $nama_field=mysql_field_name($result,$i);
	 echo "<th>$nama_field</th>";
	}
 while($row=mysql_fetch_row($result))
	{
	 for ($i=0;$i<mysql_num_fields(result);$i++)
	 { 
		echo "<td>".htmlentities($row[$i])."</td>";
		//mendapatkan field pertama untuk proses hapus
		$a=$row[0];
		$field=mysql_list_fields("$database","$tabel");
		$name=mysql_field_name($field,0);
		echo"<td><a href='hapus_data.php?var_database&tabel=$tabel&query=delete from $tabel where $name='$a' limit 1'>Delete</a></td>";
	 }
	} 
echo "$nama";
echo "$var_database";
?>
<body>
</html>