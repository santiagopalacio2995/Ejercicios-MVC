<?php
class RecetaModel {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['recetas'])) {
            // Recetas de ejemplo para que la plataforma no esté vacía al inicio
            if (empty($_SESSION['recetas'])) {
                $_SESSION['recetas'] = [
                    [
                        'id' => uniqid(),
                        'titulo' => 'Pastas Carbonara',
                        'ingredientes' => "200g de Spaghetti\n100g de o tocineta\n2 yemas de huevo\n50g de Queso crema\nPimienta negra",
                        'pasos' => "1. Cocinar la tocineta hasta que esté crujiente.\n2. Batir las yemas con la tocineta y la pimienta.\n3. Cocinar el spaghetti.\n4. Mezclar el spaghetti caliente con la salsa de huevo.\n5. Servir inmediatamente."
                    ]
                ];
            }
        }
    }

    public function obtenerRecetas() {
        // Devolvemos las recetas en orden, las más nuevas primero
        return array_reverse($_SESSION['recetas']);
    }

    public function obtenerRecetaPorId($id) {
        foreach ($_SESSION['recetas'] as $receta) {
            if ($receta['id'] == $id) {
                return $receta;
            }
        }
        return null;
    }

    public function guardarReceta($titulo, $ingredientes, $pasos) {
        $nuevaReceta = [
            'id' => uniqid(),
            'titulo' => htmlspecialchars($titulo),
            'ingredientes' => htmlspecialchars($ingredientes),
            'pasos' => htmlspecialchars($pasos)
        ];
        $_SESSION['recetas'][] = $nuevaReceta;
    }

    public function eliminarReceta($id) {
        foreach ($_SESSION['recetas'] as $key => $receta) {
            if ($receta['id'] == $id) {
                unset($_SESSION['recetas'][$key]);
                // Reindexar el array para evitar IDs vacíos
                $_SESSION['recetas'] = array_values($_SESSION['recetas']); 
                return true;
            }
        }
        return false;
    }
}
?>