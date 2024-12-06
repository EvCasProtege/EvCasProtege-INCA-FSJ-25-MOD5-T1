<?php

class Libro {
    private $conn;
    private $table_name = "libros";

    private $id;
    private $titulo;
    private $autor;
    private $anio_publicacion;
    private $genero;
    private $estado;  // Nueva propiedad para el estado

    public function __construct($db) {
        $this->conn = $db;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getAnioPublicacion() {
        return $this->anio_publicacion;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function getEstado() {
        return $this->estado;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function setAnioPublicacion($anio_publicacion) {
        $this->anio_publicacion = $anio_publicacion;
    }

    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function obtenerLibroPorId() {
        $query = "SELECT id, titulo, autor, anio_publicacion, genero, estado FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        // Preparar la sentencia
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->titulo = $row['titulo'];
        $this->autor = $row['autor'];
        $this->anio_publicacion = $row['anio_publicacion'];
        $this->genero = $row['genero'];
        $this->estado = $row['estado'];
    
    }

    public function crearLibro() {
        $query = "INSERT INTO " . $this->table_name . " (titulo, autor, anio_publicacion, genero, estado) VALUES (:titulo, :autor, :anio_publicacion, :genero, :estado)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':autor', $this->autor);
        $stmt->bindParam(':anio_publicacion', $this->anio_publicacion);
        $stmt->bindParam(':genero', $this->genero);
        $stmt->bindParam(':estado', $this->estado);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function actualizarLibro() {
        $query = "UPDATE " . $this->table_name . " SET titulo = :titulo, autor = :autor, anio_publicacion = :anio_publicacion, genero = :genero, estado = :estado WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->autor = htmlspecialchars(strip_tags($this->autor));
        $this->anio_publicacion = htmlspecialchars(strip_tags($this->anio_publicacion));
        $this->genero = htmlspecialchars(strip_tags($this->genero));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":autor", $this->autor);
        $stmt->bindParam(":anio_publicacion", $this->anio_publicacion);
        $stmt->bindParam(":genero", $this->genero);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function eliminarLibro() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
}
?>
