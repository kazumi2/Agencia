<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Productos - Aventura Travel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../css/productos.css" />
  <link rel="icon" href="img/logo.png">
</head>
<body>

  <header class="bg-primary text-white p-3 sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
      <a href="index.html" class="text-white text-decoration-none fs-3 fw-bold">
        🌍 Aventura Travel
      </a>
      <nav>
        <ul class="nav">
          <li class="nav-item"><a href="index.php" class="nav-link text-white">Inicio</a></li>
          <li class="nav-item"><a href="../../carrito/carrito.php " class="nav-link text-white">Carrito (<span id="contador-carrito">0</span>)</a></li>
            <li class="nav-item"><a class="nav-link active" href="index.php">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="../productos/auto.php">Alquilar auto</a></li>
          <li class="nav-item"><a class="nav-link" href="./administrador/index.php">Administrador</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="container my-5">
    <h1 class="mb-4 text-center">Nuestros Paquetes Turísticos</h1>
    
    <!-- Filtros de búsqueda -->
    <div class="row mb-4">
      <div class="col-md-6">
        <input type="text" class="form-control" id="buscador" placeholder="Buscar paquetes...">
      </div>
      <div class="col-md-3">
        <select class="form-select" id="filtro-precio">
          <option value="">Todos los precios</option>
          <option value="0-1500">Hasta $1500</option>
          <option value="1501-2000">$1501 - $2000</option>
          <option value="2001-3000">Más de $2000</option>
        </select>
      </div>
      <div class="col-md-3">
        <select class="form-select" id="filtro-categoria">
          <option value="">Todas las categorías</option>
          <option value="playa">Playa</option>
          <option value="montaña">Montaña</option>
          <option value="aventura">Aventura</option>
          <option value="cultural">Cultural</option>
        </select>
      </div>
    </div>

    <div class="row g-4" id="contenedor-productos">

      <!-- Producto 1 -->
      <div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="playa" data-precio="1500">
        <div class="card shadow-sm h-100">
          <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Paquete Playa">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Escapada a la Playa</h5>
            <p class="card-text flex-grow-1">Disfruta de 5 días de sol y mar en la mejor playa tropical.</p>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <span class="precio fs-5 fw-bold text-primary">$1500 ARS</span>
              <button class="btn btn-primary btn-agregar" data-id="1">Agregar al carrito</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Producto 2 -->
      <div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="montaña" data-precio="1800">
        <div class="card shadow-sm h-100">
          <img src="https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Paquete Montaña">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Aventura en la Montaña</h5>
            <p class="card-text flex-grow-1">Excursión de 7 días para amantes del trekking y la naturaleza.</p>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <span class="precio fs-5 fw-bold text-primary">$1800 ARS</span>
              <button class="btn btn-primary btn-agregar" data-id="2">Agregar al carrito</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Producto 3 -->
      <div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="cultural" data-precio="900">
        <div class="card shadow-sm h-100">
          <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Paquete Ciudad">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Tour por la Ciudad</h5>
            <p class="card-text flex-grow-1">Visita guiada por los puntos históricos y culturales más emblemáticos.</p>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <span class="precio fs-5 fw-bold text-primary">$900 ARS</span>
              <button class="btn btn-primary btn-agregar" data-id="3">Agregar al carrito</button>
            </div>
          </div>
        </div>
      </div>

