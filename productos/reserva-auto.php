<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reservar Auto</title>
  <link rel="stylesheet" href="../assets/css/reserva-auto.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>
  <header>
    <h1>Formulario de Reserva</h1>
  </header>

  <main class="formulario-container">
    <form action="confirmarpago.php" method="POST">
      <label for="nombre">Nombre completo:</label>
      <input type="text" id="nombre" name="nombre" required>

      <label for="email">Correo electrónico:</label>
      <input type="email" id="email" name="email" required>

      <label for="telefono">Teléfono de contacto:</label>
      <input type="tel" id="telefono" name="telefono" required>

      <label for="auto">Auto a reservar:</label>
      <select id="auto" name="auto" required>
        <option value="">Seleccionar un auto</option>
        <option>Chevrolet Onix</option>
        <option>Fiat Cronos</option>
        <option>Peugeot 208</option>
        <option>Volkswagen Gol</option>
        <option>Renault Kwid</option>
        <option>Ford Ka</option>
        <option>Citroën C3</option>
        <option>Honda Fit</option>
        <option>Toyota Etios</option>
        <option>Nissan Versa</option>
        <option>Renault Sandero</option>
        <option>Ford Fiesta</option>
        <option>Volkswagen Polo</option>
        <option>Toyota Yaris</option>
        <option>Peugeot 301</option>
        <option>Fiat Argo</option>
        <option>Chevrolet Prisma</option>
        <option>Honda City</option>
        <option>Kia Rio</option>
        <option>Hyundai HB20</option>
      </select>

      <label for="fecha-inicio">Fecha de inicio:</label>
      <input type="date" id="fecha-inicio" name="fecha_inicio" required>

      <label for="fecha-fin">Fecha de devolución:</label>
      <input type="date" id="fecha-fin" name="fecha_fin" required>

      <hr>

      <h2>Datos de Pago</h2>

      <label for="tarjeta">Número de tarjeta:</label>
      <input type="text" id="tarjeta" name="tarjeta" maxlength="19" placeholder="1234 5678 9012 3456" required>

      <label for="titular">Nombre del titular:</label>
      <input type="text" id="titular" name="titular" required>

      <label for="vencimiento">Fecha de vencimiento:</label>
      <input type="month" id="vencimiento" name="vencimiento" required>

      <label for="cvv">Código de seguridad (CVV):</label>
      <input type="text" id="cvv" name="cvv" maxlength="4" required>

      <button type="submit"><i class="fas fa-credit-card"></i> Confirmar Reserva</button>
    </form>

    <div class="volver">
      <a href="auto.php"><i class="fas fa-arrow-left"></i> Volver a Autos</a>
    </div>
  </main>
</body>
</html>
