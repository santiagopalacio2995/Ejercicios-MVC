<?php
require_once 'app/models/EncuestaModel.php';

class EncuestasController {
    private $model;

    public function __construct() {
        $this->model = new EncuestaModel();
    }

    public function index() {
        $encuestas = $this->model->obtenerEncuestas();
        require_once 'app/views/encuestas_lista.php';
    }

    // Muestra el formulario de creación o procesa la creación
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['titulo'])) {
            $titulo = $_POST['titulo'];
            $preguntas_raw = $_POST['pregunta'] ?? [];
            $opciones_raw = $_POST['opciones'] ?? [];
            
            $preguntas_finales = [];

            // Procesar las preguntas y opciones
            foreach ($preguntas_raw as $qIndex => $preguntaTexto) {
                if (!empty(trim($preguntaTexto))) {
                    // Separar opciones por salto de línea y filtrar vacías
                    $opciones = array_filter(array_map('trim', explode("\n", $opciones_raw[$qIndex] ?? '')));
                    
                    if (count($opciones) >= 2) {
                        $preguntas_finales[] = [
                            'texto' => htmlspecialchars(trim($preguntaTexto)),
                            'opciones' => array_map('htmlspecialchars', $opciones)
                        ];
                    }
                }
            }

            if (!empty($preguntas_finales)) {
                $this->model->crearEncuesta($titulo, $preguntas_finales);
                header("Location: index.php?c=encuestas&a=index");
                exit();
            } else {
                $error = "Debe crear al menos una pregunta con dos o más opciones.";
            }
        }
        
        require_once 'app/views/encuestas_crear.php';
    }

    // Muestra el formulario para responder o procesa la respuesta
    public function responder() {
        $id = $_GET['id'] ?? null;
        $encuesta = $this->model->obtenerEncuestaPorId($id);

        if (!$encuesta) {
            header("Location: index.php?c=encuestas&a=index");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $respuestas_post = $_POST['respuesta'] ?? [];
            
            if (count($respuestas_post) == count($encuesta['preguntas'])) {
                $respuestas_procesadas = [];
                // Guardar como [indice_pregunta => indice_opcion_elegida]
                foreach ($respuestas_post as $qIndex => $oIndex) {
                    $respuestas_procesadas[$qIndex] = intval($oIndex);
                }
                
                $this->model->guardarRespuesta($id, $respuestas_procesadas);
                header("Location: index.php?c=encuestas&a=resultados&id=" . $id);
                exit();
            } else {
                $error = "Por favor, responde todas las preguntas de la encuesta.";
            }
        }

        require_once 'app/views/encuestas_responder.php';
    }

    // Muestra los resultados de la encuesta
    public function resultados() {
        $id = $_GET['id'] ?? null;
        $encuesta = $this->model->obtenerEncuestaPorId($id);

        if (!$encuesta) {
            header("Location: index.php?c=encuestas&a=index");
            exit();
        }

        $resultados = $this->model->analizarResultados($id);
        
        require_once 'app/views/encuestas_resultados.php';
    }
}
?>