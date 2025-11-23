<?php
// index.php - El Enrutador Principal

// 1. Definir controlador y acción por defecto (Home)
$controller = isset($_GET['c']) ? $_GET['c'] : 'home';
$action = isset($_GET['a']) ? $_GET['a'] : 'index';

// 2. Construir el nombre del archivo del controlador
// Ejemplo: si c=tareas, busca TareasController
$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = "app/controllers/" . $controllerName . ".php";

// 3. Verificar si el archivo existe y cargarlo
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    if (class_exists($controllerName)) {
        $object = new $controllerName();
        
        if (method_exists($object, $action)) {
            $object->$action(); // Ejecuta la acción
        } else {
            echo "Error: La acción '$action' no existe.";
        }
    } else {
        echo "Error: La clase '$controllerName' no existe.";
    }
} else {
    echo "<h1>Error 404</h1><p>El ejercicio o página que buscas no existe.</p>";
}
?>