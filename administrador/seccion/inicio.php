

<?php
// administrador.php
session_start();
// Podés incluir seguridad si querés proteger esta página, por ejemplo:
// if (!isset($_SESSION['usuario'])) { header("Location: ../usuario/login.php"); exit(); }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel Administrador - Agencia Turismo</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/adminitrador.css"> 
</head>
<body>

<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">🛠️ Admin Panel</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="../../index.php">Ir al sitio</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Contenido principal -->
<div class="container py-5">
  <div class="col-md-12">
    <div class="jumbotron text-center">
      <h1 class="display-3">¡Bienvenidos!</h1>
      <p class="lead">Gestiona y explora nuestros destinos turísticos</p>
      <hr class="my-4">
      <p>Ver productos disponibles para la venta</p>
      <p class="lead">
        <a class="btn btn-primary btn-lg" href="../seccion/productos.php" role="button">Administrar productos</a>
      </p>
    </div>
  </div>
</div>

<!-- Footer opcional -->
<footer class="bg-light text-center py-3 mt-5">
  <p class="mb-0">© <?= date("Y") ?> Agencia Turismo - Panel de Administración</p>
</footer>

</body>
</html>
