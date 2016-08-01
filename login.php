<?php
session_start();
require_once('conexion.php');
$formData = array(
    "username" => $_POST["username"],
    "password" => $_POST["password"]
);

$sql = "SELECT * FROM usuario where user='" . $formData['username'] . "' and password='" . $formData['password'] . "'";
$consulta = mysql_query($sql)or die('Error. ' . mysql_error());
$res=FALSE;
while ($row = mysql_fetch_array($consulta)) {
    if (isset($formData['username'])) {
        $_SESSION['user'] = $formData['username'];
        $res=TRUE;
    }    
}
echo $res;
?>