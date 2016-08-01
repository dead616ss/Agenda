<?php

require_once('conexion.php');
$id = $_POST['ID'];

$sql = "DELETE FROM usuario WHERE idUser=" . $id;
$consulta = mysql_query($sql, $con)or die('Error. ' . mysql_error());
$res = 'No';
if ($consulta) {
    $res = 'si';
}
echo $res;
?>