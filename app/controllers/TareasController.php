<?php
// Importamos el modelo
require_once 'app/models/TareaModel.php';

class TareasController {
    private $model;

    public function __construct() {
        $this->model = new TareaModel();
    }

    // Acción principal: Mostrar la lista
    public function index() {
        $tareas = $this->model->obtenerTareas();
        // Cargamos la vista
        require_once 'app/views/tareas.php';
    }

    // Acción: Agregar nueva tarea
    public function agregar() {
        if (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {
            $this->model->agregar($_POST['descripcion']);
        }
        // Redirigir de vuelta a la lista
        header("Location: index.php?c=tareas&a=index");
    }

    // Acción: Eliminar tarea
    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->model->eliminar($_GET['id']);
        }
        // Redirigir de vuelta a la lista
        header("Location: index.php?c=tareas&a=index");
    }
}
?>