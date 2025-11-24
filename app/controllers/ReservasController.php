<?php
require_once 'app/models/ReservaModel.php';

class ReservasController {
    private $model;

    public function __construct() {
        $this->model = new ReservaModel();
    }

    public function index() {
       
        $fechaSeleccionada = $_GET['fecha'] ?? date('Y-m-d');
        
        $horariosDisponibles = $this->model->obtenerDisponibilidadDelDia($fechaSeleccionada);
        $reservasExistentes = $this->model->obtenerReservas();

        
        $reservaExitosa = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $servicio = $_POST['servicio'] ?? '';
            $fecha = $_POST['fecha_reserva'] ?? '';
            $hora = $_POST['hora_reserva'] ?? '';

            if ($this->model->agregarReserva($nombre, $servicio, $fecha, $hora)) {
                $reservaExitosa = "¡Reserva confirmada para $fecha a las $hora!";
                
                header("Location: index.php?c=reservas&a=index&fecha=$fecha");
                exit();
            } else {
                $reservaExitosa = "❌ ERROR: El horario ya está ocupado o faltan datos.";
            }
        }

        require_once 'app/views/reservas.php';
    }
}
?>