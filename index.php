<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Agencia de Turismo</title>
 
  <link rel="stylesheet" href="assets/css/styles.css" />
  <link rel="icon" href="assets/img/logo.png" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
</head>
<body>
  <!-- Navegador -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
    <div class="container-fluid">
     
      <a class="navbar-brand" href="index.php">Aventura Travel</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="index.php">Inicio</a></li>
          <li class="nav-item">
            <a class="nav-link" href="administrador/seccion/productos.php">Ver lugares</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="productos/auto.php">Alquilar auto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="carrito/carrito.php">Carrito</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="administrador/seccion/index2.php">Administrador</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="paginas/sobre_nosotros.php">Sobre nosotros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="paginas/contacto.php">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="usuario/login.php">
              <img src="assets/img/iconos/usuario.png" alt="Iniciar sesión" style="width: 24px; height: 24px"/>
              </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section
    class="hero-y-guia text-center py-5"
    style="
      background: url('assets/img/que gran fondo.jpg') center center/cover no-repeat;
      color: white;
    "
  >
    <div class="container bg-dark bg-opacity-75 p-4 rounded">
      <!-- Hero -->
      <div class="mb-5">
        <h1>Explorá el mundo con nosotros</h1>
        <p>Viajes únicos, experiencias inolvidables.</p>
        <a href="#destinos" class="btn btn-light mt-3">Ver tu destino</a>
      </div>

      <!-- Guía de compra -->
      <h2 class="mb-4">¿Cómo sacar tu pasaje?</h2>
      <p class="lead">¡Es fácil! Seguí estos pasos para reservar tu próxima aventura:</p>
      <div class="row mt-4">
        <div class="col-md-4">
          <div class="mb-3">
            <!-- Icono SVG -->
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="48"
              height="48"
              fill="white"
              class="bi bi-person-circle"
              viewBox="0 0 16 16"
            >
              <path d="M11 10a3 3 0 0 1-6 0h6z" />
              <path
                fill-rule="evenodd"
                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0-1A6 6 0 1 1 8 2a6 6 0 0 1 0 12z"
              />
            </svg>
          </div>
          <h5>1. Registrate o iniciá sesión</h5>
          <p>Creá tu cuenta o ingresá para empezar a explorar.</p>
        </div>
        <div class="col-md-4">
          <div class="mb-3">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="48"
              height="48"
              fill="white"
              class="bi bi-card-checklist"
              viewBox="0 0 16 16"
            >
              <path
                d="M10.854 6.854a.5.5 0 0 0-.708-.708L8.5 7.793 7.354 6.646a.5.5 0 1 0-.708.708L8.5 9l2.354-2.146z"
              />
              <path
                d="M14 4.5V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4.5H14zm1-1h-1V2a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v1H6V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1a1 1 0 0 0-1 1v1h16V4.5a1 1 0 0 0-1-1z"
              />
            </svg>
          </div>
          <h5>2. Elegí tu destino</h5>
          <p>Buscá entre nuestros viajes y agregá al carrito.</p>
        </div>
        <div class="col-md-4">
          <div class="mb-3">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="48"
              height="48"
              fill="white"
              class="bi bi-cash-stack"
              viewBox="0 0 16 16"
            >
              <path
                d="M14 2a1 1 0 0 1 1 1v1H1V3a1 1 0 0 1 1-1h12zm1 2H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4zM1 11.5a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5V10H1v1.5z"
              />
            </svg>
          </div>
          <h5>3. Pagá y viajá</h5>
          <p>Completá el pago y recibí tu pasaje al instante.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Tarjetas de destinos -->
  <section id="destinos" class="contenedor-tarjetas">
    <a href="productos/hoteles/bariloche.php" class="card-link">
      <div class="card">
        <img src="assets/img/bariloche.jpg" alt="Bariloche" />
        <h3>Bariloche</h3>
      </div>
    </a>

    <a href="productos/hoteles/mendoza.php" class="card-link">
      <div class="card">
        <img src="assets/img/mendoza.jpg" alt="Mendoza" />
        <h3>Mendoza</h3>
      </div>
    </a>

    <a href="productos/hoteles/salta.php" class="card-link">
      <div class="card">
        <img src="assets/img/salta.jpg" alt="Salta" />
        <h3>Salta</h3>
      </div>
    </a>

    <a href="productos/hoteles/ushuaia.php" class="card-link">
      <div class="card">
        <img src="assets/img/ushuaia.webp" alt="Ushuaia" />
        <h3>Ushuaia</h3>
      </div>
    </a>

    <a href="productos/hoteles/el-calafate.php" class="card-link">
      <div class="card">
        <img src="assets/img/el calafate.jpg" alt="El Calafate" />
        <h3>El Calafate</h3>
      </div>
    </a>

    <a href="productos/hoteles/Córdoba.php" class="card-link">
      <div class="card">
        <img src="assets/img/cordoba.jpg" alt="Cordoba" />
        <h3>Cordoba</h3>
      </div>
    </a>

    <a href="productos/hoteles/Iguazú.php" class="card-link">
      <div class="card">
        <img src="assets/img/iguazu.jpg" alt="Iguazú" />
        <h3>Iguazú</h3>
      </div>
    </a>

    <a href="productos/hoteles/Buenos-Aires.php" class="card-link">
      <div class="card">
        <img src="assets/img/buenos aires.jpg" alt="Buenos Aires" />
        <h3>Buenos Aires</h3>
      </div>
    </a>

    <a href="productos/hoteles/San-Juan.php" class="card-link">
      <div class="card">
        <img src="assets/img/san juan.jpeg" alt="San Juan" />
        <h3>San Juan</h3>
      </div>
    </a>

    <a href="productos/hoteles/Tucumán.php" class="card-link">
      <div class="card">
        <img src="assets/img/tucuman.jpg" alt="Tucumán" />
        <h3>Tucumán</h3>
      </div>
    </a>
  </section>

  <!-- Footer -->
  <footer>
    <p>© 2025 Agencia de Turismo. Todos los derechos reservados.</p>
    <div class="redes">
      <a href="https://www.facebook.com/AventuraTravelAgencia/">Facebook</a>
      <a href="https://www.instagram.com/aventuratravel.agencia/">Instagram</a>
      <a href="https://x.com/aventuras_viaje">Twitter</a>
    </div>
  </footer>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  ></script>
</body>
</html>
