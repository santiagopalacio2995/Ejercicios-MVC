<?php
class CronometroModel {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    // Este modelo se mantiene simple ya que toda la lógica de tiempo
    // debe residir en JavaScript para asegurar la precisión.
    // Podríamos añadir funciones aquí si quisiéramos guardar el historial
    // de sesiones del cronómetro.
}
?>