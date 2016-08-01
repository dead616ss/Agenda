<?php session_start(); ?>
<?php

require 'conexion.php';

$sql = "SELECT distinct concat(name, ' ', apP, ' ',apM) as Nombre, birthDate, address, concat( email, ' ', site) as Web, concat(tel, ' ', cel) as Telefono, idUser, oficio "
        . "FROM usuario WHERE tipo='user'";
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