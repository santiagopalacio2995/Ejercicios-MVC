<?php
class JuegoModel {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function generarTablero($dimension) {
        $numPares = ($dimension * $dimension) / 2;
        // Usamos letras para simular las imágenes
        $valores = range('A', 'Z'); 
        
        shuffle($valores);
        $pares = array_slice($valores, 0, $numPares);
        
        // Duplicar y mezclar los valores
        $cartasValores = array_merge($pares, $pares);
        shuffle($cartasValores);

        $tablero = [];
        foreach ($cartasValores as $index => $valor) {
            $tablero[] = [
                'valor' => $valor,
                'estado' => 'hidden', // hidden, shown, matched
                'index' => $index
            ];
        }
        return $tablero;
    }

    public function iniciarJuego($dificultad = 'facil') {
        $dimension = ($dificultad == 'dificil') ? 6 : 4; // 4x4 o 6x6

        $_SESSION['juego'] = [
            'dificultad' => $dificultad,
            'tablero' => $this->generarTablero($dimension),
            'volteadas' => [], // Cartas en el turno actual (máximo 2)
            'score' => 0,
            'intentos' => 0,
            'pares_restantes' => ($dimension * $dimension) / 2,
            'dimension' => $dimension,
            'mensaje' => '¡Comienza el juego!'
        ];
    }

    public function obtenerEstado() {
        return $_SESSION['juego'] ?? null;
    }

    public function voltearCarta($index) {
        if (!isset($_SESSION['juego'])) return;
        $juego = &$_SESSION['juego']; // Referencia para modificar la sesión

        // 1. Validar si ya está emparejada o ya volteada
        if ($juego['tablero'][$index]['estado'] !== 'hidden') {
            return;
        }

        // 2. Si hay 2 cartas volteadas, primero re-ocultamos las anteriores (no hicieron match)
        if (count($juego['volteadas']) == 2) {
            $juego['tablero'][$juego['volteadas'][0]['index']]['estado'] = 'hidden';
            $juego['tablero'][$juego['volteadas'][1]['index']]['estado'] = 'hidden';
            $juego['volteadas'] = []; // Limpiamos para el nuevo turno
        }

        // 3. Voltear la carta actual y añadirla a la lista
        $juego['tablero'][$index]['estado'] = 'shown';
        $juego['volteadas'][] = $juego['tablero'][$index];

        // 4. Verificar Match si ahora hay 2 cartas volteadas
        if (count($juego['volteadas']) == 2) {
            $juego['intentos']++;
            $card1 = $juego['volteadas'][0];
            $card2 = $juego['volteadas'][1];
            
            if ($card1['valor'] == $card2['valor']) {
                // ¡MATCH! Se fijan como 'matched'
                $juego['tablero'][$card1['index']]['estado'] = 'matched';
                $juego['tablero'][$card2['index']]['estado'] = 'matched';
                $juego['score'] += 10;
                $juego['pares_restantes']--;
                $juego['mensaje'] = '¡PAR ENCONTRADO!';
                $juego['volteadas'] = []; // Limpiar para que el siguiente click inicie un nuevo turno
                
                if ($juego['pares_restantes'] == 0) {
                    $juego['mensaje'] = '🎉 ¡Juego Terminado! Puntuación final: ' . $juego['score'] . ' en ' . $juego['intentos'] . ' intentos.';
                }

            } else {
                // NO MATCH. Se quedan 'shown' y se re-ocultan en el siguiente click (Paso 2).
                $juego['score'] = max(0, $juego['score'] - 1); // Penalización
                $juego['mensaje'] = 'No es un par. Voltea la siguiente carta.';
            }
        }
    }
}
?>