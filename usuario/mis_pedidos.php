<?php

include(__DIR__ . "login.php");
include(__DIR__ ."php/conexion_bd.php");

$cliente_id = $_SESSION['cliente_id'];

$sql = "SELECT * FROM pedidos WHERE cliente_id = ? ORDER BY fecha DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cliente_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Pedidos - Agencia de Turismo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f8fb;
            padding: 20px;
        }

        h1 {
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dcdcdc;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f9fc;
        }

        .volver {
            margin-top: 20px;
            display: inline-block;
            background: #2980b9;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        .volver:hover {
            background-color: #1c5980;
        }
    </style>
</head>
<body>

<h1>Mis Pedidos de Viajes</h1>

<?php if ($resultado->num_rows > 0): ?>
    <table>
        <tr>
            <th>ID Pedido</th>
            <th>Destino</th>
            <th>Fecha del Viaje</th>
            <th>Estado</th>
        </tr>
        <?php while ($pedido = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $pedido['id'] ?></td>
                <td><?= htmlspecialchars($pedido['destino']) ?></td>
                <td><?= $pedido['fecha'] ?></td>
                <td><?= $pedido['estado'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No tienes pedidos registrados aún.</p>
<?php endif; ?>

<a class="volver" href="hacer_pedido.php">➕ Hacer nuevo pedido</a>

</body>
</html>