<?php

class Biblioteca {
    private $conn;
    private $table_name = "libros";

    private $libro;  // Nueva propiedad para el estado

    public function __construct($db) {
        $this->conn = $db;
    }

    public function setLibro($libro) {
        $this->libro = $libro;
    }

    public function obtenerLibros() {
        $query = "SELECT id, titulo, autor, anio_publicacion, genero, estado FROM " . $this->table_name . " ORDER BY titulo ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // buscarLibros() se encarga de buscar libros por título, autor o género
    public function buscarLibros($keywords) {
        $query = "SELECT id, titulo, autor, anio_publicacion, genero, estado FROM " . $this->table_name . " WHERE titulo LIKE ? OR autor LIKE ? OR genero LIKE ? ORDER BY titulo ASC";

        $stmt = $this->conn->prepare($query);

        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);

        $stmt->execute();

        return $stmt;
    }

    // Método para cambiar el estado de un libro
    public function cambiarEstado() {
        $query = "UPDATE " . $this->table_name . " SET estado = :estado WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':estado', $this->libro->getEstado());
        $stmt->bindParam(':id', $this->libro->getId());

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    //funcion para prestamos de libro
    public function prestarLibro($id) {
        $query = "UPDATE " . $this->table_name . " SET estado = 'inactivo' WHERE id = :id and estado = 'activo'";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
}

?>
