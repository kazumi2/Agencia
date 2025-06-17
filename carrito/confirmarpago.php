<?php
session_start();

// Verificar si hay productos en el carrito
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    header("Location: productos.php"); // O la página que quieras si no hay carrito
    exit();
}

// Procesar el formulario de pago
$mensaje = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aquí puedes validar y procesar los datos de pago
    $nombre = $_POST['nombre'] ?? '';
    $tarjeta = $_POST['tarjeta'] ?? '';
    $vencimiento = $_POST['vencimiento'] ?? '';
    $cvv = $_POST['cvv'] ?? '';

    // Validaciones básicas (puedes mejorar)
    if ($nombre && $tarjeta && $vencimiento && $cvv) {
        // Aquí pondrías la lógica para guardar el pedido y procesar el pago

        // Por ahora, solo mensaje de éxito y limpiar carrito
        $mensaje = "¡Pago realizado con éxito! Gracias por tu compra, $nombre.";
        unset($_SESSION['carrito']);
    } else {
        $mensaje = "Por favor, completa todos los campos para realizar el pago.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Confirmar Pago</h1>

    <?php if ($mensaje): ?>
        <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
        <?php if (empty($_SESSION['carrito'])): ?>
            <a href="../paginas/productos.php" class="btn btn-primary">Volver a la tienda</a>
            <?php exit(); ?>
        <?php endif; ?>
    <?php endif; ?>

    <h3>Productos en tu carrito</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Producto</th>
            <th>Código</th>
            <th>Tipo</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        foreach ($_SESSION['carrito'] as $item):
            $subtotal = $item['precio'] * $item['cantidad'];
            $total += $subtotal;
            ?>
            <tr>
                <td><?= htmlspecialchars($item['nombre']) ?></td>
                <td><?= htmlspecialchars($item['codigo_producto'] ?? '') ?></td>
                <td><?= htmlspecialchars($item['tipo_producto'] ?? '') ?></td>
                <td>$<?= number_format($item['precio'], 2) ?></td>
                <td><?= $item['cantidad'] ?></td>
                <td>$<?= number_format($subtotal, 2) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5" class="text-end"><strong>Total:</strong></td>
            <td><strong>$<?= number_format($total, 2) ?></strong></td>
        </tr>
        </tfoot>
    </table>

    <h3 class="mt-4">Formulario de Pago</h3>
   <form action="pago.php" method="post">
   <div class="mb-3">
            <label for="nombre" class="form-label">Nombre en la tarjeta</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="tarjeta" class="form-label">Número de tarjeta</label>
            <input type="text" class="form-control" id="tarjeta" name="tarjeta" maxlength="16" pattern="\d{16}" required>
            <div class="form-text">Solo números, 16 dígitos</div>
        </div>
        <div class="mb-3">
            <label for="vencimiento" class="form-label">Fecha de vencimiento</label>
            <input type="month" class="form-control" id="vencimiento" name="vencimiento" required>
        </div>
        <div class="mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <input type="text" class="form-control" id="cvv" name="cvv" maxlength="3" pattern="\d{3}" required>
        </div>
    <button type="submit" class="btn btn-success">Pagar ahora</button>
</form>

</body>
</html>
