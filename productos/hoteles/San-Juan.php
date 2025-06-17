<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hoteles en San Juan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../assets/css/hotel.css" />
</head>
<body>

<div class="container py-5">
  <h1 class="text-center mb-4">Hoteles en San Juan</h1>

  <div class="row">

    <!-- Hotel 1 -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100 shadow-sm">
        <img src="../../assets/img/Hotel img/SanJuan/HotelAndes.jpg" class="card-img-top" alt="Hotel Andes">
        <div class="card-body">
          <h5 class="card-title">Andes</h5>
          <span class="badge bg-warning text-dark">★★★★</span>
          <p class="card-text mt-2">Hotel moderno con vista a la cordillera, piscina y spa.</p>
          <ul class="list-unstyled small">
            <li>✅ Piscina climatizada</li>
            <li>✅ Spa y gimnasio</li>
            <li>✅ Restaurante gourmet</li>
          </ul>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
          <div>
            <strong>$45.000</strong> <small>/noche</small>
          </div>
          <a href="reserva.php?id=1" class="btn btn-sm btn-primary">
            <i class="bi bi-calendar-check"></i> Reservar
          </a>
        </div>
      </div>
    </div>

    <!-- Hotel 2 -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100 shadow-sm">
        <img src="../../assets/img/Hotel img/SanJuan/IMG_8620-argentina-mendoza-huentala-hotel-review-001-1024x631.jpg" class="card-img-top" alt="Hotel Valle">
        <div class="card-body">
          <h5 class="card-title">Valle</h5>
          <span class="badge bg-warning text-dark">★★★</span>
          <p class="card-text mt-2">Acogedor hotel familiar cerca del centro histórico.</p>
          <ul class="list-unstyled small">
            <li>✅ Desayuno incluido</li>
            <li>✅ WiFi gratis</li>
            <li>✅ Estacionamiento gratuito</li>
          </ul>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
          <div>
            <strong>$30.000</strong> <small>/noche</small>
          </div>
          <a href="reserva.php?id=2" class="btn btn-sm btn-primary">
            <i class="bi bi-calendar-check"></i> Reservar
          </a>
        </div>
      </div>
    </div>

    <!-- Hotel 3 -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100 shadow-sm">
        <img src="../../assets/img/Hotel img/SanJuan/Frente del hotel.jpeg" class="card-img-top" alt="Hotel San Juan">
        <div class="card-body">
          <h5 class="card-title">el San Juan</h5>
          <span class="badge bg-warning text-dark">★★★</span>
          <p class="card-text mt-2">Confort y tranquilidad en el corazón de la provincia. Ideal para viajeros y familias.</p>
          <ul class="list-unstyled small">
            <li>✅ WiFi gratis</li>
            <li>✅ Desayuno incluido</li>
            <li>✅ Estacionamiento</li>
          </ul>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
          <div>
            <strong>$38.000</strong> <small>/noche</small>
          </div>
          <a href="reserva.php?id=3" class="btn btn-sm btn-primary">
            <i class="bi bi-calendar-check"></i> Reservar
          </a>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Bootstrap JS opcional -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
