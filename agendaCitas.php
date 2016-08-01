<?php session_start(); 

require 'conexion.php';

$sql = "SELECT CONCAT(usuario.name, ' ',  usuario.apP, ' ', usuario.apM) as Nombre, usuario.idUser, "
        . "citas.idCita, citas.fecha, citas.horaI, citas.lugar, citas.citaCon, citas.comentario, citas.estado FROM usuario, citas "
        . "WHERE citas.usuario='".$_SESSION['user']."' AND usuario.idUser=citas.citaCon";
$resultado = mysql_query($sql, $con)or die("Error de conexión" . mysql_error());

if ($resultado) {
    $datos = array();
    $i = 0;
    while ($fila = mysql_fetch_assoc($resultado)) {
        $datos[$i] = $fila;
        $i++;
    }
} 
mysql_close($con);
echo json_encode($datos);