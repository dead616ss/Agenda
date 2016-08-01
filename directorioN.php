<?php

session_start();

$formData = array(
    "name" => $_POST["name"],
    "app" => $_POST["app"],
    "apm" => $_POST["apm"],
    "birthdate" => $_POST["birthdate"],
    "address" => $_POST["dir"],
    "user" => $_POST["username"],
    "email" => $_POST["emailInput"],
    "site" => $_POST["site"],
    "phone" => $_POST["phone"],
    "cel" => $_POST["celphone"],
    "oficio" => $_POST["oficio"],
);

$fecha1 = convertirFecha_SpanishToEnglish($formData['birthdate']);

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

require_once('conexion.php');
$res = true;

$valor = 0;


$sql1 = "INSERT INTO usuario (idUser, name, apP, apM, birthDate, address, password, user, email, site, tel, cel, oficio, question, respuesta, tipo) "
        . "VALUES ('', '" . $formData['name'] . "', '" . $formData['app'] . "','" . $formData['apm'] . "','" . $fecha1 . "',"
        . "'" . $formData['address'] . "', '', '" . $_SESSION['user'] . "','"
        . $formData['email'] . "','" . $formData['site'] . "','" . $formData['phone'] . "', '" . $formData['cel'] . "', "
        . "'" . $formData['oficio'] . "','" . $valor . "','','client')";
$insertar = mysql_query($sql1)or die('Error. ' . mysql_error());

echo $res;
mysql_close($con);
?>