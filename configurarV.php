<?php
/*date_default_timezone_set('UTC');
echo date("Y-m-d");
*/
require_once('conexion.php');

$fI = $_POST['FI'];
$fF = $_POST['FF'];

$fechaI = convertirFecha_SpanishToEnglish($fI);
$fecha2 = convertirFecha_SpanishToEnglish($fF);

//
function convertirFecha_SpanishToEnglish($date) {
    if ($date) {
        $fecha = $date;
        $hora = "";

        # separamos la fecha recibida por el espacio de separación entre
        # la fecha y la hora
        $fechaHora = explode(" ", $date);
        if (count($fechaHora) == 2) {
            $fecha = $fechaHora[0];
            $hora = $fechaHora[1];
        }

        # cogemos los valores de la fecha
        $values = preg_split('/(\/|-)/', $fecha);
        if (count($values) == 3) {
            return date("Y/m/d", mktime(0, 0, 0, $values[1], $values[0], $values[2]));
        }
    }
    return "";
}

$sql = "SELECT * FROM `fechasAd` WHERE `fechaI`<='" . $fechaI . "' AND `fechaF`>='" . $fechaI . "'";
$consulta = mysql_query($sql);
$tipo = "";
while ($row = mysql_fetch_array($consulta)) {
    $tipo = $row['tipo'];
    if ($tipo!='1') {
        echo 'invalido';
        return;
    }
}
$sql = "SELECT * FROM `fechasAd` WHERE `fechaI`<='" . $fecha2 . "' AND `fechaF`>='" . $fecha2 . "'";
$consulta = mysql_query($sql);
$tipo = "";
while ($row = mysql_fetch_array($consulta)) {
    $tipo = $row['tipo'];
    if ($tipo!='1') {
        echo 'invalido';
        return;
    }
}

echo 'valido';