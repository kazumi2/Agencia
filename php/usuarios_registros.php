<?php
// Conexión a la base de datos
include_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $contrasenia = password_hash($_POST["contrasenia"], PASSWORD_DEFAULT);
    $telefono = trim($_POST["telefono"]);

    if (!empty($nombre) && !empty($email) && !empty($_POST["contrasenia"])) {
        try {
            // Verificar que el email no exista ya
            $check = $conexion->prepare("SELECT * FROM Clientes WHERE email = :email");
            $check->bindParam(':email', $email);
            $check->execute();

            if ($check->rowCount() > 0) {
                echo "⚠️ El email ya está registrado.";
            } else {
                // Insertar nuevo cliente
                $sql = "INSERT INTO Clientes (nombre, email, contrasenia, telefono, fecha_alta) 
                        VALUES (:nombre, :email, :contrasenia, :telefono, NOW())";
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':contrasenia', $contrasenia);
                $stmt->bindParam(':telefono', $telefono);

                if ($stmt->execute()) {
                    echo "✅ Registro exitoso. Ya puedes iniciar sesión.";
                } else {
                    echo "❌ Error al registrar. Intenta más tarde.";
                }
            }
        } catch (PDOException $e) {
            echo "⚠️ Error: " . $e->getMessage();
        }
    } else {
        echo "⚠️ Completa todos los campos obligatorios.";
    }
} else {
    echo "⛔ Acceso no permitido.";
}
?>
