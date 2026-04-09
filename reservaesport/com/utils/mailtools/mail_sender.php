<?php
function enviarConfirmacion($destinatario, $fecha, $hora) {
    $asunto = "Confirmación de tu Reserva";
    $mensaje = "Hola! Tu reserva para el día $fecha a las $hora ha sido confirmada con éxito.";
    $cabeceras = "From: no-reply@reservaesport.com";

    // Nota: mail() requiere que el servidor esté configurado (XAMPP necesita Mercury o usar PHPMailer)
    return mail($destinatario, $asunto, $mensaje, $cabeceras);
}
?>