CREATE DATABASE IF NOT EXISTS gestion_libros;
USE gestion_libros;

CREATE TABLE IF NOT EXISTS libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    anio_publicacion INT(4) NOT NULL,
    genero VARCHAR(100) NOT NULL
);

ALTER TABLE libros
ADD COLUMN estado ENUM('activo', 'inactivo') DEFAULT 'activo';