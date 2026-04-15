-- Crear la base de datos
CREATE DATABASE reservaesport;
GO
USE reservaesport;
GO

-- Tabla de Usuarios
CREATE TABLE usuarios (
    id_usuario INT IDENTITY(1,1) PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    telefono VARCHAR(20),
    fecha_registro DATETIME DEFAULT GETDATE()
);

-- Tabla de Pistas
CREATE TABLE pistas (
    id_pista INT IDENTITY(1,1) PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) DEFAULT 'Pádel', -- Ej: Pádel, Tenis, etc.
    estado VARCHAR(20) DEFAULT 'Disponible'
);

-- Tabla de Reservas (Basado en el formulario de la imagen)
CREATE TABLE reservas (
    id_reserva INT IDENTITY(1,1) PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_pista INT NOT NULL,
    fecha_hora DATETIME NOT NULL,
    fecha_creacion DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_pista) REFERENCES pistas(id_pista) ON DELETE CASCADE ON UPDATE CASCADE,
    -- Restricción para evitar que la misma pista se reserve a la misma hora
    CONSTRAINT pista_fecha_unica UNIQUE (id_pista, fecha_hora)
);
