<?php
class CalendarioModel {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['eventos'])) {
            $_SESSION['eventos'] = []; // Formato: ['YYYY-MM-DD' => [['titulo' => '...', 'hora' => '...'], ...]]
        }
    }

    /**
     * Devuelve el número de días en un mes específico.
     * @param int $mes
     * @param int $anio
     * @return int
     */
    public function obtenerDiasDelMes($mes, $anio) {
        return cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
    }

    /**
     * Devuelve el día de la semana en que comienza un mes (1=Lunes, 7=Domingo).
     * @param int $mes
     * @param int $anio
     * @return int
     */
    public function obtenerDiaInicioMes($mes, $anio) {
        // Devuelve 1 (Lunes) a 7 (Domingo)
        return date('N', strtotime("$anio-$mes-01"));
    }

    /**
     * Agrega un evento a la lista
     */
    public function agregarEvento($titulo, $fecha, $hora) {
        // Aseguramos que la clave de la fecha exista
        if (!isset($_SESSION['eventos'][$fecha])) {
            $_SESSION['eventos'][$fecha] = [];
        }
        
        // Agregamos el evento
        $_SESSION['eventos'][$fecha][] = [
            'titulo' => htmlspecialchars($titulo),
            'hora' => htmlspecialchars($hora)
        ];
    }

    /**
     * Obtiene los eventos para un día específico
     */
    public function obtenerEventosDia($fecha) {
        return $_SESSION['eventos'][$fecha] ?? [];
    }

    /**
     * Obtiene todos los eventos guardados
     */
    public function obtenerTodosLosEventos() {
        return $_SESSION['eventos'];
    }


   public function eliminarEvento($fecha, $index) {
        if (isset($_SESSION['eventos'][$fecha]) && isset($_SESSION['eventos'][$fecha][$index])) {
            // 1. Eliminar el evento del índice específico
            unset($_SESSION['eventos'][$fecha][$index]);
            // 2. Reindexar el array para evitar huecos (importante)
            $_SESSION['eventos'][$fecha] = array_values($_SESSION['eventos'][$fecha]);
            
            // 3. Si la fecha queda sin eventos, limpiamos la clave de la fecha
            if (empty($_SESSION['eventos'][$fecha])) {
                unset($_SESSION['eventos'][$fecha]);
            }
            return true;
        }
        return false;
 }
}

?>