<!-- Producto 4 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="naturaleza" data-precio="1300">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\bosque.jpg" class="card-img-top" alt="Paquete Bosque">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Escapada al Bosque</h5>
      <p class="card-text flex-grow-1">Disfruta de caminatas y la tranquilidad de la naturaleza.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$1300 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="4">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 5 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="aventura" data-precio="2500">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\safari.jpeg" class="card-img-top" alt="Paquete Safari">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Safari en África</h5>
      <p class="card-text flex-grow-1">Explora la fauna salvaje y paisajes impresionantes.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$2500 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="5">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 6 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="aventura" data-precio="2200">
  <div class="card shadow-sm h-100">
    <img src="https://images.unsplash.com/photo-1470770841072-f978cf4d019e?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Paquete Nieve">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Aventura en la Nieve</h5>
      <p class="card-text flex-grow-1">Disfruta de esquí y snowboard en las mejores pistas.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$2200 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="6">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 7 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="aventura" data-precio="1600">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\desierto.jpg" class="card-img-top" alt="Paquete Desierto">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Tour por el Desierto</h5>
      <p class="card-text flex-grow-1">Experimenta las dunas y paisajes áridos sorprendentes.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$1600 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="7">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 8 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="playa" data-precio="2700">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\paraiso.jpg" class="card-img-top" alt="Paquete Isla">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Islas Paradisíacas</h5>
      <p class="card-text flex-grow-1">Relájate en playas de arena blanca y aguas cristalinas.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$2700 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="8">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 9 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="relax" data-precio="2000">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\crucero.jpg" class="card-img-top" alt="Paquete Río">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Crucero por el Río</h5>
      <p class="card-text flex-grow-1">Navega y disfruta del paisaje desde un barco confortable.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$2000 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="9">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 10 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="playa" data-precio="2400">
  <div class="card shadow-sm h-100">
    <img src="https://images.unsplash.com/photo-1472214103451-9374bd1c798e?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Paquete Isla Tropical">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Isla Tropical</h5>
      <p class="card-text flex-grow-1">Disfruta de la vida isleña y actividades acuáticas.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$2400 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="10">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 11 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="playa" data-precio="1800">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\playa nocturna.jpg" class="card-img-top" alt="Paquete Playa Nocturna">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Playa Nocturna</h5>
      <p class="card-text flex-grow-1">Disfruta de las estrellas y el mar en la noche.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$1800 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="11">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 12 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="naturaleza" data-precio="1700">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\lago.jpg" class="card-img-top" alt="Paquete Lago">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Viaje al Lago</h5>
      <p class="card-text flex-grow-1">Relájate y practica deportes acuáticos en un lago tranquilo.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$1700 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="12">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 13 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="aventura" data-precio="2500">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\foto.jpg" class="card-img-top" alt="Paquete Safari">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Safari Fotográfico</h5>
      <p class="card-text flex-grow-1">Explora la fauna salvaje con guía profesional y cámara en mano.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$2500 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="13">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 14 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="aventura" data-precio="1900">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\volcan.jpg" class="card-img-top" alt="Paquete Volcán">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Exploración de Volcán</h5>
      <p class="card-text flex-grow-1">Ascenso a volcanes activos con vistas increíbles.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$1900 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="14">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 15 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="aventura" data-precio="2800">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\isla.webp" class="card-img-top" alt="Paquete Isla Remota">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Isla Remota</h5>
      <p class="card-text flex-grow-1">Aventura aislada en una isla virgen.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$2800 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="15">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 16 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="cultural" data-precio="1400">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\cultura.webp" class="card-img-top" alt="Paquete Cultura">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Tour Cultural</h5>
      <p class="card-text flex-grow-1">Sumérgete en la cultura y tradiciones locales.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$1400 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="16">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 17 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="aventura" data-precio="2300">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\extremo.jpg" class="card-img-top" alt="Paquete Aventura Extrema">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Aventura Extrema</h5>
      <p class="card-text flex-grow-1">Deportes de adrenalina para los más valientes.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$2300 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="17">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 18 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="relax" data-precio="1700">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\barco.jpg" class="card-img-top" alt="Paquete Paseo en Barco">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Paseo en Barco</h5>
      <p class="card-text flex-grow-1">Relájate navegando en aguas tranquilas.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$1700 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="18">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 19 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="eventos" data-precio="2100">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\musica.avif" class="card-img-top" alt="Paquete Festival">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Festival de Música</h5>
      <p class="card-text flex-grow-1">Disfruta de grandes artistas en un ambiente único.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$2100 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="19">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 20 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="relax" data-precio="2000">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\spa.jpg" class="card-img-top" alt="Paquete Spa">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Relajación en Spa</h5>
      <p class="card-text flex-grow-1">Días de descanso con tratamientos de bienestar.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$2000 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="20">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<!-- Producto 21 -->
