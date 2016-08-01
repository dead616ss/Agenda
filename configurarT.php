<?php

$fI=$_POST["FI"];
$fF=$_POST["FF"];
$hI=$_POST["HI"];
$hF=$_POST["HF"];
$tipo=$_POST["TI"];
$hi=$hI.':00:00';
$hf=$hF.':00:00';

/*$fI="13/5/2014";
$fF="13/5/2014";
$hI=9;
$hF=16;

$hi=$hI.':00:00'; 
$hf=$hF.':00:00';*/

$fechaI= convertirFecha_SpanishToEnglish($fI);
$fecha2= convertirFecha_SpanishToEnglish($fF);
//
function convertirFecha_SpanishToEnglish($date)
{
    if($date)
    {
        $fecha=$date;
        $hora="";
        
        # separamos la fecha recibida por el espacio de separación entre
        # la fecha y la hora
        $fechaHora=explode(" ",$date);
        if(count($fechaHora)==2)
        {
            $fecha=$fechaHora[0];
            $hora=$fechaHora[1];
        }
        
        # cogemos los valores de la fecha
        $values=preg_split('/(\/|-)/',$fecha);
        if(count($values)==3)
        {
            return date("Y/m/d",mktime(0,0,0,$values[1],$values[0],$values[2]));
        }
    }
    return "";
}

require_once('conexion.php');
$res=FALSE;

$sql = "INSERT INTO fechasAd (idFecha, fechaI, fechaF, inicioH, fin, libre, tipo) VALUES('', '$fechaI', '$fecha2', '$hi', '$hf', '00:00:00', '$tipo') ";
$insertar = mysql_query($sql)or die('Error. ' . mysql_error());

if ($insertar) {    
    $res= TRUE;
} 
mysql_close($con);
echo $res;
?>