<?php  
$host = "localhost";
$bd = "agencia";
$usuario = "root";
$contrasenia = "";

$conn = mysqli_connect($host, $usuario, $contrasenia, $bd);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
