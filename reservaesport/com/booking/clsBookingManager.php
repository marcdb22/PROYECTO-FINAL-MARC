<?php
require_once '../utils/dbo/daoConnection.php';
require_once '../utils/dbo/daoBooking.php';

class clsBookingManager {
    public function crearNuevaReserva($idUsuario, $idPista, $fechaHora) {
        $database = new daoConnection();
        $db = $database->getConnection();
        
        $dao = new daoBooking($db);
        
        // Aquí podrías añadir lógica extra (ej: si el usuario tiene deudas)
        return $dao->ejecutarReserva($idUsuario, $idPista, $fechaHora);
    }
}
?>