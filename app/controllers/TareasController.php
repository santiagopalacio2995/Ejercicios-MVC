<?php

require_once 'app/models/TareaModel.php';

class TareasController {
    private $model;

    public function __construct() {
        $this->model = new TareaModel();
    }

    
    public function index() {
        $tareas = $this->model->obtenerTareas();
       
        require_once 'app/views/tareas.php';
    }

    
    public function agregar() {
        if (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {
            $this->model->agregar($_POST['descripcion']);
        }
        
        header("Location: index.php?c=tareas&a=index");
    }

    
    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->model->eliminar($_GET['id']);
        }
        
        header("Location: index.php?c=tareas&a=index");
    }
}
?>