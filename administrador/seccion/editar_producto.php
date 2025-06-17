<?php
include 'validar_sesion.php';
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $producto = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM productos WHERE id = $id"));

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        mysqli_query($conexion, "UPDATE productos SET nombre='$nombre', precio=$precio WHERE id = $id");
        echo "Producto actualizado.";
    }
?>
<form method="POST">
    Nombre: <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" required><br>
    Precio: <input type="number" name="precio" value="<?= $producto['precio'] ?>" required><br>
    <button type="submit">Actualizar</button>
</form>
<?php } else { echo "ID de producto no proporcionado."; } ?>
