<?php
// procesar_compra.php

// Datos conexión (ajusta según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agencia";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Ejemplo: obtener el pedido_id (puede venir de un formulario o URL)
$pedido_id = isset($_GET['pedido_id']) ? intval($_GET['pedido_id']) : 0;

if ($pedido_id <= 0) {
    die("ID de pedido inválido.");
}

// Preparar consulta para obtener detalles del pedido
$sql_detalles = "
    SELECT p.descripcion, dp.cantidad, dp.precio_unitario
    FROM DetallePedidos dp
    INNER JOIN Productos p ON dp.producto_id = p.producto_id
    WHERE dp.pedido_id = ?
";

$stmt = $conn->prepare($sql_detalles);
if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("i", $pedido_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No se encontraron detalles para el pedido #$pedido_id.";
} else {
    echo "<h2>Detalles del pedido #$pedido_id</h2>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Subtotal</th></tr>";

    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $subtotal = $row['cantidad'] * $row['precio_unitario'];
        $total += $subtotal;

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
        echo "<td>" . intval($row['cantidad']) . "</td>";
        echo "<td>$" . number_format($row['precio_unitario'], 2) . "</td>";
        echo "<td>$" . number_format($subtotal, 2) . "</td>";
        echo "</tr>";
    }

    echo "<tr><td colspan='3'><strong>Total</strong></td><td><strong>$" . number_format($total, 2) . "</strong></td></tr>";
    echo "</table>";
}

$stmt->close();
$conn->close();
?>
