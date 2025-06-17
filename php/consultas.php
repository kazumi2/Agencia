<?php
include 'validar_sesion.php';
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];

    $consulta = mysqli_query($conexion, "
        SELECT * FROM pedidos 
        WHERE usuario_id = $cliente_id 
        AND fecha BETWEEN '$desde' AND '$hasta'
    ");

    echo "<h2>Resultados:</h2><ul>";
    while ($pedido = mysqli_fetch_assoc($consulta)) {
        echo "<li>Pedido #{$pedido['id']} - Estado: {$pedido['estado']} - Fecha: {$pedido['fecha']}</li>";
    }
    echo "</ul>";
}
?>

<form method="POST">
    ID del Cliente: <input type="number" name="cliente_id" required><br>
    Desde: <input type="date" name="desde" required><br>
    Hasta: <input type="date" name="hasta" required><br>
    <button type="submit">Consultar</button>
</form>
