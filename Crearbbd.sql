CREATE TABLE pistas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50)
);

CREATE TABLE reservas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_pista INT,
    fecha DATE,
    hora TIME,
    usuario_email VARCHAR(100),
    FOREIGN KEY (id_pista) REFERENCES pistas(id)
);

-- Insertar algunas pistas de ejemplo
INSERT INTO pistas (nombre) VALUES ('Pista de Pádel 1'), ('Pista de Tenis A');

PRUEBA PARA EL GITHUB

aaaa