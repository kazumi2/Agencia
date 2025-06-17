<?php
include('../../includes/header.php');
include('../../includes/db_connection.php');

if (isset($_GET['id'])) {
    $reserva_id = $_GET['id'];
    $query = "SELECT r.*, h.nombre as hotel_nombre, h.precio, h.imagen 
              FROM reservas r 
              JOIN hoteles h ON r.hotel_id = h.id 
              WHERE r.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $reserva_id);
    $stmt->execute();
    $reserva = $stmt->get_result()->fetch_assoc();
    
    if ($reserva) {
        $noches = (strtotime($reserva['fecha_salida']) - strtotime($reserva['fecha_entrada'])) / (60 * 60 * 24);
        $total = $noches * $reserva['precio'];
?>
<div class="container py-5">
  <div class="card shadow-lg">
    <div class="card-header bg-primary text-white">
      <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Comprobante de Reserva #<?= $reserva_id ?></h3>
        <span class="badge bg-light text-dark"><?= strtoupper($reserva['estado']) ?></span>
      </div>
    </div>
    <div class="card-body">
      <div class="row mb-4">
        <div class="col-md-4">
          <img src="<?= $reserva['imagen'] ?>" class="img-fluid rounded" alt="<?= $reserva['hotel_nombre'] ?>">
        </div>
        <div class="col-md-4">
          <h4><?= $reserva['hotel_nombre'] ?></h4>
          <p class="text-muted">Fecha de emisión: <?= date('d/m/Y H:i') ?></p>
          <hr>
          <h5>Detalles de la estadía:</h5>
          <p><i class="bi bi-calendar-check"></i> Check-in: <?= date('d/m/Y', strtotime($reserva['fecha_entrada'])) ?></p>
          <p><i class="bi bi-calendar-x"></i> Check-out: <?= date('d/m/Y', strtotime($reserva['fecha_salida'])) ?></p>
          <p><i class="bi bi-people"></i> Huéspedes: <?= $reserva['huespedes'] ?></p>
        </div>
        <div class="col-md-4 border-start">
          <h5>Resumen de pago</h5>
          <table class="table table-bordered">
            <tr>
              <td><?= $noches ?> noches x $<?= number_format($reserva['precio'], 0, ',', '.') ?></td>
              <td class="text-end">$<?= number_format($reserva['precio'] * $noches, 0, ',', '.') ?></td>
            </tr>
            <tr class="table-active">
              <th>TOTAL</th>
              <th class="text-end">$<?= number_format($total, 0, ',', '.') ?></th>
            </tr>
          </table>
          <div class="d-grid gap-2">
            <button class="btn btn-outline-primary" onclick="window.print()">
              <i class="bi bi-printer"></i> Imprimir
            </button>
          </div>
        </div>
      </div>
      
      <div class="alert alert-success">
        <h5><i class="bi bi-check-circle"></i> ¡Reserva confirmada!</h5>
        <p class="mb-0">Presentar este comprobante al check-in junto con documento de identidad.</p>
      </div>
      
      <div class="border p-3 rounded bg-light">
        <h6><i class="bi bi-info-circle"></i> Información importante:</h6>
        <ul class="mb-0">
          <li>Check-in a partir de las 15:00 hs</li>
          <li>Check-out antes de las 10:00 hs</li>
          <li>Política de cancelación: 48 horas antes sin cargo</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php
    } else {
        echo "<div class='alert alert-danger'>Reserva no encontrada</div>";
    }
} else {
    echo "<div class='alert alert-danger'>ID de reserva no especificado</div>";
}

include('../../includes/footer.php');
?>