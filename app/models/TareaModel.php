<?php
class TareaModel {
    public function __construct() {
        // Iniciamos la sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Si no existe la lista de tareas, la creamos vacía
        if (!isset($_SESSION['tareas'])) {
            $_SESSION['tareas'] = [];
        }
    }

    public function obtenerTareas() {
        return $_SESSION['tareas'];
    }

    public function agregar($descripcion) {
        // Guardamos la tarea con su nombre y estado (pendiente)
        $_SESSION['tareas'][] = [
            'nombre' => $descripcion,
            'completada' => false
        ];
    }

    public function eliminar($indice) {
        if (isset($_SESSION['tareas'][$indice])) {
            // Elimina la tarea de la posición indicada
            array_splice($_SESSION['tareas'], $indice, 1);
        }
    }
}
?>