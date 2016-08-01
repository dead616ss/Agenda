<?php session_start(); ?>
<?php

require 'conexion.php';

if (isset($_SESSION['user'])) {
    $sql = "SELECT * FROM usuario where user='" . $_SESSION['user'] . "' AND (tipo='user' OR tipo='admin')";
    $consulta = mysql_query($sql);
    while ($row = mysql_fetch_array($consulta)) {
        $tipo = $row['tipo'];
    }
}

if ($tipo == 'admin') {
    $sql = "SELECT distinct concat(name, ' ', apP, ' ',apM) as Nombre, idUser FROM usuario where user='" . $_SESSION['user'] . "' and tipo='client'";
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
} else {
    $sql = "SELECT distinct concat(name, ' ', apP, ' ',apM) as Nombre, idUser FROM usuario where user='" . $_SESSION['user'] . "' and tipo='client' or tipo='admin'";
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
}

mysql_close($con);
echo json_encode($datos);
?>