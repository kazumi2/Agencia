<?php
include('../../includes/header.php');
include('../../includes/db_connection.php');

// Validación del ID de reserva
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("<div class='alert alert-danger container mt-5'>ID de reserva no válido</div>");
}

$reserva_id = intval($_GET['id']);

// Obtener detalles de la reserva con información del hotel
$query = "SELECT r.*, h.nombre as hotel_nombre, h.descripcion, h.precio, h.imagen, 
                 h.categoria, h.ubicacion, h.servicios, h.check_in, h.check_out,
                 h.telefono, h.email, h.politica_cancelacion
          FROM reservas r 
          JOIN hoteles h ON r.hotel_id = h.id 
          WHERE r.id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $reserva_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("<div class='alert alert-danger container mt-5'>Reserva no encontrada</div>");
}

$reserva = $result->fetch_assoc();

// Calcular estadía y total
$fecha_entrada = new DateTime($reserva['fecha_entrada']);
$fecha_salida = new DateTime($reserva['fecha_salida']);
$noches = $fecha_entrada->diff($fecha_salida)->days;
$total = $noches * $reserva['precio'];
$servicios = explode(';', $reserva['servicios']);
$codigo_reserva = 'USH-' . str_pad($reserva_id, 6, '0', STR_PAD_LEFT);
?>

