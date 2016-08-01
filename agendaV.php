<?php session_start(); ?>
<?php

/* date_default_timezone_set('UTC');
  echo date("Y-m-d");
 */
require_once('conexion.php');

$fI = $_POST['FECHA'];
$conC = $_POST['CON'];
$h = $_POST['HORA'];
$hi = $h . ':00:00';
$nota = $_POST['NOTE'];
$lugar = $_POST['PLACE'];
$res = 'Valido';
/* $fI = '30/05/2014';
  $conC = '1';
  $h = '15';
  $hi = $h . ':00:00';
  $res = 'Valido'; */

$fechaI = convertirFecha_SpanishToEnglish($fI);

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

$sql = "SELECT * FROM `citas` WHERE usuario='" . $_SESSION['user'] . "' AND `fecha`='$fechaI' AND horaI='$hi'";
$consulta = mysql_query($sql) or die('Error ' . mysql_error());
while ($row = mysql_fetch_array($consulta)) {
    $res = 'Ya tienes una cita agendada en este horario';
    echo $res;
    return;
}

if ($conC == '1') {
    $fecha = date('l', strtotime($fechaI));

    if ($fecha == 'Sunday' || $fecha == 'Saturday') {
        $res = 'No puedes agendar en sabado o domingo';
        echo $res;
        return;
    }

    $sql = "SELECT * FROM `citas` WHERE fecha='$fechaI' and  horaI='$hi' and citaCon='1'";
    $consulta = mysql_query($sql);
    while ($row = mysql_fetch_array($consulta)) {
        $res = 'Horario no disponible';
        echo $res;
        return;
    }

    $sql = "SELECT * FROM `fechasAd` WHERE inicioH<='" . $hi . "' AND fin>'" . $hi . "' AND libre!='" . $hi . "'";
    $consulta = mysql_query($sql);
    $tipo = "";
    while ($row = mysql_fetch_array($consulta)) {

        $sql = "INSERT INTO citas (idCita, usuario, fecha, horaI, horaF, lugar, citaCon, comentario, estado) "
                . "VALUES('', '" . $_SESSION['user'] . "', '$fechaI', '$hi', '$hi', '$lugar', '$conC', '$nota', 'Agendada') ";
        $insertar = mysql_query($sql)or die('Error. ' . mysql_error());
        $res = 'Regisrto correcto';
        echo $res;
        return;
    }
} else {
    $sql = "INSERT INTO citas (idCita, usuario, fecha, horaI, horaF, lugar, citaCon, comentario, estado) "
            . "VALUES('', '" . $_SESSION['user'] . "', '$fechaI', '$hi', '$hi', '$lugar', '$conC', '$nota', 'Agendada') ";
    $insertar = mysql_query($sql)or die('Error. ' . mysql_error());
    $res = 'DentroR';
    echo $res;
    return;
}