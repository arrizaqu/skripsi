<?php

include ("fungsi.php");

$query_drop_column=$_GET['query_drop_column'];
mysql_select_db("".$_GET['var_database']."");
$drop_column=mysql_query($query_drop_column);
$pesan="hapus column OK";
if($drop_column){
header ("location:mysql_field.php?var_database=".$_GET['var_database']."&tabel=".$tabel."");
}
else{
header ("location:mysql_field.php?var_database=".$_GET['var_database']."&tabel=".$tabel."&pesan=".mysql_error()."");
}

?>