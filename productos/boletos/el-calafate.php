<?php
include('../../includes/header.php');
include('../../includes/db_connection.php');

if (isset($_GET['id'])) {
    $reserva_id = $_GET['id'];
    $query = "SELECT r.*, t.nombre as tour_nombre, t.precio, t.imagen, t.duracion, t.incluye 
              FROM reservas_tours r 
              JOIN tours t ON r.tour_id = t.id 
              WHERE r.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $reserva_id);
    $stmt->execute();
    $reserva = $stmt->get_result()->fetch_assoc();
    
    if ($reserva) {
        $total = $reserva['precio'] * $reserva['pasajeros'];
?>
<div class="container py-5">
  <div class="card shadow-lg">
    <div class="card-header bg-success text-white">
      <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Boleto de Excursión #<?= $reserva_id ?></h3>
        <span class="badge bg-light text-dark"><?= strtoupper($reserva['estado']) ?></span>
      </div>
    </div>
    <div class="card-body">
      <div class="row mb-4">
        <div class="col-md-4">
          <img src="<?= $reserva['imagen'] ?>" class="img-fluid rounded" alt="<?= $reserva['tour_nombre'] ?>">
        </div>
        <div class="col-md-4">
          <h4><?= $reserva['tour_nombre'] ?></h4>
          <p class="text-muted">Fecha de emisión: <?= date('d/m/Y H:i') ?></p>
          <hr>
          <h5>Detalles de la excursión:</h5>
          <p><i class="bi bi-calendar-date"></i> Fecha: <?= date('d/m/Y', strtotime($reserva['fecha_tour'])) ?></p>
          <p><i class="bi bi-clock"></i> Hora: <?= $reserva['hora_recojo'] ?></p>
          <p><i class="bi bi-people"></i> Pasajeros: <?= $reserva['pasajeros'] ?></p>
          <p><i class="bi bi-hourglass"></i> Duración: <?= $reserva['duracion'] ?></p>
        </div>
        <div class="col-md-4 border-start">
          <h5>Resumen de pago</h5>
          <table class="table table-bordered">
            <tr>
              <td><?= $reserva['pasajeros'] ?> personas x $<?= number_format($reserva['precio'], 0, ',', '.') ?></td>
              <td class="text-end">$<?= number_format($total, 0, ',', '.') ?></td>
            </tr>
            <tr class="table-active">
              <th>TOTAL</th>
              <th class="text-end">$<?= number_format($total, 0, ',', '.') ?></th>
            </tr>
          </table>
          <div class="d-grid gap-2">
            <button class="btn btn-outline-success" onclick="window.print()">
              <i class="bi bi-printer"></i> Imprimir boleto
            </button>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <div class="alert alert-info">
            <h5><i class="bi bi-info-circle"></i> Incluye:</h5>
            <ul class="mb-0">
              <?php 
              $incluye = explode(',', $reserva['incluye']);
              foreach($incluye as $item) {
                echo "<li>".trim($item)."</li>";
              }
              ?>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <div class="border p-3 rounded bg-light">
            <h6><i class="bi bi-geo-alt"></i> Punto de recojo:</h6>
            <p class="mb-2"><?= $reserva['lugar_recojo'] ?></p>
            <h6 class="mt-3"><i class="bi bi-exclamation-triangle"></i> Importante:</h6>
            <ul class="mb-0">
              <li>Presentar este boleto al guía</li>
              <li>Llegar 15 minutos antes</li>
              <li>Política de cancelación: 24 horas antes</li>
              <li>No incluye propinas</li>
            </ul>
          </div>
        </div>
      </div>
      
      <div class="alert alert-success mt-4">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <i class="bi bi-check-circle-fill fs-1"></i>
          </div>
          <div class="flex-grow-1 ms-3">
            <h5 class="alert-heading">¡Excursión confirmada!</h5>
            <p class="mb-0">Tu guía turístico se pondrá en contacto contigo un día antes para confirmar detalles.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer text-muted text-center">
      Código de verificación: <strong><?= strtoupper(uniqid()) ?></strong>
    </div>
  </div>
</div>
<?php
    } else {
        echo "<div class='alert alert-danger'>Reserva de excursión no encontrada</div>";
    }
} else {
    echo "<div class='alert alert-danger'>ID de boleto no especificado</div>";
}

include('../../includes/footer.php');
?>