<div class="container py-4">
    <div class="card border-0 shadow-sm">
        <!-- Encabezado con diseño temático de Ushuaia -->
        <div class="card-header bg-gradient-ushuaia text-white">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-1"><i class="bi bi-building"></i> Confirmación de Reserva</h2>
                    <p class="mb-0"><i class="bi bi-geo-alt"></i> Ushuaia, Argentina - <?= date('d/m/Y H:i') ?></p>
                </div>
                <div class="col-md-4 text-end">
                    <span class="badge bg-light text-dark fs-6">Ref: <?= $codigo_reserva ?></span>
                    <p class="mb-0 mt-1"><small>Estado: <span class="badge bg-success">Confirmada</span></small></p>
                </div>
            </div>
        </div>

        <!-- Cuerpo principal -->
        <div class="card-body">
            <!-- Sección del hotel -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3 mb-md-0">
                    <img src="<?= htmlspecialchars($reserva['imagen']) ?>" class="img-fluid rounded shadow" alt="<?= htmlspecialchars($reserva['hotel_nombre']) ?>">
                    
                    <!-- Código QR para validación -->
                    <div class="text-center mt-3">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=<?= urlencode("ReservaID:$reserva_id,Hotel:{$reserva['hotel_nombre']},Fecha:{$fecha_entrada->format('d/m/Y')}") ?>" 
                             alt="Código QR" class="img-thumbnail border-ushuaia">
                        <p class="small text-muted mt-1">Presentar al check-in</p>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h3 class="text-ushuaia"><?= htmlspecialchars($reserva['hotel_nombre']) ?></h3>
                            <div class="mb-2">
                                <?= str_repeat('<i class="bi bi-star-fill text-warning"></i>', substr_count($reserva['categoria'], '★')) ?>
                                <span class="badge bg-ushuaia ms-2"><?= $reserva['categoria'] ?></span>
                            </div>
                        </div>
                        <span class="badge bg-<?= $reserva['precio'] > 80000 ? 'ushuaia' : 'success' ?>">
                            <?= $reserva['precio'] > 80000 ? 'Experiencia Premium' : 'Alojamiento Standard' ?>
                        </span>
                    </div>
                    
                    <p class="text-muted"><i class="bi bi-geo-alt-fill"></i> <?= htmlspecialchars($reserva['ubicacion']) ?></p>
                    <p><?= htmlspecialchars($reserva['descripcion']) ?></p>
                    
                    <!-- Detalles de la estadía -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="border p-3 rounded bg-light">
                                <h5><i class="bi bi-calendar-range"></i> Fechas de estadía</h5>
                                <div class="d-flex mb-3">
                                    <div class="me-3">
                                        <div class="fw-bold"><?= $fecha_entrada->format('d M') ?></div>
                                        <small class="text-muted">Check-in</small>
                                    </div>
                                    <div class="mx-2">
                                        <i class="bi bi-arrow-right"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold"><?= $fecha_salida->format('d M') ?></div>
                                        <small class="text-muted">Check-out</small>
                                    </div>
                                </div>
                                <p><i class="bi bi-moon-stars"></i> <strong><?= $noches ?> noches</strong></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border p-3 rounded bg-light">
                                <h5><i class="bi bi-person-lines-fill"></i> Huéspedes</h5>
                                <p class="mb-2"><strong><?= $reserva['huespedes'] ?> persona(s)</strong></p>
                                <p class="mb-0"><i class="bi bi-clock"></i> Check-in: <?= $reserva['check_in'] ?></p>
                                <p><i class="bi bi-clock"></i> Check-out: <?= $reserva['check_out'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de servicios y pago -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card border-ushuaia mb-4">
                        <div class="card-header bg-ushuaia text-white">
                            <h5 class="mb-0"><i class="bi bi-list-check"></i> Servicios Incluidos</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach(array_chunk($servicios, ceil(count($servicios)/2)) as $columna): ?>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <?php foreach($columna as $servicio): ?>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-ushuaia"></i> <?= htmlspecialchars(trim($servicio)) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-info-circle"></i> Información Importante</h5>
                        </div>
                        <div class="card-body">
                            <p><i class="bi bi-telephone"></i> <strong>Contacto:</strong> <?= htmlspecialchars($reserva['telefono']) ?></p>
                            <p><i class="bi bi-envelope"></i> <strong>Email:</strong> <?= htmlspecialchars($reserva['email']) ?></p>
                            <hr>
                            <h6><i class="bi bi-exclamation-triangle"></i> Política de cancelación</h6>
                            <p class="small"><?= htmlspecialchars($reserva['politica_cancelacion']) ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-cash-stack"></i> Resumen de Pago</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
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
                            
                            <div class="alert alert-success mt-3">
                                <h6><i class="bi bi-check-circle"></i> Pago Confirmado</h6>
                                <p class="mb-0 small">Reserva confirmada y garantizada</p>
                            </div>
                            
                            <div class="alert alert-warning small">
                                <h6><i class="bi bi-lightbulb"></i> Recomendaciones para Ushuaia</h6>
                                <ul class="mb-0">
                                    <li>Excursión al Parque Nacional Tierra del Fuego</li>
                                    <li>Paseo en el Tren del Fin del Mundo</li>
                                    <li>Navegación por el Canal Beagle</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie de página con acciones -->
        <div class="card-footer bg-light">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <button onclick="window.print()" class="btn btn-outline-ushuaia me-2">
                        <i class="bi bi-printer"></i> Imprimir
                    </button>
                    <button class="btn btn-outline-ushuaia me-2" id="saveToWallet">
                        <i class="bi bi-wallet2"></i> Guardar en Wallet
                    </button>
                </div>
                <div>
                    <a href="ushuaia.php" class="btn btn-ushuaia">
                        <i class="bi bi-arrow-left"></i> Volver a Hoteles
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos personalizados -->
<style>
    .bg-gradient-ushuaia {
        background: linear-gradient(135deg, #4682B4 0%, #1E90FF 100%);
    }
    
    .bg-ushuaia {
        background-color: #4682B4;
    }
    
    .text-ushuaia {
        color: #4682B4;
    }
    
    .btn-ushuaia {
        background-color: #4682B4;
        color: white;
    }
    
    .btn-outline-ushuaia {
        border-color: #4682B4;
        color: #4682B4;
    }
    
    .btn-outline-ushuaia:hover {
        background-color: #4682B4;
        color: white;
    }
    
    .border-ushuaia {
        border-color: #4682B4 !important;
    }
    
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
            margin: 0;
            border: none;
            box-shadow: none;
        }
        .no-print, .card-footer {
            display: none !important;
        }
    }
    
    .star-rating {
        font-size: 1.2rem;
    }
</style>

<!-- Script para guardar en wallet -->
<script>
document.getElementById('saveToWallet').addEventListener('click', function() {
    alert('Próximamente: Opción para guardar en tu wallet digital');
});
</script>

<?php include('../../includes/footer.php'); ?>