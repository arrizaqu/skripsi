
<?php
session_start();


include ("fungsi.php");

mysql_select_db("test");
$query=mysql_query("show create procedure;");

echo "<table>";
while ($row=mysql_fetch_row($query))
{
 echo "<tr><td>$row[0]</td></tr>";
}
echo "</table>";

?>