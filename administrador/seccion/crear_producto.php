<?php
include 'validar_sesion.php';
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    mysqli_query($conexion, "INSERT INTO productos (nombre, precio) VALUES ('$nombre', $precio)");
    echo "Producto agregado correctamente.";
}
?>

<form method="POST">
    Nombre: <input type="text" name="nombre" required><br>
    Precio: <input type="number" name="precio" required><br>
    <button type="submit">Guardar</button>
</form>
