<?php

require 'conexion.php';

$sql = "SELECT * FROM fechasAd WHERE tipo!=1 ORDER BY `fechaI` ASC";
$resultado = mysql_query($sql, $con);

if ($resultado) {
    $datos = array();
    $i = 0;
    while ($fila = mysql_fetch_assoc($resultado)) {
        $datos[$i] = $fila;
        $i++;
    }
} else {
    die("Error de conexión" . mysql_error());
}
mysql_close($con);
echo json_encode($datos);
?>