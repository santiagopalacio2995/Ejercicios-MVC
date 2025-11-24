<?php
class NotaModel {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['notas'])) {
            $_SESSION['notas'] = [];
        }
    }

    public function obtenerNotas() {
    
        return array_reverse($_SESSION['notas']); 
    }

    
    public function obtenerNotaPorIndice($indice) {
        
        if (isset($_SESSION['notas'][$indice])) {
            return $_SESSION['notas'][$indice];
        }
        return null;
    }

    
    public function crearNota($titulo, $contenido) {
        $nuevaNota = [
            'titulo' => htmlspecialchars($titulo),
            'contenido' => htmlspecialchars($contenido),
            'fecha' => date('Y-m-d H:i:s')
        ];
        $_SESSION['notas'][] = $nuevaNota;
    }

 
    public function eliminarNota($indice) {
        if (isset($_SESSION['notas'][$indice])) {
            // Elimina la nota y reindexa el array
            unset($_SESSION['notas'][$indice]);
            $_SESSION['notas'] = array_values($_SESSION['notas']);
        }
    }
}
?>