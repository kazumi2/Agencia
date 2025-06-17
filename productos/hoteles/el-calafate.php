<?php 
session_start();

// Procesar reserva si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservar'])) {
    $hotel_id = (int) $_POST['hotel_id'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $fecha_salida = $_POST['fecha_salida'];
    $huespedes = (int) $_POST['huespedes'];
    $usuario_id = $_SESSION['user_id'] ?? null;

    // Validar que el usuario esté logueado
    if (!$usuario_id) {
        $_SESSION['error_reserva'] = "Debes iniciar sesión para reservar.";
        header("Location: login.php");
        exit();
    }

    // Validar fechas
    if (strtotime($fecha_salida) <= strtotime($fecha_entrada)) {
        $_SESSION['error_reserva'] = "La fecha de salida debe ser posterior a la de entrada.";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    // Insertar reserva
    $stmt = $conn->prepare("INSERT INTO reservas (usuario_id, hotel_id, fecha_entrada, fecha_salida, huespedes, estado) 
                            VALUES (?, ?, ?, ?, ?, 'confirmada')");
    $stmt->bind_param("iissi", $usuario_id, $hotel_id, $fecha_entrada, $fecha_salida, $huespedes);

    if ($stmt->execute()) {
        $_SESSION['reserva_exitosa'] = $conn->insert_id;
        header("Location: boleto_reserva.php?id=" . $conn->insert_id);
        exit();
    } else {
        $_SESSION['error_reserva'] = "Error al realizar la reserva. Inténtalo más tarde.";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hoteles en Córdoba</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/hotel.css" />
</head>
<body>

<div class="container py-5">
  <h1 class="text-center mb-4">Hoteles El Calafate</h1>

  <?php if (isset($_SESSION['error_reserva'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error_reserva'] ?></div>
    <?php unset($_SESSION['error_reserva']); ?>
  <?php endif; ?>

  <div class="row">
    <!-- Hotel 1 -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <img src="..\..\assets\img\Hotel img\ElCalafate\xelena-deluxe-suites.jpg" class="card-img-top" alt="Xelena Hotel">
        <div class="card-body">
          <h5 class="card-title">1. Xelena Hotel & Suites</h5>
          <div class="mb-2">
            <span class="badge bg-warning text-dark">★★★★★</span>
            <span class="badge bg-primary ms-2">Premium</span>
          </div>
          <p class="card-text">Vistas al Lago Argentino con servicio de lujo y spa glaciar.</p>
          <ul class="list-unstyled">
            <li>✅ Ubicación privilegiada</li>
            <li>✅ Piscina climatizada</li>
            <li>✅ Cena con vista al glaciar</li>
          </ul>
        </div>
        <div class="card-footer bg-white">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <span class="h5">$125.800</span>
              <small class="text-muted">/noche</small>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservaXelena">Reservar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Hotel 2 -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <img src="..\..\assets\img\Hotel img\ElCalafate\36591641.jpg" class="card-img-top" alt="Kosten Aike">
        <div class="card-body">
          <h5 class="card-title">2. Kosten Aike</h5>
          <div class="mb-2">
            <span class="badge bg-warning text-dark">★★★★</span>
            <span class="badge bg-success ms-2">Boutique</span>
          </div>
          <p class="card-text">Hotel boutique con arquitectura patagónica y calidez única.</p>
          <ul class="list-unstyled">
            <li>✅ Ubicación céntrica</li>
            <li>✅ Chimenea en lobby</li>
            <li>✅ Desayuno patagónico</li>
          </ul>
        </div>
        <div class="card-footer bg-white">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <span class="h5">$89.400</span>
              <small class="text-muted">/noche</small>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservaKosten">Reservar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modales de Reserva -->
<div class="modal fade" id="reservaXelena" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="">
        <input type="hidden" name="hotel_id" value="1">
        <div class="modal-header">
          <h5 class="modal-title">Reservar Xelena Hotel & Suites</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Fecha de entrada</label>
            <input type="date" name="fecha_entrada" class="form-control" required min="<?= date('Y-m-d') ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Fecha de salida</label>
            <input type="date" name="fecha_salida" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Huéspedes</label>
            <select name="huespedes" class="form-select" required>
              <option value="1">1 persona</option>
              <option value="2" selected>2 personas</option>
              <option value="3">3 personas</option>
              <option value="4">4 personas</option>
            </select>
          </div>
          <div class="alert alert-info">
            <strong>Precio por noche:</strong> $125.800 ARS<br>
            <span id="totalXelena">Total estimado: $125.800 ARS</span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name="reservar" class="btn btn-primary">Confirmar Reserva</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="reservaKosten" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="">
        <input type="hidden" name="hotel_id" value="2">
        <div class="modal-header">
          <h5 class="modal-title">Reservar Kosten Aike</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Fecha de entrada</label>
            <input type="date" name="fecha_entrada" class="form-control" required min="<?= date('Y-m-d') ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Fecha de salida</label>
            <input type="date" name="fecha_salida" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Huéspedes</label>
            <select name="huespedes" class="form-select" required>
              <option value="1">1 persona</option>
              <option value="2" selected>2 personas</option>
              <option value="3">3 personas</option>
              <option value="4">4 personas</option>
            </select>
          </div>
          <div class="alert alert-info">
            <strong>Precio por noche:</strong> $89.400 ARS<br>
            <span id="totalKosten">Total estimado: $89.400 ARS</span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name="reservar" class="btn btn-primary">Confirmar Reserva</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function calcularTotal(hotelId, precio) {
  const entrada = new Date(document.querySelector(`#reserva${hotelId} input[name='fecha_entrada']`).value);
  const salida = new Date(document.querySelector(`#reserva${hotelId} input[name='fecha_salida']`).value);
  const noches = (salida - entrada) / (1000 * 60 * 60 * 24);
  const totalElement = document.querySelector(`#total${hotelId}`);
  if (noches > 0) {
    totalElement.textContent = `Total estimado: $${(noches * precio).toLocaleString('es-AR')} ARS (${noches} noches)`;
  } else {
    totalElement.textContent = "Selecciona fechas válidas.";
  }
}

document.querySelector('#reservaXelena input[name="fecha_salida"]').addEventListener('change', () => {
  calcularTotal('Xelena', 125800);
});

document.querySelector('#reservaKosten input[name="fecha_salida"]').addEventListener('change', () => {
  calcularTotal('Kosten', 89400);
});
</script>

