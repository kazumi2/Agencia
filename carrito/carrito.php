<?php
session_start();
include(__DIR__ . '/../Administrador/config/bd.php'); // Ajusta la ruta a tu conexión

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar producto al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnAccion']) && $_POST['btnAccion'] === 'Agregar') {
    $producto_id = $_POST['producto_id'] ?? null;
    $tipo = $_POST['tipo'] ?? null;
    $codigo = $_POST['codigo'] ?? null;
    $nombre = $_POST['nombre'] ?? null;
    $precio = floatval($_POST['precio'] ?? 0);
    $cantidad = intval($_POST['cantidad'] ?? 1);

    if ($producto_id && $tipo && $codigo && $nombre && $precio > 0 && $cantidad > 0) {
        // Verificar si producto ya está en carrito para sumar cantidad
        $encontrado = false;
        foreach ($_SESSION['carrito'] as &$item) {
            if ($item['id'] == $producto_id && $item['tipo'] == $tipo) {
                $item['cantidad'] += $cantidad;
                $encontrado = true;
                break;
            }
        }
        unset($item);

        if (!$encontrado) {
            $_SESSION['carrito'][] = [
    'id' => $producto_id,
    'tipo' => $tipo,
    'codigo' => $codigo,
    'nombre' => $nombre,
    'precio' => $precio,
    'cantidad' => $cantidad,
    'imagen' => $_POST['imagen'] ?? 'default.jpg'
   
];
     
        }
    }
}

// Eliminar producto del carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnAccion']) && $_POST['btnAccion'] === 'Eliminar') {
    $producto_id = $_POST['producto_id'] ?? null;
    $tipo = $_POST['tipo'] ?? null;

    if ($producto_id !== null && $tipo !== null) {
        foreach ($_SESSION['carrito'] as $index => $item) {
            if (
                isset($item['id'], $item['tipo']) &&
                $item['id'] == $producto_id &&
                $item['tipo'] == $tipo
            ) {
                unset($_SESSION['carrito'][$index]);
                $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar
                break;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../assets/css/carrito.css" />
</head>
<body>

<div class="container py-5">
    <h1 class="text-center mb-4">🛒 Carrito de Compras</h1>
    </div>

    <?php if (empty($_SESSION['carrito'])): ?>
        <div class="alert alert-info text-center">No hay productos en el carrito 😢</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Código</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['carrito'] as $item):
                        $codigo = $item['codigo'] ?? 'N/A';
                        $tipo = $item['tipo'] ?? 'N/A';
                        $nombre = $item['nombre'] ?? 'Sin nombre';
                        $precio = $item['precio'] ?? 0;
                        $cantidad = $item['cantidad'] ?? 1;

                        $subtotal = $precio * $cantidad;
                        $total += $subtotal;

                        $imagen = '../assets/img/' . ($item['imagen'] ?? 'default.jpg');
                      
                    ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($imagen) ?>" alt="<?= htmlspecialchars($nombre) ?>" width="80" height="60" style="object-fit: cover; border-radius: 8px;">
                         </td>
                        <td><?= htmlspecialchars($nombre) ?></td>
                        <td><?= htmlspecialchars($codigo) ?></td>
                        <td><?= htmlspecialchars(ucfirst($tipo)) ?></td>
                        <td>$<?= number_format($precio, 2) ?></td>
                        <td><?= intval($cantidad) ?></td>
                        <td>$<?= number_format($subtotal, 2) ?></td>
                    
                        <td>
                            <form action="" method="post" onsubmit="return confirm('¿Seguro que quieres eliminar este producto?');">
                                <input type="hidden" name="producto_id" value="<?= htmlspecialchars($item['id']) ?>">
                                <input type="hidden" name="tipo" value="<?= htmlspecialchars($tipo) ?>">
                                <button class="btn btn-sm btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="6" class="text-end"><strong>Total:</strong></td>
                        <td colspan="2"><strong>$<?= number_format($total, 2) ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-center">
            <a href="confirmarpago.php" class="btn btn-success">Finalizar Compra</a>
            <a href="../administrador/seccion/productos.php" class="btn btn-secondary">Seguir comprando</a>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
