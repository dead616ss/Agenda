<?php
session_start();

$formData = array(
    "name" => $_POST["name"],
    "app" => $_POST["app"],
    "apm" => $_POST["apm"],
    "birthdate" => $_POST["birthdate"],
    "address" => $_POST["dir"],
    "user" => $_POST["username"],
    "pass" => $_POST["passwordInput"],
    "email" => $_POST["emailInput"],
    "site" => $_POST["site"],
    "phone" => $_POST["phone"],
    "cel" => $_POST["celphone"],
    "oficio" => $_POST["oficio"],
    "pregunta" => $_POST["combobox"],
    "res" => $_POST["res"],
    "tipo" => $_POST["client"]
);

$fecha1= convertirFecha_SpanishToEnglish($formData['birthdate']);
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
$res=true;
$sql = "SELECT * FROM usuario where user='" . $formData['user'] . "'";
$consulta = mysql_query($sql);
if ($consulta) {    
    while ($row = mysql_fetch_array($consulta)) {
        $res = false;
        echo $res;
        return;
    }
}
$valor = 1;
if ($formData['pregunta'] == 'Pelicula favorita') {
    $valor = 1;
} else if ($formData['pregunta'] == 'Nombre de tu primera mascota') {
    $valor = 2;
} else if ($formData['pregunta'] == 'Equipo de futbol') {
    $valor = 3;
} else if ($formData['pregunta'] == 'Personaje de una caricatura') {
    $valor = 4;
}else{
    $valor=0;
}

$sql1 = "INSERT INTO usuario (idUser, name, apP, apM, birthDate, address, password, user, email, site, tel, cel, oficio, question, respuesta, tipo) "
        . "VALUES ('', '" . $formData['name'] . "', '" . $formData['app'] . "','" . $formData['apm'] . "','" . $fecha1 . "',"
        . "'".$formData['address']."',"."'" . $formData['pass'] . "','" . $formData['user'] . "','" 
        . $formData['email'] ."','".$formData['site']. "','" . $formData['phone'] . "', '" . $formData['cel'] . "', "
        . "'" . $formData['oficio'] . "','" . $valor . "','" . $formData['res'] . "','".$formData['tipo']."')";
$insertar = mysql_query($sql1)or die('Error. ' . mysql_error());

if ($insertar) {    
    $_SESSION['user'] = $formData['user'];
} else {
    $res=FALSE;
}
echo $res;
mysql_close($con);
return;
?>