<?php
include 'validar_sesion.php';
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conexion, "DELETE FROM productos WHERE id = $id");
    echo "Producto eliminado.";
} else {
    echo "ID de producto no proporcionado.";
}
?>
