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
        // Devolvemos la lista de notas completa
        return array_reverse($_SESSION['notas']); // Las más nuevas primero
    }

    /**
     * Obtiene una nota específica por su índice.
     */
    public function obtenerNotaPorIndice($indice) {
        // Verificar si la nota existe en el índice dado
        if (isset($_SESSION['notas'][$indice])) {
            return $_SESSION['notas'][$indice];
        }
        return null;
    }

    /**
     * Crea una nueva nota.
     */
    public function crearNota($titulo, $contenido) {
        $nuevaNota = [
            'titulo' => htmlspecialchars($titulo),
            'contenido' => htmlspecialchars($contenido),
            'fecha' => date('Y-m-d H:i:s')
        ];
        $_SESSION['notas'][] = $nuevaNota;
    }

    /**
     * Elimina una nota por su índice.
     */
    public function eliminarNota($indice) {
        if (isset($_SESSION['notas'][$indice])) {
            // Elimina la nota y reindexa el array
            unset($_SESSION['notas'][$indice]);
            $_SESSION['notas'] = array_values($_SESSION['notas']);
        }
    }
}
?>