<?php
// /controllers/LibroController.php
include_once './config/database.php';
include_once './models/Libro.php';
include_once './models/Biblioteca.php';

class LibroController {

    private $db;
    private $libro;
    private $biblioteca;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->libro = new Libro($this->db);
        $this->biblioteca = new Biblioteca($this->db);
    }

    public function listarLibros() {
        $this->biblioteca->setLibro($this->libro);
        $stmt = $this->biblioteca->obtenerLibros();
        $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include_once './views/index.php';
    }

    public function agregarLibro() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->libro->setTitulo($_POST['titulo']);
            $this->libro->setAutor($_POST['autor']);
            $this->libro->setAnioPublicacion($_POST['anio_publicacion']);
            $this->libro->setGenero($_POST['genero']);
            $this->libro->setEstado($_POST['estado']);

            if (empty($this->libro->getTitulo()) || empty($this->libro->getAutor()) || empty($this->libro->getAnioPublicacion()) || empty($this->libro->getGenero()) || empty($this->libro->getEstado())) {
                echo "Todos los campos son obligatorios.";
                return;
            }

            if ($this->libro->crearLibro()) {
                header("Location: index.php");
            } else {
                echo "Error al agregar el libro";
            }
        } else {
            include_once './views/agregar.php';
        }
    }

    public function editarLibro($id) {
        $this->libro->setId($id);
        $this->libro->obtenerLibroPorId();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->libro->setTitulo($_POST['titulo']);
            $this->libro->setAutor($_POST['autor']);
            $this->libro->setAnioPublicacion($_POST['anio_publicacion']);
            $this->libro->setGenero($_POST['genero']);
            $this->libro->setEstado($_POST['estado']);

            if ($this->libro->actualizarLibro()) {
                header("Location: index.php");
            } else {
                echo "Error al actualizar el libro";
            }
        } else {
            include_once './views/editar.php';
        }
    }

    public function eliminarLibro($id) {
        $this->libro->setId($id);
        if ($this->libro->eliminarLibro()) {
            header("Location: index.php");
        } else {
            echo "Error al eliminar el libro";
        }
    }

    public function buscarLibro($titulo) {
        $this->biblioteca->setLibro($this->libro);
        $stmt = $this->biblioteca->buscarLibros($titulo);
        $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include_once './views/index.php';
    }

    // Método para cambiar el estado de un libro
    public function cambiarEstadoLibro($id, $estado) {        
        $this->libro->setId($id);
        $this->libro->setEstado($estado);
        $this->biblioteca->setLibro($this->libro);
        if ($this->biblioteca->cambiarEstado()) {
            header("Location: index.php");
        } else {
            echo "Error al cambiar el estado del libro";
        }
    }

    //prestamo de libro 
    public function prestarLibro($id) {
        $this->libro->setId($id);
        $this->biblioteca->setLibro($this->libro);
        if ($this->biblioteca->prestarLibro($id)) {
            header("Location: index.php");
        } else {
            echo "Error al prestar el libro ya esta prestado";
        }
    }
}
?>
