<?php
require_once 'app/models/PropinaModel.php';

class PropinasController {
    private $model;

    public function __construct() {
        $this->model = new PropinaModel();
    }

    // Acción: Mostrar el formulario (y el resultado si existe)
    public function index() {
        $resultado = null; // Inicialmente no hay resultado

        // Si el usuario envió el formulario...
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cuenta = $_POST['cuenta'] ?? 0;
            $porcentaje = $_POST['porcentaje'] ?? 10;
            
            // Pedimos al modelo que haga el cálculo
            $resultado = $this->model->calcular($cuenta, $porcentaje);
        }

        // Cargamos la vista (pasándole $resultado si existe)
        require_once 'app/views/propinas.php';
    }
}
?>