<?php
class PropinaModel {
    public function calcular($totalCuenta, $porcentaje) {
        // Aseguramos que sean números
        $totalCuenta = floatval($totalCuenta);
        $porcentaje = intval($porcentaje);

        $montoPropina = $totalCuenta * ($porcentaje / 100);
        $totalPagar = $totalCuenta + $montoPropina;

        
        return [
            'propina' => number_format($montoPropina, 0),
            'total' => number_format($totalPagar, 0),
            'porcentaje' => $porcentaje
        ];
    }
}
?>