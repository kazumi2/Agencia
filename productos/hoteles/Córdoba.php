<?php 
session_start();

// Procesar reserva si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reservar'])) {
    $hotel_id = $_POST['hotel_id'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $fecha_salida = $_POST['fecha_salida'];
    $huespedes = $_POST['huespedes'];
    $usuario_id = $_SESSION['user_id'] ?? null;
    
    // Validar fechas
    if (strtotime($fecha_salida) <= strtotime($fecha_entrada)) {
        $_SESSION['error_reserva'] = "La fecha de salida debe ser posterior a la de entrada";
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
        $_SESSION['error_reserva'] = "Error al realizar la reserva: " . $conn->error;
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}
?>
  
  <?php if (isset($_SESSION['error_reserva'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error_reserva'] ?></div>
    <?php unset($_SESSION['error_reserva']); ?>
  <?php endif; ?>
  <!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Hotel</title>
<link rel="stylesheet" href="..\..\assets\css\hotel.css" />
</head>
<body>
  <div class="row">
    <!-- Hotel 1: Windsor Hotel & Tower -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <img src="../../assets/img/Hotel img/Cordoba/image-3-1413x2048.jpeg" class="card-img-top" alt="Windsor Hotel & Tower">
        <div class="card-body">
          <h5 class="card-title">Windsor Hotel & Tower</h5>
          <div class="mb-2">
            <span class="badge bg-warning text-dark">★★★★★</span>
            <span class="badge bg-primary ms-2">Premium</span>
          </div>
          <p class="card-text">El hotel más alto de Córdoba con vista panorámica.</p>
          <ul class="list-unstyled">
            <li>✅ Piscina en altura (piso 28)</li>
            <li>✅ Spa con cabinas de hidromasaje</li>
            <li>✅ 3 restaurantes gourmet</li>
          </ul>
        </div>
        <div class="card-footer bg-white">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <span class="h5">$48.000</span>
              <small class="text-muted">/noche</small>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservaWindsor">Reservar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Hotel 2: Holiday Inn Córdoba -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <img src="../../assets/img/Hotel img/Cordoba/Exterior.jpg" class="card-img-top" alt="Holiday Inn Córdoba">
        <div class="card-body">
          <h5 class="card-title">Holiday Inn Córdoba</h5>
          <div class="mb-2">
            <span class="badge bg-warning text-dark">★★★★</span>
            <span class="badge bg-success ms-2">Familiar</span>
          </div>
          <p class="card-text">Cadena internacional en zona céntrica.</p>
          <ul class="list-unstyled">
            <li>✅ Kids stay free (2 niños)</li>
            <li>✅ Desayuno buffet internacional</li>
            <li>✅ Gimnasio 24hs</li>
          </ul>
        </div>
        <div class="card-footer bg-white">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <span class="h5">$32.500</span>
              <small class="text-muted">/noche</small>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservaHoliday">Reservar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Reserva Windsor -->
<div class="modal fade" id="reservaWindsor" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="">
        <input type="hidden" name="hotel_id" value="1">
        <div class="modal-header">
          <h5 class="modal-title">Reservar Windsor Hotel & Tower</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
            <strong>Precio por noche:</strong> $48.000 ARS<br>
            <span id="totalWindsor">Total estimado: $48.000 ARS</span>
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

<!-- Modal Reserva Holiday Inn -->
<div class="modal fade" id="reservaHoliday" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="">
        <input type="hidden" name="hotel_id" value="2">
        <div class="modal-header">
          <h5 class="modal-title">Reservar Holiday Inn Córdoba</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
            <label class="form-label">Huéspedes (incluye niños)</label>
            <select name="huespedes" class="form-select" required>
              <option value="1">1 adulto</option>
              <option value="2" selected>2 adultos</option>
              <option value="3">2 adultos + 1 niño</option>
              <option value="4">2 adultos + 2 niños</option>
            </select>
          </div>
          <div class="alert alert-info">
            <strong>Precio por noche:</strong> $32.500 ARS<br>
            <span id="totalHoliday">Total estimado: $32.500 ARS</span>
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
// Calcular total estimado para Windsor
document.querySelector('#reservaWindsor input[name="fecha_salida"]').addEventListener('change', function() {
  const entrada = new Date(document.querySelector('#reservaWindsor input[name="fecha_entrada"]').value);
  const salida = new Date(this.value);
  const noches = (salida - entrada) / (1000 * 60 * 60 * 24);
  if (noches > 0) {
    document.querySelector('#totalWindsor').textContent = `Total estimado: $${(noches * 48000).toLocaleString('es-AR')} ARS (${noches} noches)`;
  }
});

// Calcular total estimado para Holiday Inn
document.querySelector('#reservaHoliday input[name="fecha_salida"]').addEventListener('change', function() {
  const entrada = new Date(document.querySelector('#reservaHoliday input[name="fecha_entrada"]').value);
  const salida = new Date(this.value);
  const noches = (salida - entrada) / (1000 * 60 * 60 * 24);
  if (noches > 0) {
    document.querySelector('#totalHoliday').textContent = `Total estimado: $${(noches * 32500).toLocaleString('es-AR')} ARS (${noches} noches)`;
  }
});
</script>

</body>
</html>