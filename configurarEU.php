<?php

require_once('conexion.php');
$id = $_POST['ID'];

$sql = "SELECT * FROM usuario where idUser=$id";
$consulta = mysql_query($sql)or die('Error. ' . mysql_error());
$res='';
while ($row = mysql_fetch_array($consulta)) {
        $res=$row['user'];
}

$sql = "DELETE FROM usuario WHERE user='$res'";
$consulta2 = mysql_query($sql, $con)or die('Error. ' . mysql_error());

$sql = "DELETE FROM citas WHERE usuario='$res'";
$consulta2 = mysql_query($sql, $con)or die('Error. ' . mysql_error());


?>