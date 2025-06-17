<?php
// Archivo boleto.php

if (isset($_GET['id'])) {
    $reserva_id = $_GET['id'];
    $query = "SELECT r.*, h.nombre as hotel_nombre, h.precio 
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
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h3>Comprobante de Reserva #<?= $reserva_id ?></h3>
    </div>
    <div class="card-body">
      <div class="row mb-4">
        <div class="col-md-6">
          <h4><?= $reserva['hotel_nombre'] ?></h4>
          <p>Fecha: <?= date('d/m/Y') ?></p>
        </div>
        <div class="col-md-6 text-end">
          <p class="mb-1">Check-in: <?= date('d/m/Y', strtotime($reserva['fecha_entrada'])) ?></p>
          <p class="mb-1">Check-out: <?= date('d/m/Y', strtotime($reserva['fecha_salida'])) ?></p>
          <p>Huéspedes: <?= $reserva['huespedes'] ?></p>
        </div>
      </div>
      
      <table class="table">
        <tr>
          <th>Descripción</th>
          <th class="text-end">Total</th>
        </tr>
        <tr>
          <td><?= $noches ?> noches x $<?= number_format($reserva['precio'], 0, ',', '.') ?></td>
          <td class="text-end">$<?= number_format($total, 0, ',', '.') ?></td>
        </tr>
      </table>
      
      <div class="alert alert-success mt-4">
        <h5>¡Reserva confirmada!</h5>
        <p>Presentar este comprobante al check-in</p>
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

<?php include('../../includes/footer.php'); ?>