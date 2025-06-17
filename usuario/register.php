<?php
// Configuración para mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sesión
session_start();

require_once(__DIR__ . ".\..\includes\connection.php");
include(__DIR__ . ".\..\includes\header.php");

$message = '';

if(isset($_POST['register'])) {
    if(!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['nombre']) && !empty($_POST['contrasenia'])) {
        
        $full_name = trim($_POST['fullname']);
        $email = trim($_POST['email']);
        $nombre = trim($_POST['nombre']);
        $contrasenia = $_POST['contrasenia'];
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Formato de email inválido";
        } else {
            $contrasenia_hash = password_hash($contrasenia, PASSWORD_BCRYPT);
            
            try {
                // Verificar si email existe
                $check = $connection->prepare("SELECT id FROM usuariosinternos WHERE email = ?");
                $check->execute([$email]);
                
                if($check->rowCount() > 0) {
                    $message = "El email ya está registrado";
                } else {
                    // Inserción correcta (sin especificar ID)
                    $insert = $connection->prepare("INSERT INTO usuariosinternos (FULLNAME, NOMBRE, CONTRASENIA, EMAIL) VALUES (?, ?, ?, ?)");
                    
                    if($insert->execute([$full_name, $nombre, $contrasenia_hash, $email])) {
                        $_SESSION['registration_success'] = true;
                        header("Location: login.php");
                        exit();
                    }
                }
            } catch(PDOException $e) {
                $message = "Error de base de datos: " . $e->getMessage();
                
                // Si es error de ID, mostrar solución específica
                if(strpos($e->getMessage(), 'id') !== false) {
                    $message .= "<br><br><strong>Solución requerida:</strong> Ejecuta en phpMyAdmin:<br>"
                             . "<code>ALTER TABLE usuariosinternos MODIFY COLUMN id INT NOT NULL AUTO_INCREMENT PRIMARY KEY;</code>";
                }
            }
        }
    } else {
        $message = "Todos los campos son obligatorios";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="..\assets\css\login.css">
</head>
<body>
    <div class="container">
        <h1>Registro de Usuario</h1>
        
        <?php if(!empty($message)): ?>
            <div class="error"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <form method="post" action="">
            <div class="form-group">
                <label for="fullname">Nombre Completo:</label>
                <input type="text" id="fullname" name="fullname" 
                       value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>" 
                       required>
            </div>
            
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email"
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                       required>
            </div>
            
            <div class="form-group">
                <label for="nombre">Nombre de Usuario:</label>
                <input type="text" id="nombre" name="nombre"
                       value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>" 
                       required>
            </div>
            
            <div class="form-group">
                <label for="contrasenia">Contraseña:</label>
                <input type="password" id="contrasenia" name="contrasenia" 
                       required minlength="8">
            </div>
            
            <div class="form-group">
                <input type="submit" name="register" value="Registrarse">
            </div>
        </form>
        
        <div class="login-link">
            ¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a>
        </div>
    </div>
</body>
<?php include(__DIR__ . "..\..\includes/footer.php"); ?>
</html>
