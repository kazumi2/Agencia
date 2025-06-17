<?php
// Configuración para mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sesión
session_start();

require_once(__DIR__ . "..\..\includes\connection.php");
include(__DIR__ . "..\..\includes\header.php");

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Validar campos vacíos
    if (empty($_POST['nombre']) || empty($_POST['contrasenia'])) {
        $message = '<p class="error">Todos los campos son requeridos!</p>';
    } else {
        $nombre = trim($_POST['nombre']);
        $contrasenia = $_POST['contrasenia'];

        try {
            // Consulta preparada para evitar inyección SQL
            $query = $connection->prepare("SELECT id, nombre, contrasenia FROM usuariosinternos WHERE nombre = :nombre");
            $query->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $query->execute();

            $usuario = $query->fetch(PDO::PARAM_STR);

            if (!$usuario) {
                // Usuario no encontrado
                $message = '<p class="error">Usuario no encontrado</p>';
                error_log("Intento de login fallido - Usuario no existe: " . $nombre);
            } else {
                // Verificar contraseña
                if (password_verify($contrasenia, $usuario['contrasenia'])) {
                    // Autenticación exitosa
                    $_SESSION['user_id'] = $usuario['id'];
                    $_SESSION['session_nombre'] = $usuario['nombre'];
                    $_SESSION['loggedin'] = true;

                    // Redireccionar al área protegida
                    header("Location: ../paginas/index.php");
                    exit();
                } else {
                    // Contraseña incorrecta
                    $message = '<p class="error">Contraseña incorrecta</p>';
                    error_log("Intento de login fallido - Contraseña incorrecta para usuario: " . $nombre);
                }
            }
        } catch(PDOException $e) {
            $message = '<p class="error">Error en el sistema. Por favor intente más tarde.</p>';
            error_log("Error de base de datos: " . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="..\assets\css\login.css">
</head>
<body>
    <div class="container login">
        <div id="login">
            <h1>Inicio de Sesión</h1>
            <?php if(!empty($message)) { echo $message; } ?>
            <form name="loginforma" id="loginform" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <p>
                    <label for="nombre">Nombre de Usuario<br />
                    <input type="text" name="nombre" id="nombre" class="input" value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>" size="20" required /></label>
                </p>
                <p>
                    <label for="contrasenia">Contraseña<br />
                    <input type="password" name="contrasenia" id="contrasenia" class="input" value="" size="20" required /></label>
                </p>
                <p class="submit">
                    <input type="submit" name="login" class="button" value="Entrar" />
                </p>
                <p class="regtext">¿No estás registrado? <a href="register.php">Regístrate Aquí</a></p>
                <p class="regtext"><a href="recuperar_password.php">¿Olvidaste tu contraseña?</a></p>
            </form>
        </div>
    </div>

    <?php include(__DIR__ . "..\..\includes/footer.php"); ?>
</body>
</html>