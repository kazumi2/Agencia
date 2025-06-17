<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reservar'])) {
    $hotel_id = $_POST['hotel_id'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $fecha_salida = $_POST['fecha_salida'];
    $huespedes = $_POST['huespedes'];
    $usuario_id = $_SESSION['user_id'] ?? null;

    if (!$usuario_id) {
        $_SESSION['error_reserva'] = "Debes iniciar sesión para realizar una reserva.";
        header("Location: login.php");
        exit();
    }

    if (strtotime($fecha_salida) <= strtotime($fecha_entrada)) {
        $_SESSION['error_reserva'] = "La fecha de salida debe ser posterior a la de entrada";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    $precio_por_noche = ($hotel_id == 101) ? 78900 : 65200;
    $noches = (strtotime($fecha_salida) - strtotime($fecha_entrada)) / (60 * 60 * 24);
    $total_estimado = $precio_por_noche * $noches;

    $stmt = $conn->prepare("INSERT INTO reservas (usuario_id, hotel_id, fecha_entrada, fecha_salida, huespedes, estado) 
                            VALUES (?, ?, ?, ?, ?, 'confirmada')");
    $stmt->bind_param("iissi", $usuario_id, $hotel_id, $fecha_entrada, $fecha_salida, $huespedes);

    if ($stmt->execute()) {
        $_SESSION['reserva_exitosa'] = $conn->insert_id;
        header("Location: boleto_reserva.php?id=" . $conn->insert_id);
        exit();
    } else {
        $_SESSION['error_reserva'] = "Error al realizar la reserva: " . $conn->error;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Hotel</title>
<link rel="stylesheet" href="../../assets/css/hotel.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5">
  <h1 class="text-center mb-4">Hoteles en Salta</h1>

  <?php if (isset($_SESSION['error_reserva'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error_reserva'] ?></div>
    <?php unset($_SESSION['error_reserva']); ?>
  <?php endif; ?>

  <div class="row">
    <!-- Hotel 1: Legado Mítico -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <img src="../../assets/img/Hotel img/Salta/public.avif" class="card-img-top" alt="Legado Mítico">
        <div class="card-body">
          <h5 class="card-title">1. Legado Mítico</h5>
          <div class="mb-2">
            <span class="badge bg-warning text-dark">★★★★★</span>
            <span class="badge bg-danger ms-2">Boutique</span>
          </div>
          <p class="card-text">Mansión colonial renovada en el corazón histórico de Salta.</p>
          <ul class="list-unstyled">
            <li>✅ Patio interior con aljibe</li>
            <li>✅ Terraza panorámica a los cerros</li>
            <li>✅ Degustación de vinos torrontés</li>
          </ul>
        </div>
        <div class="card-footer bg-white">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <span class="h5">$78.900</span>
              <small class="text-muted">/noche</small>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservaLegadoMitico">Reservar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Hotel 2: Casa Real -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <img src="../../assets/img/Hotel img/Salta/quienes-01.jpg" class="card-img-top" alt="Casa Real">
        <div class="card-body">
          <h5 class="card-title">2. Casa Real</h5>
          <div class="mb-2">
            <span class="badge bg-warning text-dark">★★★★</span>
            <span class="badge bg-info ms-2">Hacienda</span>
          </div>
          <p class="card-text">Antigua hacienda con jardines de cactus y piscina colonial.</p>
          <ul class="list-unstyled">
            <li>✅ Cabalgatas culturales</li>
            <li>✅ Taller de artesanías diaguitas</li>
            <li>✅ Peña folklórica los viernes</li>
          </ul>
        </div>
        <div class="card-footer bg-white">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <span class="h5">$65.200</span>
              <small class="text-muted">/noche</small>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservaCasaReal">Reservar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modales de reserva -->
<div class="modal fade" id="reservaLegadoMitico" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST">
        <input type="hidden" name="hotel_id" value="101">
        <div class="modal-header">
          <h5 class="modal-title">Reservar Legado Mítico</h5>
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
            <select name="huespedes" class="form-select">
              <option value="1">1 persona</option>
              <option value="2" selected>2 personas</option>
              <option value="3">3 personas</option>
              <option value="4">4 personas</option>
            </select>
          </div>
          <div class="alert alert-info">
            <strong>Precio por noche:</strong> $78.900 ARS<br>
            <span id="totalLegadoMitico">Total estimado: $78.900 ARS</span>
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

<div class="modal fade" id="reservaCasaReal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST">
        <input type="hidden" name="hotel_id" value="102">
        <div class="modal-header">
          <h5 class="modal-title">Reservar Casa Real</h5>
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
            <select name="huespedes" class="form-select">
              <option value="1">1 persona</option>
              <option value="2" selected>2 personas</option>
              <option value="3">3 personas</option>
              <option value="4">4 personas</option>
            </select>
          </div>
          <div class="alert alert-info">
            <strong>Precio por noche:</strong> $65.200 ARS<br>
            <span id="totalCasaReal">Total estimado: $65.200 ARS</span>
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
function calcularTotal(modalId, precioPorNoche, totalId) {
  const entradaInput = document.querySelector(`${modalId} input[name='fecha_entrada']`);
  const salidaInput = document.querySelector(`${modalId} input[name='fecha_salida']`);
  const totalSpan = document.querySelector(totalId);

  function updateTotal() {
    const entrada = new Date(entradaInput.value);
    const salida = new Date(salidaInput.value);
    const noches = (salida - entrada) / (1000 * 60 * 60 * 24);

    if (noches > 0) {
      totalSpan.textContent = `Total estimado: $${(noches * precioPorNoche).toLocaleString('es-AR')} ARS (${noches} noches)`;
    } else {
      totalSpan.textContent = `Total estimado: $${precioPorNoche.toLocaleString('es-AR')} ARS`;
    }
  }

  entradaInput.addEventListener('change', updateTotal);
  salidaInput.addEventListener('change', updateTotal);
}

calcularTotal('#reservaLegadoMitico', 78900, '#totalLegadoMitico');
calcularTotal('#reservaCasaReal', 65200, '#totalCasaReal');
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
