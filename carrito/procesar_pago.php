<?php
session_start();
require_once(__DIR__ . '/../Administrador/config/bd.php');

if (!isset($_SESSION['cliente_id']) || empty($_SESSION['carrito'])) {
    header("Location: checkout.php");
    exit();
}

$cliente_id = $_SESSION['cliente_id'];
$metodo = $_POST['metodo_pago'] ?? 'no definido';
$fecha = date('Y-m-d H:i:s');

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("INSERT INTO Pedidos (cliente_id, fecha_pedido, estado) VALUES (?, ?, ?)");
    $stmt->execute([$cliente_id, $fecha, 'Pagado']);
    $pedido_id = $pdo->lastInsertId();

    $stmtDetalle = $pdo->prepare("INSERT INTO DetallePedidos (pedido_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");

    foreach ($_SESSION['carrito'] as $producto) {
        $stmtDetalle->execute([
            $pedido_id,
            $producto['id'],
            $producto['cantidad'],
            $producto['precio']
        ]);
    }

    unset($_SESSION['carrito']);
    $pdo->commit();

    header("Location: confirmarpago.php?pedido_id=$pedido_id");
    exit();

} catch (Exception $e) {
    $pdo->rollBack();
    echo "Error al registrar el pedido: " . $e->getMessage();
}