<div class="col-sm-6 col-md-4 col-lg-3 producto" data-categoria="naturaleza" data-precio="1500">
  <div class="card shadow-sm h-100">
    <img src="..\..\assets\img\bajo las estrella.avif" class="card-img-top" alt="Paquete Camping">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">Camping Bajo las Estrellas</h5>
      <p class="card-text flex-grow-1">Vive la naturaleza y la aventura al aire libre.</p>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="precio fs-5 fw-bold text-primary">$1500 ARS</span>
        <button class="btn btn-primary btn-agregar" data-id="21">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>
  <footer class="bg-dark text-white py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p>© 2025 Agencia de Turismo. Todos los derechos reservados.</p>
        </div>
        <div class="col-md-6 text-end">
          <div class="redes">
            <a href="https://www.facebook.com/AventuraTravelAgencia/" class="text-white mx-2"><i class="fab fa-facebook"></i> Facebook</a>
            <a href="https://www.instagram.com/aventuratravel.agencia/" class="text-white mx-2"><i class="fab fa-instagram"></i> Instagram</a>
            <a href="https://x.com/aventuras_viaje" class="text-white mx-2"><i class="fab fa-twitter"></i> Twitter</a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS + Font Awesome -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <!-- Script mejorado para el carrito -->
  <script>
  document.addEventListener('DOMContentLoaded', function() {
  let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
  actualizarContadorCarrito();

  document.querySelectorAll('.btn-agregar').forEach(boton => {
    boton.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      const producto = obtenerInfoProducto(this);

      // Buscar si ya está en el carrito
      const existe = carrito.find(item => item.id === id);
      if (existe) {
        existe.cantidad++;
      } else {
        carrito.push({
          id: id,
          titulo: producto.titulo,
          precio: producto.precio,
          imagen: producto.imagen,
          cantidad: 1
        });
      }

      localStorage.setItem('carrito', JSON.stringify(carrito));
      actualizarContadorCarrito();
      mostrarNotificacion(`${producto.titulo} agregado al carrito`);
    });
  });

  // Función para sacar info del producto
  function obtenerInfoProducto(boton) {
    const tarjeta = boton.closest('.card');
    return {
      titulo: tarjeta.querySelector('.card-title').textContent,
      precio: parseFloat(tarjeta.querySelector('.precio').textContent.replace('$', '').replace('ARS', '').trim()),
      imagen: tarjeta.querySelector('img').src
    };
  }

  // Actualiza contador visible del carrito
  function actualizarContadorCarrito() {
    const total = carrito.reduce((sum, item) => sum + item.cantidad, 0);
    document.getElementById('contador-carrito').textContent = total;
  }

  // Mostrar toast notificación
  function mostrarNotificacion(mensaje) {
    const notificacion = document.createElement('div');
    notificacion.className = 'position-fixed bottom-0 end-0 p-3';
    notificacion.style.zIndex = '11';
    notificacion.innerHTML = `
      <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
          <strong class="me-auto">Éxito</strong>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Cerrar"></button>
        </div>
        <div class="toast-body">${mensaje}</div>
      </div>
    `;
    document.body.appendChild(notificacion);
    setTimeout(() => notificacion.remove(), 3000);
  }

  // Código para filtros (buscador, precio y categoría)
  document.getElementById('buscador').addEventListener('input', filtrarProductos);
  document.getElementById('filtro-precio').addEventListener('change', filtrarProductos);
  document.getElementById('filtro-categoria').addEventListener('change', filtrarProductos);

  function filtrarProductos() {
    const texto = document.getElementById('buscador').value.toLowerCase();
    const rangoPrecio = document.getElementById('filtro-precio').value;
    const categoria = document.getElementById('filtro-categoria').value;

    document.querySelectorAll('.producto').forEach(producto => {
      const titulo = producto.querySelector('.card-title').textContent.toLowerCase();
      const precio = parseFloat(producto.getAttribute('data-precio'));
      const catProducto = producto.getAttribute('data-categoria');

      let coincideTexto = titulo.includes(texto);
      let coincidePrecio = true;
      let coincideCategoria = true;

      if (rangoPrecio) {
        const [min, max] = rangoPrecio.split('-').map(Number);
        coincidePrecio = precio >= min && (max ? precio <= max : true);
      }

      if (categoria) {
        coincideCategoria = catProducto === categoria;
      }

      producto.style.display = (coincideTexto && coincidePrecio && coincideCategoria) ? 'block' : 'none';
    });
  }
});

  </script>
</body>
</html>