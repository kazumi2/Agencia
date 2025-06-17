<?php
$host = "localhost";
$bd = "agencia";
$usuario = "root";
$contrasenia = "";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd;charset=utf8", $usuario, $contrasenia);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die("Error de conexión: " . $ex->getMessage());
}
?>
