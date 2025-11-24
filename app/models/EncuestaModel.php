<?php
class EncuestaModel {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['encuestas'])) {
            $_SESSION['encuestas'] = []; 
        }
        if (!isset($_SESSION['respuestas'])) {
            $_SESSION['respuestas'] = []; 
        }
    }

    public function obtenerEncuestas() {
        return array_reverse($_SESSION['encuestas']);
    }

    public function obtenerEncuestaPorId($id) {
        return $_SESSION['encuestas'][$id] ?? null;
    }

    
    public function crearEncuesta($titulo, $preguntas) {
        $id = uniqid();
        $_SESSION['encuestas'][$id] = [
            'id' => $id,
            'titulo' => htmlspecialchars($titulo),
            'preguntas' => $preguntas 
        ];
        $_SESSION['respuestas'][$id] = [];
        return $id;
    }

   
    public function guardarRespuesta($id_encuesta, $respuestas) {
        if (isset($_SESSION['encuestas'][$id_encuesta])) {
           
            $_SESSION['respuestas'][$id_encuesta][] = $respuestas;
            return true;
        }
        return false;
    }
    
   
    public function analizarResultados($id_encuesta) {
        if (!isset($_SESSION['encuestas'][$id_encuesta])) {
            return null;
        }
        
        $encuesta = $_SESSION['encuestas'][$id_encuesta];
        $respuestas = $_SESSION['respuestas'][$id_encuesta] ?? [];
        $totalVotos = count($respuestas);
        $resultados = [];
        
        
        foreach ($encuesta['preguntas'] as $qIndex => $pregunta) {
            $resultados[$qIndex] = [
                'pregunta' => $pregunta['texto'],
                'opciones' => [],
                'total_votos_pregunta' => 0
            ];
            foreach ($pregunta['opciones'] as $oIndex => $opcion) {
                $resultados[$qIndex]['opciones'][$oIndex] = ['texto' => $opcion, 'conteo' => 0];
            }
        }
        
        
        foreach ($respuestas as $respuesta) {
            foreach ($respuesta as $qIndex => $oIndex) {
                if (isset($resultados[$qIndex]['opciones'][$oIndex])) {
                    $resultados[$qIndex]['opciones'][$oIndex]['conteo']++;
                    $resultados[$qIndex]['total_votos_pregunta']++;
                }
            }
        }

        
        foreach ($resultados as $qIndex => &$preguntaResultado) {
            $totalPregunta = $preguntaResultado['total_votos_pregunta'];
            if ($totalPregunta > 0) {
                foreach ($preguntaResultado['opciones'] as $oIndex => &$opcionResultado) {
                    $opcionResultado['porcentaje'] = round(($opcionResultado['conteo'] / $totalPregunta) * 100, 1);
                }
            }
        }

        return ['total_participantes' => $totalVotos, 'preguntas' => $resultados];
    }
}
?>