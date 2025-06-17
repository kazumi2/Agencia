<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_cliente = $_POST['email'] ?? '';
    $nombre_cliente = $_POST['nombre'] ?? '';
    $detalle_compra = $_POST['detalle_compra'] ?? '';

    if (filter_var($email_cliente, FILTER_VALIDATE_EMAIL)) {
        $asunto = "Confirmación de compra - Agencia";

        $mensaje = "
        <html>
        <head><title>$asunto</title></head>
        <body>
            <h2>Hola, " . htmlspecialchars($nombre_cliente) . "</h2>
            <p>Gracias por tu compra.</p>
            <p><strong>Detalle de la compra:</strong><br>" . nl2br(htmlspecialchars($detalle_compra)) . "</p>
            <p>¡Disfrutá tu viaje!</p>
        </body>
        </html>";

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: Agencia de Turismo <no-reply@agenciaturismo.com>\r\n";

        if (mail($email_cliente, $asunto, $mensaje, $headers)) {
            echo "Correo enviado correctamente";
        } else {
            echo "Error al enviar el correo";
        }
    } else {
        echo "Email inválido";
    }
} else {
    echo "Método no permitido";
}
