<?php
session_start();
require_once 'conexion_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $telefono = trim($_POST['telefono'] ?? '');
    
    // Validaciones
    $errores = [];
    
    if (empty($nombre)) $errores[] = "El nombre es obligatorio";
    if (empty($email)) $errores[] = "El email es obligatorio";
    if (empty($password)) $errores[] = "La contraseña es obligatoria";
    if ($password !== $confirm_password) $errores[] = "Las contraseñas no coinciden";
    
    if (empty($errores)) {
        $cliente_id = $database->registrarCliente($nombre, $email, $password, $telefono);
        
        if ($cliente_id) {
            $_SESSION['cliente_id'] = $cliente_id;
            $_SESSION['cliente_nombre'] = $nombre;
            $_SESSION['es_cliente'] = true;
            header("Location: perfil.php");
            exit();
        } else {
            $errores[] = "El email ya está registrado o hubo un error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Cliente</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Registro de Cliente</h1>
    
    <?php if (!empty($errores)): ?>
        <div class="error">
            <?php foreach ($errores as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <form method="POST">
        <div>
            <label>Nombre completo:</label>
            <input type="text" name="nombre" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Teléfono (opcional):</label>
            <input type="tel" name="telefono">
        </div>
        <div>
            <label>Contraseña:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Confirmar contraseña:</label>
            <input type="password" name="confirm_password" required>
        </div>
        <button type="submit">Registrarse</button>
    </form>
    
    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
</body>
</html>