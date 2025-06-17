<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hoteles en Iguazú</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../assets/css/hotel.css" />
  <style>
    .card-title {
      font-weight: bold;
    }
    .card-footer {
      border-top: 1px solid #dee2e6;
    }
    .badge {
      font-size: 0.8rem;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <h1 class="text-center mb-5">Hoteles en Iguazú</h1>

  <div class="row">

    <!-- Hotel 1: Gran Meliá Iguazú -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100 shadow-sm">
        <img src="../../assets/img/Hotel img/Iguazu/cf3443d26f8f5fafde4c6bd910d267a1d5186301.jpeg" class="card-img-top" alt="Gran Meliá Iguazú">
        <div class="card-body">
          <h5 class="card-title">1. Gran Meliá Iguazú</h5>
          <div class="mb-2">
            <span class="badge bg-warning text-dark">★★★★★</span>
            <span class="badge bg-danger ms-2">Premium</span>
          </div>
          <p class="card-text">Único hotel dentro del Parque Nacional Iguazú con vista directa a las Cataratas.</p>
          <ul class="list-unstyled small">
            <li>✅ Piscina infinita con vista</li>
            <li>✅ Spa y gimnasio de lujo</li>
            <li>✅ Restaurante gourmet</li>
          </ul>
        </div>
        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
          <div>
            <span class="fw-bold">$95.000</span> <small class="text-muted">/noche</small>
          </div>
          <a href="reserva.php?id=1" class="btn btn-sm btn-primary">
            <i class="bi bi-calendar-check"></i> Reservar
          </a>
        </div>
      </div>
    </div>

    <!-- Hotel 2: Loi Suites Iguazú -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100 shadow-sm">
        <img src="../../assets/img/Hotel img/Iguazu/3.jpg" class="card-img-top" alt="Loi Suites Iguazú">
        <div class="card-body">
          <h5 class="card-title">2. Loi Suites Iguazú</h5>
          <div class="mb-2">
            <span class="badge bg-warning text-dark">★★★★</span>
            <span class="badge bg-info ms-2">Selva</span>
          </div>
          <p class="card-text">Ubicado en medio de la selva misionera con puentes colgantes y piscina en altura.</p>
          <ul class="list-unstyled small">
            <li>✅ Habitaciones amplias</li>
            <li>✅ Spa con tratamientos naturales</li>
            <li>✅ Actividades en la selva</li>
          </ul>
        </div>
        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
          <div>
            <span class="fw-bold">$74.800</span> <small class="text-muted">/noche</small>
          </div>
          <a href="reserva.php?id=2" class="btn btn-sm btn-primary">
            <i class="bi bi-calendar-check"></i> Reservar
          </a>
        </div>
      </div>
    </div>

</div>
</div> 

</body>
</html>
