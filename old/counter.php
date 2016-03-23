<?php
$con = mysql_connect("matrixpe.net","mpe-server","#Cookies153");
if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("serverauth", $con);

$result = mysql_query("SELECT * FROM srvauth_serverauthdata");
$rows = mysql_num_rows($result);
echo "Players registered:" . $rows;
mysql_close($con);
?>
