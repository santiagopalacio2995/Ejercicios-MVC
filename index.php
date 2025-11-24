<?php



// Definir controlador y acción por defecto (Home)
$controller = isset($_GET['c']) ? $_GET['c'] : 'home';
$action = isset($_GET['a']) ? $_GET['a'] : 'index';


$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = "app/controllers/" . $controllerName . ".php";


if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    if (class_exists($controllerName)) {
        $object = new $controllerName();
        
        if (method_exists($object, $action)) {
            $object->$action(); 
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