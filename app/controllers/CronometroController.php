<?php
require_once 'app/models/CronometroModel.php';

class CronometroController {
    private $model;

    public function __construct() {
        $this->model = new CronometroModel();
    }

    // Acción principal: carga la vista con la lógica de JS
    public function index() {
        require_once 'app/views/cronometro.php';
    }
}
?>
