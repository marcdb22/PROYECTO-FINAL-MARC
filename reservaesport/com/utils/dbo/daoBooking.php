<?php
class daoBooking {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function ejecutarReserva($idUsuario, $idPista, $fechaHora) {
        // Llamada al Procedure de SQL
        $query = "CALL sp_guardar_reserva(:u, :p, :f)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":u", $idUsuario);
        $stmt->bindParam(":p", $idPista);
        $stmt->bindParam(":f", $fechaHora);

        if($stmt->execute()) return true;
        return false;
    }
}
?>