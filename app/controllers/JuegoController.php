<?php
require_once 'app/models/JuegoModel.php';

class JuegoController {
    private $model;

    public function __construct() {
        $this->model = new JuegoModel();
    }

    public function index() {
        $estado = $this->model->obtenerEstado();
        require_once 'app/views/juego.php';
    }

    public function iniciar() {
        $dificultad = $_GET['dificultad'] ?? 'facil';
        $this->model->iniciarJuego($dificultad);
        
        header("Location: index.php?c=juego&a=index");
        exit();
    }

    public function voltear() {
        $index = $_GET['index'] ?? null;
        if ($index !== null && is_numeric($index)) {
            $this->model->voltearCarta(intval($index));
        }
        
        header("Location: index.php?c=juego&a=index");
        exit();
    }
}
?>