<?php

require_once('conexion.php');
$id = $_POST['ID'];

$sql = "UPDATE citas SET estado='Cancelada' WHERE idCita=" . $id;
$consulta = mysql_query($sql, $con)or die('Error. ' . mysql_error());
$res = 'No';
if ($consulta) {
    $res = 'si';
}
echo $res;
?>



UPDATE `citas` SET `idCita`=[value-1],`lugar`=[value-6],`citaCon`=[value-7],`comentario`=[value-8],`estado`=[value-9] WHERE 1