<?php
require_once 'app/models/RecetaModel.php';

class RecetasController {
    private $model;

    public function __construct() {
        $this->model = new RecetaModel();
    }

    // Acción principal: Muestra el listado de todas las recetas
    public function index() {
        $recetas = $this->model->obtenerRecetas();
        require_once 'app/views/recetas_lista.php';
    }

    // Acción para ver los detalles de una receta
    public function ver() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $receta = $this->model->obtenerRecetaPorId($id);
            if ($receta) {
                require_once 'app/views/recetas_detalle.php';
                return;
            }
        }
        // Si no se encuentra la receta o falta el ID, redirigir a la lista
        header("Location: index.php?c=recetas&a=index");
        exit();
    }

    // Acción para mostrar el formulario de creación o procesar la creación
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['titulo'])) {
            $titulo = $_POST['titulo'];
            $ingredientes = $_POST['ingredientes'] ?? '';
            $pasos = $_POST['pasos'] ?? '';
            
            $this->model->guardarReceta($titulo, $ingredientes, $pasos);
            header("Location: index.php?c=recetas&a=index");
            exit();
        }
        
        
        require_once 'app/views/recetas_crear.php';
    }

    
    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->eliminarReceta($id);
        }
        header("Location: index.php?c=recetas&a=index");
        exit();
    }
}
?>