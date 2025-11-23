<?php
require_once 'app/models/GastoModel.php';

class GastosController {
    private $model;

    public function __construct() {
        $this->model = new GastoModel();
    }

    // Acción principal: Mostrar lista y formulario de registro
    public function index() {
        $categorias = $this->model->obtenerCategorias();
        $gastos = $this->model->obtenerGastos();
        
        // La vista principal (que contendrá la lista)
        require_once 'app/views/gastos_registro.php';
    }

    // Acción: Procesar el registro de un nuevo gasto
    public function agregar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['monto'])) {
            $monto = $_POST['monto'];
            $categoria = $_POST['categoria'];
            $descripcion = $_POST['descripcion'] ?? '';
            $fecha = $_POST['fecha'] ?? date('Y-m-d'); // Usa hoy si no se especifica
            
            $this->model->agregarGasto($monto, $categoria, $descripcion, $fecha);
        }
        // Redirige al índice después de guardar
        header("Location: index.php?c=gastos&a=index");
    }

    // Acción: Mostrar el resumen por categorías
    public function resumen() {
        $resumen = $this->model->resumirPorCategoria();
        require_once 'app/views/gastos_resumen.php';
    }
}
?>