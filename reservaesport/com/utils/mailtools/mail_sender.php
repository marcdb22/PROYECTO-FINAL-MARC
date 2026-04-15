<?php
function enviarConfirmacion($destinatario, $fecha, $hora) {
    $asunto = "Confirmación de tu Reserva";
    $mensaje = "Hola! Tu reserva para el día $fecha a las $hora ha sido confirmada con éxito.";
    $cabeceras = "From: no-reply@reservaesport.com";

    // Nota: mail() requiere que el servidor esté configurado (XAMPP necesita Mercury o usar PHPMailer)
    return mail($destinatario, $asunto, $mensaje, $cabeceras);
}
?><?php

function enviarCorreo($url, $destinatario, $asunto, $cuerpo, $adjunto) {
    $data = array(
        'destinatario' => $destinatario,
        'asunto' => $asunto,
        'cuerpo' => $cuerpo,
        'adjunto' => $adjunto
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
            'ignore_errors' => true // Ignorar errores para poder leer el contenido de respuesta
        ),
    );

    $context  = stream_context_create($options);
    $result = @file_get_contents($url, false, $context);

    if ($result === FALSE) {
        // Obtener más detalles del error
        $error = error_get_last();
        return false;
    }

    $response = json_decode($result, true);

    if ($response === null) {
        return false;
    }

    return $response['resultado'];
}

// function readAndRegisterUsers($url) {

//     $options = array(
//         'http' => array(
//             'header'  => "Content-type: application/json\r\n",
//             'method'  => 'GET',
//             'ignore_errors' => true // Ignorar errores para poder leer el contenido de respuesta
//         ),
//     );

//     $context  = stream_context_create($options);
//     $result = @file_get_contents($url, false, $context);

//     if ($result === FALSE) {
//         // Obtener más detalles del error
//         $error = error_get_last();
//         return false;
//     }

//     $response = json_decode($result, true);

//     if ($response === null) {
//         return false;
//     }

//     return $response['resultado'];
// }
?>a<?php

function enviarCorreo($url, $destinatario, $asunto, $cuerpo, $adjunto) {
    $data = array(
        'destinatario' => $destinatario,
        'asunto' => $asunto,
        'cuerpo' => $cuerpo,
        'adjunto' => $adjunto
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
            'ignore_errors' => true // Ignorar errores para poder leer el contenido de respuesta
        ),
    );

    $context  = stream_context_create($options);
    $result = @file_get_contents($url, false, $context);

    if ($result === FALSE) {
        // Obtener más detalles del error
        $error = error_get_last();
        return false;
    }

    $response = json_decode($result, true);

    if ($response === null) {
        return false;
    }

    return $response['resultado'];
}

// function readAndRegisterUsers($url) {

//     $options = array(
//         'http' => array(
//             'header'  => "Content-type: application/json\r\n",
//             'method'  => 'GET',
//             'ignore_errors' => true // Ignorar errores para poder leer el contenido de respuesta
//         ),
//     );

//     $context  = stream_context_create($options);
//     $result = @file_get_contents($url, false, $context);

//     if ($result === FALSE) {
//         // Obtener más detalles del error
//         $error = error_get_last();
//         return false;
//     }

//     $response = json_decode($result, true);

//     if ($response === null) {
//         return false;
//     }

//     return $response['resultado'];
// }
?>