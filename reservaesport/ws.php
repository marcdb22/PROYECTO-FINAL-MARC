<?php
require_once 'utils/dbo/daoBooking.php';
require_once 'utils/mailtools/mail_sender.php';

header('Content-Type: application/json');

$accion = $_GET['accion'] ?? '';

if ($accion == 'reservar') {
    $idPista = $_POST['pista'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $email = $_POST['email'];

    $dao = new daoBooking();
    $resultado = $dao->crearReserva($idPista, $fecha, $hora, $email);

    if ($resultado) {
        // Si se guarda en DB, enviamos el mail
        enviarConfirmacion($email, $fecha, $hora);
        echo json_encode(["status" => "ok", "message" => "Reserva confirmada. Revisa tu email."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Horario no disponible."]);
    }
}
?>