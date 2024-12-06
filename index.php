<?php
// index.php
include_once 'controllers/LibroController.php';

$action = $_GET['action'] ?? 'listar';
$controller = new LibroController();

switch ($action) {
    case 'listar':
        $controller->listarLibros();
        break;
    case 'buscar':
        $controller->buscarLibro($_GET['titulo']);
        break;
    case 'agregar':
        $controller->agregarLibro();
        break;
    case 'editar':
        $controller->editarLibro($_GET['id']);
        break;
    case 'eliminar':
        $controller->eliminarLibro($_GET['id']);
        break;
    case 'cambiar_estado':
        if (isset($_GET['id']) && isset($_GET['estado'])) {
            $controller->cambiarEstadoLibro($_GET['id'], $_GET['estado']);
        } else {
            echo "Faltan parámetros para cambiar el estado.";
        }
        break;
    case 'prestamo':
        $controller->prestarLibro($_GET['id']);
        break;
    default:
        $controller->listarLibros();
}
?>
