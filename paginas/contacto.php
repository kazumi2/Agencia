<?php
// contacto.php

// Activa el reporte de errores MySQLi para que muestre excepciones
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Incluye tu conexión a la base de datos (ajusta la ruta si hace falta)
require_once(__DIR__ . '/../php/conexion_bd.php');

$mensaje_exito = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recibir y sanitizar datos
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $asunto = trim($_POST['asunto'] ?? '');
    $mensaje_usuario = trim($_POST['mensaje'] ?? '');

    // Validar campos obligatorios y email válido
    if (empty($nombre) || empty($email) || empty($asunto) || empty($mensaje_usuario)) {
        $error = "Por favor, complete todos los campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Por favor, ingrese un email válido.";
    } else {
        try {
            // Verificar si email ya existe (opcional)
            $check = $conn->prepare("SELECT email FROM Contactos WHERE email = ?");
            $check->bind_param("s", $email);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                $error = "Ya hemos recibido un mensaje con este correo.";
            } else {
                // Insertar contacto
                $stmt = $conn->prepare("INSERT INTO Contactos (nombre, email, asunto, mensaje) VALUES (?, ?, ?, ?)");
                if (!$stmt) throw new Exception("Error en prepare(): " . $conn->error);

                $stmt->bind_param("ssss", $nombre, $email, $asunto, $mensaje_usuario);

                if ($stmt->execute()) {
                    // Enviar email de confirmación
                    $para = $email;
                    $titulo = "Gracias por contactarnos";
                    $contenido = "Hola $nombre,\n\nGracias por escribirnos. Hemos recibido tu mensaje:\n\nAsunto: $asunto\nMensaje: $mensaje_usuario\n\nNos pondremos en contacto pronto.\n\nSaludos,\nAgencia Turismo";

                    $headers = "From: no-reply@agenciatourismo.com\r\n";
                    $headers .= "Reply-To: soporte@agenciatourismo.com\r\n";
                    $headers .= "X-Mailer: PHP/" . phpversion();

                    mail($para, $titulo, $contenido, $headers);

                    // Guardar registro del mail enviado (opcional)
                    $stmt_mail = $conn->prepare("INSERT INTO MailsEnviados (destinatario, asunto, cuerpo) VALUES (?, ?, ?)");
                    $stmt_mail->bind_param("sss", $para, $titulo, $contenido);
                    $stmt_mail->execute();
                    $stmt_mail->close();

                    $mensaje_exito = "Gracias por contactarnos, $nombre. Tu mensaje fue enviado correctamente.";
                } else {
                    $error = "Hubo un problema al enviar tu mensaje. Por favor, intenta más tarde.";
                }
                $stmt->close();
            }
            $check->close();

        } catch (Exception $e) {
            $error = "Error en la base de datos: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Contacto - Agencia Turismo</title>
<link rel="stylesheet" href="../assets/css/contacto.css" />
</head>
<body>
 <!-- Navegador -->
    
     <nav class="navbar">
  <div class="nav-container">
    <a class="navbar-brand" href="index.php">🌍 Aventura Travel</a>
    <ul class="nav-menu">
      <li><a class="nav-link active" href="index.php">Inicio</a></li>
      <li><a class="nav-link" href="../administrador/seccion/productos.php">Ver lugares</a></li>
      <li><a class="nav-link" href="../productos/auto.php">Alquilar auto</a></li>
      <li><a class="nav-link" href="carrito.php">Carrito</a></li>
      <li><a class="nav-link" href="login.php">Iniciar sesión</a></li>
      <li><a class="nav-link" href="./administrador/index.php">Administrador</a></li>
      <li><a class="nav-link" href="sobre_nosotros.php">Sobre nosotros</a></li>
      <li><a class="nav-link" href="contacto.php">Contacto</a></li>
    </ul>
  </div>
</nav>


  
<div class="container">
    <h1>Contacto</h1>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($mensaje_exito): ?>
        <div class="success"><?= htmlspecialchars($mensaje_exito) ?></div>
    <?php endif; ?>

    <form method="POST" action="contacto.php">
        <label for="nombre">Nombre completo:</label>
        <input type="text" id="nombre" name="nombre" required value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>" />

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />

        <label for="asunto">Asunto:</label>
        <input type="text" id="asunto" name="asunto" required value="<?= htmlspecialchars($_POST['asunto'] ?? '') ?>" />

        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" rows="5" required><?= htmlspecialchars($_POST['mensaje'] ?? '') ?></textarea>

        <button type="submit">Enviar</button>
    </form>
</div>

</body>
</html>
