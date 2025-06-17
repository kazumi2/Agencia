<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sobre Nosotros - Aventura Travel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/nosotros.css" />
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.html">Aventura Travel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link active" href="index.php">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="../administrador/seccion/productos.php">Ver lugares</a></li>
        <li class="nav-item"><a class="nav-link" href="../productos/auto.php">Alquilar auto</a></li>
        <li class="nav-item"><a class="nav-link" href="carrito.php">Carrito</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Iniciar sesión</a></li>
        <li class="nav-item"><a class="nav-link" href="./administrador/index.php">Administrador</a></li>
        <li class="nav-item"><a class="nav-link" href="sobre_nosotros.php">Sobre nosotros</a></li>
        <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- HISTORIA -->
<section class="container py-5 fade-in fade-delay-1">
  <div class="row align-items-center mb-5">
    <div class="col-md-6">
      <h2 class="fw-bold text-primary">Nuestra historia</h2>
      <p class="lead">
        Aventura Travel nace del deseo de conectar personas con los destinos más maravillosos de Argentina.
        Comenzamos como un pequeño proyecto de Olimpiada y hoy brindamos una plataforma completa para planear tus viajes
        de forma simple, segura y emocionante.
      </p>
    </div>
    <div class="col-md-6 text-center">
      <img src="../assets/img/que gran fondo.jpg" alt="Viajes" class="img-fluid rounded shadow historia-img">
    </div>
  </div>
</section>

<!-- EQUIPO -->
<section class="container py-5 fade-in fade-delay-2">
  <h2 class="text-center fw-bold text-primary mb-4">Nuestro equipo</h2>
  <div class="row text-center justify-content-center">

    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="equipo-card p-3 rounded shadow-sm h-100">
        <img src="../assets/img/iconos/usuario.png" alt="Brenda" class="equipo-img mb-3">
        <h5 class="fw-semibold">Brenda Aylen Blando Callorda</h5>
        <small>
          <img src="../assets/img/iconos/recursos-humanos.png" alt="Líder" width="16" class="me-1">
          Líder de proyecto
        </small><br>
        <small>
          <img src="../assets/img/iconos/codificacion.png" alt="Programadora" width="16" class="me-1">
          Programadora
        </small>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="equipo-card p-3 rounded shadow-sm h-100">
        <img src="../assets/img/iconos/usuario.png" alt="Zahira" class="equipo-img mb-3">
        <h5 class="fw-semibold">Zahira Berenice Blando Callorda</h5>
        <small>
          <img src="../assets/img/iconos/diseno-grafico.png" alt="Diseño" width="16" class="me-1">
          Diseñadora Gráfica
        </small>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="equipo-card p-3 rounded shadow-sm h-100">
        <img src="../assets/img/iconos/usuario.png" alt="Candela" class="equipo-img mb-3">
        <h5 class="fw-semibold">Candela Trinidad Basto</h5>
        <small>
          <img src="../assets/img/iconos/cientifico-de-datos.png" alt="Analista" width="16" class="me-1">
          Analista Funcional
        </small>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="equipo-card p-3 rounded shadow-sm h-100">
        <img src="../assets/img/iconos/usuario.png" alt="Neri" class="equipo-img mb-3">
        <h5 class="fw-semibold">Neri Franco Cano</h5>
        <small>
          <img src="../assets/img/iconos/codificacion.png" alt="Programador" width="16" class="me-1">
          Programador
        </small>
      </div>
    </div>

  </div>
</section>

 <!-- Botón profesional para acceder al manual -->
      <a href="../paginas/manual/manual.php" class="btn btn-outline-primary mt-3">
        Leer nuestro Manual de Usuario
      </a>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="text-center py-4 bg-light mt-5 border-top">
  <p class="mb-0 text-muted">© 2025 Aventura Travel. Todos los derechos reservados.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
