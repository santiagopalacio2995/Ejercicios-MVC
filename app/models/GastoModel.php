<?php
class GastoModel {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['gastos'])) {
            // Inicializamos la lista de gastos
            $_SESSION['gastos'] = [];
        }
        if (!isset($_SESSION['categorias'])) {
            // Inicializamos algunas categorías
            $_SESSION['categorias'] = ['Comida', 'Transporte', 'Vivienda', 'Diversion', 'Servicios', 'Otros'];
        }
    }

    public function obtenerCategorias() {
        return $_SESSION['categorias'];
    }

    public function obtenerGastos() {
        // Ordena los gastos por fecha, el más nuevo primero
        $gastos = $_SESSION['gastos'];
        usort($gastos, function($a, $b) {
            return strtotime($b['fecha']) - strtotime($a['fecha']);
        });
        return $gastos;
    }

    public function agregarGasto($monto, $categoria, $descripcion, $fecha) {
        $_SESSION['gastos'][] = [
            'monto' => floatval($monto),
            'categoria' => $categoria,
            'descripcion' => htmlspecialchars($descripcion),
            'fecha' => $fecha,
            'id' => uniqid() // ID único para futuras eliminaciones
        ];
    }
    
    public function resumirPorCategoria() {
        $resumen = [];
        foreach ($_SESSION['gastos'] as $gasto) {
            $cat = $gasto['categoria'];
            $monto = $gasto['monto'];
            
            if (!isset($resumen[$cat])) {
                $resumen[$cat] = 0;
            }
            $resumen[$cat] += $monto;
        }
        // Ordenar el resumen de mayor a menor gasto
        arsort($resumen);
        return $resumen;
    }
    
    
}
?>