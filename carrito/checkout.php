<?php
session_start();
require_once(__DIR__ . '/../Administrador/config/bd.php');

// Simulación: el usuario ya inició sesión
if (!isset($_SESSION['cliente_id'])) {
    $_SESSION['cliente_id'] = 1; // Elimina esto en producción
}

// Verificar carrito
if (empty($_SESSION['carrito'])) {
    echo "Tu carrito está vacío.";
    exit;
}

// Calcular total
$total = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total += $item['precio'] * $item['cantidad'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Método de Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">Método de Pago</h2>

    <div class="mb-4">
        <h4>Resumen del Pedido</h4>
        <ul class="list-group">
            <?php foreach ($_SESSION['carrito'] as $item): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($item['nombre']) ?> x <?= $item['cantidad'] ?>
                    <span>$<?= number_format($item['precio'] * $item['cantidad'], 2) ?></span>
                </li>
            <?php endforeach; ?>
            <li class="list-group-item d-flex justify-content-between">
                <strong>Total:</strong>
                <strong>$<?= number_format($total, 2) ?></strong>
            </li>
        </ul>
    </div>

    <form action="procesar_pago.php" method="post">
        <div class="mb-3">
            <label for="metodo" class="form-label">Selecciona método de pago:</label>
            <select name="metodo_pago" id="metodo" class="form-select" required>
                <option value="">-- Selecciona --</option>
                <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                <option value="transferencia">Transferencia Bancaria</option>
            </select>
        </div>

        <div id="datos_tarjeta" style="display: none;">
            <div class="mb-3">
                <label for="numero" class="form-label">Número de tarjeta</label>
                <input type="text" name="numero_tarjeta" class="form-control">
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre en la tarjeta</label>
                <input type="text" name="nombre_titular" class="form-control">
            </div>
            <div class="mb-3">
                <label for="vencimiento" class="form-label">Vencimiento (MM/AA)</label>
                <input type="text" name="vencimiento" class="form-control">
            </div>
            <div class="mb-3">
                <label for="cvv" class="form-label">CVV</label>
                <input type="text" name="cvv" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Confirmar Pago</button>
    </form>
</div>

<script>
document.getElementById('metodo').addEventListener('change', function () {
    const tarjeta = document.getElementById('datos_tarjeta');
    tarjeta.style.display = this.value === 'tarjeta' ? 'block' : 'none';
});
</script>
</body>
</html>
