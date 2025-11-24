<?php
require_once 'app/models/PropinaModel.php';

class PropinasController {
    private $model;

    public function __construct() {
        $this->model = new PropinaModel();
    }

    
    public function index() {
        $resultado = null; 

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cuenta = $_POST['cuenta'] ?? 0;
            $porcentaje = $_POST['porcentaje'] ?? 10;
            
            
            $resultado = $this->model->calcular($cuenta, $porcentaje);
        }

        
        require_once 'app/views/propinas.php';
    }
}
?>