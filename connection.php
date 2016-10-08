<?php
$mysql_host = "**";
$mysql_user = "**";
$mysql_password = "**";
$mysql_database = "**";
$conexion = mysql_connect($mysql_host, $mysql_user, $mysql_password);
mysql_select_db($mysql_database, $conexion) or die (mysql_error());
?>
