<?php
session_start();

// Vacía el carrito (opcional)
unset($_SESSION['carrito']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gracias por tu compra</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: #f0f8ff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .thank-you-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      padding: 40px 50px;
      text-align: center;
      max-width: 400px;
      animation: fadeIn 1.2s ease forwards;
    }
    .thank-you-card h1 {
      color: #28a745;
      margin-bottom: 20px;
      font-size: 2.5rem;
    }
    .thank-you-card p {
      font-size: 1.2rem;
      color: #555;
      margin-bottom: 30px;
    }
    .btn-home {
      background-color: #28a745;
      color: white;
      font-weight: 600;
      padding: 12px 30px;
      border-radius: 8px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }
    .btn-home:hover {
      background-color: #218838;
      color: white;
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(30px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>
  <div class="thank-you-card">
    <h1>¡Gracias por tu compra! 🎉</h1>
    <p>Tu pedido fue procesado con éxito.<br>¡Te esperamos de nuevo!</p>
    <a href="../index.php" class="btn-home">Volver al inicio</a>
  </div>
</body>
</html>
