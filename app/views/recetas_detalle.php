<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Receta: <?php echo $receta['titulo']; ?></title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 20px auto; padding: 0 15px; }
        h1 { color: #d9534f; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        h2 { color: #5cb85c; }
        ul, ol { line-height: 1.6; }
    </style>
</head>
<body>
    <h1>Receta: <?php echo $receta['titulo']; ?></h1>
    <a href="index.php?c=recetas&a=index">⬅ Volver al Listado</a>
    <hr>

    <h2>Ingredientes</h2>
    <ul>
        <?php
        // Convertir la cadena de ingredientes separada por salto de línea en una lista HTML
        $ingredientesArray = array_filter(explode("\n", $receta['ingredientes']));
        foreach ($ingredientesArray as $ingrediente) {
            echo '<li>' . trim($ingrediente) . '</li>';
        }
        ?>
    </ul>

    <h2>Pasos de Preparación</h2>
    <ol>
        <?php
        // Convertir la cadena de pasos separada por salto de línea en una lista ordenada HTML
        $pasosArray = array_filter(explode("\n", $receta['pasos']));
        foreach ($pasosArray as $paso) {
            echo '<li>' . trim($paso) . '</li>';
        }
        ?>
    </ol>
</body>
</html>