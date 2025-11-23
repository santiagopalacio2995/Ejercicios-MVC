<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plataforma de Recetas</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 20px auto; padding: 0 15px; }
        .receta-card { border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .receta-card h3 { color: #d9534f; margin-top: 0; }
        .receta-card a { margin-right: 15px; text-decoration: none; color: #337ab7; }
        .receta-card a.eliminar { color: red; }
    </style>
</head>
<body>
    <h1>Ejercicio 8: Plataforma de Recetas</h1>
    <a href="index.php">⬅ Volver al Menú Principal</a> | <a href="index.php?c=recetas&a=crear">➕ Añadir Nueva Receta</a>
    <hr>

    <h2>Todas las Recetas</h2>
    <?php if (empty($recetas)): ?>
        <p>Aún no hay recetas en la plataforma. ¡Crea una!</p>
    <?php else: ?>
        <?php foreach ($recetas as $receta): ?>
            <div class="receta-card">
                <h3><?php echo $receta['titulo']; ?></h3>
                
                <a href="index.php?c=recetas&a=ver&id=<?php echo $receta['id']; ?>">Ver Receta Completa</a>
                
                <a href="index.php?c=recetas&a=eliminar&id=<?php echo $receta['id']; ?>" class="eliminar" onclick="return confirm('¿Eliminar la receta de <?php echo $receta['titulo']; ?>?');">Eliminar</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>