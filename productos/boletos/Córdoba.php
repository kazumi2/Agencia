<?php
include('../../includes/header.php');
include('../../includes/db_connection.php');

// Verificar si se proporcionó un ID de reserva
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("<div class='alert alert-danger'>ID de reserva no válido</div>");
}

$reserva_id = intval($_GET['id']);

// Obtener los detalles de la reserva
$query = "SELECT r.*, h.nombre as hotel_nombre, h.descripcion, h.precio, h.imagen, h.categoria 
          FROM reservas r 
          JOIN hoteles h ON r.hotel_id = h.id 
          WHERE r.id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $reserva_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("<div class='alert alert-danger'>Reserva no encontrada</div>");
}

$reserva = $result->fetch_assoc();

// Calcular estadía y total
$fecha_entrada = new DateTime($reserva['fecha_entrada']);
$fecha_salida = new DateTime($reserva['fecha_salida']);
$noches = $fecha_entrada->diff($fecha_salida)->days;
$total = $noches * $reserva['precio'];

// Formatear fechas
$fecha_emision = new DateTime();
?>

<div class="container py-5">
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-primary text-white py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-0">Comprobante de Reserva</h2>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="badge bg-light text-dark fs-6">N° <?= str_pad($reserva_id, 6, '0', STR_PAD_LEFT) ?></span>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <!-- Encabezado -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <img src="<?= htmlspecialchars($reserva['imagen']) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($reserva['hotel_nombre']) ?>">
                </div>
                <div class="col-md-8">
                    <h3 class="text-primary"><?= htmlspecialchars($reserva['hotel_nombre']) ?></h3>
                    <p class="text-muted mb-1"><i class="bi bi-geo-alt"></i> Córdoba, Argentina</p>
                    <p class="text-muted"><i class="bi bi-star-fill text-warning"></i> <?= str_repeat('★', substr_count($reserva['categoria'], '★')) ?></p>
                    <p class="lead"><?= htmlspecialchars($reserva['descripcion']) ?></p>
                </div>
            </div>
            
            <hr>
            
            <!-- Detalles de la reserva -->
            <div class="row">
                <div class="col-md-6">
                    <h4 class="mb-3"><i class="bi bi-calendar-check"></i> Detalles de la Estadía</h4>
                    <div class="row">
                        <div class="col-6">
                            <p class="mb-1"><strong>Check-in:</strong></p>
                            <p><?= $fecha_entrada->format('d/m/Y') ?></p>
                            <p class="text-muted small">A partir de las 15:00 hs</p>
                        </div>
                        <div class="col-6">
                            <p class="mb-1"><strong>Check-out:</strong></p>
                            <p><?= $fecha_salida->format('d/m/Y') ?></p>
                            <p class="text-muted small">Antes de las 10:00 hs</p>
                        </div>
                    </div>
                    <p><strong>Noches:</strong> <?= $noches ?></p>
                    <p><strong>Huéspedes:</strong> <?= $reserva['huespedes'] ?></p>
                </div>
                
                <div class="col-md-6">
                    <h4 class="mb-3"><i class="bi bi-receipt"></i> Resumen de Pago</h4>
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Concepto</th>
                                <th class="text-end">Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $noches ?> noches x $<?= number_format($reserva['precio'], 0, ',', '.') ?></td>
                                <td class="text-end">$<?= number_format($reserva['precio'] * $noches, 0, ',', '.') ?></td>
                            </tr>
                            <tr class="table-light">
                                <th>TOTAL</th>
                                <th class="text-end">$<?= number_format($total, 0, ',', '.') ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <hr>
            
            <!-- Información adicional -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="alert alert-info">
                        <h5><i class="bi bi-info-circle"></i> Información Importante</h5>
                        <ul class="mb-0">
                            <li>Presentar este comprobante y documento de identidad al check-in</li>
                            <li>Política de cancelación: 48 horas antes sin cargo</li>
                            <li>No incluye tasas turísticas (se abonan directamente en el hotel)</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-light">
                        <h5><i class="bi bi-clock-history"></i> Estado de la Reserva</h5>
                        <p class="mb-2"><strong>Estado:</strong> <span class="badge bg-success"><?= ucfirst($reserva['estado']) ?></span></p>
                        <p class="mb-0"><strong>Fecha de emisión:</strong> <?= $fecha_emision->format('d/m/Y H:i') ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button onclick="window.print()" class="btn btn-outline-primary">
                        <i class="bi bi-printer"></i> Imprimir
                    </button>
                </div>
                <div>
                    <a href="hoteles_cordoba.php" class="btn btn-primary">
                        <i class="bi bi-house-door"></i> Volver a Hoteles
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .card, .card * {
            visibility: visible;
        }
        .card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none;
            box-shadow: none;
        }
        .no-print {
            display: none !important;
        }
    }
</style>

<?php include('../../includes/footer.php'); ?>