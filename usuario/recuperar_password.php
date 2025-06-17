<?php
// Configuración para mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once(__DIR__ . ".\..\includes\connection.php");
include(__DIR__ . ".\..\includes\header.php");

$message = '';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset'])) {
    if(empty($_POST['email'])) {
        $message = '<p class="error">Por favor ingresa tu email</p>';
    } else {
        $email = trim($_POST['email']);

        try {
            // Verificar si el email existe
            $query = $connection->prepare("SELECT id, nombre FROM usuariosinternos WHERE email = :email");
            $query->bindParam(":email", $email, PDO::PARAM_STR);
            $query->execute();

            $usuario = $query->fetch(PDO::FETCH_ASSOC);

            if(!$usuario) {
                $message = '<p class="error">No existe una cuenta con este email</p>';
            } else {
                // Generar token seguro
                $token = bin2hex(random_bytes(32));
                $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));
                
                // Guardar token temporalmente en la contraseña (solución temporal)
                $hashed_token = password_hash($token, PASSWORD_DEFAULT);
                $update = $connection->prepare("UPDATE usuariosinternos SET contraseña = :token WHERE usuario_id = :id");
                $update->bindParam(":token", $hashed_token);
                $update->bindParam(":id", $id['id']);
                
                if($update->execute()) {
                    // Enviar email con enlace de recuperación
                    $resetLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/reset-password.php?token=$token&email=".urlencode($email);
                    
                    $asunto = "Recuperación de Contraseña";
                    $mensaje = "Hola ".$usuario['nombre'].",\n\n";
                    $mensaje .= "Para restablecer tu contraseña, haz clic en este enlace:\n";
                    $mensaje .= $resetLink."\n\n";
                    $mensaje .= "Este enlace expirará en 1 hora.\n\n";
                    $mensaje .= "Si no solicitaste este cambio, ignora este mensaje.";
                    
                    $headers = "From: no-reply@".$_SERVER['HTTP_HOST'];
                    
                    // Intento de enviar email
                    if(@mail($email, $asunto, $mensaje, $headers)) {
                        $message = '<p class="success">Se ha enviado un enlace de recuperación a tu email</p>';
                    } else {
                        $message = '<p class="error">Error al enviar el email. Por favor contacta al administrador.</p>';
                        error_log("Error al enviar email a: $email");
                    }
                } else {
                    $message = '<p class="error">Error al generar el enlace de recuperación</p>';
                }
            }
        } catch(PDOException $e) {
            $message = '<p class="error">Error en el sistema: '.$e->getMessage().'</p>';
            error_log("PDO Error: ".$e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="..\assets\css\login.css">
</head>
<body>
    <div class="container login">
        <div id="login">
            <h1>Recuperar Contraseña</h1>
            <?php if(!empty($message)) echo $message; ?>
            
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <p>
                    <label for="email">Email registrado<br />
                    <input type="email" name="email" id="email" class="input" 
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                           size="30" required />
                    </label>
                </p>
                <p class="submit">
                    <input type="submit" name="reset" class="button" value="Enviar Enlace" />
                </p>
                <p class="regtext">
                    <a href="login.php">Volver a Iniciar Sesión</a>
                </p>
            </form>
        </div>
    </div>

    <?php include(__DIR__ . "..\..\includes/footer.php"); ?>
</body>
</html>