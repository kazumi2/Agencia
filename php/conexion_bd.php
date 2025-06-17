<?php
// Configura con tus datos reales
$host = 'localhost';
$usuario = 'root';
$password = '';
$baseDatos = 'agencia';

// Crear conexión
$conn = new mysqli($host, $usuario, $password, $baseDatos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");
