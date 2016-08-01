<?php

$servidor="localhost";
$usuario="root";
$contrasena="";
$baseDatos="agenda";
$con=mysql_connect($servidor,$usuario,$contrasena)or die("Error de conexión".mysql_error());
mysql_select_db($baseDatos,$con);
?>

