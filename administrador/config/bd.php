<?php
$host = 'localhost';
$bd = 'sitioPHP';
$usurio = 'root';
$contraseña = "";


try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd", $usurio, $contraseña);
    if ($conexion) {
        //echo "conexión realizada";
    };
} catch (Exception $ex) {
    echo "error en conexion";
    echo $ex->getMessage();
}

?>