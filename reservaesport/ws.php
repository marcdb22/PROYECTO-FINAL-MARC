<?php
require_once 'booking/clsBookingManager.php';

// Simulamos recibir datos por POST (de un formulario o fetch)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mgr = new clsBookingManager();
    
    $u = $_POST['usuario_id'];
    $p = $_POST['pista_id'];
    $f = $_POST['fecha']; // Formato YYYY-MM-DD HH:MM:SS

    if ($mgr->crearNuevaReserva($u, $p, $f)) {
        echo json_encode(["status" => "success", "message" => "Reserva guardada"]);
    } else {
        echo json_encode(["status" => "error", "message" => "No se pudo guardar"]);
    }
}
?>