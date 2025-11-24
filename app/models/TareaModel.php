<?php
class TareaModel {
    public function __construct() {
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['tareas'])) {
            $_SESSION['tareas'] = [];
        }
    }

    public function obtenerTareas() {
        return $_SESSION['tareas'];
    }

    public function agregar($descripcion) {
        
        $_SESSION['tareas'][] = [
            'nombre' => $descripcion,
            'completada' => false
        ];
    }

    public function eliminar($indice) {
        if (isset($_SESSION['tareas'][$indice])) {
            
            array_splice($_SESSION['tareas'], $indice, 1);
        }
    }
}
?>