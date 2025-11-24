<?php
require_once 'app/models/NotaModel.php';

class NotasController {
    private $model;

    public function __construct() {
        $this->model = new NotaModel();
    }

    
    public function index() {
        $notas = $this->model->obtenerNotas();
        require_once 'app/views/notas.php';
    }

    
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['titulo'])) {
            $titulo = $_POST['titulo'];
            $contenido = $_POST['contenido'] ?? '';
            
            $this->model->crearNota($titulo, $contenido);
        }
        
        header("Location: index.php?c=notas&a=index");
        exit();
    }

    
    public function eliminar() {
        
        if (isset($_GET['id'])) {
            $this->model->eliminarNota($_GET['id']);
        }
        
        header("Location: index.php?c=notas&a=index");
        exit();
    }
}
?>