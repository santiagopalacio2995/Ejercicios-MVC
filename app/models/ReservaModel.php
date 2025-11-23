<?php
class ReservaModel {
    private $horarios = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['reservas'])) {
            $_SESSION['reservas'] = [];
        }
    }

    public function obtenerReservas() {
        return $_SESSION['reservas'];
    }

    public function obtenerHorarios() {
        return $this->horarios;
    }

    /**
     * Verifica la disponibilidad para una fecha y hora específicas.
     */
    public function estaDisponible($fecha, $hora) {
        foreach ($_SESSION['reservas'] as $reserva) {
            if ($reserva['fecha'] == $fecha && $reserva['hora'] == $hora) {
                return false; // No disponible
            }
        }
        return true; // Disponible
    }

    /**
     * Devuelve los horarios disponibles para una fecha específica.
     */
    public function obtenerDisponibilidadDelDia($fecha) {
        $disponibles = [];
        foreach ($this->horarios as $hora) {
            if ($this->estaDisponible($fecha, $hora)) {
                $disponibles[] = $hora;
            }
        }
        return $disponibles;
    }

    /**
     * Agrega la reserva si está disponible.
     */
    public function agregarReserva($nombre, $servicio, $fecha, $hora) {
        if ($this->estaDisponible($fecha, $hora)) {
            $_SESSION['reservas'][] = [
                'nombre' => htmlspecialchars($nombre),
                'servicio' => htmlspecialchars($servicio),
                'fecha' => $fecha,
                'hora' => $hora,
                'id' => uniqid() 
            ];
            return true;
        }
        return false;
    }
}
?>