<?php session_start(); ?>
<?php

require 'conexion.php';

$ID=$_POST['ID'];
$sql = "SELECT address FROM usuario where idUser=$ID";
$consulta = mysql_query($sql, $con);
$dire='error';
while ($row = mysql_fetch_array($consulta)) {
    $dire = $row['address'];
}
echo $dire;

mysql_close($con);
?>