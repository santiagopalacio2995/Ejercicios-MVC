<?php
require_once 'app/models/CalendarioModel.php';

class CalendarioController {
    private $model;

    public function __construct() {
        $this->model = new CalendarioModel();
    }

    // Acción principal: Muestra el calendario para el mes/año seleccionado
    public function index() {
        // 1. Determinar el mes y año a mostrar
        $mes = $_GET['mes'] ?? date('m');
        $anio = $_GET['anio'] ?? date('Y');
        
        // 2. Preparar los datos del calendario para la vista
        $diasDelMes = $this->model->obtenerDiasDelMes($mes, $anio);
        $diaInicio = $this->model->obtenerDiaInicioMes($mes, $anio);
        $eventos = $this->model->obtenerTodosLosEventos(); // Todos los eventos para la vista

        // 3. Preparar la navegación (mes anterior y siguiente)
        $mesAnterior = $mes - 1;
        $anioAnterior = $anio;
        $mesSiguiente = $mes + 1;
        $anioSiguiente = $anio;

        if ($mesAnterior == 0) {
            $mesAnterior = 12;
            $anioAnterior--;
        }
        if ($mesSiguiente == 13) {
            $mesSiguiente = 1;
            $anioSiguiente++;
        }

        require_once 'app/views/calendario.php';
    }

    // Acción: Procesar el formulario para agregar un evento
    public function agregar() {
        $titulo = $_POST['titulo'] ?? '';
        $fecha = $_POST['fecha_evento'] ?? '';
        $hora = $_POST['hora_evento'] ?? '';
        
        if (!empty($titulo) && !empty($fecha)) {
            $this->model->agregarEvento($titulo, $fecha, $hora);
        }
        $mes = date('m', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        header("Location: index.php?c=calendario&a=index&mes=$mes&anio=$anio");
        }

    public function eliminar() {
        $fecha = $_GET['fecha'] ?? null;
        $index = $_GET['index'] ?? null;
        
        if ($fecha !== null && $index !== null) {
            $this->model->eliminarEvento($fecha, $index);
        }

        // Redirigir de vuelta al mes donde se eliminó el evento
        $mes = date('m', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        header("Location: index.php?c=calendario&a=index&mes=$mes&anio=$anio");
        exit();
    }

}
?>