CREATE DATABASE IF NOT EXISTS reserva_db;
USE reserva_db;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    email VARCHAR(50) UNIQUE
);

CREATE TABLE pistas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) -- Ejemplo: "Pista de Pádel 1"
);

CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_pista INT,
    fecha_hora DATETIME,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_pista) REFERENCES pistas(id)
);

-- Procedimiento almacenado para guardar reserva
DELIMITER //
CREATE PROCEDURE sp_guardar_reserva(IN u_id INT, IN p_id INT, IN f_hora DATETIME)
BEGIN
    INSERT INTO reservas (id_usuario, id_pista, fecha_hora) 
    VALUES (u_id, p_id, f_hora);
END //
DELIMITER ;