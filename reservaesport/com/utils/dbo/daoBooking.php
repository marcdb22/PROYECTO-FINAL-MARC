<?php
require_once 'daoConnection.php';

class daoBooking {
    private $conn;

    public function __construct() {
        $db = new daoConnection();
        $this->conn = $db->getConnection();
    }

    public function crearReserva($idPista, $fecha, $hora, $email) {
        // 1. Comprobar si ya está ocupada
        $sqlCheck = "SELECT id FROM reservas WHERE id_pista = ? AND fecha = ? AND hora = ?";
        $stmt = $this->conn->prepare($sqlCheck);
        $stmt->bind_param("iss", $idPista, $fecha, $hora);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) return false;

        // 2. Insertar si está libre
        $sqlInsert = "INSERT INTO reservas (id_pista, fecha, hora, usuario_email) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sqlInsert);
        $stmt->bind_param("isss", $idPista, $fecha, $hora, $email);
        return $stmt->execute();
    }
}
?>