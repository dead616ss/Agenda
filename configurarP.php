<?php

$hI=$_POST["HI"];
$hF=$_POST["HF"];
$hL=$_POST["HL"];

$hi=$hI.':00:00';
$hf=$hF.':00:00';
$hl=$hL.':00:00';        
require_once('conexion.php');
$res=FALSE;

$sql = "UPDATE fechasAd SET inicioH='$hi', fin='$hf', libre='$hl' WHERE tipo=1";
$insertar = mysql_query($sql)or die('Error. ' . mysql_error());

if ($insertar) {    
    $res= TRUE;
} else {
    $res= FALSE;
}
mysql_close($con);
echo $res;
?>