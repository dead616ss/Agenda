<?php
require_once('conexion.php');

$fecha=$_POST['Fecha'];
//$fecha=23;

$sql = "DELETE FROM fechasAd WHERE idFecha='$fecha'";
$consulta = mysql_query($sql)or die('Error. ' . mysql_error());
$res=FALSE;
if($consulta){
    $res=TRUE;
}
echo $res;
?>
